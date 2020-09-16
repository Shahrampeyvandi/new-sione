
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
<a href="<?php echo e(route('Panel.SeriesList')); ?><?php echo e($type == 'documentary' ? '?type=documentary' : ''); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.SeriesList"): ?> <?php echo e('active'); ?> 
            <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddSerie')); ?><?php echo e($type == 'documentary' ? '?type=documentary' : ''); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddSerie"): ?> <?php echo e('active'); ?> 
   <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
          
</ul>
 </div>
</div>
<?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Panel/seriesmenu.blade.php ENDPATH**/ ?>