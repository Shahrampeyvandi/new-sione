<?php $__env->startSection('Title',$title); ?>


<?php $__env->startSection('content'); ?>


<div class="margin-bottom container">
    <div class="row mt-8">
        <div class="col-6 col-md-3 d-flex ">
            <?php if($cast->image): ?>
            <img src="<?php echo e(asset($cast->image)); ?>" alt="<?php echo e($cast->name); ?>" title="<?php echo e($cast->name); ?>" class="Person-image">
             <?php else: ?> 
               <img src="<?php echo e(asset('assets/images/avatar.png')); ?>" alt="<?php echo e($cast->name); ?>" class="radius-50">  
            <?php endif; ?>

        </div>
        <div class="col-md-9">
            <div class="Person-description">
                <div class="Person-title fs-1-5 mb-2 mt-0 mt-md-5"><?php echo e($cast->name); ?></div>
                <div class="fs-1">
                    <?php echo html_entity_decode($cast->bio, ENT_QUOTES, 'UTF-8'); ?>

                </div>
            </div>
        </div>
    </div>
</div>


<?php if(count($posts)): ?>
  <div class="container">
<div class="row mt-8 mb-5">
  <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="col-6 col-md-2">
            <?php $__env->startComponent('components.article',['model'=>$post , 'ajax'=>0]); ?>
            <?php echo $__env->renderComponent(); ?>
            </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  </div>
<?php endif; ?>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/Cast.blade.php ENDPATH**/ ?>