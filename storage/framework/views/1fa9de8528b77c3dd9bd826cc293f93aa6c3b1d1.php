<?php $__env->startSection('content'); ?>
<div class="modal fade" id="addDiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form class="add-discount" action="<?php echo e(route('Panel.Discount.Insert')); ?>" method="post"
            enctype="multipart/form-data">
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

                        <div class="form-group col-md-12">
                            <label for=""><span class="text-danger">*</span> مربوط به: </label>
                            <select name="for[]" class="js-example-basic-single" multiple dir="rtl">
                              
                                <?php $__currentLoopData = \App\Plan::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($plan->id); ?>"
                                    <?php echo e(isset($discount) && $discount->plans()->pluck('id')->contains($plan->id) ? 'selected' : ''); ?>>
                                    <?php echo e($plan->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="">عنوان</label>
                            <input type="text" class="form-control" name="title" id="title" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">درصد تخفیف</label>
                            <input type="number" class="form-control" name="percent" id="percent" value=""
                                placeholder="به صورت عدد وارد نمایید">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="text-danger">کد تخفیف</label>
                            <input type="text" class="form-control" name="code" id="code" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">تاریخ انقضا</label>
                            <input required type="text" class="form-control datepicker-fa" name="date" id="date"
                                value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">محدودیت تعداد</label>
                            <input  type="number" class="form-control " name="count" id="count" value="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">توضیحات</label>
                            <textarea type="text" class="form-control" name="description" id="description"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="desc">اطلاع رسانی به کاربران: </label>
                            <select class="custom-select" name="sendsms" id="sendsms">
                                <option value="">لازم نیست</option>
                                <option value="sms">پیامک</option>
                                <option value="email">ایمیل</option>
                                <option value="noty">نوتیفیکیشن</option>
                            </select>
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




<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                موارد علامت زده شده حذف شوند؟
            </div>
            <div class="modal-footer">
                <a href="#" class="deleteposts btn btn-danger text-white">حذف! </a>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="container_icon card-body d-flex justify-content-end">
        <div class="delete-edit" >
            <a href="#" title="جدید " data-toggle="modal" data-target="#addDiscount" class="order-delete   m-2">
                <span class="__icon bg-success">
                    <i class="fa fa-plus"></i> افزودن
                </span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">لیست تخفیف ها</h5>
            <hr>
        </div>
        <div style="overflow-x: auto;">
            <table id="example1" class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>ردیف</th>
                        <th> عنوان </th>
                        <th> مربوط به اشتراک </th>
                        <th> کد تخفیف</th>
                        <th>درصد </th>
                        <th>تاریخ انقضا</th>
                        <th>محدودیت</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key+1); ?></td>
                        <td>
                            <a href="#" class="text-primary"><?php echo e($discount->name); ?></a>
                        </td>
                        <td>
                            <?php $__currentLoopData = $discount->plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($plan->name); ?> <br />
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td class="text-success"><?php echo e($discount->d_code); ?></td>
                        <td class="text-success"><?php echo e($discount->percent); ?></td>
                        <td class="text-info">
                            <?php echo e(\Morilog\Jalali\Jalalian::forge($discount->expire_date)->format('%B %d، %Y')); ?></td>

                        <td>
                            <?php echo e($discount->count ? $discount->count : 'نامحدود'); ?>

                        </td>
                        <td>
                            <a href="<?php echo e(route('Panel.Discount.Edit',['id' => $discount->id])); ?>"
                                class="btn btn-sm btn-info">ویرایش</a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.fa.min.js')); ?>"></script>

<script>
    $(".datepicker-fa").datepicker({
            changeMonth: true,
            changeYear: true
            });
   
       


     $('.deleteposts').click(function(e){
            e.preventDefault()
            data = { array:array, _method: 'delete',_token: "<?php echo e(csrf_token()); ?>" };
            url='<?php echo e(route('Panel.DeleteDiscount')); ?>';
            request = $.post(url, data);
            request.done(function(res){
            location.reload()
        });
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Discounts/list.blade.php ENDPATH**/ ?>