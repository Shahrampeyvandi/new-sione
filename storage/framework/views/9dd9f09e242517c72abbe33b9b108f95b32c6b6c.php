<?php $__env->startSection('Title','لیست من'); ?>


<?php $__env->startSection('content'); ?>



<section class="movie-sections favorite-section mt-7">
    <?php if(count($myfavorites)): ?>
    <h3>
        لیست من
        <a href="#">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="container-fluid">
        <div class="row ">
            <?php $__currentLoopData = $myfavorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-2">
                <?php $__env->startComponent('components.article',['model'=>$post , 'ajax'=>0]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/MyFavorite.blade.php ENDPATH**/ ?>