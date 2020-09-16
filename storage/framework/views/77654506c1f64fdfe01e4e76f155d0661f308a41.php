<?php $__env->startSection('Title', $title); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
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


            <form action="<?php echo e(route('forgetpass.submitNewPass')); ?>" method="post" id="loginForm"
                class="loginform ">
                <?php echo csrf_field(); ?>
                <?php if(count($errors)): ?>
                <h1>
                    <?php echo e($errors->first()); ?>

                </h1>
                <?php endif; ?>

                <h3>
                    لطفا رمز عبور جدید خود را وارد نمایید
                </h3>
                <div class="input-place">

                    <input type="hidden" id="mobile" name="mobile" value="<?php echo e($mobile); ?>">
                    <input type="hidden" id="mobile" name="code" value="<?php echo e($code); ?>">


                </div>

                <div class="input-place">
                    <label for="password">
                        رمز عبور
                    </label>
                    <input type="text" id="mainpassword" name="password" autocomplete="off">
                </div>
                <div class="input-place">
                    <label for="cpassword">
                        تایید رمز عبور
                    </label>
                    <input type="text" id="cpassword" name="cpassword" autocomplete="off">
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
<script src="<?php echo e(asset('assets/vendors/jquery-validate/jquery.validate.js')); ?>"></script>
<script>
    $(function() {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
        );
        $(".loginform").validate({
            rules: {
               password: {
             required: true,
             minlength: 8,
             regex: /^[a-zA-Z\d]*$/,
         },
          cpassword: {
             required: true,
             minlength: 8,
             equalTo:'#mainpassword',
         }
            },
            messages: {
                  password: {
             required: "لطفا رمز عبور خود را وارد نمایید",
             minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
             regex: "پسورد بایستی شامل اعداد و حروف لاتین باشد",
         },
          cpassword: {
             required: "لطفا رمز عبور خود را وارد نمایید",
             minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
             equalTo:'رمز عبور یکسان نیست',
         },
            },
        });


    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/forgotpassnewpass.blade.php ENDPATH**/ ?>