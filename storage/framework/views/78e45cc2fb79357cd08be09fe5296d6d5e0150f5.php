<?php $__env->startSection('content'); ?>
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                برای حذف ویدئو مطمئن هستید؟
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteVideo')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="video_id" id="video_id" value="">
                    <button type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">افزودن ویدیو</h5>
                <hr />
            </div>
            <?php if(isset($videos) && count($videos)): ?>
            <div style="overflow-x: auto;" class="mb-3">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th> url </th>
                            <th>کیفیت</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <td>
                                <a href="<?php echo e($video->url); ?>" class="text-primary"><?php echo e($video->url); ?></a>
                            </td>
                            <td>
                                <?php echo e($video->quality->quality); ?>

                            </td>
                            <td>
                                <a href="#" data-id="<?php echo e($video->id); ?>" data-toggle="modal" data-target="#deletemodal"
                                    class="btn btn-danger btn-sm">حذف</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>

            <form class="add-video" action="<?php echo e(route('Panel.UploadVideo')); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="post" value="<?php echo e($id); ?>">
                <?php if(isset($episode_id) && $episode_id !== null): ?>
                <input type="hidden" name="episode" value="<?php echo e($episode_id); ?>">
                <?php endif; ?>
                <div class="files-wrapper">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for=""> فایل: </label>
                                </div>
                                <div class="col-md-9">
                                    <input required type="file" name="file" id="file" class="dropify"
                                        data-default-file="" data-allowed-file-extensions="mp4" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <?php $__currentLoopData = \App\Quality::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="custom-control custom-radio custom-control">
                                <input type="radio" id="<?php echo e($key+1); ?>" name="quality" value="<?php echo e($item->quality); ?>"
                                    class="custom-control-input" <?php echo e($key == 0 ? 'checked' : ''); ?>>
                                <label class="custom-control-label" for="<?php echo e($key+1); ?>"><?php echo e($item->quality); ?></label>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="wraper">
                                <?php $__currentLoopData = \App\Quality::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quality): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="language" name="language" value="<?php echo e($quality->id); ?>"
                                        <?php echo e(isset($post) && $post->languages()->pluck('id')->contains($quality->id) ? 'checked' : ''); ?>

                                        class="custom-control-input">
                                    <label class="custom-control-label" for="language">
                                        <?php echo e($quality->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <input type="number" class="form-control" placeholder="کیفیت جدید">
                            <a href="#" onclick="addQuality(event)" class="d-block btn btn-sm btn-success mt-2"><i
                                    class="fas fa-plus-circle"></i></a>
                        </div>
                        <div
                            class="form-group <?php echo e(!is_null($post) && $post->type == "series" ? " col-md-12" : "col-md-12"); ?>">
                            <button class="btn btn-sm btn-success text-white" type="submit"> آپلود &nbsp; <i
                                    class="fas fa-upload"></i></button>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 0%">
                                    0%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            
        </div>
    </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $('#deletemodal').on('shown.bs.modal', function (event) {
var button = $(event.relatedTarget)
  var recipient = button.data('id')
  $('#video_id').val(recipient)

    })


   
    $("form").ajaxForm({
        beforeSerialize: function ($Form, options) {},
        beforeSend: function () {},
        uploadProgress: function (event, position, total, percentComplete) {
            $(".progress-bar").text(percentComplete + "%");
            $(".progress-bar").css("width", percentComplete + "%");
        },
        success: function (data) {
      
        },
        error: function (data) {},
    });

    function deleteVideo(id) { 
        
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Files/UploadVideo.blade.php ENDPATH**/ ?>