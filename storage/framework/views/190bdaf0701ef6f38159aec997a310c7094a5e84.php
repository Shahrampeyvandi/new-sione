<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/bundle.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/app.css')); ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" type="text/css">
    <link rel="shortcut icon" href="<?php echo e(asset('assets/media/image/favicon.png')); ?>">
    <meta name="theme-color" content="#3f51b5" />
</head>

<body class="icon-side-menu pt-0">

    <!-- begin::page loader-->
    <div class="page-loader">
        <div class="spinner-border"></div>
        <span>در حال بارگذاری ...</span>
    </div>
    <!-- end::page loader -->

    <!-- begin::main content -->
    <main class="main-content">
        <div class="container h-100-vh">
            <div class="row align-items-center h-100-vh">

                <div class="col-md-4 offset-lg-4 p-t-b-25">
                    <div class="d-flex align-items-center m-b-20">
                    <img src="<?php echo e(asset('assets/media/image/dark-logo.png')); ?>" class="m-l-15" width="40" alt="">
                        <h3 class="m-0">مدیریت </h3>
                    </div>
                    <?php echo $__env->make('Includes.Panel.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <form id="loginForm" action="<?php echo e(route('Admin.Login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                        <div class="form-group mb-4">
                            <input type="number" name="mobile" class="form-control form-control-lg" id="exampleInputEmail1" autofocus
                                placeholder="شماره تلفن">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1"
                                placeholder="رمز عبور">
                        </div>
                        <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ورود</button>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="rememberme" id="customCheck">
                                <label class="custom-control-label" for="customCheck">به خاطر سپاری</label>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo e(asset('assets/vendors/bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
</body>

</html><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Login.blade.php ENDPATH**/ ?>