<?php $__env->startSection('content'); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                موارد علامت زده شده حذف شوند؟
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="video_id" id="video_id" value="">
                    <a href="#" class="deleteposts btn btn-danger text-white">حذف! </a>
                </form>
            </div>
        </div>
    </div>
</div>

<ul class="nav nav-pills mb-3">
    <li class="nav-item">
        <a href="<?php echo e(route('Panel.FileList')); ?>" class="nav-link <?php if(\Request::route()->getName() == "Panel.FileList"): ?>
            <?php echo e('active'); ?> <?php endif; ?>">لیست</a>
    </li>
    <li class="nav-item">
        <a href="<?php echo e(route('Panel.UploadImdb')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.UploadImdb"): ?> <?php echo e('active'); ?> <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
    </li>

</ul>
<div class="card">
    <div class="container_icon card-body d-flex justify-content-end">
        <div class="delete-edit" style="display:none;">
            <a href="#" title="حذف " data-toggle="modal" data-target="#exampleModal" class="order-delete   m-2">
                <span class="__icon bg-danger">
                    <i class="fa fa-trash"></i>
                </span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت فایل ها</h5>
            <hr>
        </div>
        
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th></th>
                    <th>ردیف</th>
                    <th> نام </th>
                    <th>بازدید ها</th>
                    <th>لایک ها</th>
                    <th>دسته بندی ها</th>
                    <th>زبان</th>
                    <th></th>


                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox custom-control-inline" style="margin-left: -1rem;">
                            <input data-id="<?php echo e($post->id); ?>" type="checkbox" id="post_<?php echo e($key); ?>"
                                name="customCheckboxInline1" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="post_<?php echo e($key); ?>"></label>
                        </div>
                    </td>
                    <td><?php echo e($key+1); ?></td>
                    <td>
                        <a href="#" class="text-primary"><?php echo e($post->name); ?></a>
                    </td>
                    <td><?php echo e($post->views); ?></td>
                    <td class="text-success"><?php echo e($post->votes()->count()); ?></td>
                    <td>
                        <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($category->name); ?> ,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $post->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($language->name); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('Panel.FileEdit',$post)); ?>" class="btn btn-sm btn-info">ویرایش</a>
                        <a href="<?php echo e(route('Panel.UploadVideo')); ?>?id=<?php echo e($post->id); ?>"
                            class="btn btn-sm btn-outline-info">ویدیوها</a>

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
    $('table input[type="checkbox"]').change(function(){
            if( $(this).is(':checked')){
            $(this).parents('tr').css('background-color','#41f5e07d');
            }else{
                $(this).parents('tr').css('background-color','');

            }
            array=[]
            $('table input[type="checkbox"]').each(function(){
                if($(this).is(':checked')){
                array.push($(this).attr('data-id'))

               }
               if(array.length !== 0){
                $('.delete-edit').show()
                if (array.length !== 1) {
                    $('.container_icon').removeClass('justify-content-end')
                    $('.container_icon').addClass('justify-content-between')
                    $('.edit-personal').hide()
                }else{

                    $('.container_icon').removeClass('justify-content-end')
                    $('.container_icon').addClass('justify-content-between')
                    $('.edit-personal').show()
                    
                   
                }
            }
            else{
                $('.container_icon').removeClass('justify-content-between')
                $('.container_icon').addClass('justify-content-end')
                $('.delete-edit').hide()
            }
        })
            
    })
    
       


     $('.deleteposts').click(function(e){
            e.preventDefault()
            data = { array:array, _method: 'delete',_token: "<?php echo e(csrf_token()); ?>" };
            url='<?php echo e(route('Panel.DeletePost')); ?>';
            request = $.post(url, data);
            request.done(function(res){
            location.reload()
        });
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Files/List.blade.php ENDPATH**/ ?>