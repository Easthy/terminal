# Install the following before run
sudo pip3 install pytz

sudo apt-get install python3-sip

sudo apt-get install python3-pyqt5

sudo apt-get install python3-pyqt5.qtwebengine

sudo pip3 install PyQt5 

## To run debugger run app as follow:
python3.6 run.py --remote-debugging-port=8081
## Then open in chromium-based browser url http://127.0.0.1:8081



MediaStreamRecorder

VIDEOJS: Using video.js 7.2.3 with videojs-record 2.4.1 and recordrtc 5.4.8
RecordRTC.js:1039 Using recorderType: WhammyRecorder
RecordRTC.js:3515 Using frames-interval: 10
adapter.js:5345 URL.createObjectURL(stream) is deprecated, please use elem.srcObject = stream instead.
deprecated @ adapter.js:5345
URL.createObjectURL @ adapter.js:3994
setSrcObject @ RecordRTC.js:1860
WhammyRecorder.record @ RecordRTC.js:3563
initRecorder @ RecordRTC.js:94
MRecordRTC.startRecording @ RecordRTC.js:1214
start @ videojs.record.js:1340
startRecording @ videojs.record.js:2450
(anonymous) @ videojs.record.js:2416
n @ video.min.js:12
t @ video.min.js:12
o.dispatcher.o.dispatcher @ video.min.js:12
bt @ video.min.js:12
trigger @ video.min.js:12
ya.(anonymous function) @ video.min.js:12
n @ video.min.js:12
n @ video.min.js:12
o.dispatcher.o.dispatcher @ video.min.js:12
RecordRTC.js:3582 canvas resolutions 320 * 240
RecordRTC.js:3583 video width/height 320 * 240
RecordRTC.js:699 Recorder state changed: recording
RecordRTC.js:99 Initialized recorderType: WhammyRecorder for output-type: video
webcam:101 started recording!
RecordRTC.js:1039 Using recorderType: StereoAudioRecorder
RecordRTC.js:2508 StereoAudioRecorder is set to record number of channels:  2
RecordRTC.js:2917 sample-rate 44100
RecordRTC.js:2918 buffer-size 4096
RecordRTC.js:699 Recorder state changed: recording
RecordRTC.js:99 Initialized recorderType: StereoAudioRecorder for output-type: audio
RecordRTC.js:59 started recording video stream.
adapter.js:5345 URL.createObjectURL(stream) is deprecated, please use elem.srcObject = stream instead.
deprecated @ adapter.js:5345
URL.createObjectURL @ adapter.js:3994
setSrcObject @ RecordRTC.js:1860
WhammyRecorder.record @ RecordRTC.js:3563
startRecording @ RecordRTC.js:64
(anonymous) @ RecordRTC.js:1217
config.initCallback @ RecordRTC.js:86
onAudioProcessDataAvailable @ RecordRTC.js:3058
RecordRTC.js:3582 canvas resolutions 320 * 240
RecordRTC.js:3583 video width/height 320 * 240
RecordRTC.js:699 Recorder state changed: recording
RecordRTC.js:59 started recording audio stream.
RecordRTC.js:699 Recorder state changed: recording
blob:https://test-terminal/12efacac-6891-4490-bf4a-9eead1da0fa3:2 whammyInWebWorker ->frames [{…}]
RecordRTC.js:125 Stopped recording audio stream.
RecordRTC.js:166 audio/wav -> 16.4 KB
webcam:108 finished recording:  {audio: Blob(16428), video: Blob(390)}
RecordRTC.js:699 Recorder state changed: stopped
RecordRTC.js:125 Stopped recording video stream.
RecordRTC.js:699 Recorder state changed: stopped
webcam:137 segment: 1
blob:https://test-terminal/3b5ea35f-00c4-46a2-975a-af13fcc18af1:2 whammyInWebWorker ->frames [undefined]


duration:17
"data:image/webp;base64,UklGRu4AAABXRUJQVlA4WAoAAAAQAAAAPwEA7wAAQUxQSBUAAAABBxARESCQtFn//Nsf0f/k/t9/AQMAVlA4ILIAAABQEwCdASpAAfAAPm02mUmkIyKhICgAgA2JaW7hd2EbQAnsA99snIe+2TkPfbJyHvtk5D32ych77ZOQ99snIe+2TkPfbJyHvtk5D32ych77ZOQ99snIe+2TkPfbJyHvtk5D32ych77ZOQ99snIe+2TkPfbJyHvtk5D32ych77ZOQ99snIe+2TkPfbJyHvtk5D32ych77ZOQ99snIe+2TkPfbJiAAP7/6wAAAAAAAAAAAAAA"

whammyInWebWorker ->frames 


blob:https://test-terminal/99958b84-2ad2-4531-879d-48f34090a0f1:317 Uncaught TypeError: Cannot read property 'image' of undefined
    at blob:https://test-terminal/99958b84-2ad2-4531-879d-48f34090a0f1:317
    at Array.map (<anonymous>)
    at whammyInWebWorker (blob:https://test-terminal/99958b84-2ad2-4531-879d-48f34090a0f1:316)
    at onmessage (blob:https://test-terminal/99958b84-2ad2-4531-879d-48f34090a0f1:323)
(anonymous) @ blob:https://test-terminal/99958b84-2ad2-4531-879d-48f34090a0f1:317
whammyInWebWorker @ blob:https://test-terminal/99958b84-2ad2-4531-879d-48f34090a0f1:316
onmessage @ blob:https://test-terminal/99958b84-2ad2-4531-879d-48f34090a0f1:323

        var webm = new ArrayToWebM(frames.map(function(frame) {
            var webp = parseWebP(parseRIFF(atob(frame.image.slice(23))));
            webp.duration = frame.duration;
            return webp;
        }));


Uncaught TypeError: Cannot read property 'image' of undefined

/var/www/terminal/app/webroot/node_modules/recordrtc/RecordRTC.js
function whammyInWebWorker(frames) {