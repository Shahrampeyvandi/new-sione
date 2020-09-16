<?php $__env->startSection('Title',$title); ?>


<?php $__env->startSection('content'); ?>



<section class="movie-sections m--t m-h-50">
    <?php if(count($commingsoon)): ?>


    <?php $__currentLoopData = $commingsoon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="container comming-soon-item">
        <div class="row">
            <div class="col-md-3">
                <div class="img-container"><img src="<?php echo e(asset($post->poster)); ?>" alt="<?php echo e($post->title); ?>" class="">
                    <div class=" rounded"></div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="detail-wrapper">
                    <h2 class=""><?php echo e($post->title); ?></h2>
                    <div class="">
                        <?php echo html_entity_decode(str_limit($post->description,350,' ...'), ENT_QUOTES, 'UTF-8'); ?>

                    </div>
                    <div class="date">
                        <p class="">تاریخ انتشار:

                            <?php if($post->type == "series"): ?>

                            <?php echo e(\Morilog\Jalali\Jalalian::forge($post->first_publish_date)->format('%B %d، %Y')); ?>

                            <?php else: ?>
                            <?php echo e(\Morilog\Jalali\Jalalian::forge($post->released)->format('%B %d، %Y')); ?>

                            <?php endif; ?>
                        </p>
                    </div>

                    <a href="<?php echo e($post->play()); ?>" class="page-movie-play btn--ripple mr-0">
                        <i class="fa fa-play"></i>
                        پیش نمایش
                    </a>

                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>
</section>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/CommingSoon.blade.php ENDPATH**/ ?>