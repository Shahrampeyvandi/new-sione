<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Includes.Panel.Comments.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td>
        <div class="custom-control custom-checkbox custom-control-inline" style="margin-left: -1rem;">
            <input data-id="<?php echo e($comment->id); ?>" type="checkbox" id="comment_<?php echo e($key); ?>" name="customCheckboxInline1"
                class="custom-control-input" value="1">
            <label class="custom-control-label" for="comment_<?php echo e($key); ?>"></label>
        </div>
    </td>
    <td><?php echo e($key+1); ?></td>
    <td>
        <a href="#" class="text-primary"><?php echo e($comment->name); ?></a>
    </td>
    <td><?php echo e($comment->views); ?></td>
    <td class="text-success"><?php echo e($comment->votes()->count()); ?></td>
    <td>
        <?php $__currentLoopData = $comment->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($category->name); ?> ,
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </td>
    <td>
        <?php $__currentLoopData = $comment->languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($language->name); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </td>
    <td>
        <a href="<?php echo e(route('Panel.EditMovie',$comment)); ?>" class="btn btn-sm btn-info">ویرایش سریع </a>
        <a href="<?php echo e(route('Panel.EditMovie',$comment)); ?>" class="btn btn-sm btn-primary">پاسخ</a>
        <a href="<?php echo e(route('Panel.EditMovie',$comment)); ?>" class="btn btn-sm btn-success">پذیرفتن</a>

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
    
       


     $('.delete-comment').click(function(e){
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
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Comments/UnconfirmedComments.blade.php ENDPATH**/ ?>