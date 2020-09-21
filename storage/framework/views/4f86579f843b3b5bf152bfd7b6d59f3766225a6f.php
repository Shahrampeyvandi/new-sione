<?php $__env->startSection('content'); ?>

<?php echo $__env->make('Includes.Panel.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Panel.moviesmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت فایل ها</h5>
            <hr>
        </div>

        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    
                    <th>ردیف</th>
                    <th> نام </th>
                    
                    <th>لایک ها</th>
                    <th>دسته بندی ها</th>
                    <th>زبان</th>
                    <th></th>


                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                   
                    <td><?php echo e($key+1); ?></td>
                    <td style="max-width: 120px">
                        <a href="#" class="text-primary"><?php echo e($post->name); ?></a>
                    </td>
                   
                    <td class="text-success"><?php echo e($post->likes()); ?></td>
                    <td>
                        <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($category->name); ?> ,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $post->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($language->name); ?> -
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('Panel.EditMovie',$post)); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="#" data-id="<?php echo e($post->id); ?>" title="حذف " data-toggle="modal" data-target="#deletePost"
                            class="btn btn-sm btn-danger   m-2">

                            <i class="fa fa-trash"></i>

                        </a>

                    </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </tbody>
        </table>

    </div>



</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
   
    
         $('#deletePost').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#post_id').val(recipient)

    })


    //  $('.deleteposts').click(function(e){
    //         e.preventDefault()

    //         data = { array:array, _method: 'delete',_token: "<?php echo e(csrf_token()); ?>" };
    //         url='<?php echo e(route('Panel.DeletePost')); ?>';
    //         request = $.post(url, data);
    //         request.done(function(res){
    //         location.reload()
    //     });
    // })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Movies/List.blade.php ENDPATH**/ ?>