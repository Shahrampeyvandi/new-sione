<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('content'); ?>
<?php if($first_post): ?>
    <div class="top_img-place">
    <img src="<?php echo e(asset($first_post->poster)); ?>" alt="<?php echo e($category_name); ?>">
    <div class="cover-img-top"></div>
    <div class="cover-img-bottom"></div>
    <h3>
        <?php echo e($category_name); ?>

    </h3>
</div>
<section class="blog-page-elements">
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="blog-page-elements-box">
                    <a href="#">
                        <div class="img-place-blog">
                            <img src="assets/images/Blog-pages/Soul-2020.jpeg" alt="">
                            <div class="img-place-blog-cover"></div>
                            <div class="play-show-blog">
                                <i class="fa fa-video"></i>
                            </div>
                            <span>
                                پیش نمایش
                            </span>
                        </div>
                        <h3>
                            جدیدترین آنونس روح Soul محصول پیکسار را تماشا کنید
                        </h3>
                        <span class="date-blog-post">
                            ۱۲ تیر ۱۳۹۹
                        </span>
                        <h4>
                            این‌طور که به‌نظر می‌رسد باید برای تماشای انیمیشن روح Soul محصول جدید پیکسار کمی بیشتر منتظر
                            بمانیم؛ اما با توجه به آنونس‌هایی که دیده‌ایم، ارزشش را دارد.پیت داکتر، مدیر پیکسار،
                            کارگردان این اثر به همراه کمپ پاورز یکی دیگر از نویسنده‌ها، داستان جو گاردنر (جیمی فاکس) که
                            معلم موسیقی در یک مدرسه است را روایت […]
                        </h4>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/blog/movie.blade.php ENDPATH**/ ?>