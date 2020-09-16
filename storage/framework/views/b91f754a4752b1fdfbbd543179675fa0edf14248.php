<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-80">
    <?php if($first_post): ?>
<div class="top_img-place">
    <img src="<?php echo e(asset(unserialize($first_post->poster)['poster'])); ?>" alt="<?php echo e($category_name); ?>">
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
                <a href="<?php echo e($item->url()); ?>">
                        <div class="img-place-blog">
                            <img src="<?php echo e(asset(unserialize($item->poster)['resize'])); ?>" alt="<?php echo e($item->title); ?>">
                            <div class="img-place-blog-cover"></div>
                            <?php if($category_name == 'ویدیوها'): ?>
                                <div class="play-show-blog">
                                <i class="fa fa-video"></i>
                            </div>
                            <span>
                                پیش نمایش
                            </span>
                            <?php endif; ?>
                        </div>
                        <h3>
                           <?php echo e($item->title); ?>

                        </h3>
                        <span class="date-blog-post">
                            <?php echo e($item->get_shamsi_date()); ?>

                        </span>
                        <h4>
                          <?php echo str_limit(html_entity_decode($item->remove_image_from_desc(), ENT_QUOTES, 'UTF-8'),30,' ... '); ?>

                        </h4>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
</section>
<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/blog/category.blade.php ENDPATH**/ ?>