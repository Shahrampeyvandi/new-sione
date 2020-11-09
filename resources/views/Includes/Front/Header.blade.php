<header>
    <div class="cover-menu"></div>
    <nav class="siteNav">
        <div class="navBar">
            <div class="menu-button">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <ul class="navList">
                <li class="navItem logo">
                    <a href="{{route('MainUrl')}}">
                        SiOne
                    </a>
                </li>
                <li class="navItem">
                    <a href="{{route('MainUrl')}}" class="
                        @if(\Request::route()->getName() == "MainUrl") {{'active-nav'}} @endif ">
                            <i class=" far fa-home"></i>
                        خانه
                    </a>
                </li>
                <li class="navItem">
                    <a href="{{route('AllMovies')}}" class="
                    @if(\Request::route()->getName() == "AllMovies") {{'active-nav'}} @endif">
                        <i class="far fa-camera-movie"></i>
                        فیلم
                    </a>
                </li>
                <li class="navItem">
                    <a href="{{route('AllSeries')}}" class="
                    @if(\Request::route()->getName() == "AllSeries") {{'active-nav'}} @endif">
                        <i class="fa fa-tv"></i>
                        سریال
                    </a>
                </li>
                 <li class="navItem">
                    <a href="{{route('AllDocumentaries')}}" class="
                    @if(\Request::route()->getName() == "AllDocumentaries") {{'active-nav'}} @endif">
                        <i class="fa fa-tv"></i>
                        مستند
                    </a>
                </li>
                <li class="navItem">
                    <a href="{{route('Categories')}}" class="
                    @if(\Request::route()->getName() == "Categories") {{'active-nav'}} @endif">
                        <i class="fa fa-cloud"></i>
                        دسته بندی
                    </a>
                </li>
                  <li class="navItem">
                    <a href="{{route('S.ShowMore')}}?c=collections&type=all" class="
                    @if(request()->has('c') && request()->c == 'collections') {{'active-nav'}} @endif">
                        <i class="fa fa-cloud"></i>
                        کالکشن
                    </a>
                </li>

               
                <li class="navItem">
                    <a href="{{route('CommingSoon')}}" class="
                    @if(\Request::route()->getName() == "CommingSoon") {{'active-nav'}} @endif">
                        <i class="fa fa-child"></i>
                        به زودی
                    </a>
                </li>

                <li class="navItem">
                    <a href="{{route('Blog.index')}}" class="
                    @if(\Request::route()->getName() == "Blog.index") {{'active-nav'}} @endif"> 
                        <i class="fa fa-fire"></i>
                        وبلاگ
                    </a>
                </li>
            </ul>
            <div class="menu-item-left_nav">
                <!--                <div class="login-register">-->
                <!--                    <a href="login_register.html">-->
                <!--                        ورود / ثبت نام-->
                <!--                    </a>-->
                <!--                </div>-->
                <div class="user-login-show">
                    <i class="fa fa-user-circle"></i>
                </div>
                <div class="profile-dropdown-box hidden">
                    <ul>
                        <li>
                            <a href="{{route('S.Account')}}">
                                <i class="fa fa-user-circle"></i>
                                <span>
                                    @isset($user)
                                    {{$user->name()}}
                                    @endisset
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('S.SiteSharing')}}">
                                <i class="fa fa-shopping-bag"></i>
                                <span>
                                    خرید اشتراک
                                </span>
                            </a>
                        </li>
                        <li>
                        <a href="{{route('S.MyFavorite')}}">
                                <i class="fa fa-list"></i>
                                <span>
                                    لیست من
                                </span>
                            </a>
                        </li>

                         <li>
                        <a href="{{route('MovieRequest')}}">
                                <i class="fa fa-film"></i>
                                <span>
                                    درخواست فیلم
                                </span>
                            </a>
                        </li>
                      
                        <li>
                            <a href="{{route('logout-user')}}">
                                <i class="fa fa-power-off"></i>
                                <span>
                                    خروج
                                </span>
                            </a>
                        </li>
                       
                    </ul>
                </div>
              @if (auth()->check())
                    <a  class="buy-subscribe inbox-icon"  href="#" >
                    <i class="fa fa-envelope"></i>
                    @if ($user->newNoty())
                             <span class="inbox-noty"><i class="fa fa-exclamation-circle"></i></span>

                    @endif
                </a>
                <div class="inbox close">
                   @if (count($user->noty))
                        <ul>
                       @foreach ($user->noty()->latest()->take(6)->get() as $item)
                            <li>
                            <p>
                               {{$item->content}}
                            </p>
                            <span >sione support</span>
                        </li>
                       @endforeach
                    </ul>
                   @endif
                </div>
              @endif
                <div id="search-box">
                    <i class="far fa-search"></i>
                </div>
                @include('Includes.Front.Search')
            </div>
        </div>
    </nav>
</header>