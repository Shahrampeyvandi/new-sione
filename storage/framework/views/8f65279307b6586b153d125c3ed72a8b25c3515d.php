     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.CatList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.CatList"): ?> <?php echo e('active'); ?>

             <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddCat')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddCat"): ?> <?php echo e('active'); ?>

    <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
<?php /**PATH C:\xampp1\htdocs\sione\resources\views/Includes/Panel/categoriesmenu.blade.php ENDPATH**/ ?>