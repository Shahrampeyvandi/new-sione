<div class="search-panel">
    <button id="close_search">
        <i class="fa fa-times"></i>
    </button>
    <div class="input-place">
        <label for="search-input"></label>
    <input id="search-input" data-url="<?php echo e(route('S.Search')); ?>" type="search" name="search" required autocomplete="off"
            placeholder="فیلم، سریال، بازیگر،ژانر">
    </div>
    <div class="filter-place-box">
        <div class="filter-place-elements">
            <div class="filter-search">
                فیلتر ها
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
        <div class="filter-delete-place">

        </div>
    </div>
    <div class="filter-box">
        <div class="menu-filters">
            <ul>
                <li id="genre">
                    ژانرها
                    <i class="fa fa-angle-left"></i>
                </li>
                
                <li id="Sound">
                    زیرنویس
                    <i class="fa fa-angle-left"></i>
                </li>
                <li id="Construction">
                    سال ساخت
                    <i class="fa fa-angle-left"></i>
                </li>
                <li id="Order">
                    مرتب سازی
                    <i class="fa fa-angle-left"></i>
                </li>
            </ul>
        </div>
        <div class="filter-body">
            <div class="filter-body-box genre-box">
                <div class="container-fluid">
                    <div class="row">
                        <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                            <div class="checkbox-place">
                                <label>
                                    <input data-id="<?php echo e($genre->id); ?>" data-type="genre" data-url="<?php echo e(route('S.Search')); ?>"
                                        id="genre_<?php echo e($genre->id); ?>" name="gnere_<?php echo e($genre->id); ?>" class="filter"
                                        type="checkbox" value="<?php echo e($genre->name); ?>">
                                    <?php echo e($genre->name); ?>

                                </label>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>
            </div>
            
            <div class="filter-body-box SoundSubtitles-box">
                <div class="container-fluid">
                    <div class="row">
                        <?php $__currentLoopData = $captions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$caption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                            <div class="checkbox-place">
                                <label>
                                    <input id="<?php echo e($key+1); ?>" name="<?php echo e($key+1); ?>" class="filter" type="checkbox"
                                        data-id="<?php echo e($caption); ?>" data-type="caption" data-url="<?php echo e(route('S.Search')); ?>"
                                        value="<?php echo e($caption); ?>">
                                    <?php echo e($caption); ?>

                                </label>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="filter-body-box YearConstruction-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input data-url="<?php echo e(route('S.Search')); ?>" type="text" id="demo_2"
                                    class="range-slider__range">
                            </div>
                            
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-body-box OrderConstruction-box">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="<?php echo e(route('S.Search')); ?>" name="order" value="default" checked>
                            <label for="male">پیش فرض</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="<?php echo e(route('S.Search')); ?>" name="order" value="new">
                            <label for="male">تازه ها</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="<?php echo e(route('S.Search')); ?>" name="order" value="rate">
                            <label for="male">امتیاز IMDB</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="<?php echo e(route('S.Search')); ?>" name="order" value="yearasc">
                            <label for="male">سال ساخت (جدیدترین)</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="<?php echo e(route('S.Search')); ?>" name="order" value="yeardsc">
                            <label for="male">سال ساخت (قدیمی ترین)</label><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row results">

    </div>
</div>
</div><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Front/Search.blade.php ENDPATH**/ ?>