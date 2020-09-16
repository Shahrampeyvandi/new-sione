<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Includes.Panel.categoriesmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">
                    <?php if(isset($category)): ?>
                    ویرایش
                    <?php else: ?>
                    افزودن
                    <?php endif; ?>
                    دسته بندی </h5>
                <hr />
            </div>
            <form id="add-plan" method="post" <?php if(isset($category)): ?> action="<?php echo e(route('Panel.EditCat',$category)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddCat')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="name" id="name" 
                                    placeholder="نام "
                                    <?php if(isset($category)): ?>
                                     value="<?php echo e($category->name); ?>"
                                    <?php endif; ?>
                                    >
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="latin" id="latin" 
                                    placeholder="نام لاتین"
                                    
                                     <?php if(isset($category)): ?>
                                     value="<?php echo e($category->latin); ?>"
                                    <?php endif; ?>>
                            </div>
                        </div>
                        <div class="form-row col-6">
                            <div class="col-md-3">
                                <label for=""> پوستر : </label>
                            </div>
                            <div class="col-md-9">
                                <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($category) && $category->image): ?>
                                             <?php echo e(asset($category->image)); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/300x200.png')); ?> 
                                            <?php endif; ?>">
                                <input type="file" name="poster" id="poster" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <?php if(isset($category)): ?>
                            ویرایش
                            <?php else: ?>
                            ثبت
                            <?php endif; ?>


                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<style>
    label.error {
        font-size: 12px;
        color: red;
        /* position: absolute; */
        /* top: -50px; */
        /* right: 70px; */
        margin-left: 50px;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Category/add.blade.php ENDPATH**/ ?>