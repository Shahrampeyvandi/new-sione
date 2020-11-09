<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>
</head>

<body>
    <script src="<?php echo e(asset('frontend/assets/js/jquery-3.5.1.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/FontAwesome/all.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>">

    <link href="https://vjs.zencdn.net/7.7.6/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/player.css')); ?>">
    <script src="https://vjs.zencdn.net/7.7.6/video.js"></script>
    <script src="<?php echo e(asset('assets/js/player.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/videojs.ads.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/videojs-preroll.js')); ?>"></script>
    <link href="<?php echo e(asset('frontend/assets/css/videojs-preroll.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('frontend/assets/css/videojs.watermark.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('frontend/assets/js/videojs.watermark.js')); ?>"></script>
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
        <a href="<?php echo e(url()->previous()); ?>" class="btn-white-color bg-tt"> <i class="fa fa-chevron-left"></i> بازگشت</a>
        <a href="#" onclick="fillMode(event)" class="btn-white-color bg-tt" style="left: 130px">
            حالت کشیده </a>

        <section id="play" class=" position-relative">
            <video class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" id="player" controls>
                <?php if(isset($videos)): ?>
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <source src="<?php echo e($item->url); ?>" type='video/mp4' label='<?php echo e($item->quality->name); ?>' />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $post->captions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $caption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <track kind='captions' src='<?php echo e(asset($caption->url)); ?>' srclang='<?php echo e($caption->lang); ?>'
                    label='<?php echo e($post->lang); ?>' <?php if($key==0): ?> default <?php endif; ?> />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if(isset($trailer_url)): ?>
                <source src="<?php echo e($trailer_url); ?>" type='video/mp4' label='720' />
                <?php endif; ?>
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
    video.currentTime(localStorage.getItem('videoTime' + '<?php echo e($post->id); ?>')); 
      video.watermark({
         file: '<?php echo e(asset("frontend/assets/images/s.png")); ?>',
         xpos: 1,
       ypos: 0,
       xrepeat:1,
       opacity: 0.5
     });
     function run_url_every_2seconds(){
        var whereYouAt = video.currentTime();
            localStorage.setItem('videoTime' + '<?php echo e($post->id); ?>' , whereYouAt);
            
        } 
        video.on('play', function() {  
            setInterval(run_url_every_2seconds,2000);
           send = setInterval(function(){
                sendData()
                // console.log('sended')
            },10000)
        });
         video.on('pause', function() {  
           clearInterval(send)
        //    console.log('pause')
        });




        function sendData() {
             var token = $('meta[name="_token"]').attr("content");
             var data = {time:video.currentTime(),type:'<?php echo e($type); ?>',season:'<?php echo e($season_id); ?>',section:'<?php echo e($section_id); ?>',id:'<?php echo e($post->id); ?>',_token:token}
               var request = $.post('<?php echo e(route('Ajax.LastPlayed')); ?>', data);
               request.done(function(res) {
                   $(".results").html(res);
                   timeout = true;
               });
        }


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

</html><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/play.blade.php ENDPATH**/ ?>