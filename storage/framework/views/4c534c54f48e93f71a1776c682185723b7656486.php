<div class="modal fade" id="delete<?php echo e($name); ?>" tabindex="-1" role="dialog" aria-labelledby="delete<?php echo e($name); ?>Label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete<?php echo e($name); ?>Label">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                برای حذف مورد مطمئن هستید
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteCat')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="<?php echo e($name); ?>_id" id="<?php echo e($name); ?>_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp1\htdocs\sione\resources\views/components/modal.blade.php ENDPATH**/ ?>