<?php $__env->startSection('Title','وبلاگ'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Includes.Blog.popups', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="blog_page post-blog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="main-post-blog">
                    <div class="blog-top-img">
                        <div class="top-post-img">

                            <img src="<?php echo e(asset(unserialize($post->poster)['poster'])); ?>" alt="">
                            <div class="cover-img-post"></div>
                        </div>

                    </div>
                    <div class="blog-post-define">
                        <i class="fa fa-quote-right"></i>
                        <p>
                            <?php echo $post->description; ?>

                        </p>

                        <?php if(count($post->videos)): ?>
                            <div class="row justify-content-center my-3">
                            <video width="100%" controls>
                                <source src="<?php echo e(asset($post->videos->first()->url)); ?>" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        <?php endif; ?>
                    </div>


                    <div class="sharing-post-blog">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="social-post-sharing">
                                        <span>
                                            این پست را به اشتراک بزارید
                                        </span>
                                        <a href="#" class="share-links">
                                            <i class="fas fa-share-alt"></i>
                                        </a>

                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="vote-post-sharing">
                                        <span>
                                            به ابن مطلب رای دهید
                                        </span>
                                        <div class="star-vote-box">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(count($latest_movies)): ?>
                <div class="slider-blog-post">
                    <div class="site_define">
                        <h2>
                            آخرین های سایت
                        </h2>
                        <h3>
                            تماشای آنلاین فیلم و سریال
                        </h3>
                        <a href="<?php echo e(route('MainUrl')); ?>" class="btn--ripple">
                            ورود به سایت
                        </a>
                    </div>
                    <div class="swiper-container post-blog-page-slider">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $latest_movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <div class="slider-post-img-box">
                                    <a href="#">
                                        <img src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(count($relateds)>0): ?>
                <div class="blog-body">
                    <h1>
                        <span>
                            نوشته های مرتبط با این پست
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $relateds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="swiper-slide">
                                <a href="<?php echo e($related->url()); ?>">
                                    <div class="slider-blog-box">
                                        <img src="<?php echo e(asset(unserialize($related->poster)['resize'])); ?>" alt="">
                                        <div class="cover-img-slider"></div>
                                        
                                    </div>
                                    <h4>
                                        <?php echo e($related->title); ?>

                                    </h4>
                                </a>
                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                        </div>
                        <div class="slider-prev">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="slider-next">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php echo $__env->make('Includes.Blog.CommentForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php echo $__env->make('Includes.Blog.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/blog/post.blade.php ENDPATH**/ ?>