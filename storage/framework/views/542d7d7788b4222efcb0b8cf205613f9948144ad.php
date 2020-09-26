<?php $__env->startSection('Title',$title); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
 
  <div class="movie-req">
    <form action="<?php echo e(route('MovieRequest')); ?>" method="post">
      <?php echo csrf_field(); ?>
      <?php if(count($errors)): ?>
      <h1>
        <?php echo e($errors->first()); ?>

      </h1>
      <?php endif; ?>
      <div class="i">
        <label for="name" class="mb-2">
          لطفا نام فیلم یا سریال را وارد نمایید
        </label>
        <input type="text" id="name" name="name" class="form-control mb-3" autocomplete="off" dir="rtl">
      </div>
      <button class="submit_login btn--ripple" type="submit">
        تایید
      </button>
    </form>
  </div>


</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/movie-request.blade.php ENDPATH**/ ?>