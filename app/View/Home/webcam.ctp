<script src="/js/RecordRTC.js"></script>
<script src="/js/adapter-latest.js"></script>
<style>
    video {
      background-color: #00007a;
      width: 950px;
      height: 800px;
      margin: 65px 0 0 15px;
    }
</style>

<video id="your-video-id" controls="" autoplay=""></video>

<script type="text/javascript">
    // capture camera and/or microphone
    navigator.mediaDevices.getUserMedia({ video: true, audio: true }).then(function(camera) {

    // preview camera during recording
    document.getElementById('your-video-id').muted = true;
    setSrcObject(camera, document.getElementById('your-video-id'));

    // recording configuration/hints/parameters
    var recordingHints = {
        type: 'video',
        recorderType: MediaStreamRecorder,
        mimeType: 'video/webm\;codecs=vp9'
    };

    // initiating the recorder
    var recorder = RecordRTC(camera, recordingHints);

    // starting recording here
    recorder.startRecording();

    // auto stop recording after 300 seconds (5 minutes)
    var milliSeconds = 300 * 1000;
    setTimeout(
        function() {
            // stop recording
            recorder.stopRecording(function() {
                                
                // get recorded blob
                var blob = recorder.getBlob();

                // generating a random file name
                var fileName = getFileName('webm');

                // we need to upload "File" --- not "Blob"
                var fileObject = new File([blob], fileName, {
                    type: 'video/webm',
                });

                uploadToPHPServer(fileObject, function(response, fileDownloadURL) {
                    if(response !== 'ended') {
                        document.getElementById('header').innerHTML = response; // upload progress
                        return;
                    }
                    document.getElementById('header').innerHTML = '<a href="' + fileDownloadURL + '" target="_blank">' + fileDownloadURL + '</a>';
                    alert('Successfully uploaded recorded blob.');
                    // preview uploaded file
                    document.getElementById('your-video-id').src = fileDownloadURL;
                    // open uploaded file in a new tab
                    window.open(fileDownloadURL);
                });

                // release camera
                document.getElementById('your-video-id').srcObject = document.getElementById('your-video-id').src = null;
                camera.getTracks().forEach(function(track) {
                    track.stop();
                });
            });
        }, milliSeconds);
    });

    function uploadToPHPServer(blob, callback) {
        // create FormData
        var formData = new FormData();
        formData.append('video-filename', blob.name);
        formData.append('video-blob', blob);
        callback('Uploading recorded-file to server.');
        makeXMLHttpRequest('/home/save_video/', formData, function(progress) {
            if (progress !== 'upload-ended') {
                callback(progress);
                return;
            }
            var initialURL = '/home/save_video/' + blob.name;
            callback('ended', initialURL);
        });
    }

    function makeXMLHttpRequest(url, data, callback) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState == 4 && request.status == 200) {
                if (request.responseText === 'success') {
                    callback('upload-ended');
                    return;
                }
                alert(request.responseText);
                return;
            }
        };
        request.upload.onloadstart = function() {
            callback('PHP upload started...');
        };
        request.upload.onprogress = function(event) {
            callback('PHP upload Progress ' + Math.round(event.loaded / event.total * 100) + "%");
        };
        request.upload.onload = function() {
            callback('progress-about-to-end');
        };
        request.upload.onload = function() {
            callback('PHP upload ended. Getting file URL.');
        };
        request.upload.onerror = function(error) {
            callback('PHP upload failed.');
        };
        request.upload.onabort = function(error) {
            callback('PHP upload aborted.');
        };
        request.open('POST', url);
        request.send(data);
    }

    // this function is used to generate random file name
    function getFileName(fileExtension) {
        var d = new Date();
        var year = d.getUTCFullYear();
        var month = d.getUTCMonth();
        var date = d.getUTCDate();
        return 'RecordRTC-' + year + month + date + '-' + getRandomString() + '.' + fileExtension;
    }

    function getRandomString() {
        if (window.crypto && window.crypto.getRandomValues && navigator.userAgent.indexOf('Safari') === -1) {
            var a = window.crypto.getRandomValues(new Uint32Array(3)),
                token = '';
            for (var i = 0, l = a.length; i < l; i++) {
                token += a[i].toString(36);
            }
            return token;
        } else {
            return (Math.random() * new Date().getTime()).toString(36).replace(/\./g, '');
        }
    }
</script>
<script src="/js/common.js"></script>
