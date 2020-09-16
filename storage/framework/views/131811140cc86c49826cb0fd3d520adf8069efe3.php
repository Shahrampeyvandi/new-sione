<?php $__env->startSection('Title','دسته بندی ها'); ?>

<?php $__env->startSection('content'); ?>
<section class="category">
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="category-box">
                <a href="<?php echo e($category->path()); ?>">
                        <img src="<?php echo e(asset($category->getImage())); ?>" alt="">
                        <h3>
                            <?php echo e($category->name); ?>

                        </h3>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/Categories.blade.php ENDPATH**/ ?>