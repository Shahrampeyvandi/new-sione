{{-- <!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sione</title>
    <link href="https://vjs.zencdn.net/7.8.3/video-js.css" rel="stylesheet" />

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>


    <link rel="stylesheet" href="assets/style.css">
</head>

<body>


    <div class="col-12 col-md-12 pb-3 justify-content-center text-center">

        <video id="my-video" class="video-js vjs-default-skin vjs-16-9" height="100%" controls data-setup='{}'>
            <source src="{{$video->first()->url}}" type='video/mp4' label='SD' res='480' />
<!-- <source src="https://vjs.zencdn.net/v/oceans.mp4?hd" type='video/mp4' label='HD' res='1080' />
            <source src="https://vjs.zencdn.net/v/oceans.mp4?phone" type='video/mp4' label='phone' res='144' />
            <source src="https://vjs.zencdn.net/v/oceans.mp4?4k" type='video/mp4' label='4k' res='2160' /> -->
</video>



</div>


<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://vjs.zencdn.net/7.8.3/video.js"></script>
<script>
    var options = {};

        videojs('my-video')
</script>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>video.js play on popup open</title>


    <link rel='stylesheet prefetch'
        href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='https://vjs.zencdn.net/5-unsafe/video-js.css'>

    <link rel="stylesheet" href="css/style.css">


</head>
<style>
    * {
        outline: none;
    }

    .video-js .vjs-fullscreen-control {
        display: none;
    }
</style>

<body>


    <div class="btn-group-vertical text-center" role="group" aria-label="Basic example">

        <button type="button" onclick="togglePause()" data-toggle="modal" data-target="#exampleModal2"
            class="btn btn-secondary playVideo">Middle</button>

    </div>

    <!-- Modal -->
    <div class="modal" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              

                    <button type="button" onclick="closeModal()" class="close close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                
                <div class="modal-body">


                    <video id="videoID2" class="video-js vjs-default-skin" width="640px" height="300px" controls
                        preload="none" poster='http://ctwist.jalbum.net/mirage_videos/slides/oceans-clip.jpg'
                        data-setup='{ "aspectRatio":"640:300", "playbackRates": [1, 1.5, 2] }'>
                        <source src="https://vjs.zencdn.net/v/oceans.mp4" type='video/mp4' />

                    </video>


                </div>
            </div>
        </div>
    </div>















    <br />





    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
    <script src='https://vjs.zencdn.net/5-unsafe/video.js'></script>



    <script>
var myPlayer = videojs("#videoID2");
togglePause = function(){
  if (myPlayer.paused()) {
    myPlayer.play();
  }
  
  else {
    myPlayer.pause();
  }
}

function closeModal(){
     myPlayer.pause();
}
$('#exampleModal2').on('hidden.bs.modal', function (e) {
   myPlayer.pause();
})
$('#exampleModal2').on('shown.bs.modal', function () {
  
})
    </script>




</body>

</html>