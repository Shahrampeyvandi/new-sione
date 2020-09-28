<?php $__env->startSection('content'); ?>
<!-- modals -->


<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="edit-member" method="post" action="<?php echo e(route('Panel.AddActor')); ?>" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <div class="modal-content">
        <div class="modal-body">

          <div class="row">
            <div class="form-group col-md-6">
              <label for=""><span class="text-danger">*</span> نقش </label>

              <select name="type" id="type" class="custom-select form-control">
                <option value="actor">actor</option>
                <option value="director">director</option>
                <option value="writer">writer</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for=""><span class="text-danger">*</span> نام لاتین</label>
              <input type="text" class="form-control" name="name" id="name" value="" placeholder="نام " required>
            </div>

          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for=""> نام فارسی</label>
              <input type="text" class="form-control" name="fa_name" id="name" value="" placeholder="نام ">
            </div>

          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="bio">بیوگرافی: </label>
              <textarea class="form-control" name="bio" id="bio" cols="30" rows="8"></textarea>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-12">
              <div class="form-row">
                <div class="col-md-3">
                  <label for=""> تصویر: </label>
                </div>
                <div class="col-md-3">
                  <input type="file" name="poster" id="poster" />
                </div>
              </div>
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

<div class="modal fade" id="deleteActor" tabindex="-1" role="dialog" aria-labelledby="deleteActorLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteActorLabel">اخطار</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        آیا میخواهید هنرمند حذف شود؟
      </div>
      <div class="modal-footer">
        <form action="<?php echo e(route('Panel.DeleteActor')); ?>" method="post">
          <?php echo csrf_field(); ?>
          <?php echo method_field('delete'); ?>
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="type" id="type_" value="">
          <button type="submit" href="#" class=" btn btn-danger text-white">حذف! </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content edit-modal-user"></div>
  </div>
</div>

<!-- end modals -->

<div class="container-fluid">
  <div class="card">
    <div class="container_icon card-body d-flex justify-content-end">
      <div class="delete-edit" style="display:none;">
        <a href="#" title="حذف " data-toggle="modal" data-target="#exampleModal" class="order-delete   m-2">
          <span class="__icon bg-danger">
            <i class="fa fa-trash"></i>
          </span>
        </a>
      </div>
      <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-user">افزودن <i
          class="fas fa-plus"></i></a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="card-title">
        <h5 class="text-center">مدیریت کاربران</h5>
        <hr />
      </div>
      <div style="overflow-x: auto;">
        <table id="example1" class="table table-striped table-bordered">
          <thead>
            <tr>

              <th>ردیف</th>
              <th style="width: 100px">
                نام
              </th>
              <th>
                نام فارسی
              </th>
              <th>
                نقش
              </th>

              <th>بیوگرافی</th>
              <th style="width: 100px">تصویر</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="tbody">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            if ($user instanceof \App\Actor){
            $name = 'بازیگر';
            $type = 'actor';
            }elseif($user instanceof \App\Director){
            $name = 'کارگردان';
            $type = 'director';
            }else{
            $name = ' نویسنده';
            $type = 'writer';
            }
            ?>
            <tr>

              <td><?php echo e($key+1); ?></td>
              <td><?php echo e($user->name); ?></td>
              <td><?php echo e($user->fa_name); ?></td>
              <td><?php echo e($name); ?></td>

              <td><?php echo e(str_limit($user->bio,50,' ... ')); ?></td>
              <td>
                <?php if(isset($user->image)): ?> <img width="75px" class="img-fluid " src="
                      <?php echo e(asset($user->image)); ?> " />
                <?php else: ?> <img width="75px" class="img-fluid " src="
                      <?php echo e(asset("assets/images/avatar.png")); ?> " /> <?php endif; ?>
              </td>
              <td>
                <a href="<?php echo e(route('Panel.EditActor',$user->id)); ?>?type=<?php echo e($type); ?>" class="btn btn-sm btn-info"><i
                    class="fas fa-edit"></i></a>
                <a href="#" data-id="<?php echo e($user->id); ?>" data-type="<?php echo e($type); ?>" title="حذف " data-toggle="modal"
                  data-target="#deleteActor" class="btn btn-sm btn-danger   m-2">
                  <i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
  $('#deleteActor').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#id').val(recipient)
             var type = button.data('type')
            $('#type_').val(type)

    })
  
 
     $('.deleteposts').click(function(e){
            e.preventDefault()
            data = { array:array, _method: 'delete',_token: "<?php echo e(csrf_token()); ?>" };
            url='<?php echo e(route('Panel.DeleteUser')); ?>';
            request = $.post(url, data);
            request.done(function(res){
            location.reload()
        });
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Panel/Actors/Lists.blade.php ENDPATH**/ ?>