<?php $__env->startSection('Title',$title); ?>

<?php $__env->startSection('content'); ?>

<div class="showmore-wrapper">
    <?php if(count($posts)): ?>
    <section class="movie-sections">
        <h3>
            <?php echo e($title); ?>


        </h3>
        <div class="row">

            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="col-6 col-md-2 mb-5">
                <?php $__env->startComponent('components.article',['model'=>$post]); ?>
            <?php echo $__env->renderComponent(); ?>
           </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </section>
    <?php endif; ?>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/ShowMore.blade.php ENDPATH**/ ?>