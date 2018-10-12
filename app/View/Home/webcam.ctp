  <link href="../node_modules/video.js/dist/video-js.min.css" rel="stylesheet">
  <link href="../dist/css/videojs.record.css" rel="stylesheet">

  <script src="../node_modules/video.js/dist/video.min.js"></script>
  <script src="../node_modules/recordrtc/RecordRTC.js"></script>
  <script src="../node_modules/webrtc-adapter/out/adapter.js"></script>

  <script src="../dist/videojs.record.js"></script>

  <style>
  /* change player background color */
  #myVideo {
      background-color: #00007a;
      width: 950px;
      height: 800px;
      margin: 65px 0 0 15px;
  }
  </style>


<video id="myVideo" class="video-js vjs-default-skin"></video>

  
<script>
var player = videojs("myVideo", {
    controls: true,
    width: 320,
    height: 240,
    fluid: false,
    plugins: {
        record: {
            audio: true,
            video: true,
            maxLength: 10,
            debug: true
        }
    }
}, function(){
    // print version information at startup
    var msg = 'Using video.js ' + videojs.VERSION +
        ' with videojs-record ' + videojs.getPluginVersion('record') +
        ' and recordrtc ' + RecordRTC.version;
    videojs.log(msg);
});

// error handling
player.on('deviceError', function() {
    console.log('device error:', player.deviceErrorCode);
});

player.on('error', function(error) {
    console.log('error:', error);
});

// user clicked the record button and started recording
player.on('startRecord', function() {
    console.log('started recording!');
});

// user completed recording and stream is available
player.on('finishRecord', function() {
    // the blob object contains the recorded data that
    // can be downloaded by the user, stored on server etc.
    console.log('finished recording: ', player.recordedData);
    upload_video(player.recordedData);
});

function upload_video(recordedData){
  if (recordedData) {
    
    var binaryData = recordedData.video;

    var segmentNumber = 0;
    segmentNumber++;

    var formData = new FormData();
    formData.append('SegmentNumber', segmentNumber);
    formData.append('Data', binaryData);
    
    $.ajax({
        url: '/home/save_video',
        method: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function (res) {
            console.log("segment: " + segmentNumber);
        }
    });
  }
}

</script>