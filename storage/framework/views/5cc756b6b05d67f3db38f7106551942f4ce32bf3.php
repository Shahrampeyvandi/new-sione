<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.modal',['name'=>'collection']); ?>
<?php echo $__env->renderComponent(); ?>

<div class="card">
    <div class=" card-body ">
        <ul class="nav nav-pills ">
            <li class="nav-item">
                <a href="<?php echo e(route('Panel.CollectionList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.CollectionList"): ?> <?php echo e('active'); ?> <?php endif; ?>">لیست</a>
            </li>
            <li class="nav-item">
                <a href="<?php echo e(route('Panel.AddCollection')); ?>" class="nav-link
            <?php if(\Request::route()->getName() == "Panel.AddCollection"): ?> <?php echo e('active'); ?> <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
            </li>
        </ul>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">لیست مجموعه ها</h5>
            <hr>
        </div>
        <div style="overflow-x: auto;">
            <table id="example1" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th> عنوان </th>
                        <th>تصویر</th>
                        <th>نوع</th>
                        <th>
                            محتوا
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $collections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$collection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td>
                            <a href="#" class="text-primary"><?php echo e($collection->name); ?></a>
                        </td>
                        <td class="text-info">
                            <?php if($collection->poster): ?>
                            <img src="<?php echo e(asset($collection->poster)); ?>" style="width:200px;">
                            <?php else: ?>
                            --
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($collection->for == 'movies'): ?>
                            <span>فیلم</span>
                                
                            <?php elseif($collection->for == 'series'): ?>
                            <span>سریال</span>
                            <?php else: ?>
                            <span>مستند</span>
                            <?php endif; ?>
                        </td>
                          <td>
                            <?php $__currentLoopData = $collection->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                             <a href="#"><?php echo e(str_limit($post->title,20,'..')); ?></a> <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <a href="<?php echo e(route('Panel.EditCollection',$collection)); ?>" class="btn btn-sm btn-info"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#" data-id="<?php echo e($collection->id); ?>" title="حذف " data-toggle="modal"
                                data-target="#deletecollection" class="btn btn-sm btn-danger   m-2">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div style="text-align: center">
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script>
    $('#deletecollection').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#collection_id').val(recipient)

    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Collection/list.blade.php ENDPATH**/ ?>