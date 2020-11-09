<!-- begin::sidebar -->
<div class="sidebar">
    <ul class="nav nav-pills nav-justified m-b-30" id="pills-tab" role="tablist">

        <li class="nav-item">
            <a class="nav-link" id="notifications-tab" data-toggle="pill" href="#notifications" role="tab"
                aria-controls="notifications" aria-selected="false">
                <i class="fa fa-bell"></i>
            </a>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <div class="tab-pane-body">
                <h5 class="font-weight-bold m-b-20">اعلان ها</h5>

                <div>
                    <ul class="list-group list-group-flush m-b-10">
                        <?php $__currentLoopData = $merge_noty; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <p class="m-b-0">
                                    <span class="badge small badge-danger">جدید</span>
                                    <?php if($item instanceof \App\BugReport): ?>
                                <span class="titl" style="font-size: 0.8rem;margin-right: 1rem;">گزارش خطا  <?php echo e(\App\Post::find($item->post_id)->name); ?></span>
                                    <?php else: ?>
                                    <span class="titl" style="font-size: 0.8rem; margin-right: 1rem;"> درخواست
                                        فیلم</span>
                                    <?php endif; ?>
                                    <br>
                                    <span class="content"><?php echo e(str_limit($item->name,30,'...')); ?></span>
                                </p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">
                                        <?php echo e(\Morilog\Jalali\Jalalian::forge($item->created_at)->ago()); ?></li>
                                    <li class="list-inline-item">
                                        <?php if($item instanceof \App\BugReport): ?>
                                        <a href="#" onclick="readNoty(event,'<?php echo e($item->id); ?>','bug')">علامت خوانده شده</a>
                                        <?php else: ?>
                                        <a href="#" onclick="readNoty(event,'<?php echo e($item->id); ?>','req')">علامت خوانده شده</a>

                                        <?php endif; ?>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" <?php if($item instanceof \App\BugReport): ?>
                                            onclick="showNotification(event,'<?php echo e($item->id); ?>','bug')" <?php else: ?>
                                            onclick="showNotification(event,'<?php echo e($item->id); ?>','req')" <?php endif; ?>>مشاهده</a>
                                    </li>
                                     <li class="list-inline-item">
                                        <a href="#" class="text-danger" <?php if($item instanceof \App\BugReport): ?>
                                            onclick="deleteNoty(event,'<?php echo e($item->id); ?>','bug')" <?php else: ?>
                                            onclick="deleteNoty(event,'<?php echo e($item->id); ?>','req')" <?php endif; ?>>حذف</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>

            </div>
            
        </div>

    </div>
</div>
<!-- end::sidebar --><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Includes/Panel/sidebar.blade.php ENDPATH**/ ?>