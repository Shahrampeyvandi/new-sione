<?php if(\Request::route()->getName() == "Panel.MoviesList" || \Request::route()->getName() == "Panel.AddMovie"): ?>
     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.MoviesList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.MoviesList"): ?> <?php echo e('active'); ?>

             <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddMovie')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddMovie"): ?> <?php echo e('active'); ?>

    <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
<?php endif; ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Includes/Panel/moviesmenu.blade.php ENDPATH**/ ?>