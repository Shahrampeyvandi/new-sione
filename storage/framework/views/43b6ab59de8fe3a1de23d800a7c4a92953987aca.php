<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/swiper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/index.css')); ?>">
    <script src="<?php echo e(asset('assets/js/jquery-3.5.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/swiper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/index.js')); ?>"></script>
     <meta charset="UTF-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo $__env->yieldContent('title','sione | blog'); ?></title>
</head>

<body>
    <?php echo $__env->make('Includes.Blog.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('Includes.Blog.Footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\tm\resources\views/Layout/Blog.blade.php ENDPATH**/ ?>