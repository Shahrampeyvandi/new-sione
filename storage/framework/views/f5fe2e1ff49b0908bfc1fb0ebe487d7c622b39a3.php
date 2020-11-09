<?php $__env->startSection('Title',$title); ?>

<?php $__env->startSection('content'); ?>
<div class="row h-100">
    <div class="col-md-12">
        <section class="main_login_register" <?php if($setting && isset($setting->login_background)): ?>
            style="background-image:-webkit-gradient(linear, left top, left bottom, from(#ffffff00), to(black)),url(<?php echo e(asset($setting->login_background)); ?>);background-repeat: no-repeat;background-size: cover;"
            <?php else: ?>
            style="background-image:radial-gradient(at bottom, #1993ff, #121212 70%);"
            <?php endif; ?>
            >
            <div class="btn-loader-place">
                <h1>
                    <a href="<?php echo e(route('MainUrl')); ?>">
                        <img class="site-logo" src="<?php echo e(asset('assets/images/aa-300x157.png')); ?>" alt="site-logo">
                    </a>
                </h1>
                <button type="button" class="register-form-load btn--ripple">
                    ثبت نام
                </button>
                <button type="button" class="login-form-load btn--ripple">
                    ورود
                </button>
            </div>

            <form action="<?php echo e(route('login')); ?>" method="post" id="loginForm" class="loginform">
                <?php echo csrf_field(); ?>
                <?php if(count($errors)): ?>
                <h1>
                    <?php echo e($errors->first()); ?>

                </h1>
                <?php endif; ?>
                <h3>
                    لطفا شماره تلفن خود و رمز عبور را وارد نمایید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        شماره تلفن همراه
                    </label>
                    <input type="tex" id="mobile" name="mobile" autocomplete="off" dir="rtl" <?php if($phone): ?> value="<?php echo e($phone); ?>" <?php endif; ?> placeholder="+98**********">
                </div>
                <div class="input-place">
                    <label for="password">
                        رمز عبور
                    </label>
                    <input type="password" id="password" <?php if($password): ?> value="<?php echo e($password); ?>" <?php endif; ?> name="password" autocomplete="off" dir="rtl">
                </div>
                <button class="submit_login btn--ripple" type="submit">
                    ورود
                </button>
               <div class="d-flex justify-content-between dd">
                    <a class="forget-pass" href="#">
                    رمز عبور خود را فراموش کرده ام
                </a>
                
               </div>
    

            </form>
            <form action="<?php echo e(route('forgetpass')); ?>" method="post" id="loginForm" class=" forget-pas" style="display: none">
                <?php echo csrf_field(); ?>
                <?php if(count($errors)): ?>
                <h1>
                    <?php echo e($errors->first()); ?>

                </h1>
                <?php endif; ?>

                <h3>
                    لطفا شماره تلفن خود را وارد نمایید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        شماره تلفن همراه
                    </label>
                    <input type="tex" id="mobile" name="mobile" autocomplete="off" dir="rtl" placeholder="+98**********">
                </div>
                <button class="submit_login btn--ripple" type="submit">
                    تایید
                </button>
            </form>
            <form action="<?php echo e(route('S.Register')); ?>" method="post" id="registerForm">
                <?php echo csrf_field(); ?>
                <?php if(count($errors)): ?>
                <h1>
                    <?php echo e($errors->first()); ?>

                </h1>
                <?php endif; ?>
                <h1 class="text-center m-0">
                    ثبت نام
                </h1>
                <div class="input-place">
                    <label for="Mobile-register">
                        شماره تلفن همراه
                    </label>
                    <input type="text" id="Mobile-register" name="mobile" autocomplete="off" placeholder="+98**********">
                </div>
                <div class="input-place">
                    <label for="fName">
                        نام
                    </label>
                    <input type="text" id="fName" name="fname" autocomplete="off" placeholder="نام">
                </div>
                <div class="input-place">
                    <label for="lName">
                        نام خانوادگی
                    </label>
                    <input type="text" id="lName" name="lname" autocomplete="off" placeholder="نام خانوادگی">
                </div>
                <div class="input-place">
                    <label for="password">
                        رمز عبور
                    </label>
                    <input type="password" id="mainpassword" name="password" autocomplete="off" placeholder="رمز عبور">
                </div>
                <div class="input-place">
                    <label for="cpassword">
                        تایید پسورد
                    </label>
                    <input type="password" id="cpassword" name="cpassword" autocomplete="off" placeholder="تایید پسورد">
                </div>
                <button class="submit_register btn--ripple" type="submit">
                    ثبت نام
                </button>
            </form>
        </section>
    </div>
</div>
<span id="browser" style="color: #bababacf;
    bottom: -152px;
    position: absolute;
    right: 26px;"></span>
<script type="text/javascript">

// Browser with version  Detection
navigator.sayswho= (function(){
    var N= navigator.appName, ua= navigator.userAgent, tem;
    var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
    if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
    M= M? [M[1], M[2]]: [N, navigator.appVersion,'-?'];
    return M;
})();

var browser_version          = navigator.sayswho;
// alert(browser_version);
if (
/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
navigator.userAgent
)
) {

}else{
document.getElementById('browser').innerHTML = browser_version
document.querySelector('.dd').innerHTML  += `<a class="goto-tvsione" href="https://tv.sione.live">
    ورود به نسخه تلویزیون

</a>`
}
if(browser_version[0] != 'Chrome' && browser_version[0] != 'Mozilla' && browser_version[0] != 'Netscape' && browser_version[0] != 'MSIE' && (browser_version[0] == 'Safari' && browser_version[1] =='4.0') && browser_version[0] != 'OP' && browser_version[0] != 'Firefox'){
              window.location = "https://tv.sione.live/";
}

</script>
<script type="text/javascript">

if (screen.width >= 1980) {
          window.location = "https://www.tv.sione.live/";
}



</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/login.blade.php ENDPATH**/ ?>