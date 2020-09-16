@extends('Layout.Blog')
@section('Title','وبلاگ')

@section('content')
@include('Includes.Blog.popups')
<section class="blog_page post-blog">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-9">
                <div class="main-post-blog">
                    <div class="blog-top-img">
                        <div class="top-post-img">

                            <img src="{{asset(unserialize($post->poster)['poster'])}}" alt="">
                            <div class="cover-img-post"></div>
                        </div>

                    </div>
                    <div class="blog-post-define">
                        <i class="fa fa-quote-right"></i>
                        <p>
                            {!! $post->description !!}
                        </p>

                        @if (count($post->videos))
                            <div class="row justify-content-center my-3">
                            <video width="100%" controls>
                                <source src="{{asset($post->videos->first()->url)}}" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                        @endif
                    </div>


                    <div class="sharing-post-blog">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-lg-6">
                                    <div class="social-post-sharing">
                                        <span>
                                            این پست را به اشتراک بزارید
                                        </span>
                                        <a href="#" class="share-links">
                                            <i class="fas fa-share-alt"></i>
                                        </a>

                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="vote-post-sharing">
                                        <span>
                                            به ابن مطلب رای دهید
                                        </span>
                                        <div class="star-vote-box">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($latest_movies))
                <div class="slider-blog-post">
                    <div class="site_define">
                        <h2>
                            آخرین های سایت
                        </h2>
                        <h3>
                            تماشای آنلاین فیلم و سریال
                        </h3>
                        <a href="{{route('MainUrl')}}" class="btn--ripple">
                            ورود به سایت
                        </a>
                    </div>
                    <div class="swiper-container post-blog-page-slider">
                        <div class="swiper-wrapper">
                            @foreach ($latest_movies as $item)
                            <div class="swiper-slide">
                                <div class="slider-post-img-box">
                                    <a href="#">
                                        <img src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                @endif
                @if(count($relateds)>0)
                <div class="blog-body">
                    <h1>
                        <span>
                            نوشته های مرتبط با این پست
                        </span>
                    </h1>
                    <div class="swiper-container slider-blog">
                        <div class="swiper-wrapper">
                            @foreach($relateds as $related)

                            <div class="swiper-slide">
                                <a href="{{$related->url()}}">
                                    <div class="slider-blog-box">
                                        <img src="{{asset(unserialize($related->poster)['resize'])}}" alt="">
                                        <div class="cover-img-slider"></div>
                                        {{-- <div class="play-show">
                                            <i class="fa fa-video"></i>
                                        </div> --}}
                                    </div>
                                    <h4>
                                        {{$related->title}}
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

                @include('Includes.Blog.CommentForm')
            </div>
            @include('Includes.Blog.sidebar')

        </div>
    </div>
</section>
@endsection