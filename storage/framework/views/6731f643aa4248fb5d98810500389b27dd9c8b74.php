     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.SliderList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.SliderList"): ?> <?php echo e('active'); ?>

             <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddSlider')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddSlider"): ?> <?php echo e('active'); ?>

    <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Panel/slidermenu.blade.php ENDPATH**/ ?>