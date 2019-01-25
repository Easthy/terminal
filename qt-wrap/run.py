# -*- coding: utf-8 -*-
import os 
import sys
from functools import partial
from datetime import datetime
import json

from PyQt5 import *
from PyQt5 import Qt, QtCore, QtGui, QtWidgets, QtPrintSupport
from PyQt5.QtCore import QEvent, pyqtSlot, pyqtSignal
from PyQt5.QtWidgets import QMainWindow, QWidget, QAction, QApplication, QPushButton, QVBoxLayout, QDesktopWidget
from PyQt5.QtGui import QIcon, QKeyEvent, QKeySequence, QFont
from PyQt5 import QtWebEngineWidgets, QtNetwork


class Terminal(QMainWindow):
    host_method = {
        "emias.info": 'showKeyboard'
    }
    pages = {
        "home": "https://test-terminal"
    }
    host_allowed = ['emias.info', 'test-terminal']

    def __init__(self):
        super().__init__()
        self.initUI()
        event = ''

    def initUI(self):
        self.statusBar().hide()
        self.setObjectName("MainWindow")
        # Hide window frame
        self.setWindowFlags(QtCore.Qt.FramelessWindowHint)
       
        self.webView = WebEngineView()
        self.openPage(self.pages['home'])
        self.webView.setObjectName("webView")
        self.webView.setAttribute(QtCore.Qt.WA_AcceptTouchEvents, True)
        
        self.webView.resize(1080, 1920)
        self.setGeometry(0, 0, 1080, 1920)
        self.resize(1080, 1920)

        self.DigitKeyboard = DigitKeyboard()

        self.wgt = QWidget()
        self.setCentralWidget(self.wgt)
        self.main_layout = QVBoxLayout()
        self.main_layout.addWidget(self.webView)
        self.main_layout.addWidget(self.DigitKeyboard)
        self.main_layout.setContentsMargins(0, 0, 0, 0)
        self.wgt.setLayout(self.main_layout)
        self.wgt.setContextMenuPolicy(QtCore.Qt.PreventContextMenu)

        self.page = self.webView.page()
        self.page.profile().clearHttpCache()
        self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.JavascriptEnabled, True)
        self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.AllowRunningInsecureContent, True)
        self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.PluginsEnabled, True)
        
        self.showFullScreen() #FullScreen
        self.hideKeyboard()
        # self.webView.loadStarted.connect(self.hideKeyboard)
        self.webView.urlChanged.connect(self.afterPageLoad)
        self.webView.loadFinished.connect(self.disableSelection)
        # self.webView.loadFinished.connect(self.afterPageLoad)
        # Grant webcam using
        self.webView.page().featurePermissionRequested.connect(self.grantFeatures)
        # QT keyboard settings
        self.DigitKeyboard.keyClick.connect(self.clickHandler)
        self.DigitKeyboard.homeClick.connect(partial(self.openPage, self.pages['home']))
        self.webView.focusProxy().installEventFilter(self)
        # Enable filter by setting to 1
        self.filter_edge = 0
        self.filter_series = 0
        self.filter_short = 0
        self.filter_long = 0
        self.filter_immed_move = 0
        # Default event filter settings
        self.press_timestamp = 0
        self.release_timestamp = 0
        self.press_min_pause = 0.15
        self.press_min_duration = 0.2
        self.press_max_duration = 0.55
        self.move_after_release_min = 0.5
        self.move_after_press_min = 0.1
        self.cursor_x_min = 20
        self.cursor_x_max = 1060
        self.cursor_y_min = 20
        self.cursor_y_max = 1900
        self.cursor_x = 0
        self.cursor_y = 0
        self.press_release_distance = 500
        self.scr_set_delay = 60000 # ms
        self.scr_up_delay = 1800000 # ms
        # Long press to activate screensaver
        self.press_scr_activation = 5 # s
        self.scr_manual_activated = 0
        # Screensave active
        self.scr_on = 1
        # Activate screensaver on long press
        self.scr_long_activation = 0
        # Load and overwrite default settings
        self.load_settings()
        # Screensaver settings
        self.timer_scr_set = QtCore.QTimer()
        self.timer_scr_set.timeout.connect(self.setScreensaver)
        self.resetTimer(self.timer_scr_set, self.scr_set_delay)
        # Screensaver update timer
        self.timer_scr_up = QtCore.QTimer()
        self.timer_scr_up.timeout.connect(self.setScreensaver)
        # Last visited host
        self.last_host = False
        # Center application window
        qtRectangle = self.frameGeometry()
        centerPoint = QDesktopWidget().availableGeometry().center()
        qtRectangle.moveCenter(centerPoint)
        self.move(qtRectangle.topLeft())

    def grantFeatures(self):
        """Grant permissions to capture webcam video"""
        self.page.setFeaturePermission(self.page.url(), WebEnginePage.MediaAudioVideoCapture, True)
        # If video still can not be captured due to user requests blocking
        # self.page.setFeaturePermission(self.page.url(), WebEnginePage.MediaAudioCapture, True)
        # self.page.setFeaturePermission(self.page.url(), WebEnginePage.MediaVideoCapture, True)

    def setScreensaver(self):
        """Enable screensaver by redirecting to home page with get parameter"""
        # Hide emias keyboard first
        self.hideKeyboard()
        script = ''.join(["window.location.href = '", self.pages['home'], "/?activate_screensaver=1'"])
        self.webView.page().runJavaScript(script)
        self.stopTimer(self.timer_scr_set)
        self.resetTimer(self.timer_scr_up, self.scr_up_delay)

    def resetTimer(self, timer, delay):
        """Reset screensaver timer if user action detected"""
        if not self.scr_on:
            return 
        timer.setInterval(delay)
        timer.start()

    def stopTimer(self, timer):
        """Stop screensaver timer"""
        timer.stop()
        # self.timer_scr_set.stop()

    def load_settings(self):
        """Load settings file"""
        dir_path = os.path.dirname(os.path.realpath(__file__))
        settings_path = '/'.join([dir_path, "settings.json"])
        if ( not os.path.isfile(settings_path) ):
            print('Settings file not found')
            return False
        with open( settings_path, 'r') as f:
            settings = json.loads(f.read())
            for k,v in settings.items():
                setattr(self, k, v)
        f.close()

    def eventFilter(self, object, event):
        """Filter false events generated by sensor screen"""
        cursor = QtGui.QCursor()
        cursor_x = cursor.pos().x()
        cursor_y = cursor.pos().y()
        event_timestamp = datetime.utcnow().timestamp()
        readable_event_timestamp = datetime.utcfromtimestamp(event_timestamp).strftime('%Y-%m-%d %H:%M:%S.%f')

        # This filter should be enabled only with 90 degree rotated screen
        if self.filter_edge and \
           (cursor_x < self.cursor_x_min or 
           cursor_x > self.cursor_x_max or 
           cursor_y < self.cursor_y_min or 
           cursor_y > self.cursor_y_max):
            return True

        # Filter series of fast false click
        if event.type() == QtCore.QEvent.MouseButtonPress:
            if self.filter_series and \
              (self.release_timestamp > 0 and 
               event_timestamp - self.release_timestamp < self.press_min_pause):
                return True
            self.press_timestamp = event_timestamp
            self.cursor_x = cursor_x
            self.cursor_y = cursor_y

        # Filter short and long press. Reset screensaver timer 
        if event.type() == QtCore.QEvent.MouseButtonRelease:
            press_duration = event_timestamp - self.press_timestamp
            # Activate screensaver on long touch
            if (self.scr_long_activation and press_duration >= self.press_scr_activation):
                self.scr_manual_activated = 0 if self.scr_manual_activated else 1
                if self.scr_manual_activated:
                    self.setScreensaver()
                else:
                    self.openPage(self.pages['home'])
                return False
            # Filter out if screensaver activated
            if self.scr_manual_activated:
                return True
            # Filters
            if self.filter_short and \
              (press_duration < self.press_min_duration):
                return True
            if self.filter_long and \
              (press_duration > self.press_max_duration and
               press_duration < self.press_scr_activation):
                return True
            if ((cursor_x - self.cursor_x) > self.press_release_distance or \
               (cursor_y - self.cursor_y) > self.press_release_distance):
                return True
            self.release_timestamp = event_timestamp
            # Reset screensaver set timer when user touchs the screen
            self.resetTimer(self.timer_scr_set, self.scr_set_delay)
            # Stop screensaver updater timer when user touchs the screen
            self.stopTimer(self.timer_scr_up)

        # Filter move when it starts immediately
        if self.filter_immed_move and event.type() == QtCore.QEvent.MouseMove:
            if(self.press_timestamp < self.release_timestamp):
                return True
            if(event_timestamp - self.release_timestamp < self.move_after_release_min):
                return True
            if(event_timestamp - self.press_timestamp < self.move_after_press_min):
                return True

        return False

    def event_log(self,d):
        """Log events"""
        self.save_file("events.log", "\n"+json.dumps(d))

    def save_file(self,path,file):
        """Save file"""
        dir_path = os.path.dirname(os.path.realpath(__file__))
        path = '/'.join([dir_path, path])
        os.makedirs(os.path.dirname(path), exist_ok=True)
        with open(path,'a') as f:
            f.write(file)
            f.close()

    def openPage(self,url):
        """Open web page with certain URL"""
        self.webView.setUrl(QtCore.QUrl(url))

    def disableSelection(self):
        """Inject css on every page, including external resources such an emias.info"""
        style = "-webkit-touch-callout: none; -webkit-user-select: none; user-select: none;"
        script = "document.querySelector('html').setAttribute('style', '%s')" %(style)
        self.webView.page().runJavaScript( script )

    def afterPageLoad(self):
        """Callback after page is loaded"""
        # Hide  keyboard
        self.hideKeyboard()
        # Spot page params
        Qurl = self.webView.url()
        host = Qurl.host()
        path = Qurl.path()
        location = ''.join([host, path])
        # Check if host is allowed to be displayed
        if host not in self.host_allowed:
            print(' '.join(['Page', host, 'is not allowed to be displayed. Coming home...']))
            self.openPage(self.pages['home'])
            return
        # Remove cookies if host is changed
        if self.last_host != host:
            self.page.profile().cookieStore().deleteAllCookies()
        print(' '.join(["Page loaded:", str(host), str(path)]))
        # Catch current host
        self.last_host = host
        # Callback part
        if host in self.host_method:
            print(''.join(["Calling host specific methods:", str(host)]))
            getattr(self, self.host_method[host])() 

    def showKeyboard(self):
        """Show QT keyboard"""
        print("showKeyboard function")
        self.DigitKeyboard.show()

    def hideKeyboard(self):
        """Hide QT keyboard"""
        print("hideKeyboard function")
        self.DigitKeyboard.hide()

    def printDoc(self):
        """Print using default printer"""
        doc = QtGui.QTextDocument("Hello World!\nThe second row\n----------")
        printer = QtPrintSupport.QPrinter()
        printer.setOrientation(QtPrintSupport.QPrinter.Portrait)
        printer.setPaperSize(QtCore.QSizeF(72, 144), printer.Millimeter)
        printer.setPageMargins(2, 2, 2, 2, QtPrintSupport.QPrinter.Millimeter)
        printer.setFullPage(True)
        doc.print_(printer)

    @pyqtSlot(str)
    def clickHandler(self,ch):
        # Getting current focus
        recipient = self.webView.focusProxy()
        modifiers = QtCore.Qt.NoModifier
        qt_key = getattr(QtCore.Qt, ch)
        self.event = QKeyEvent(QEvent.KeyPress, qt_key, modifiers, QKeySequence(qt_key).toString())
        QApplication.postEvent(recipient, self.event)
        # Reset timer when operate with keyboard
        self.resetTimer(self.timer_scr_set, self.scr_set_delay)

