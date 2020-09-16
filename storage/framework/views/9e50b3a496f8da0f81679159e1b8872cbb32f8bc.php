<?php $__env->startSection('content'); ?>
<style>
    th,td{
        padding: 10px;
    }
</style>
  <a href="<?php echo e(route('MainUrl')); ?>" class="logo-float-right">
                            <img class="site-logo" src="<?php echo e(asset('assets/images/aa-300x157.png')); ?>" alt="site-logo">

</a>
<section class="profile-section" style="width: 70%">

    <h1>
        لیست سفارشات
    </h1>
    
    <div class="plans">
        <div class="container-fluid">

            <table class=" w-100">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شماره سفارش</th>
                        <th>زمان ثبت سفارش</th>
                        <th>وضعیت سفارش</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e(($key+1)); ?></td>
                        <td><?php echo e($item->transaction_code); ?></td>
                        <td><?php echo e(\Morilog\Jalali\Jalalian::forge($item->created_at)->format('%B %d، %Y')); ?></td>
                        <td>
                            <?php if($item->success == '1'): ?>
                            <span class="text-success">موفق</span>
                            <?php else: ?>    
                             <span class="text-danger">ناموفق</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>

        </div>
    </div>



</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/orders.blade.php ENDPATH**/ ?>