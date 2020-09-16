<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/range-slider/css/ion.rangeSlider.min.css')); ?>" type="text/css">

    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/swiper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/index.css')); ?>">

    <script src="<?php echo e(asset('frontend/assets/js/jquery-3.5.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendors/jquery-validate/jquery.validate.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/bootstrap.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/toastr.css')); ?>">
    <script src="<?php echo e(asset('frontend/assets/js/swiper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/all.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.css" rel="stylesheet">
    <?php echo $__env->yieldContent('css'); ?>
    <script>
        var mainUrl = "<?php echo e(route('MainUrl')); ?>";
    </script>

    <script src="<?php echo e(asset('frontend/assets/js/index.js')); ?>"></script>
    <meta charset="UTF-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> sione | <?php echo $__env->yieldContent('Title'); ?></title>
</head>


<body <?php if(\Request::route()->getName() == "S.SiteSharing" || \Request::route()->getName() == "S.Account" ||
    \Request::route()->getName() == "S.OrderLists" ): ?>
    class="site-sharing"
    <?php endif; ?>>
    <div class="overlay"></div>
    <div class="lds-ripple center-screen" style="display: none">
        <div></div>
        <div></div>
    </div>


    <?php if(\Request::route()->getName() !== "login" && \Request::route()->getName() !== "S.SiteSharing" &&
    \Request::route()->getName() !== "S.OrderLists" && \Request::route()->getName() !== "forgetpass" &&
     \Request::route()->getName() !== "forgetpass.submitCode" && \Request::route()->getName() !== "forgetpass.submitNewPass"
    
    ): ?>
    <?php echo $__env->make('Includes.Front.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php if(\Request::route()->getName() !== "login" && \Request::route()->getName() !== "S.SiteSharing" &&
    \Request::route()->getName() !== "S.OrderLists" && \Request::route()->getName() !== "forgetpass" &&
     \Request::route()->getName() !== "forgetpass.submitCode" && \Request::route()->getName() !== "forgetpass.submitNewPass"
   && \Request::route()->getName() !==  "S.Account"
  ): ?>
    <?php echo $__env->make('Includes.Front.Footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <script src="<?php echo e(asset('assets/js/toastr.min.js')); ?>"></script>
    <!-- begin::range slider -->
    <script src="<?php echo e(asset('assets/vendors/range-slider/js/ion.rangeSlider.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/examples/range-slider.js')); ?>"></script>
    <!-- end::range slider -->
    <?php echo app('toastr')->render(); ?>
    <?php echo $__env->yieldContent('js'); ?>
   
</body>

</html><?php /**PATH C:\xampp\htdocs\tm\resources\views/Layout/Front.blade.php ENDPATH**/ ?>