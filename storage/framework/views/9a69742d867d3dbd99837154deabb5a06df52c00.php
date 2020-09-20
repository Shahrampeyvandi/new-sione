<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Includes.Panel.categoriesmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Panel.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">لیست دسته بندی ها</h5>
            <hr>
        </div>
        <div style="overflow-x: auto;">
            <table id="example1" class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>ردیف</th>
                        <th> عنوان </th>
                        <th>تصویر</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>

                        <td><?php echo e($key+1); ?></td>
                        <td>
                            <a href="#" class="text-primary"><?php echo e($category->name); ?></a>
                        </td>


                        <td class="text-info">
                            <?php if($category->image): ?>
                            <img src="<?php echo e(asset($category->image)); ?>" style="width:200px;">
                            <?php else: ?>
                            --
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="<?php echo e(route('Panel.EditCat',$category)); ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" data-id="<?php echo e($category->id); ?>" title="حذف " data-toggle="modal"
                                data-target="#deleteCategory" class="btn btn-sm btn-danger   m-2">

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
    
       
 $('#deleteCategory').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#category_id').val(recipient)

    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Category/list.blade.php ENDPATH**/ ?>