<?php $__env->startSection('content'); ?>


<div class="container-fluid">
    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.FileList')); ?>" class="nav-link <?php if(\Request::route()->getName() == " Panel.FileList"): ?>
                <?php echo e('active'); ?> <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.UploadImdb')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == " Panel.UploadImdb"): ?> <?php echo e('active'); ?> <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>

    </ul>
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

                            <div class="form-group col-md-4 my-2">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="checkImdb" name="checkImdb">
                                    <label class="custom-control-label" for="checkImdb">IMDB</label>
                                </div>
                            </div>
                            <div class="form-group col-md-8  add-code" style="display: none;">
                                <input type="text" class="form-control col-md-5 my-2 ml-2" name="code" id="code"
                                    value="<?php echo e($post->name ?? ''); ?>" placeholder="کد imdb را وارد کنید">
                                <div class="wrapper--btn">

                                    <a href="#" onclick="getCode(event)" class="btn btn-primary my-2 ">جست و جو &nbsp;<i
                                            class="fas fa-search"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">عنوان فیلم: </label>
                                <input type="text" class="form-control" name="title" id="title" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">عنوان اصلی: </label>
                                <input type="text" class="form-control" name="name" id="original-title"
                                    value="<?php echo e($post->name ?? ''); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">

                                <label for="">مدت زمان برحسب دقیقه</label>
                                <input type="text" class="form-control" name="duration" id="runtime" value="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for=""></label>
                                <select name="type" id="movie-type" class=" custom-select  mb-3"
                                    onchange="seriesOptions(event)">
                                    <option value="movies">سینمایی</option>
                                    <option value="series">سریال</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">

                                <label for="">تاریخ انتشار</label>
                                <input type="text" class="form-control  datepicker" name="released" id="released"
                                    value="">
                                <input type="text" class="form-control " name="imdb_released" id="imdb-released"
                                    value="">

                            </div>
                        </div>
                        <div class="row series-date">
                            <div class="form-group col-md-6">
                                <label for="">تاریخ اولین ارائه</label>
                                <input type="text" class="form-control datepicker" name="first_release"
                                    id="first_release" value="">
                            </div>
                            <div class="form-group col-md-6">

                                <label for="">تاریخ آخرین ارائه</label>
                                <input type="text" class="form-control datepicker" name="last_release" id="last_release"
                                    value="">
                            </div>
                            <div class="form-group col-md-6">

                                <label for="">وضعیت</label>
                                <input type="text" class="form-control" name="serie_status" id="serie_status" value="">
                            </div>
                            <div class="form-group col-md-6">

                                <label for="">درحال تولید</label>
                                <select name="comming" id="" class=" custom-select  mb-3">
                                    <option value="yes">بله</option>
                                    <option value="no">خیر</option>
                                </select>
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
                            <div class="form-group col-md-12">
                                <?php if(isset($post)): ?>
                                <img src="<?php echo e($post->poster); ?>" alt="">
                                <?php endif; ?>
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر فیلم: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%"
                                            src="<?php echo e(asset('assets/images/640x360.png')); ?>">
                                        <input type="file" name="poster" id="poster" />
                                        <div style="display: none;">
                                            <input type="hidden" name="imdbposter" id="imdbposter" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">آدرس تریلر: </label>
                            <input type="text" class="form-control" name="trailer" id="trailer" value="">
                        </div>
                        <label for="desc">تصاویر: </label>
                        <div class="row images mb-3">
                        </div>
                        

                        

                        <hr>

                        <label for="">نویسنده </label>

                        <div class="row imdb-writers">

                        </div>
                        <hr>

                        <label for="">بازیگران </label>

                        <div class="row actors">

                        </div>
                    </div>
                    <div class="col-md-4 right-side">
                        <div class="cat">
                            <div class="">
                                <h6 class="">دسته بندی: </h6>
                                <div>
                                    <div class="d-flex">
                                        <input type="text" class="form-control mb-2" name="" id="pprev"
                                            placeholder="نام">
                                        <input type="text" class="form-control mb-2" name="" id="prev"
                                            placeholder="نام لاتین">
                                    </div>
                                    <a href="#" class="btn btn-sm btn-primary mb-3"
                                        onclick="addCategory(event)">افزودن</a>
                                </div>
                            </div>
                            <div class="cat-wrapper card pr-2"
                                style=" min-height:50px;max-height: 200px;overflow-y: scroll;">
                                <?php $__currentLoopData = \App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox custom-control-inline ">
                                    <input type="checkbox" id="cat-<?php echo e($key+1); ?>" name="categories[]"
                                        value="<?php echo e($item->latin); ?>" class="custom-control-input scat">
                                    <label class="custom-control-label" for="cat-<?php echo e($key+1); ?>"><?php echo e($item->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="writers-wrapper mt-3">
                            <h6 class="">نویسنده</h6>
                            <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addWriter(event)">افزودن</a>
                            <div class="writers-list card pr-2"
                                style="min-height:50px;max-height: 200px;overflow-y: scroll;">
                                <?php $__currentLoopData = \App\Writer::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="ac-<?php echo e($key+1); ?>" name="writers[]" value="<?php echo e($writer->name); ?>"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="ac-<?php echo e($key+1); ?>">
                                        <?php echo e($writer->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>
                        <div class="cast-wrapper mt-3">
                            <h6 class="">بازیگران</h6>
                            <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addActor(event)">افزودن</a>
                            <div class="actors-list card pr-2"
                                style="min-height:50px;max-height: 200px;overflow-y: scroll;">
                                <?php $__currentLoopData = \App\Actor::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="ac-<?php echo e($key+1); ?>" name="actors[]" value="<?php echo e($actor->name); ?>"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="ac-<?php echo e($key+1); ?>">
                                        <?php echo e($actor->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="directors-wrapper mt-3">
                            <h6 class="">کارگردان</h6>
                            <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addDirectorsImdb(event)">افزودن</a>
                            <div class="directors-list card pr-2"
                                style="min-height:50px;max-height: 200px;overflow-y: scroll;">

                                <?php $__currentLoopData = \App\Director::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $director): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="di-<?php echo e($key+1); ?>" name="directors[]"
                                        value="<?php echo e($director->name); ?>" class="custom-control-input">
                                    <label class="custom-control-label" for="di-<?php echo e($key+1); ?>">
                                        <?php echo e($director->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>
                        <div class="languages-wrapper mt-3">
                            <h6 class="">زبان</h6>
                            <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
                            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addLanguage(event)">افزودن</a>
                            <div class="lang-list card pr-2"
                                style="min-height:50px;max-height: 200px;overflow-y: scroll;">
                                <?php $__currentLoopData = \App\Language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="ln-<?php echo e($key+1); ?>" name="language" value="<?php echo e($language->name); ?>"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="ln-<?php echo e($key+1); ?>">
                                        <?php echo e($language->name); ?></label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="awards-wrapper mt-3">
                            <h6 class="">جوایز فیلم</h6>
                            <input type="text" class="form-control mb-2" name="awards" id="awards" placeholder="جوایز">
                            
                            
                </div>
        </div>
    </div>
</div>

<input type="hidden" name="rating" id="rating">
<input type="hidden" name="votes" id="votes">
<input type="hidden" name="" id="">

<div class="row">
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary"> ادامه &nbsp;<i class="fas fa-arrow-circle-left"></i>
        </button>
    </div>
</div>
</form>
<hr>

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
    $('#imdb-released').hide()
    $('#checkImdb').change(function(){
        if($(this).is(':checked')){
            $('.add-code').css('display','flex')
            $('.casts-wrapper').hide()
            $('#released').hide()
            $('#imdb-released').show()
        }else{
             $('.add-code').hide()
             $('.casts-wrapper').show()
             $('#released').show()
             $('#imdb-released').hide()
        }
    })

    $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
            });

    CKEDITOR.replace('desc',{
            contentsLangDirection: 'rtl',
            filebrowserUploadUrl: '<?php echo e(route('UploadImage')); ?>?type=file',
            imageUploadUrl: '<?php echo e(route('UploadImage')); ?>?type=image',
        });
        
                 array  =[];
                $('.scat').each(function(){
                    array.push(this.value)
                })
              
    function getCode(event) {
            event.preventDefault()

            var code = $('#code').val()
            
            if(code != '') {
                var parentHtml = $('.wrapper--btn');
             parentHtml.html(`<button class="btn btn-primary  my-2" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm m-l-5" role="status" aria-hidden="true"></span>
                    در حال دریافت اطلاعات ...
                </button>`)   
            data = { code:code,_token: "<?php echo e(csrf_token()); ?>" };
            url='<?php echo e(route('Panel.GetImdb')); ?>';
            request = $.post(url, data);
            request.done(function(res){
                console.log(res)
                $('#movie-type').val(res.is_serial)
                $('#original-title').val(res.title)
                $('#year').val(res.year)
                $('#runtime').val(res.duration)
                CKEDITOR.instances['desc'].setData(res.storyline)
                
                // $('#poster').attr('data-default-file',res.photo)
                // $('.dropify').dropify()
                $('#poster').next().show()
                $('#preview').attr('src',res.photo)
                $('#poster').hide()
                $('#runtime').val(res.runtime)
                $('#imdb-released').val(res.released)
                $('#released').val(res.Released[0])
                $('#miladi-released').val(res.Released[0])
                $('#awards').val(res.Awards)
            //    const catOptions = res.categories.map(function(item){
                   
                  
            //         if(array.includes(item[0])) {
            //            return  `<div class="custom-control custom-checkbox custom-control-inline">
            //                         <input type="checkbox" id="${item[0]}" name="category[]" value="${item[0]}"
            //                             class="custom-control-input" checked>
            //                         <label class="custom-control-label" for="${item[0]}">${item[1]}</label>
            //                     </div> `
            //         }
                    
            //             return  `<div class="custom-control custom-checkbox custom-control-inline">
            //                         <input type="checkbox" id="${item[0]}" name="category[]" value="${item[0]}"
            //                             class="custom-control-input" >
            //                         <label class="custom-control-label" for="${item[0]}">${item[1]}</label>
            //                     </div> `
                    
                
            //     })
            //     goin = catOptions.join('');
            //      $('.cat-wrapper').html(goin)



                 const Directors = res.directors.map((item,index) => {
                           return `<div class="custom-control custom-checkbox custom-control-inline">
                                     <input type="checkbox" id="director-${index}" name="directors[]" value="${item.name}"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="director-${index}">
                                        ${item.name}</label>
                                </div>`

                        });
                joinDirectors = Directors.join('');
                $('.directors-list').html(joinDirectors)

                       const Writers = res.writers.map((item,index) => {
                           return `<div class="custom-control custom-checkbox custom-control-inline">
                                     <input type="checkbox" id="writer-${index}" name="writers[]" value="${item.name}"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="writer-${index}">
                                        ${item.name}</label>
                                </div>`

                        });
                joinWriters = Writers.join('');
                $('.writers-list').html(joinWriters)

              
               
                // const actors = res.casts.map(item => {
                //     return  `<div class=" col-md-3">
                //                 <a style="cursor:pointer;color:red" onclick="deleteImage(event)"><i
                //                         class="fas fa-trash"></i></a>
                //                 <input type="hidden" name="actorname[]" value="${item[0]}" />
                //                   <input type="hidden" name="actorsrc[]" value="${item[1]}" />
                //                 <img width="100%" src="${item[1]}" alt="" style="height:150px">
                //                 <span>${item[0]}</span>
                //             </div>`
                // });
                // joinActors = actors.join('');
                // $('.actors').html(joinActors)
                const actors = res.casts.map((item,index) => {
                           return `<div class="custom-control custom-checkbox custom-control-inline">
                                     <input type="checkbox" id="ac-${index}" name="actors[]" value="${item[0]}"
                                        class="custom-control-input" checked>
                                    <label class="custom-control-label" for="ac-${index}">
                                        ${item[0]}</label>
                                </div>`

                        });
                   joinActors = actors.join('');
                   $('.actors-list').html(joinActors)

                const Images = res.mainPictures.map(item => {
                    return  `<div class=" col-md-3">
                                <a style="cursor:pointer;color:red" onclick="deleteImage(event)"><i
                                        class="fas fa-trash"></i></a>
                                <img width="100%" src="${item}" alt="">
                               <input type="hidden" name="images[]" value="${item}" />
                            </div>`
                });
                joinImages = Images.join('');
                $('.images').html(joinImages)
                parentHtml.html(`
                    <a href="#" onclick="getCode(event)" class="btn btn-primary my-2">جست و جو &nbsp;<i
                                                class="fas fa-search"></i></a>
                    `)
               
          });
            request.fail(function(xhr, status, error) {
            alert('خطا در دریافت اطلاعات')
            parentHtml.html(`
                        <a href="#" onclick="getCode(event)" class="btn btn-primary my-2">جست و جو &nbsp;<i
                                                    class="fas fa-search"></i></a>
                        `)
          });
         
       }
    }

    function deleteImage (event) {
            event.preventDefault()
            var target =$(event.target)
            target.parents('.col-md-3').remove()
            }
              

           
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/IMDB/add.blade.php ENDPATH**/ ?>