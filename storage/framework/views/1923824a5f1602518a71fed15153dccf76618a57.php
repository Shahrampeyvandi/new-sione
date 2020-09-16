<!-- begin::side menu -->
<div class="side-menu">
    <div class="side-menu-body">
        <ul>
            <li class="side-menu-divider">فهرست</li>
            <li><a href="<?php echo e(route('BaseUrl')); ?>"><i class="fas fa-home"></i> <span class="pr-4">داشبورد</span> </a></li>
            <li><a href="<?php echo e(route('Panel.UserList')); ?>"><i class="fas fa-users"></i> <span class="pr-4">کاربران</span>
                </a>
            </li>
            <li><a href="<?php echo e(route('Panel.MoviesList')); ?>"><i class="fas fa-film"></i> <span class="pr-4">فیلم </span> </a>

            </li>
            <li><a href="<?php echo e(route('Panel.SeriesList')); ?>"><i class="fas fa-video"></i> <span class="pr-4">سریال</span> </a>
            </li>
            <li><a href="<?php echo e(route('Panel.SeriesList')); ?>?type=documentary"><i class="fas fa-video"></i> <span class="pr-4">مستند</span> </a>
            </li>
            <li><a href="#"><i class="fas fa-blog"></i> <span class="pr-4">وبلاگ</span> </a>
                <ul>
                    <li><a href="<?php echo e(route('Panel.AddBlog')); ?>">افزودن</a></li>
                    <li><a href="<?php echo e(route('Panel.BlogList')); ?>">لیست</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-image"></i> <span class="pr-4">بنر تبلیغاتی</span> </a>
                <ul>
                    <li><a href="<?php echo e(route('Panel.AddAdvert')); ?>">افزودن</a></li>
                    <li><a href="<?php echo e(route('Panel.AdvertList')); ?>">لیست</a></li>
                </ul>
            </li>
              <li><a href="<?php echo e(route('Panel.SliderList')); ?>"><i class="fas fa-sliders-h"></i> <span class="pr-4">اسلایدشو</span> </a>
             <li><a href="<?php echo e(route('Panel.CatList')); ?>"><i class="fas fa-list-alt"></i> <span class="pr-4">دسته بندی ها</span> </a>
                <li><a href="<?php echo e(route('Panel.ActorsList')); ?>"><i class="fas fa-list-alt"></i> <span class="pr-4">هنرمندان</span> </a>
                <li><a href="#"><i class="fas fa-star"></i> <span class="pr-4">اشتراک</span> </a>
                <ul>
                    <li><a href="<?php echo e(route('Panel.AddPlan')); ?>">افزودن</a></li>
                    <li><a href="<?php echo e(route('Panel.PlanList')); ?>">لیست</a></li>
                    <li><a href="<?php echo e(route('Panel.DiscountList')); ?>">کدهای تخفیف</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fas fa-envelope"></i> <span class="pr-4">ارتباط با کاربران</span> </a>
                <ul>
                    <li><a href="<?php echo e(route('Panel.SendMessage')); ?>">ارسال پیام</a></li>
                </ul>
            </li>
            <li><a href="<?php echo e(route('Panel.UnconfirmedComments')); ?>"><i class="fas fa-comment"></i> <span
                        class="pr-4">دیدگاه ها</span> </a>
            </li>
             <li><a href="<?php echo e(route('Panel.Setting')); ?>"><i class="fas fa-cog"></i> <span
                        class="pr-4">تنظیمات</span> </a>
            </li>

        </ul>
    </div>
</div>
<!-- end::side menu --><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Panel/side-menu.blade.php ENDPATH**/ ?>