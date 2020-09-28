<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
</head>

<body>
    <script src="{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('assets/vendors/FontAwesome/all.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

    <link href="https://vjs.zencdn.net/7.7.6/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/player.css')}}">
    <script src="https://vjs.zencdn.net/7.7.6/video.js"></script>
    <script src="{{asset('assets/js/player.js')}}"></script>
    <script src="{{asset('frontend/assets/js/videojs.ads.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/videojs-preroll.js')}}"></script>
    <link href="{{asset('frontend/assets/css/videojs-preroll.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('frontend/assets/css/videojs.watermark.css')}}" rel="stylesheet">
    <script src="{{asset('frontend/assets/js/videojs.watermark.js')}}"></script>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        #play {
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: radial-gradient(at bottom, #1993ff, #121212 70%);
            height: 100%;

        }

        #player {
            width: 100%;
            height: 100vh;
        }

        .btn-white-color {
            position: fixed;
            color: white;
            top: 13px;
            left: 21px;
            z-index: 10;
        }

        .bg-tt {
            background: #1f57aa8a;
            padding: 4px 8px;
            border-radius: 4px;
            color: #ffffff94;
        }

        .object-fill {
            object-fit: fill;
        }

        .player-dimensions {
            width: 1250px;
            height: 521px;
        }
    </style>

    <body>
        <a href="{{ url()->previous() }}" class="btn-white-color bg-tt"> <i class="fa fa-chevron-left"></i> بازگشت</a>
        <a href="#" onclick="fillMode(event)" class="btn-white-color bg-tt" style="left: 130px">
            حالت کشیده </a>

        <section id="play" class=" position-relative">
            <video class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" id="player" controls>
                @if (isset($videos))
                @foreach ($videos as $item)
                <source src="{{$item->url}}" type='video/mp4' label='{{$item->quality->name}}' />
                @endforeach
                @foreach ($post->captions as $key => $caption)
                <track kind='captions' src='{{asset($caption->url)}}' srclang='{{$caption->lang}}'
                    label='{{$post->lang}}' @if($key==0) default @endif />
                @endforeach
                @endif
                @if (isset($trailer_url))
                <source src="{{$trailer_url}}" type='video/mp4' label='720' />
                @endif
            </video>
        </section>

    </body>
    <script>
        $('#play .close').click(function(e){
         e.preventDefault()
         $(this).next('a').remove()
         $(this).remove()
       })
     var video = videojs('player');
     video.responsive(true);
     
     video.videoJsResolutionSwitcher()
    video.currentTime(localStorage.getItem('videoTime' + '{{$post->id}}')); 
      video.watermark({
         file: '{{asset("frontend/assets/images/s.png")}}',
         xpos: 1,
       ypos: 0,
       xrepeat:1,
       opacity: 0.5
     });
    function run_url_every_2seconds(){
      var whereYouAt = video.currentTime();
            localStorage.setItem('videoTime' + '{{$post->id}}' , whereYouAt);
            
        } 
        video.on('play', function() {  
            setInterval(run_url_every_2seconds,2000);
        });

        function fillMode(event) {
            event.preventDefault()
            el = $(event.target).next().find('video')
            if(el.hasClass('object-fill')){
            el.removeClass('object-fill')
            }else{
            el.addClass('object-fill')
            }

        }
    </script>

</body>

</html>