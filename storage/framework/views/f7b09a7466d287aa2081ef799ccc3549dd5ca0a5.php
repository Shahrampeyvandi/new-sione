<?php $__env->startSection('Title',$title); ?>

<?php $__env->startSection('content'); ?>
<style>
    .cntr {
	margin: auto;
}

.btn-radio {
	cursor: pointer;
	display: inline-block;

	-webkit-user-select: none;
	user-select: none;
}

.btn-radio:not(:first-child) {
	margin-left: 20px;
}

@media  screen and (max-width: 480px) {
	.btn-radio {
		display: block;
		float: none;
	}

	.btn-radio:not(:first-child) {
		margin-left: 0;
		margin-top: 15px;
	}
}

.btn-radio svg {
	fill: none;
	vertical-align: middle;
}

.btn-radio svg circle {
	stroke-width: 2;
	stroke: #C8CCD4;
}

.btn-radio svg path {
	stroke: #008FFF;
}

.btn-radio svg path.inner {
	stroke-width: 6;
	stroke-dasharray: 19;
	stroke-dashoffset: 19;
}

.btn-radio svg path.outer {
	stroke-width: 2;
	stroke-dasharray: 57;
	stroke-dashoffset: 57;
}

.btn-radio input {
	display: none;
}

.btn-radio input:checked + svg path {
	transition: all .4s ease;
}

.btn-radio input:checked + svg path.inner {
	stroke-dashoffset: 38;
	transition-delay: .3s;
}

.btn-radio input:checked + svg path.outer {
	stroke-dashoffset: 0;
}

.btn-radio span {
	display: inline-block;
	vertical-align: middle;
}
</style>
<div class="showmore-wrapper">
    <div class="text-white">
        <div class="col-md-12 text-right mr-0 mr-md-3">
            <span>مرتب سازی بر اساس سال ساخت </span> 
            <label for="rdo-1" class="btn-radio">
            <input  type="radio" id="rdo-1" value="desc" 
            <?php echo e(isset($order) && $order == 'desc' ? 'checked' : ''); ?>

            onclick="javascript:window.location.href='<?php echo e(route('S.ShowMore')); ?>?c=<?php echo e($c); ?>&type=<?php echo e($type); ?>&order=desc'">
                <svg width="20px" height="20px" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="9"></circle>
                    <path
                        d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                        class="inner"></path>
                    <path
                        d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                        class="outer"></path>
                </svg>
                <span>نزولی</span>
            </label>
            <label for="rdo-2" class="btn-radio">
                <input  type="radio" id="rdo-2" value="asc"
                <?php echo e(isset($order) && $order == 'asc' ? 'checked' : ''); ?>

                onclick="javascript:window.location.href='<?php echo e(route('S.ShowMore')); ?>?c=<?php echo e($c); ?>&type=<?php echo e($type); ?>&order=asc'">
                <svg width="20px" height="20px" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="9"></circle>
                    <path
                        d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                        class="inner"></path>
                    <path
                        d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                        class="outer"></path>
                </svg>
                <span>صعودی</span>
            </label>
           
        </div>
    </div>
    <?php if(count($posts)): ?>
    <section class="movie-sections">
        <h2>
            <?php echo e($title); ?>

        </h2>
        <?php if(isset($collection)): ?>
        <p class="text-white mb-5"><?php echo e($collection->description); ?></p>
        <?php endif; ?>
        <div class="row">
            <?php if(isset($type) && $type == 'collection'): ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3 mb-5">
                <?php $__env->startComponent('components.collection',['collection'=>$post , 'ajax'=>1]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>

            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-2 mb-5">
                <?php $__env->startComponent('components.article',['model'=>$post]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>

    </section>
    <?php endif; ?>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Front/ShowMore.blade.php ENDPATH**/ ?>