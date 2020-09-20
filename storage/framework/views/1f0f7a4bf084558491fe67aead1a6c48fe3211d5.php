<div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                برای حذف این مورد مطمئن هستید
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeletePost')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="post_id" id="post_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteSlider" tabindex="-1" role="dialog" aria-labelledby="deleteSliderLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSliderLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                برای حذف این مورد مطمئن هستید
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteSlider')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="slider_id" id="slider_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                با حذف دسته بندی تمام فیلم های این دسته بندی از دسته بندی مورد نظر خارج میشوند
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteCat')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="category_id" id="category_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp1\htdocs\sione\resources\views/Includes/Panel/modals.blade.php ENDPATH**/ ?>