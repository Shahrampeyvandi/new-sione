<?php $__env->startSection('Title',$title); ?>


<?php $__env->startSection('content'); ?>


<?php echo $__env->make('Includes.Front.DesktopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.MobileSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php if(count($newmovies)): ?>
<section class="movie-sections">
    <h3>
        تازه ترین فیلم ها
        <a href="<?php echo e(route('S.ShowMore')); ?>?c=new&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $newmovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$movie,'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>

<?php if(count($latestdoble)): ?>
<section class="movie-sections">
    <h3>
        دوبله فارسی بدون سانسور
        <a href="<?php echo e(route('S.ShowMore')); ?>?c=doble&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $latestdoble; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$post , 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>



<?php if(count($newyear)): ?>
<section class="movie-sections">
    <h3>
        <?php echo e($year); ?>

        <a href="<?php echo e(route('S.ShowMore')); ?>?c=<?php echo e($year); ?>&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $newyear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$post , 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>



<?php if(isset($cat) && count($cat)): ?>
<?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(count($category)): ?>
<section class="movie-sections">
    <h3>
        <?php echo e(\App\Category::whereLatin($key)->first()->name); ?>

        <a href="<?php echo e(route('S.ShowMore')); ?>?c=animation&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$animation , 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>






<?php if(isset($top250) && count($top250)): ?>
<section class="movie-sections">
    <h3>
        برترین فیلم های Imdb
        <a href="<?php echo e(route('S.ShowMore')); ?>?c=top250&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $top250; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <?php $__env->startComponent('components.article',['model'=>$post , 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/AllMovies.blade.php ENDPATH**/ ?>