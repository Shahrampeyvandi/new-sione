<header>
    <nav>
        <div class="menuSite">
            <div class="Logo_mobile">
                <a href="<?php echo e(route('MainUrl')); ?>">
                    <i class="fa fa-home"></i>
                </a>
            </div>
            <ul class="menuList">
                <li class="menuItems close_menu">
                    <a href="#">
                        بستن منو
                    </a>
                </li>
                <li class="menuItems logo">
                    <a href="<?php echo e(route('MainUrl')); ?>">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li class="menuItems">
                    <a href="<?php echo e(route('Blog.Category','news')); ?>">
                        <i class="far fa-microphone-alt"></i>
                        اخبار
                    </a>
                </li>
                <li class="menuItems">
                    <a href="<?php echo e(route('Blog.Category','articles')); ?>">
                        <i class="far fa-file-alt"></i>
                        مقالات
                    </a>
                </li>

                <li class="menuItems">
                    <a href="<?php echo e(route('Blog.Category','videos')); ?>">
                        <i class="far fa-camcorder"></i>
                        ویدیوها
                    </a>
                </li>
                <li class="menuItems">
                    <a href="<?php echo e(route('Blog.Category','naghd-va-barrasi')); ?>">
                        <i class="far fa-film-alt"></i>
                        نقد و بررسی
                    </a>
                </li>


            </ul>
            <div class="menu-left-items">
                <div class="menu-left-items-elements">
                    <div class="menu-button">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </div>
                <div class="menu-left-items-elements">
                    <div class="far fa-search search-blog"></div>
                </div>
            </div>
        </div>
    </nav>
</header>


<div class="search-modal" >
    <div class="search-input-holder">
        <a href="#" class="search-blog-close"><i class="fa fa-times"></i></a>
    <form class="search-from f-w" action="#" autocomplete="off" onsubmit="searchInBlogs(event,'<?php echo e(route('Blog.Ajax.Search')); ?>')"> 
            <input
                class="f-w search-inp-fld" name="s" id="s-blog" type="text" placeholder="عبارت مورد نظر خود را وارد نمایید"> <button
                type="submit"></button></form>
        <div class="search-res-holder f-w">
            <div class="row-ajax-s f-w search-opened">
                
           
                
                
            
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Blog/Header.blade.php ENDPATH**/ ?>