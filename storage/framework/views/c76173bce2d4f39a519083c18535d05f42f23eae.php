<?php $__env->startSection('content'); ?>


<div class="modal fade" id="delete-season" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                در صورت حذف فصل تمام قسمت های آن حذف خواهد شد!!
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteSeason')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="season_id" id="season_id" value="">
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
                <h5 class="text-center">
                    <?php if(isset($season)): ?>
                    ویرایش
                    <?php else: ?>
                    افزودن
                    <?php endif; ?>
                    فصل</h5>
                <hr />
            </div>
            <form id="upload-file" method="post" <?php if(isset($season)): ?> action="<?php echo e(route('Panel.EditSeason',$season)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddSeason',$post_id)); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">عنوان : </label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="<?php echo e($season->name ?? ''); ?>">
                            </div>
                        </div>
                        <?php if(!isset($season)): ?>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">شماره فصل: </label>
                                <?php if(!is_null($totalSeasons)): ?>
                                <select name="number" id="number" class="form-control">

                                    <?php for($i = 1; $i <= $totalSeasons; $i++): ?> <option value="<?php echo e($i); ?>">فصل <?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                </select>
                                <?php else: ?>
                                <input type="text" class="form-control" name="number" id="number"
                                    value="<?php echo e($season->number ?? ''); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">تاریخ پخش: </label>
                                <input type="text" class="form-control datepicker" name="release" id="release"
                                    <?php if(isset($season)): ?>
                                    value="<?php echo e(\Carbon\Carbon::parse($season->publish_date)->format('d F Y')); ?>" <?php endif; ?>>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : </label>
                                <textarea class="form-control" name="desc" id="desc" cols="30"
                                    rows="8"><?php echo e($season->description ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر فصل: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px"
                                            <?php if(isset($season) && $season->poster): ?>
                                        src="<?php echo e(asset($season->poster)); ?>" <?php else: ?>
                                        src="<?php echo e(asset('assets/images/640x360.png')); ?>" <?php endif; ?>>
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <table id="example1" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th style="max-width: 100px;"> نام </th>
                                    <th> شماره </th>
                                    <th>نام <?php echo e($type == 'series' ? 'سریال' : 'مستند'); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $seasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$season): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td>
                                        <a href="#" class="text-primary"><?php echo e($season->name); ?></a>
                                    </td>
                                    <td>
                                        <?php echo e($season->number); ?>

                                    </td>
                                    <td>
                                        <?php echo e($season->serie->title); ?>

                                    </td>
                                    <td style="text-align: center">
                                        <a href="<?php echo e(route('Panel.EditSeason',$season)); ?>?type=<?php echo e($type == 'documentary' ? 'documentary' : 'series'); ?>" title="ویرایش"
                                            class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo e(route('Panel.AddSection',$season->serie->id)); ?>?season=<?php echo e($season->id); ?>&type=<?php echo e($type == 'documentary' ? 'documentary' : 'series'); ?>"
                                            title="قسمت ها" class="btn btn-sm btn-primary"> <i
                                                class="fas fa-plus"></i></a>
                                        <a href="#" data-id="<?php echo e($season->id); ?>" data-toggle="modal" title="حذف"
                                            data-target="#delete-season" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"> ذخیره
                        </button>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/ckeditor/ckeditor.js')); ?>"></script>
<script>
    $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
            });

    CKEDITOR.replace('desc',{
            contentsLangDirection: 'rtl',
            filebrowserUploadUrl: '<?php echo e(route('UploadImage')); ?>?type=file',
            imageUploadUrl: '<?php echo e(route('UploadImage')); ?>?type=image',
        });
        
               
   
  $('#delete-season').on('shown.bs.modal', function (event) {
var button = $(event.relatedTarget)
  var recipient = button.data('id')
  $('#season_id').val(recipient)

    })

 
              

           
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Series/season.blade.php ENDPATH**/ ?>