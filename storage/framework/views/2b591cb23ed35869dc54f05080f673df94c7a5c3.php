<?php $__env->startSection('Title',$title); ?>

<?php $__env->startSection('content'); ?>
<a href="<?php echo e(route('MainUrl')); ?>" class="logo-float-right">
    <img class="site-logo" src="<?php echo e(asset('assets/images/aa-300x157.png')); ?>" alt="site-logo">

</a>
<div class="buy-sharing-plan">
    <form action="<?php echo e(route('S.BuyPlan')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <input type="hidden" id="plan_name" name="plan_name" value="">
        <div class="buy-sharing-plan-box">
            <button id="close_buy-plan-box">
                <i class="fa fa-times"></i>
            </button>
            <h1>

            </h1>
            <div class="price-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <div class="price-plan-title">
                                قیمت:
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="price-plan_price"></div>
                        </div>
                     
                    </div>
                </div>
            </div>
            <div class="off-box">
                <h2>
                    کد تخفیف
                </h2>
                <p>
                    لطفا کد تخفیف خود را وارد کنید و دکمه ثبت کد تخفیف را بزنید.
                </p>
                <div class="input-place">

                    <input id="off_code" name="offCode" autocomplete="off">
                
                    <a id="submit-off_code" onclick="checkTakhfif(event,'<?php echo e(route('checkTakhfif')); ?>')"
                        class="btn--ripple text-center">
                        ثبت کد تخفیف
                    </a>

                </div>
            </div>
            <div class="pay-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8 text-right">
                            مبلغ قابل پرداخت:
                        </div>
                        <div class="col-4 text-left">
                            <span id="pay_price"></span>
                        </div>
                    </div>
                </div>
                <button id="pay_price_btn" class="btn--ripple">
                    پرداخت آنلاین
                </button>
            </div>
        </div>
    </form>
</div>
<section class="site-sharing-body">
    <h1 class="site-sharing-body-title">
        خرید اشتراک سایت
        
    </h1>
    <a class="header-link-sharing" href="#">
        <img src="assets/images/sharing_page/p1.jpg" alt="">
    </a>
    <div class="plans">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="plan-box">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <p class="plan-length"><?php echo e($item->name); ?></p>
                    </div>
                    <div class="col-3">
                        <?php if($item->discount !== null && $item->discount !== 0): ?>
                        <p class="plan-price">
                            <?php echo e($item->price); ?> تومان
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="col-3">
                        <p class="after-off">
                            <?php echo e($item->priceWithDiscount()); ?> تومان
                        </p>
                    </div>
                    <div class="col-3">
                        <a class="choosePlane" data-id="<?php echo e($item->id); ?>" href="#">
                            انتخاب
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <div id="editor1" contenteditable="true">
        
        <p class="text-sharing-page-head">
            با خرید اشتراک ، به امکانات بی نظیر زیر دسترسی خواهید داشت:
            <span class="note">
                تماشای نامحدود هزاران فیلم و سریال و انیمیشن جذاب در طول مدت اشتراک خریداری شده.
            </span>
            <span class="note">
                حجم اینترنت رایگان در زمان تماشای فیلم ( در صورتیکه اینترنت شما، یکی از شرکت های تحت قرارداد با باشد)
            </span>
            <span class="note">
                امکان دانلود درون برنامه ای تمامی محتواهای و تماشای آن در زمانیکه دسترسی به اینترنت ندارید.
            </span>
        </p>
        <div class="plans infoPlan">
            <a href="#">
                <h1>
                    <i class="fa fa-exclamation-triangle"></i>
                    شرایط محاسبه ترافیک مصرفی شما در وب‌سایت و اپلیکیشن تغییر کرده است.
                </h1>
                <p>
                    سپاس‌گزار خواهیم بود اگر برای اطلاع از شرایط جدید محاسبه‌ی ترافیک مصرفی و حجم اینترنت در هنگام
                    تماشای
                    فیلم از ، به صفحه اپراتورها مراجعه فرمایید.
                </p>
                <i class="fa fa-angle-left"></i>
            </a>
        </div>
        <p class="text-sharing-page-head">
            کاربران خارج از ایران با خرید اشتراک ، تنها به فیلم های ایرانی دسترسی خواهند داشت. تماشای فیلم های خارجی
            تنها برای کاربران داخل ایران امکان پذیر است.
        </p>
        <div class="plans support">
            <h1>
                هفت روز هفته، ۲۴ ساعت شبانه‌روز پاسخگوی شما هستیم.
            </h1>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <p class="support-info">
                            شماره تماس: 021-00000000
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="support-info">
                            ایمیل: support@site
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/Plans.blade.php ENDPATH**/ ?>