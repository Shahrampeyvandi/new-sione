<?php $__env->startSection('Title',$title); ?>
<?php $__env->startSection('content'); ?>
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close-image" onclick="closeImage(event)">&times;</span>
    <img class="modal-content" id="img01">

</div>
<?php echo $__env->make('Includes.Front.TopPoster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(count($sections)): ?>
<section class="movie-Season mt-3">
    <?php if(isset($season)): ?>
    <div class="Season-select">
        انتخاب فصل
        <i class="fa fa-angle-down"></i>
    </div>
    <ul class="movie-Season-box" id="scroll-tyle">
        <?php $__currentLoopData = $post->seasons()->orderBy('number','asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a href="<?php echo e(route('ShowMovie',['slug'=>$post->slug])); ?>?season=<?php echo e($item->number); ?>"> <?php echo e($item->name); ?></a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-4 col-lg-3 Season-movie-box">

                <a href="<?php echo e($section->play()); ?>">
                    <div class="Season-movie-img-box">
                        <img src="<?php echo e($section->image()); ?>" alt="">
                        <i class="fa fa-play-circle"></i>
                    </div>
                </a>

                <h3>
                    <?php if($post->has_season()): ?>
                    <?php echo e($section->serie->title); ?> - فصل <?php echo e($season->number); ?> - قسمت <?php echo e($section->section); ?>

                    <?php else: ?>
                    <?php echo e($section->serie->title); ?> - قسمت <?php echo e($section->section); ?>

                    <?php endif; ?>


                    <a href="#" class="section-download" data-episode="<?php echo e($section->id); ?>" data-id="<?php echo e($section->id); ?>"
                        onclick="call(event)">
                        <i class="fa fa-cloud-download-alt"></i>
                    </a>
                </h3>
                <?php if($section->duration): ?>
                <h4>
                    <?php echo e($section->duration); ?> دقیقه
                </h4>
                <?php endif; ?>

                <h5>
                    <?php echo html_entity_decode(str_limit($section->description,100), ENT_QUOTES, 'UTF-8'); ?>


                </h5>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="movie-trailer">

    <h1>
        تریلر، تصاویر و جزییات
    </h1>
    <div class="container-fluid">
        <div class="row">
            <?php if($post->trailer): ?>
            <div class="col-6 col-lg-2 trailer-wrapper">
                <a href="<?php echo e($post->play_trailer()); ?>">
                    <img class="show-img" src="<?php echo e(asset(unserialize($post->poster)['resize'])); ?>" alt="<?php echo e($post->name); ?>">
                    <i class="fa fa-play-circle"></i>
                </a>
            </div>
            <?php endif; ?>
            <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-lg-2">
                <a href="#" onclick="showImage(event)">
                    <img class="show-img" src="<?php echo e(asset($image->url)); ?>" alt="<?php echo e($post->name); ?>">
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>



    <?php if(count($post->actors)): ?>
    <div class="container-fluid">
        <h2>
            بازیگران:
        </h2>
        <div class="row">

            <?php $__currentLoopData = $post->directors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $director): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-lg-2 d-flex justify-content-center">
                <div class="star-img-box ">
                    <a href="<?php echo e($director->path()); ?>">
                        <?php if($director->image): ?>
                        <img src="<?php echo e(asset($director->image)); ?>" alt="<?php echo e($director->name); ?>">
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/images/avatar.png')); ?>" alt="<?php echo e($director->name); ?>">
                        <?php endif; ?>
                        <h4>
                            <?php echo e($director->name); ?>

                        </h4>
                        <h5>
                            کارگردان
                        </h5>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $post->actors()->take(12)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-lg-2 d-flex justify-content-center">
                <div class="star-img-box ">
                    <a href="<?php echo e($actor->path()); ?>">
                        <?php if($actor->image): ?>
                        <img src="<?php echo e(asset($actor->image)); ?>" alt="<?php echo e($actor->name); ?>">
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/images/avatar.png')); ?>" alt="<?php echo e($actor->name); ?>">
                        <?php endif; ?>
                        <h4>
                            <?php echo e($actor->name); ?>

                        </h4>
                        <h5>
                            بازیگر
                        </h5>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>
</section>
<?php if(count($relatedPosts)): ?>
<section class="movie-related">
    <h1>
        همچنین تماشا کنید
    </h1>
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-lg-2">
                <?php $__env->startComponent('components.article',['model'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>
</section>
<?php endif; ?>

<?php echo $__env->make('Includes.Front.Comments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/ShowMovie.blade.php ENDPATH**/ ?>