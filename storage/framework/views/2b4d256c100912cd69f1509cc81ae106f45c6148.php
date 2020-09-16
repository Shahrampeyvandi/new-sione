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
                برای حذف قسمت مطمئن هستید؟
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteSection')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="section_id" id="section_id" value="">
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
                    <?php if(isset($section)): ?>
                    ویرایش
                    <?php else: ?>
                    افزودن
                    <?php endif; ?>
                    قسمت</h5>
                <hr />

            </div>
            <form id="upload-section" method="post" <?php if(isset($section)): ?> action="<?php echo e(route('Panel.EditSection',$section)); ?>"
        <?php else: ?> action="<?php echo e(route('Panel.AddSection',$serie->id)); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="type" value="<?php echo e($serie->type ?? ''); ?>">

          <input type="hidden" name="serie" value="<?php echo e($serie->id ?? ''); ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""> قسمت: </label>
                                <?php if(isset($episodes)): ?>
                                <?php if(count($episodes)): ?>
                                <input type="hidden" name="season" value="<?php echo e($season->id ?? ''); ?>">
                                <select name="number" id="number" class="form-control"
                                    onchange="showSectionData(event,'<?php echo e($id); ?>','<?php echo e($season->number); ?>')">
                                    <option value="">باز کردن فهرست انتخاب
                                    </option>
                                    <?php $__currentLoopData = $episodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->Episode); ?>">قسمت <?php echo e($item->Episode); ?> - <?php echo e($item->Title); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php else: ?>
                                <input type="number" class="form-control" name="number" id="number" value="">
                                <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">عنوان : </label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="<?php echo e($section->name ?? ''); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">تاریخ پخش: </label>
                                <input type="text" class="form-control datepicker" name="release" id="release"
                                    <?php if(isset($section)): ?>
                                    value="<?php echo e(\Carbon\Carbon::parse($section->publish_date)->format('d F Y')); ?>"
                                    <?php endif; ?> />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : </label>
                                <textarea class="form-control" name="desc" id="desc" cols="30"
                                    rows="8"><?php echo e($section->description ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php if(isset($section)): ?>
                                <img src="<?php echo e($section->poster); ?>" alt="">
                                <?php endif; ?>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر قسمت: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px"
                                            <?php if(isset($section) && $section->poster): ?>
                                        src="<?php echo e(asset($section->poster)); ?>" <?php else: ?>
                                        src="<?php echo e(asset('assets/images/640x360.png')); ?>" <?php endif; ?>>
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="imdbID" id="imdbID">
                        <input type="hidden" name="runtime" id="runtime">
                        <input type="hidden" name="imdbRating" id="imdbRating">
                        <input type="hidden" name="posterImdb" id="posterImdb">
                        <?php if(isset($id)): ?>
                        <input type="hidden" name="serie" id="serie" value="<?php echo e($id); ?>">
                        <?php endif; ?>
                        <?php if(isset($section)): ?>
                        <?php echo $__env->make('Includes.Panel.Video' ,['post'=>$section], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                        <?php echo $__env->make('Includes.Panel.Video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <table id="example1" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>

                                    <th>ردیف</th>
                                    <th style="max-width: 100px"> عنوان </th>
                                    <th> فصل </th>
                                    <th style="max-width: 70px">نام سریال</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                    <td><?php echo e($key+1); ?></td>
                                    <td>
                                        <?php echo e($section->name); ?>

                                    </td>
                                    <td>
                                        <a href="#"
                                            class="text-primary"><?php echo e(!is_null($section->seasonobj) ? $section->seasonobj->number : '-'); ?></a>
                                    </td>
                                    <td>
                                        <?php echo e(!is_null($section->serie) ? $section->serie->name : ''); ?>


                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('Panel.EditSection',$section)); ?>" title="ویرایش"
                                            class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="#" data-id="<?php echo e($section->id); ?>" data-toggle="modal" title="حذف"
                                            data-target="#deletemodal" class="btn btn-danger btn-sm"><i
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
        
               
   

// $(document).on('change','#serie',function(){
//  var thiss = $(this)
// var data = $(this).val();
//  data = { data:data,_token: "<?php echo e(csrf_token()); ?>" };
//             url='<?php echo e(route('Panel.Ajax.Series')); ?>';
//             request = $.post(url, data);
//             request.done(function(res){
//               const Options = res.map(item => {
//                     return  `<option value="${item.id}">${item.name}</option>`
//                 });
//                 stringOptions = Options.join('');
//                 $('#season').html(stringOptions)
//         });
   
//  })

  $('#deletemodal').on('shown.bs.modal', function (event) {
var button = $(event.relatedTarget)
  var recipient = button.data('id')
  $('#section_id').val(recipient)
    })

function showSectionData(event,serieId,seasonNumber) {
    data = { episode:$(event.target).val(),serieId:serieId,seasonNumber:seasonNumber,_token: "<?php echo e(csrf_token()); ?>" };
            url='<?php echo e(route('Panel.getSectionImdbData')); ?>';
            request = $.post(url, data);
            request.done(function(res){
            // location.reload()
            // console.log(res.released)
            $('#title').val(res.title)
             CKEDITOR.instances['desc'].setData(res.desc)
            $('#preview').attr('src',res.poster)
             $('#posterImdb').val(res.poster)
             $('#release').val(res.released)
        //    $( "#release" ).datepicker("setDate", $.datepicker.parseDate( "yy-mm-dd", "2017-11-16" ));
             $('#imdbID').val(res.imdbID)
             $('#runtime').val(res.runtime)
             $('#imdbRating').val(res.imdbRating)

        });
}
function deleteVideo(event , videoId) {
    event.preventDefault()
    
    var el = $(event.target);
     data = { id:videoId,_method:'delete',_token: "<?php echo e(csrf_token()); ?>" };
            url="<?php echo e(route('Panel.DeleteVideo')); ?>";
            request = $.post(url, data);
            request.done(function(res){
                if($('.upload-season-file').length == 1) {
                    el.parent('.upload-season-file').find('#video-url').val('')
                    el.parent('.upload-season-file').find('#video-url').val('')

                }else{

                    el.parent('.upload-season-file').remove()
                    el.parent().next('.clone').remove()
                }

        });
}

           
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Series/section.blade.php ENDPATH**/ ?>