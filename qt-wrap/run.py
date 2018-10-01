# -*- coding: utf-8 -*-

import sys
sys.path.append('/usr/local/lib/python3.6/dist-packages/PyQt5/')
from PyQt5 import *
from PyQt5 import Qt, QtCore, QtGui, QtWidgets
from PyQt5.QtCore import QEvent, pyqtSlot, pyqtSignal
from PyQt5.QtWidgets import QMainWindow, QWidget, QAction, qApp, QApplication, QPushButton, QFrame, QSplitter, QVBoxLayout
from PyQt5.QtGui import QIcon, QKeyEvent, QKeySequence, QFont
from PyQt5 import QtWebEngineWidgets
from PyQt5.QtWebChannel import QWebChannel
from functools import partial

class Example(QMainWindow):
    host_method = {
        "emias.info": 'showKeyboard'
    }
    pages = {
        "home": "http://test-terminal"
    }
    def __init__(self):
        super().__init__()
        self.initUI()
        event = ''

    def initUI(self):
        self.statusBar().hide()
        self.setObjectName("MainWindow")
       
        self.webView = QtWebEngineWidgets.QWebEngineView()
        self.openPage(self.pages['home'])
        self.webView.setObjectName("webView")
        self.webView.setAttribute(QtCore.Qt.WA_AcceptTouchEvents, True)
        
        self.webView.resize(1080, 1920)
        self.setGeometry(0,0,1080,1920)
        self.resize(1080, 1920)

        self.DigitKeyboard = DigitKeyboard()

        self.wgt = QWidget()
        self.setCentralWidget(self.wgt)
        self.main_layout = QVBoxLayout()
        self.main_layout.addWidget(self.webView)
        self.main_layout.addWidget(self.DigitKeyboard)
        self.main_layout.setContentsMargins(0,0,0,0)
        self.wgt.setLayout(self.main_layout)
        self.wgt.setContextMenuPolicy(QtCore.Qt.PreventContextMenu)


        self.page = self.webView.page()
        # self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.DeveloperExtrasEnabled, True)
        # <script type="text/javascript" src="https://getfirebug.com/firebug-lite.js"></script>
        self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.JavascriptEnabled, True)
        self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.AllowRunningInsecureContent, True)
        # self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.ShowScrollBars, True)
        self.page.settings().setAttribute(QtWebEngineWidgets.QWebEngineSettings.PluginsEnabled, True)

        self.show()
        self.webView.loadStarted.connect(self.hideKeyboard) # loadStarted
        self.webView.loadFinished.connect(self.disableSelection)
        self.webView.loadFinished.connect(self.afterPageLoad)
        # self.webView.triggerPageAction(self.afterPageLoad)
        self.DigitKeyboard.keyClick.connect(self.clickHandler)
        self.DigitKeyboard.homeClick.connect(partial(self.openPage,self.pages['home']))

    def openPage(self,url):
        self.webView.setUrl(QtCore.QUrl(url))

    def disableSelection(self):
        style = '-webkit-touch-callout: none; -webkit-user-select: none; user-select: none;'
        script = "document.querySelector('html').setAttribute('style','%s')" %(style)
        self.webView.page().runJavaScript( script );

    def afterPageLoad(self):
        Qurl = self.webView.url()
        host = Qurl.host()
        path = Qurl.path()
        location = host + path
        print('Page loaded: ' + str(host) + str(path) )
        if host in self.host_method:
            print('Calling host specific methods: '+str(host))
            getattr(self,self.host_method[host])() 

    def showKeyboard(self):
        print('showKeyboard function')
        self.DigitKeyboard.show()

    def hideKeyboard(self):
        print('hideKeyboard function')
        self.DigitKeyboard.hide()

    @pyqtSlot(str)
    def clickHandler(self,ch):
        recipient = self.webView.focusProxy()
        modifiers = QtCore.Qt.NoModifier
        qt_key = getattr(QtCore.Qt, ch)
        self.event = QKeyEvent(QEvent.KeyPress, qt_key, modifiers, QKeySequence(qt_key).toString() )
        QApplication.postEvent(recipient, self.event)

class CustomPushButton(QPushButton):
    def __init__(self, Text, symbol, parent = None):
        super().__init__(Text, parent)
        self.symbol = symbol
        self.clicked.connect(self.on_clicked)

    @pyqtSlot()
    def on_clicked(self):
        self.symbolClick.emit(self.symbol)

    symbolClick = pyqtSignal(str)


class DigitKeyboard(QWidget):
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
        self.keyClick.emit(ch)

    @pyqtSlot()
    def home_pressed(self):
        self.homeClick.emit()

    keyClick = pyqtSignal(str)
    homeClick = pyqtSignal()


if __name__ == '__main__':
    app = QApplication(sys.argv)
    ex = Example()
    sys.exit(app.exec_())