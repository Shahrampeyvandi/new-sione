<?php $__env->startSection('content'); ?>

<div class="modal fade" id="addActor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form class="add-actor" action="<?php echo e(route('Panel.Actor.Insert')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <select name="type" class="custom-select  mb-3">
                                <option value="actor">بازیگر</option>
                                <option value="writer">نویسنده</option>
                                <option value="creator">کارگردان</option>

                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" name="fullname" id="fullname" value=""
                                placeholder="نام کامل">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">توضیحات</label>
                            <textarea type="text" class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="file" class="form-control dropify" name="picture" id="picture"
                                data-default-file="" value="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class=" btn btn-success text-white">ثبت</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">افزودن فایل</h5>
                <hr />
            </div>
            <form id="upload-file" method="post" action="<?php echo e(route('Panel.UploadFile')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($post)): ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="post_id" id="post_id" value="<?php echo e($post->id); ?>">
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" name="title" id="title"
                                    value="<?php echo e($post->name ?? ''); ?>" placeholder="عنوان">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="type" id="movie-type" class=" custom-select  mb-3"
                                    onchange="seriesOptions(event)">
                                    <option value="movies" <?php if(isset($post) && $post->type == 'movies'): ?>
                                        checked
                                        <?php endif; ?>>سینمایی</option>
                                    <option value="series" <?php if(isset($post) && $post->type == 'series'): ?>
                                        checked
                                        <?php endif; ?>>سریال</option>
                                </select>
                            </div>
                             <div class="form-group col-md-">
                         
                            <input type="number" class="form-control" name="year" id="year" value=""
                              placeholder="سال ساخت"  >
                        </div>
                            <div class="form-group form-inline col-md-4">
                               
                                <input type="number" class="form-control  mx-2" name="age_rate" id="age_rate"
                                    placeholder="محدوده سنی" value="<?php echo e($post->age_rate ?? ''); ?>">
                                <span>+</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : </label>
                                <textarea class="form-control" name="desc" id="desc" cols="30"
                                    rows="8"><?php echo e($post->description ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="short_desc">توضیحات کوتاه: </label>
                                <textarea class="form-control" name="short_desc" id="short_desc" cols="30"
                                    rows="8"><?php echo e($post->short_description ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <?php if(isset($post)): ?>

                                <video width="350" controls>
                                    <source src="<?php echo e(asset($post->trailer->url)); ?>" type="video/mp4">
                                    Your browser does not support HTML video.
                                </video>
                                <?php endif; ?>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> تریلر: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" name="trailer" <?php if(isset($post)): ?> class="form-control" <?php else: ?>
                                            class="dropify" data-default-file="" data-allowed-file-extensions="mp4"
                                            <?php endif; ?> />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <?php if(isset($post)): ?>
                                <img src="<?php echo e($post->poster); ?>" alt="">
                                <?php endif; ?>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر فیلم: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" name="poster" <?php if(isset($post)): ?> class="form-control" <?php else: ?>
                                            class="dropify" data-default-file="" data-max-file-size="600K"
                                            data-allowed-file-extensions="jpg jpeg png" <?php endif; ?> />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="desc">تصاویر: </label>
                        <?php if(isset($post)): ?>
                        <div class="row">
                            <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class=" col-md-3">
                                <a style="cursor: pointer;color:red" onclick="removeImage(event,<?php echo e($image->id); ?>)"><i
                                        class="fas fa-trash"></i></a>
                                <img width="100%" src="<?php echo e(asset($image->url)); ?>" alt="">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                        <span style="cursor: pointer;" href="" onclick="getClone(this)"><i class="fa fa-plus"></i>
                            افزودن </span>

                        <div class="row">
                            <div class=" col-md-3 image-box">
                                <div class="form-group">
                                    <input type="file" name="images[]" class="dropify" data-max-file-size="300K"
                                        data-allowed-file-extensions="png jpg jpeg" data-default-file="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 right-side">
                        <div class="cat">
                            <h6 class="">دسته بندی ها: </h6>
                            <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                            <span><?php echo e($errors->first('category')); ?></span>
                            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addCategory(event)">افزودن</a>
                            <div class="cat-wrapper">
                                <?php if(isset($post)): ?>
                                <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="<?php echo e($key+1); ?>" name="category[]" value="<?php echo e($item->name); ?>"
                                        <?php echo e($post->categories()->pluck('id')->contains($item->id) ? 'checked' : ''); ?>

                                        class="custom-control-input">
                                    <label class="custom-control-label" for="<?php echo e($key+1); ?>"><?php echo e($item->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <?php $__currentLoopData = \App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="<?php echo e($key+1); ?>" name="category[]" value="<?php echo e($item->name); ?>"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="<?php echo e($key+1); ?>"><?php echo e($item->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="casts mt-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="">بازیگران: </h6>
                                <a href="#" title="جدید " data-toggle="modal" data-target="#addActor"
                                    class="m-2 btn btn-sm btn-primary">
                                    جدید
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <div class="form-group">
                                <select name="actors[]" class="js-example-basic-single" multiple dir="rtl">
                                    <?php $__currentLoopData = $actors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($actor->id); ?>"
                                        <?php echo e(isset($post) && $post->actors()->pluck('id')->contains($actor->id) ? 'selected' : ''); ?>>
                                        <?php echo e($actor->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="casts mt-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="">نویسنده (ها)</h6>
                                <a href="#" title="جدید " data-toggle="modal" data-target="#addActor"
                                    class="m-2 btn btn-sm btn-primary">
                                    جدید
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <div class="form-group">
                                <select name="writers[]" class="js-example-basic-single" multiple dir="rtl">
                                    <?php $__currentLoopData = $writers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($writer->id); ?>"
                                        <?php echo e(isset($post) && $post->writers()->pluck('id')->contains($writer->id) ? 'selected' : ''); ?>>
                                        <?php echo e($writer->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="casts mt-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="">کارگردان</h6>
                                <a href="#" title="جدید " data-toggle="modal" data-target="#addActor"
                                    class="m-2 btn btn-sm btn-primary">
                                    جدید
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                            <div class="form-group">
                                <select name="directors[]" class="js-example-basic-single" multiple dir="rtl">
                                    <?php $__currentLoopData = $directors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $director): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($director->id); ?>"
                                        <?php echo e(isset($post) && $post->directors()->pluck('id')->contains($director->id) ? 'selected' : ''); ?>>
                                        <?php echo e($director->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="casts mt-3">
                            <h6 class="">زبان</h6>
                            <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addLanguage(event)">افزودن</a>
                            <div class="cat-wrapper">

                                <?php $__currentLoopData = \App\Language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="ln-<?php echo e($key+1); ?>" name="language" value="<?php echo e($language->name); ?>"
                                        <?php echo e(isset($post) && $post->languages()->pluck('id')->contains($language->id) ? 'checked' : ''); ?>

                                        class="custom-control-input">
                                    <label class="custom-control-label" for="ln-<?php echo e($key+1); ?>">
                                        <?php echo e($language->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                        <div class="casts mt-3">
                            <h6 class="">جوایز فیلم</h6>
                            <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addAward(event)">افزودن</a>
                            <div class="cat-wrapper">
                                <?php if(isset($post->awards)): ?>
                                <?php $__currentLoopData = $post->awards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $award): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="award-<?php echo e($key+1); ?>" name="awards[]" value="<?php echo e($award); ?>"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="award-<?php echo e($key+1); ?>">
                                        <?php echo e($award); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"> ادامه &nbsp;<i
                                class="fas fa-arrow-circle-left"></i> </button>
                    </div>
                </div>
            </form>
            <hr>
            <div>

            </div>
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

<?php $__env->startSection('js'); ?>
<script>
    function removeImage (event,id) {
            event.preventDefault()
            var target =$(event.target)
            data = { id:id, _method: 'delete',_token: "<?php echo e(csrf_token()); ?>" };
            url='<?php echo e(route('Panel.DeleteImage')); ?>';
            request = $.post(url, data);
            request.done(function(res){
            target.parents('.col-md-3').remove()
        });
            }
              
               
              

           
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Files/Upload.blade.php ENDPATH**/ ?>