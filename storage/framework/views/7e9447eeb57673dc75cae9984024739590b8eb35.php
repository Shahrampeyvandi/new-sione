<div class="col-12 col-lg-3">
    
    <div class="blog-place">
        <h1>
            <i class="fa fa-star"></i>
            <span class="blog-place-title">
                آخرین دیدگاه ها
            </span>
            <span class="blog-place-Name">
                RECENT COMMENTS
            </span>
        </h1>
        <?php $__currentLoopData = $latest_post_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentcomment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a class="quotation-blog" href="#">
            <i class="fa fa-quote-right"></i>
            <span class="quotation-blog-title">
                <?php echo e(mb_substr($recentcomment->text,'0','40')); ?>

            </span>
            <span class="quotation-blog-text">
                <?php echo e($recentcomment->commentable->title); ?>

            </span>
        </a>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <div class="blog-place">
        <h1>
            <i class="fa fa-star"></i>
            <span class="blog-place-title">
                پربازدیدترین مطالب
            </span>
            <span class="blog-place-Name">
                POPULAR POSTS
            </span>
        </h1>

        <?php $__currentLoopData = App\Blog::orderBy('views', 'DESC')->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mostvisit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a class="blog-movie" href="<?php echo e($mostvisit->url()); ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 no-padding">
                        <div class="blog-img-box">
                            <img src="<?php echo e(asset(unserialize($mostvisit->poster)['resize'])); ?>" alt="">
                            <div class="cover-img-blog"></div>
                        </div>
                    </div>
                    <div class="col-8 no-padding">
                        <h4>
                            <?php echo e($mostvisit->title); ?>

                        </h4>
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
    <div class="blog-place">
        <h1>
            <i class="fa fa-star"></i>
            <span class="blog-place-title">
                آخرین مطالب
            </span>
            <span class="blog-place-Name">
                LAST POSTS
            </span>
        </h1>
        <?php $__currentLoopData = App\Blog::latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lastpost): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a class="blog-movie" href="<?php echo e($lastpost->url()); ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 no-padding">
                        <div class="blog-img-box">
                            <img src="<?php echo e(asset(unserialize($lastpost->poster)['resize'])); ?>" alt="">
                            <div class="cover-img-blog"></div>
                        </div>
                    </div>
                    <div class="col-8 no-padding">
                        <h4>
                            <?php echo e($lastpost->title); ?>

                        </h4>
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Blog/sidebar.blade.php ENDPATH**/ ?>