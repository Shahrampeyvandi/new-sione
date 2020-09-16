<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">افزودن </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" <?php if(isset($advert)): ?> action="<?php echo e(route('Panel.EditAdvert',$advert)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddAdvert')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <h6 class=""> <span class="text-danger"> *</span> موضوع: </h6>
                                <input required type="text" class="form-control" name="title" id="title"
                                    value="<?php echo e($advert->title ?? ''); ?>">
                            </div>
                        </div>
                       

                        <div class="row mt-3">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> <span class="text-danger"> *</span> پوستر:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($advert)): ?>
                                             <?php echo e(asset($advert->poster)); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/400x200.png')); ?> 
                                            <?php endif; ?>">
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>
                       


                        

                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <?php if(isset($advert)): ?>
                            ویرایش
                            <?php else: ?>
                            ثبت
                            <?php endif; ?>
                            اطلاعات </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendors/ckeditor/ckeditor.js')); ?>"></script>
<script>
    CKEDITOR.replace('desc',{
            contentsLangDirection: 'rtl',
            filebrowserUploadUrl: '<?php echo e(route('UploadImage')); ?>?type=file',
            imageUploadUrl: '<?php echo e(route('UploadImage')); ?>?type=image',
        });


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Advert/Add.blade.php ENDPATH**/ ?>