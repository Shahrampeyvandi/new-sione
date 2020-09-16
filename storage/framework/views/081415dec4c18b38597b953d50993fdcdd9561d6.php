<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">تنظیمات </h5>
                <hr />
            </div>
            <form id="add-plan" method="post" action="<?php echo e(route('Panel.Setting')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row my-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="card-title">تم سایت</label>
                            <input type="text" name="theme" class="sample-selector-rgba form-control text-right"
                                dir="ltr">
                        </div>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-md-12">
                        <h6>فوتر</h6>
                        <label for="">متن</label>
                        <input type="text" name="footer_label" class="form-control" value="<?php echo e($setting->footer_text); ?>">
                    </div>

                </div>
                <div class="row my-3">
                    <div class="col-md-3 m-t-b-20">
                        <button type="button" class="btn btn-whatsapp ml-2">
                            <i class="fab fa-whatsapp"></i>
                        </button>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="whatsapp" name="whatsapp_status" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="whatsapp">
                                نمایش</label>
                        </div>

                        <input type="text" name="whatsapp" class="form-control mt-2">
                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <button type="button" class="ml-2 btn btn-instagram">
                            <i class="fab fa-instagram"></i>
                        </button>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="instagram" name="instagram_status" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="instagram">
                                نمایش</label>
                        </div>
                        <input type="text" name="instagram" class="form-control mt-2">

                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <button type="button" class="ml-2 btn btn-instagram">
                            <i class="fab fa-telegram"></i>
                        </button>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="telegram" name="telegram_status" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="telegram">
                                نمایش</label>
                        </div>
                        <input type="text" name="telegram" class="form-control mt-2">

                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <button type="button" class="ml-2 btn btn-youtube">
                            <i class="fab fa-youtube"></i>
                        </button>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="youtube" name="youtube_status" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="youtube">
                                نمایش</label>
                        </div>
                        <input type="text" name="youtube" class="form-control mt-2">

                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <button type="button" class="ml-2 btn btn-twitter">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="twitter" name="twitter_status" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="twitter">
                                نمایش</label>
                        </div>
                        <input type="text" name="twitter" class="form-control mt-2">

                    </div>
                    <div class="col-md-3 m-t-b-20">
                        <button type="button" class="ml-2 btn btn-facebook">
                            <i class="fab fa-facebook"></i>
                        </button>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="facebook" name="facebook_status" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="facebook">
                                نمایش</label>
                        </div>
                        <input type="text" name="facebook" class="form-control mt-2">
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <h6>فهرست ها</h6>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="menu1" name="menu" value="سینمایی" class="custom-control-input"
                                checked>
                            <label class="custom-control-label" for="menu1">
                                سینمایی</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="سریال" name="menu" value="سریال" class="custom-control-input"
                                checked>
                            <label class="custom-control-label" for="سریال">
                                سریال</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="سرچ" name="menu" value="آیکون سرچ" class="custom-control-input"
                                checked>
                            <label class="custom-control-label" for="سرچ">
                                آیکون سرچ</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="پیام" name="menu" value="آیکون پیام ها"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="پیام">
                                آیکون پیام ها</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="خانه" name="menu" value="خانه" class="custom-control-input"
                                checked>
                            <label class="custom-control-label" for="خانه">
                                خانه</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="زودی" name="menu" value="به زودی" class="custom-control-input"
                                checked>
                            <label class="custom-control-label" for="زودی">
                                به زودی</label>
                        </div>


                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-4">
                        <h6>لوگو</h6>
                        <input type="file" class="form-control">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-4">
                        <h6>تصویر زمینه صفحه ورود: </h6>
                        <input type="file" name="login_poster" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"> ذخیره </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<!-- begin::colorpicker -->
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/colorpicker/css/bootstrap-colorpicker.min.css')); ?>" type="text/css">
<!-- end::colorpicker -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- begin::colorpicker -->
<script src="<?php echo e(asset('assets/vendors/colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/examples/colorpicker.js')); ?>"></script>
<!-- end::colorpicker -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Setting/Show.blade.php ENDPATH**/ ?>