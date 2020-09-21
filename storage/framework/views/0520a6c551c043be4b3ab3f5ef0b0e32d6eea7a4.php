<?php if($post->comment_status == 'enable'): ?>
    <section class="movie-user-comments">
    <h1>
        <?php if($post->comments): ?>
        نظرات کاربران
        <?php else: ?>
        افزودن نظر
        <?php endif; ?>
    </h1>
    <div class="movie-user-comments-box">
        <div class="comments-detail">
            <div class="user-comment-img">
                <i class="fa fa-user-circle"></i>
            </div>
            <div class="comments-detail-box">
            <form id="Comments-Form" action="<?php echo e(route('SaveComment',$post)); ?>" method="post">
                <?php echo csrf_field(); ?>
                    <div class="input-place">
                        <input type="text" id="comment-user" name="comment" autocomplete="off" required>
                        <label for="comment-user">
                            نظرتان راجع به این فیلم چیست؟
                        </label>
                    </div>
                    <span class="send-comment">
                        <button type="submit">
                            ثبت نظر
                        </button>
                    </span>
                </form>
            </div>
        </div>

       <div id="comments">
            <?php $__currentLoopData = $post->comments->where('confirm',1)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="comments-detail">
            <div class="user-comment-img">
                <i class="fa fa-user-circle"></i>
            </div>
            <div class="comments-detail-box">
                <p class="user-detail-comm">
                   
                    <?php echo e($comment->user()); ?> - <?php echo e($comment->timeAndData()); ?>

                </p>
                <p class="comment-user">
                    <?php echo $comment->text; ?>

                </p>
                <div class="like-comment">
                    <i class="far fa-thumbs-up"></i>
                    <span>
                        0
                    </span>
                    <i class="far fa-thumbs-down"></i>
                    <span>
                        0
                    </span>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </div>
       <?php if(count($post->comments) > 10): ?>
            <a data-data="10" href="#" onclick="getComments(event,'<?php echo e(route('GetCommentAjax',$post)); ?>')"  class="more-comment">
                بیشتر
            </a>
       <?php endif; ?>

    </div>
</section>
<?php endif; ?><?php /**PATH C:\xampp1\htdocs\sione\resources\views/Includes/Front/Comments.blade.php ENDPATH**/ ?>