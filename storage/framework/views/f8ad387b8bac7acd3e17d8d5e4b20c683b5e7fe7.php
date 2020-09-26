<?php if(count($sliders)): ?>
<section class="slider d-none d-md-block">
    <div class="swiper-container header-slider">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <div class="slider-box">
                    <div class="shadow-bottom-slider"></div>
                    <img class="slider-back-img" src="<?php echo e(asset($slider->image)); ?>" alt="<?php echo e($slider->post->title); ?>">
                    <div class="movie-details-box-slider">
                        <a href="#">
                            <img src="#" alt="">
                        </a>
                        <h4>
                            <?php echo e($slider->post->title); ?>

                        </h4>
                        <h5>
                            <?php echo str_limit($slider->post->description,250); ?>

                        </h5>
                        <?php if($slider->post->type == 'movies'): ?>
                        <a href="<?php echo e($slider->post->play()); ?>" class="page-movie-play btn--ripple">
                            <i class="fa fa-play"></i>
                            پخش فیلم
                        </a>
                        <?php endif; ?>
                        <a href="<?php echo e($slider->post->path()); ?>" class="more-detail-movie btn--ripple">
                            <i class="fa fa-exclamation"></i>
                            جزئیات بیشتر
                        </a>
                        <?php if(count($slider->post->actors)): ?>
                        <h6>
                            ستارگان: </h6>
                        <?php
                        $countactors = count($slider->post->actors);
                        ?>
                        <h5>
                            <?php $__currentLoopData = $slider->post->actors->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span href="#">
                                <?php echo e($item->name); ?>

                                <?php echo e($key == ($countactors -1)  ? ' ' : ' - '); ?>

                            </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </h5>


                        <?php endif; ?>
                        <?php if($slider->post->directors): ?>
                        <h6>
                            کارگران:
                            <?php

                            $countdirectors = count($slider->post->directors);
                            ?>
                            <?php $__currentLoopData = $slider->post->directors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="#">

                                <?php echo e($item->name); ?>

                                <?php echo e($countdirectors -1  == $key ? ' ' : ' - '); ?>

                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </h6>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="next-header-slide">
            <i class="fa fa-angle-right"></i>
        </div>
        <div class="prev-header-slide">
            <i class="fa fa-angle-left"></i>
        </div>
    </div>
</section>
<?php endif; ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Includes/Front/DesktopSlider.blade.php ENDPATH**/ ?>