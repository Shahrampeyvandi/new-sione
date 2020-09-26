<?php $__env->startSection('content'); ?>
<div class="user-profile-change">
    <div class="user-detail-change-box">
        <i class="fa fa-times"></i>
        <form action="#" method="post">
            <div class="input-place">
                <input type="text" id="fName" name="fName" required>
                <label for="fName">نام</label>
            </div>
            <div class="input-place">
                <input type="text" id="lName" name="fName" required>
                <label for="lName">نام خانوادگی</label>
            </div>
            <button type="submit" class="sub-change btn--ripple">
                ویرایش
            </button>
        </form>
    </div>
    <div class="user-change-pass-box">
        <i class="fa fa-times"></i>
        <form action="#" method="post">
            <div class="input-place">
                <input type="text" id="Current_pass" name="Current_pass" required>
                <label for="Current_pass">پسورد فعلی</label>
            </div>
            <div class="input-place">
                <input type="text" id="new_pass" name="new_pass" required>
                <label for="new_pass">پسورد جدید</label>
            </div>
            <div class="input-place">
                <input type="text" id="confirm_pass" name="confirm_pass" required>
                <label for="confirm_pass">تایید پسورد</label>
            </div>
            <button type="submit" class="sub-change btn--ripple">
                تغییر پسورد
            </button>
        </form>
    </div>
</div>
<section class="profile-section">
    <h1>
        حساب کاربری
    </h1>
    <div class="plans">
        <div class="container-fluid">
            <div class="row">
                <div class="col-9">
                    <div class="fName_lName">
                        نام و نام خانوادگی:<?php echo e($user->name()); ?>

                    </div>
                </div>
                <div class="col-3">
                    <a class="edit-account-name">
                        ویرایش
                    </a>
                </div>
            
                <div class="col-12">
                    <div class="user-account-phone">
                        شماره تلفن همراه: <?php echo e($user->mobile); ?>

                    </div>
                </div>
                <div class="col-12">
                    <a class="change_pass_user">
                        تغییر رمز عبور
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="plans">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <div class="sharing-status">
                        وضعیت اشتراک:
                        <?php if(auth()->guard('admin')->check()): ?>
                        فعال
                        <?php else: ?> 

                        <?php if($user->planStatus()): ?>
                        <span class="green-color">
                            فعال
                        </span>
                        <?php else: ?>
                        <span class="red-color">
                            غیرفعال
                        </span>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-5">
                <a href="<?php echo e(route('S.SiteSharing')); ?>" class="buy-sharing">
                        خرید اشتراک
                    </a>
                </div>
            </div>
        </div>
    </div>
<a href="<?php echo e(route('S.OrderLists')); ?>" class="order-lists">
        لیست سفارشات
    </a>

</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/Account.blade.php ENDPATH**/ ?>