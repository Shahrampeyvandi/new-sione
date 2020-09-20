<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Includes.Panel.categoriesmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">
                    <?php if(isset($collection)): ?>
                    ویرایش
                    <?php else: ?>
                    افزودن
                    <?php endif; ?>
                    کالکشن</h5>
                <hr />
            </div>
            <form id="add-plan" method="post" <?php if(isset($collection)): ?> action="<?php echo e(route('Panel.EditCollection',$collection)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddCollection')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="نام "
                                    <?php if(isset($collection)): ?> value="<?php echo e($collection->name); ?>" <?php endif; ?>>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">مربوط به:</label>
                                <select class="custom-select" name="for" id="for">
                                    <option value="movies" <?php echo e(isset($collection) && $collection->for == 'movies' ? 'selected' : ''); ?>>movie</option>
                                    <option value="series" <?php echo e(isset($collection) && $collection->for == 'series' ? 'selected' : ''); ?>>serie</option>
                                    <option value="documentary <?php echo e(isset($collection) && $collection->for == 'documentary' ? 'selected' : ''); ?>">documentary</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-row col-6">
                            <div class="col-md-3">
                                <label for=""> پوستر : </label>
                            </div>
                            <div class="col-md-9">
                                <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($collection) && $collection->poster): ?>
                                             <?php echo e(asset($collection->poster)); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/300x200.png')); ?> 
                                            <?php endif; ?>">
                                <input type="file" name="poster" id="poster" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : </label>
                            <textarea class="form-control" name="desc" id="desc" cols="30" rows="8"><?php echo e($collection->description); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <?php if(isset($collection)): ?>
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
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Collection/add.blade.php ENDPATH**/ ?>