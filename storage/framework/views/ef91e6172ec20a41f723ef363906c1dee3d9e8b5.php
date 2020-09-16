     <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.UnconfirmedComments')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.UnconfirmedComments"): ?> <?php echo e('active'); ?>

             <?php endif; ?>">در انتظار تایید</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.ConfirmedComments')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.ConfirmedComments"): ?> <?php echo e('active'); ?>

    <?php endif; ?>">تایید شده</a>
        </li>
</ul>
<?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Panel/Comments/commentsmenu.blade.php ENDPATH**/ ?>