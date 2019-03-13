<script src="/js/RecordRTC.js"></script>
<script src="/js/adapter-latest.js"></script>
<style>
    video {
      background-color: #00007a;
      width: 950px;
      height: 800px;
      margin: 20px 0 0 15px;
    }
</style>

<div id="media-box" style="position: relative;">
    <div id="info-box" style="margin-top: 15px;font-size: 25px;color: yellow; font-weight: 700;"></div>
    <h2 id="recording-state" style="position: absolute; top:150px; left:50px; margin-top: 10px; margin-left: 10px; display: block; border: 0;line-height:1.5;z-index:1;"></h2>
    <video id="your-video-id" controls="" autoplay=""></video>
</div>

<div style="padding:25px; width:800px; margin: auto;">
<a id="record" href="javascript:void(0)" type="button" class="btn btn-2-green" style="float:left; padding: 10px;">Запись/Остановка</a>
<a id="send" href="javascript:void(0)" type="button" class="btn btn-2-yellow" style="float:right; padding: 10px;">Отправить</a>
</div>

<script type="text/javascript">
    $(function(){
        window.camer = null
        // capture camera and/or microphone
        navigator.mediaDevices.getUserMedia({ video: true, audio: true }).then(function(camera) {
            window.camera = camera;
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
            window.recorder = RecordRTC(camera, recordingHints);

            // auto stop recording after 300 seconds (5 minutes)
            var milliSeconds = 300 * 1000;
            setTimeout(
                function() {
                    stopRecording();
                }, milliSeconds
            );
        });

        function stopRecording(){
            // stop recording
            recorder.stopRecording();
        }

        function uploadToPHPServer(blob, callback) {
            // create FormData
            var formData = new FormData();
            formData.append('video-filename', blob.name);
            formData.append('video-blob', blob);
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
                    // alert(request.responseText);
                    return;
                }
            };
            request.upload.onloadstart = function() {
                $('#info-box').html('Дождитесь отправки видео.');
            };
            request.upload.onload = function() {
                $('#info-box').html('Видео успешно отправлено.<br>Вы будете направлены на главную страницу.');
                // setTimeout(function(){
                //     window.location.href = '/'
                // }, 3000);
            };
            request.upload.onerror = function(error) {
                $('#info-box').html('Видео не было отправлено.');
            };
            request.upload.onabort = function(error) {
                $('#info-box').html('Отправка видео прервана пользователем.');
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

        $(document).on('tap','#record',function(){
            $(this).toggleClass('recording').toggleClass('btn-2-red');
            if($(this).hasClass('recording')){
                // starting recording here
                recorder.startRecording();
                $('#recording-state').append('<img id="image-progress" src="https://cdn.webrtc-experiment.com/images/progress.gif">');
                $('#info-box').html('Идёт запись видео...');
            }else{
                stopRecording();
                $('#image-progress').remove();
                $('#info-box').html('Запись видео остановлена.');
            }
        });

        $(document).on('tap','#send',function(){
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
                // preview uploaded file
                // document.getElementById('your-video-id').src = fileDownloadURL;
                // open uploaded file in a new tab
                // window.open(fileDownloadURL);
            });

            // release camera
            document.getElementById('your-video-id').srcObject = document.getElementById('your-video-id').src = null;
            camera.getTracks().forEach(function(track) {
                track.stop();
            });
        });
    })
</script>
<script src="/js/common.js"></script>

