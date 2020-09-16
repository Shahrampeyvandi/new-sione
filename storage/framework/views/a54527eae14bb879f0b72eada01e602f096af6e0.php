<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">افزودن </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" <?php if(isset($blog)): ?> action="<?php echo e(route('Panel.EditBlog',$blog)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddBlog')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <h6 class=""> <span class="text-danger"> *</span> عنوان وبلاگ: </h6>
                                <input required type="text" class="form-control" name="name" id="name"
                                    value="<?php echo e($blog->title ?? ''); ?>">
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">

                                <h6 class=""> <span class="text-danger"> *</span> دسته بندی : </h6>

                                <div class="cat-wrapper">

                                    <?php $__currentLoopData = \App\BlogCategory::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="blogc-<?php echo e($key+1); ?>" name="category" value="<?php echo e($cat->id); ?>"
                                            class="custom-control-input" <?php if(isset($blog)): ?>
                                            <?php echo e($blog->category_id == $cat->id ? 'checked' : ''); ?> <?php endif; ?>>
                                        <label class="custom-control-label"
                                            for="blogc-<?php echo e($key+1); ?>"><?php echo e($cat->name); ?></label>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> <span class="text-danger"> *</span> پوستر:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($blog)): ?>
                                             <?php echo e(asset($blog->poster)); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/640x360.png')); ?> 
                                            <?php endif; ?>">
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc"> <span class="text-danger"> *</span> توضیحات : در صورت نیاز میتوانید
                                    به حالت دراگ دراپ تصویر اضافه
                                    نمایید</label>
                                <textarea class="form-control" name="desc" id="desc" cols="30" rows="8">

                                    <?php echo e($blog->description ?? ''); ?>

                                </textarea>
                            </div>
                        </div>

                       <?php if(isset($blog) && count($blog->videos)): ?>
                            <div class="row">
                            <div class="col-md-6">
                                <video width="320" height="240" controls>
                                    <source src="<?php echo e(asset($blog->videos->first()->url)); ?>" type="video/mp4">
                                   
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                       <?php endif; ?>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="desc"> ویدئو: </label>
                                <input type="file" class="form-control" name="video" id="video">
                            </div>
                        </div>

                        <label for="">منابع: </label>
                        <?php if(isset($blog) && count($blog->links)): ?>
                        <?php $__currentLoopData = $blog->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class=" row">
                            <div class="col-md-6 ">
                                <input type="text" class="form-control" name="link_name[]" id="link_name"
                                    value="<?php echo e($link->name); ?>" placeholder="نام منبع">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="link_url[]" id="link_url"
                                    value="<?php echo e($link->url); ?>" placeholder="آدرس">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php else: ?>
                        <div class=" row">
                            <div class="col-md-6 ">
                                <input type="text" class="form-control" name="link_name[]" id="link_name" value=""
                                    placeholder="نام منبع">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="link_url[]" id="link_url" value=""
                                    placeholder="آدرس">
                            </div>
                        </div>
                        <?php endif; ?>

                        <a href="#" onclick="addBlogLink(event)" class="pr-3">افزودن </a>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <?php if(isset($blog)): ?>
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
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Blog/Add.blade.php ENDPATH**/ ?>