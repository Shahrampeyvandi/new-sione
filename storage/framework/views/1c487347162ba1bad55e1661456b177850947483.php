<?php $__env->startSection('content'); ?>


<div class="card">
    <div class="card-title">
        <h5 class="text-center">ویرایش</h5>
        <hr>
    </div>
    <div class="card-body">
        <form class="add-discount" action="<?php echo e(route('Panel.Discount.Edit',$discount->id)); ?>" method="post"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
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
            </div>

            <div class="row">


                <div class="form-group col-md-12">
                    <label for="">عنوان</label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php echo e($discount->name); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="">درصد تخفیف</label>
                    <input type="number" class="form-control" name="percent" id="percent" value="<?php echo e($discount->percent); ?>"
                        placeholder="به صورت عدد وارد نمایید">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="text-danger">کد تخفیف</label>
                    <input type="text" class="form-control" name="code" id="code" value="<?php echo e($discount->d_code); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="">محدودیت تعداد</label>
                    <input required type="number" class="form-control " name="count" id="count"
                        value="<?php echo e($discount->count); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="">تاریخ انقضا</label>
                    <input required type="text" class="form-control datepicker-fa" name="date" id="date"
                        value="<?php echo e($discount->date); ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="">توضیحات</label>
                    <textarea type="text" class="form-control" name="description" id="description">
                                <?php echo e($discount->description); ?>

                            </textarea>
                </div>

            </div>
            <button type="submit" class=" btn btn-success text-white">ذخیره <i class="fas fa-edit"></i></button>



        </form>
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
    var date = <?php echo json_encode($discount->expire_date) ?>;
    $(".datepicker-fa").datepicker({
        
            changeMonth: true,
            changeYear: true
            }).datepicker('setDate',date);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Panel/Discounts/Edit.blade.php ENDPATH**/ ?>