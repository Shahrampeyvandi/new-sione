<?php if(isset($adverts) && count($adverts)): ?>
<section class="top-slider">
    <div class="swiper-container TopSlider">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $adverts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="<?php echo e(asset($advert->poster)); ?>" alt="<?php echo e($advert->title); ?>">
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Front/TopSlider.blade.php ENDPATH**/ ?>