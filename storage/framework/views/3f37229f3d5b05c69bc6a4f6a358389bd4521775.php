<?php $__env->startSection('Title', $title); ?>

<?php $__env->startSection('content'); ?>
<div class="row h-100">
    <div class="col-md-12">
        <section class="main_login_register"
            style="background-image:linear-gradient(rgba(18, 18, 18, 0) 10vw, rgb(18, 18, 18) 46.875vw), linear-gradient(to left, rgba(18, 18, 18, 0.7), rgba(18, 18, 18, 0) 50%),url(<?php echo e(asset('frontend/login/642a2247-9f00-42f8-99a5-63c79e0e13e8.jpg')); ?>)">
            <div class="btn-loader-place">
                <h1>
                    <a href="<?php echo e(route('MainUrl')); ?>">
                        LOGO
                    </a>
                </h1>
                
            </div>

       
            <form action="<?php echo e(route('forgetpass.submitCode')); ?>" method="post" id="loginForm" class="loginform">
                <?php echo csrf_field(); ?>
                <?php if(count($errors)): ?>
                <h1>
                    <?php echo e($errors->first()); ?>

                </h1>
                <?php endif; ?>
                <input type="hidden" id="mobile" name="mobile" value="<?php echo e($mobile); ?>">

                <h3>
                    کد فعال سازی برای شماره <?php echo e($mobile); ?> ارسال گردید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        کد فعال سازی
                    </label>
                    <input type="text" id="mobile" name="code" autocomplete="off" dir="rtl" placeholder="12345">
                </div>


                <button class="submit_login btn--ripple" type="submit">
                    تایید
                </button>


            </form>
            
        </section>
    </div>
</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendors/bundle.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/forgotpasscode.blade.php ENDPATH**/ ?>