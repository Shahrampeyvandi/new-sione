@extends('Layout.Blog')
@section('Title',$title)

@section('content')
<section class="mainBlog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 no-padding">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($collection1 as$key => $item)
                        @if ($key === array_key_first($collection1->toArray()))
                        <div class="col-12 no-padding">
                        <a href="{{$item->url()}}">
                                <div class="card-blog-section">
                                    <div class="card-cover"></div>
                                    <img class="img-cover" src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                    <h3>
                                        {{$item->title}}
                                    </h3>
                                </div>
                            </a>
                        </div>
                        @else

                        <div class="col-12 col-sm-6 no-padding">
                            <a href="#">
                                <div class="card-blog-section medium">
                                    <div class="card-cover"></div>
                                    <img src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                    <h3>
                                        {{$item->title}}
                                    </h3>
                                </div>
                            </a>
                        </div>
                        @endif

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 no-padding">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($collection2 as$key => $item)
                        @if ($key === array_key_last($collection2->toArray()))

                        <div class="col-12 no-padding">
                            <a href="./blog-post-page.html">
                                <div class="card-blog-section">
                                    <div class="card-cover"></div>
                                    <img class="img-cover" src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                    <h3>
                                        {{$item->title}}
                                    </h3>
                                </div>
                            </a>
                        </div>
                        @else
                        <div class="col-12 col-sm-6 no-padding">
                            <a href="./blog-post-page.html">
                                <div class="card-blog-section medium">
                                    <div class="card-cover"></div>
                                    <img src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                    <h3>
                                        {{$item->title}}
                                    </h3>
                                </div>
                            </a>
                        </div>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog_page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9">
                @if (count($naghd_va_barrasi))
                <div class="blog-body">
                    <h1>
                        <span>
                            نقد و بررسی فیلم ها
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog">
                        <div class="swiper-wrapper">
                            @foreach ($naghd_va_barrasi as $item)
                            <div class="swiper-slide">
                                <a href="#">
                                    <div class="slider-blog-box">
                                        <img src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                        <div class="cover-img-slider"></div>
                                    </div>
                                    <h4>
                                        {{$item->title}}
                                    </h4>
                                </a>
                            </div>
                            @endforeach

                        </div>
                        <div class="slider-prev">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="slider-next">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </div>
                @endif
                @if (count($latest_news))
                <div class="blog-body">
                    <h1>
                        <span>
                            آخرین اخبار
                        </span>
                    </h1>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="last-articles-box">
                                <div class="container-fluid">
                                    <div class="row">
                                        @foreach ($latest_news as $item)
                                        <div class="col-12 col-md-6">
                                            <div class="container-fluid no-padding">
                                                <div class="row">
                                                    <div class="col-4 no-padding">
                                                    <a href="{{$item->url()}}">
                                                            <div class="card-blog-section">
                                                                <div class="card-cover"></div>
                                                                <img class="blog-news-img" src="{{asset(unserialize($item->poster)['resize'])}}"
                                                            alt="{{$item->title}}">
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-8 no-padding">
                                                        <h4>
                                                           {{$item->title}}
                                                        </h4>
                                                        <h5>
                                                            {{$item->get_shamsi_date()}}
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
             @if (count($latest_articles))
                    <div class="blog-body">
                    <h1>
                        <span>
                            آخرین مقالات
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog_blog">
                        <div class="swiper-wrapper">
                            @foreach ($latest_articles as $item)
                            <div class="swiper-slide">
                                <a href="#">
                                    <div class="slider-blog-box">
                                        <img src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                        <div class="cover-img-slider"></div>
                                    </div>
                                    <h4>
                                        {{$item->title}}
                                     </h4>
                                </a>
                            </div>
                            @endforeach

                        </div>
                        <div class="slider-prev">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="slider-next">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </div>
             @endif

             @if (count($latest_videos))
                    <div class="blog-body">
                    <h1>
                        <span>
                            آخرین ویدیو ها
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog">
                        <div class="swiper-wrapper">
                           @foreach ($latest_videos as $item)
                                <div class="swiper-slide">
                                <a href="#">
                                    <div class="slider-blog-box">
                                        <img src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                        <div class="cover-img-slider"></div>
                                        <div class="play-show">
                                            <i class="fa fa-video"></i>
                                        </div>
                                    </div>
                                    <h4>
                                        {{$item->title}}
                                     </h4>
                                </a>
                            </div>
                           @endforeach
                         
                        </div>
                        <div class="slider-prev">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="slider-next">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </div>
             @endif
            </div>
            @include('Includes.Blog.sidebar')
        </div>
    </div>
</section>
@endsection