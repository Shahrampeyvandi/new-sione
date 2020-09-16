<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Includes.Panel.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Panel.slidermenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت اسلایدر ها</h5>
            <hr>
        </div>

     <table id="example1" class="table table-striped  table-bordered w-100">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>تصویر</th>
                    <th>نوع</th>
                   <th>مربوط به</th>

                    <th>عملیات</th>

                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $slideshows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$slideshow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td><img src="<?php echo e(asset($slideshow->image)); ?>" style="width:200px;"></td>
                    <td><span class="text-primary"><?php echo e($slideshow->post->type == 'series' ? 'سریال' : 'سینمایی'); ?></span></td>
                   <td><span class="text-primary"><?php echo e($slideshow->post->name . ' - ' . $slideshow->post->year); ?></span></td>
                  
               
                   
                    <td>

                         <a href="<?php echo e(route('Panel.EditSlider',$slideshow->id)); ?>" class="btn btn-sm btn-info">ویرایش</a>
                        <a href="#" data-id="<?php echo e($slideshow->id); ?>" title="حذف " data-toggle="modal" data-target="#deleteSlider"
                            class="btn btn-sm btn-danger   m-2">

                            <i class="fa fa-trash"></i>

                        </a>

                    </td>
                </tr>
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
    $('#slider-type').change(function(){
        if($(this).val() == "client slider"){
            $('.header_sec').show(200)
        }else{
            $('.header_sec').hide(200)
       
        }
    })

    $("#setting").validate({
		rules: {
            header:{
        required: function(element){
            return $("#slider-type").val() == "client slider";
        }
      },
		},
		messages: {
			header: "لطفا عنوان هدر اسلایدر را وارد نمایید",
		
		}
    });
    

    
         $('#deleteSlider').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#slider_id').val(recipient)

    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Slider/List.blade.php ENDPATH**/ ?>