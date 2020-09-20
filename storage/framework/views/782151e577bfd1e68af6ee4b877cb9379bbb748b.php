<?php $__env->startSection('Title',$title); ?>


<?php $__env->startSection('content'); ?>


<?php echo $__env->make('Includes.Front.DesktopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.MobileSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Front.TopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(isset($updated_series) && count($updated_series)): ?>
<section class="movie-sections">
    <h3>
        سریال های بروز شده
    <a href="<?php echo e(route('S.ShowMore')); ?>?c=updated&type=serie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $updated_series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
            <?php $__env->startComponent('components.article',['model'=>$serie , 'ajax'=>1,'updated'=>1]); ?>
            <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
     <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>



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



<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/AllSeries.blade.php ENDPATH**/ ?>