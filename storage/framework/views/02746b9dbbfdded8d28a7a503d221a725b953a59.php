<?php $__env->startSection('Title',$title); ?>


<?php $__env->startSection('content'); ?>


<?php echo $__env->make('Includes.Front.DesktopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.MobileSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Front.TopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(isset($posts)): ?>
<section class="movie-sections">
    <h3>
        تازه ترین سریال ها
     
    </h3>
    <div class="swiper-container">
         <div class="row">
               <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-2">
            <?php $__env->startComponent('components.article',['model'=>$post]); ?>
            <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
</div>
<?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>

</section>
<?php endif; ?>




<?php $__env->stopSection(); ?>


<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/showCategory.blade.php ENDPATH**/ ?>