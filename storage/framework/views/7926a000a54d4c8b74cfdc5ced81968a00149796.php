<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">ارسال پیام</h5>
                <hr />
            </div>
            <form id="sendsms" method="post" action="<?php echo e(route('Panel.SendMessage')); ?>">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">ارسال برای </label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="ln-1" name="for" value="all"
                                        class="custom-control-input smsfor">
                                    <label class="custom-control-label" for="ln-1">
                                        تمام کاربران
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="ln-2" name="for" value="user"
                                        class="custom-control-input smsfor">
                                    <label class="custom-control-label" for="ln-2">
                                        یک کاربر
                                    </label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="ln-3" name="for" value="email"
                                        class="custom-control-input smsfor">
                                    <label class="custom-control-label" for="ln-3">
                                        وارد کردن ایمیل
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row smsfor-input">

                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 mt-3">
                                <select name="type" class="js-example-basic-single" dir="rtl">

                                    <option value="email">
                                        ایمیل</option>
                                    <option value="sms">
                                        پیامک</option>
                                    <option value="noty">
                                        نوتیفیکشین</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-12">
                                <label for="">عنوان</label>
                                <div>
                                    <input type="text" class="form-control " name="title" id="title" placeholder=""
                                        value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">متن : </label>
                                <textarea class="form-control" name="content" id="content" cols="30"
                                    rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">ارسال &nbsp;<i
                                class="fas fa-envelope"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    var users = <?php echo json_encode($users, 15, 512) ?>;
    var options = '';
    users.map( user => {
        options += `<option value="${user.id}">${user.first_name} ${user.last_name}</option>`;
    })
    
    $(".smsfor").change(function(){
    let val = $(this).val()
    if(val == 'email') {
         html = `<div class="form-group col-md-12">
                                <label for="">ایمیل</label>
                                <div>
                                    <input type="text" class="form-control " name="email" id="time" placeholder=""
                                        value="">
                                </div>
                            </div>`;
    }
    if(val == 'user') {
         html = ` 
                            <div class="form-group col-md-12 mt-3">
                                <select name="users[]" class="js-example-basic-single" multiple dir="rtl">
                                   ${options}
                                </select>
                            </div>
                       `;
    }

    if(val == 'all') html = '';

    $(".smsfor-input").html(html)
      $('.js-example-basic-single').select2({
        placeholder: 'انتخاب کنید'
    });
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/payams/send.blade.php ENDPATH**/ ?>