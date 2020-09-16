<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">
                    
                    <?php if(isset($slideshow)): ?>
ویرایش
                     <?php else: ?>   
افزودن
                    <?php endif; ?>
                 
                  
                     
                
                
                </h5>
                <hr />
            </div>
            <form <?php if(!isset($slideshow)): ?>
                id="add-slider"
            <?php endif; ?>   method="post" <?php if(isset($slideshow)): ?> action="<?php echo e(route('Panel.EditSlider',$slideshow)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddSlider')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">محتوای مرتبط :  </label>
                                <select class="js-example-basic-single" name="post" id="post" required>
                                   <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                     <option value="<?php echo e($post->id); ?>"
                                    <?php if(isset($slideshow)): ?>
                                        <?php echo e($slideshow->post->id == $post->id ? 'selected' : ''); ?>

                                    <?php endif; ?>
                                    
                                    
                                    ><?php echo e($post->name . ' - ' . $post->year . ' - ( ' . $post->type . ' )'); ?></option>

                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($slideshow)): ?>
                                             <?php echo e(asset($slideshow->image)); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/640x360.png')); ?> 
                                            <?php endif; ?>">
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <?php if(isset($slideshow)): ?>
                                    ویرایش
                                    <?php else: ?>
                                    ثبت
                                    <?php endif; ?>
                                    اطلاعات </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Slider/Add.blade.php ENDPATH**/ ?>