<?php $__env->startSection('Title','سریال ها'); ?>


<?php $__env->startSection('content'); ?>


<?php echo $__env->make('Includes.Front.DesktopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.MobileSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Front.TopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(count($newseries)): ?>
<section class="movie-sections">
    <h3>
        تازه ترین ها
        <a href="<?php echo e(route('S.ShowMore')); ?>?c=new&type=serie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $newseries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$post, 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail',['model'=>$post]); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>

<?php if(count($latestdoble)): ?>
<section class="movie-sections">
    <h3>
        دوبله فارسی
        <a href="<?php echo e(route('S.ShowMore')); ?>?c=doble&type=serie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $latestdoble; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$post , 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail',['model'=>$post]); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>



<?php if(count($newyear)): ?>
<section class="movie-sections">
    <h3>
        جدیدترین فیلم های <?php echo e($year); ?>

        <a href="<?php echo e(route('S.ShowMore')); ?>?c=<?php echo e($year); ?>&type=serie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $newyear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$post , 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail',['model'=>$post]); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/AllSeries.blade.php ENDPATH**/ ?>