class WebEngineView(QtWebEngineWidgets.QWebEngineView):
    """Custom QWebEngineView subclass."""
    def __init__(self, parent=None):
        super().__init__(parent)
        self.setPage(WebEnginePage(parent=self))

class WebEnginePage(QtWebEngineWidgets.QWebEnginePage):
    """Custom QWebEnginePage subclass with ignoring ssl-certificate errors."""
    certificate_error = pyqtSignal()
    link_clicked = pyqtSignal(QtCore.QUrl)
    def __init__(self, parent=None):
        super().__init__(parent)
        
    def certificateError(self, error):
        return True

class CustomPushButton(QPushButton):
    """Custom buttons"""
    def __init__(self, Text, symbol, parent = None):
        super().__init__(Text, parent)
        self.symbol = symbol
        self.clicked.connect(self.on_clicked)

    @pyqtSlot()
    def on_clicked(self):
        self.symbolClick.emit(self.symbol)

    symbolClick = pyqtSignal(str)

class DigitKeyboard(QWidget):
    """Custom QT keyboard"""
    def __init__(self):
        super().__init__()
        key_1 = CustomPushButton("1","Key_1",self)
        key_2 = CustomPushButton("2","Key_2",self)
        key_3 = CustomPushButton("3","Key_3",self)
        key_4 = CustomPushButton("4","Key_4",self)
        key_5 = CustomPushButton("5","Key_5",self)
        key_6 = CustomPushButton("6","Key_6",self)
        key_7 = CustomPushButton("7","Key_7",self)
        key_8 = CustomPushButton("8","Key_8",self)
        key_9 = CustomPushButton("9","Key_9",self)
        key_0 = CustomPushButton("0","Key_0",self)
        key_backspace = CustomPushButton("<","Key_Backspace",self)
        key_back = CustomPushButton("Назад","Назад",self)

        key_1.setFont( QFont("Times", 35, QFont.Bold) )
        key_2.setFont( QFont("Times", 35, QFont.Bold) )
        key_3.setFont( QFont("Times", 35, QFont.Bold) )
        key_4.setFont( QFont("Times", 35, QFont.Bold) )
        key_5.setFont( QFont("Times", 35, QFont.Bold) )
        key_6.setFont( QFont("Times", 35, QFont.Bold) )
        key_7.setFont( QFont("Times", 35, QFont.Bold) )
        key_8.setFont( QFont("Times", 35, QFont.Bold) )
        key_9.setFont( QFont("Times", 35, QFont.Bold) )
        key_0.setFont( QFont("Times", 35, QFont.Bold) )
        key_backspace.setFont( QFont("Times", 35, QFont.Bold) )
        key_back.setFont( QFont("Times", 35, QFont.Bold) )

        key_1.resize(340, 110)
        key_2.resize(340, 110)
        key_3.resize(340, 110)
        key_4.resize(340, 110)
        key_5.resize(340, 110)
        key_6.resize(340, 110)
        key_7.resize(340, 110)
        key_8.resize(340, 110)
        key_9.resize(340, 110)
        key_0.resize(340, 110)
        key_backspace.resize(340, 110)
        key_back.resize(340, 110)

        key_1.move(15, 15)
        key_2.move(370, 15)
        key_3.move(725, 15)
        key_4.move(15, 140)
        key_5.move(370, 140)
        key_6.move(725, 140)
        key_7.move(15, 265)
        key_8.move(370, 265)
        key_9.move(725, 265)
        key_0.move(370, 390)
        key_backspace.move(725, 390)
        key_back.move(15, 390)

        self.resize(1080,755)
        self.setMinimumSize(1080,520)
        self.setGeometry(0,0,1080,755)
        self.setFocusPolicy(0)
        key_1.setFocusPolicy(0)
        key_2.setFocusPolicy(0)
        key_3.setFocusPolicy(0)
        key_4.setFocusPolicy(0)
        key_5.setFocusPolicy(0)
        key_6.setFocusPolicy(0)
        key_7.setFocusPolicy(0)
        key_8.setFocusPolicy(0)
        key_9.setFocusPolicy(0)
        key_0.setFocusPolicy(0)
        key_backspace.setFocusPolicy(0)

        key_1.symbolClick.connect(self.key_pressed)
        key_2.symbolClick.connect(self.key_pressed)
        key_3.symbolClick.connect(self.key_pressed)
        key_4.symbolClick.connect(self.key_pressed)
        key_5.symbolClick.connect(self.key_pressed)
        key_6.symbolClick.connect(self.key_pressed)
        key_7.symbolClick.connect(self.key_pressed)
        key_8.symbolClick.connect(self.key_pressed)
        key_9.symbolClick.connect(self.key_pressed)
        key_0.symbolClick.connect(self.key_pressed)
        key_backspace.symbolClick.connect(self.key_pressed)
        key_back.symbolClick.connect(self.home_pressed)

    @pyqtSlot(str)
    def key_pressed(self, ch):
        """Custom keyboard click"""
        self.keyClick.emit(ch)

    @pyqtSlot()
    def home_pressed(self):
        """Custom keyboard click home"""
        self.homeClick.emit()

    keyClick = pyqtSignal(str)
    homeClick = pyqtSignal()

if __name__ == '__main__':
    app = QApplication(sys.argv)
    ex = Terminal()
    sys.exit(app.exec_())