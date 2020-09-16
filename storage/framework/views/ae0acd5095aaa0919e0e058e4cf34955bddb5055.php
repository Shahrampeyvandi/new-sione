<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center"> ویرایش اطلاعات</h5>
                <hr />
            </div>
            <form id="edit-member" method="post" action="<?php echo e(route('Panel.EditActor',$artist->id)); ?>"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="type" value="<?php echo e($type); ?>">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for=""><span class="text-danger">*</span> نام </label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo e($artist->name ?? ''); ?>"
                            placeholder="نام ">
                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="bio">بیوگرافی: </label>
                        <textarea class="form-control" name="bio" id="bio" cols="30"
                            rows="8"><?php echo $artist->bio; ?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for=""> تصویر: </label>
                            </div>
                            <div class="col-md-3">
                                <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($artist)): ?>
                                             <?php echo e(asset($artist->image)); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/640x360.png')); ?> 
                                            <?php endif; ?>">
                                <input type="file" name="poster" id="poster" />

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <button type="submit" class="btn btn-primary">
                        ویرایش

                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Actors/Edit.blade.php ENDPATH**/ ?>