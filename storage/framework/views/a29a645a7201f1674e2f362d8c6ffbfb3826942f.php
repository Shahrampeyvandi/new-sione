<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center"> ویرایش اطلاعات</h5>
                <hr />
            </div>
            <form id="edit-member" method="post" action="<?php echo e(route('Panel.EditUser',$user)); ?>">
                <?php echo csrf_field(); ?>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for=""><span class="text-danger">*</span> نام </label>
                        <input type="text" class="form-control" name="first_name" id="first_name"
                            value="<?php echo e($user->first_name ?? ''); ?>" placeholder="نام ">
                    </div>
                    <div class="form-group col-md-6">
                        <label for=""> <span class="text-danger">*</span> نام خانوادگی</label>
                        <input type="text" class="form-control" name="last_name" id="last_name"
                            value="<?php echo e($user->last_name ?? ''); ?>" placeholder="نام خانوادگی">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for=""> <span class="text-danger">*</span> شماره موبایل</label>
                        <input type="text" class="form-control" name="mobile" id="mobile"
                            value="<?php echo e($user->mobile ?? ''); ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">آدرس ایمیل</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo e($user->email ?? ''); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for=""> <span class="text-danger">*</span> تغییر رمز عبور</label>
                        <input type="text" class="form-control" name="password" id="password" value="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for=""> <span class="text-danger">*</span> تایید رمز عبور</label>
                        <input type="text" class="form-control" name="cpassword" id="cpassword" value="">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for=""> <span class="text-danger">*</span>تاریخ انقضای اشتراک</label>
                        <input type="text" class="form-control datepicker" name="date" id="date"
                            value="<?php echo e(\Morilog\Jalali\Jalalian::forge($user->expire_date)->format('d/m/Y')); ?>">
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" id="sendsms" name="sendsms" value="1" class="custom-control-input">
                        <label class="custom-control-label" for="sendsms">
                            ارسال پیامک آگاه ساز به کاربر</label>
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

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datepicker-jalali/bootstrap-datepicker.fa.min.js')); ?>"></script>

<script>
    $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
            });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Users/Edit.blade.php ENDPATH**/ ?>