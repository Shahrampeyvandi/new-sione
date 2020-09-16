<?php $__env->startSection('Title',$title); ?>

<?php $__env->startSection('content'); ?>
<section class="mainBlog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 no-padding">
                <div class="container-fluid">
                    <div class="row">
                        <?php $__currentLoopData = $collection1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key === array_key_first($collection1->toArray())): ?>
                        <div class="col-12 no-padding">
                        <a href="<?php echo e($item->url()); ?>">
                                <div class="card-blog-section">
                                    <div class="card-cover"></div>
                                    <img class="img-cover" src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                    <h3>
                                        <?php echo e($item->title); ?>

                                    </h3>
                                </div>
                            </a>
                        </div>
                        <?php else: ?>

                        <div class="col-12 col-sm-6 no-padding">
                            <a href="#">
                                <div class="card-blog-section medium">
                                    <div class="card-cover"></div>
                                    <img src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                    <h3>
                                        <?php echo e($item->title); ?>

                                    </h3>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 no-padding">
                <div class="container-fluid">
                    <div class="row">
                        <?php $__currentLoopData = $collection2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($key === array_key_last($collection2->toArray())): ?>

                        <div class="col-12 no-padding">
                            <a href="./blog-post-page.html">
                                <div class="card-blog-section">
                                    <div class="card-cover"></div>
                                    <img class="img-cover" src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                    <h3>
                                        <?php echo e($item->title); ?>

                                    </h3>
                                </div>
                            </a>
                        </div>
                        <?php else: ?>
                        <div class="col-12 col-sm-6 no-padding">
                            <a href="./blog-post-page.html">
                                <div class="card-blog-section medium">
                                    <div class="card-cover"></div>
                                    <img src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                    <h3>
                                        <?php echo e($item->title); ?>

                                    </h3>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog_page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9">
                <?php if(count($naghd_va_barrasi)): ?>
                <div class="blog-body">
                    <h1>
                        <span>
                            نقد و بررسی فیلم ها
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $naghd_va_barrasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <a href="#">
                                    <div class="slider-blog-box">
                                        <img src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                        <div class="cover-img-slider"></div>
                                    </div>
                                    <h4>
                                        <?php echo e($item->title); ?>

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
                <?php if(count($latest_news)): ?>
                <div class="blog-body">
                    <h1>
                        <span>
                            آخرین اخبار
                        </span>
                    </h1>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="last-articles-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        <?php $__currentLoopData = $latest_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-12 col-md-6">
                                            <div class="container-fluid no-padding">
                                                <div class="row">
                                                    <div class="col-4 no-padding">
                                                    <a href="<?php echo e($item->url()); ?>">
                                                            <div class="card-blog-section">
                                                                <div class="card-cover"></div>
                                                                <img class="blog-news-img" src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>"
                                                            alt="<?php echo e($item->title); ?>">
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-8 no-padding">
                                                        <h4>
                                                           <?php echo e($item->title); ?>

                                                        </h4>
                                                        <h5>
                                                            <?php echo e($item->get_shamsi_date()); ?>

                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
             <?php if(count($latest_articles)): ?>
                    <div class="blog-body">
                    <h1>
                        <span>
                            آخرین مقالات
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog_blog">
                        <div class="swiper-wrapper">
                            <?php $__currentLoopData = $latest_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="swiper-slide">
                                <a href="#">
                                    <div class="slider-blog-box">
                                        <img src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                        <div class="cover-img-slider"></div>
                                    </div>
                                    <h4>
                                        <?php echo e($item->title); ?>

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

             <?php if(count($latest_videos)): ?>
                    <div class="blog-body">
                    <h1>
                        <span>
                            آخرین ویدیو ها
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog">
                        <div class="swiper-wrapper">
                           <?php $__currentLoopData = $latest_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                <a href="#">
                                    <div class="slider-blog-box">
                                        <img src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                                        <div class="cover-img-slider"></div>
                                        <div class="play-show">
                                            <i class="fa fa-video"></i>
                                        </div>
                                    </div>
                                    <h4>
                                        <?php echo e($item->title); ?>

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
            </div>

            <?php echo $__env->make('Includes.Blog.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/blog/index.blade.php ENDPATH**/ ?>