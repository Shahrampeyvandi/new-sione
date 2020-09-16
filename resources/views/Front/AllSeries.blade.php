@extends('Layout.Front')
@section('Title','سریال ها')


@section('content')


@include('Includes.Front.DesktopSlider')
@include('Includes.Front.MobileSlider')

@include('Includes.Front.TopSlider')

@if (count($newseries))
<section class="movie-sections">
    <h3>
        تازه ترین ها
        <a href="{{route('S.ShowMore')}}?c=new&type=serie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($newseries as $post)
            <div class="swiper-slide">
                @component('components.article',['model'=>$post, 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail',['model'=>$post])
    @endcomponent
</section>
@endif

@if (count($latestdoble))
<section class="movie-sections">
    <h3>
        دوبله سیوان
        <a href="{{route('S.ShowMore')}}?c=doble&type=serie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($latestdoble as $post)
            <div class="swiper-slide">
                @component('components.article',['model'=>$post , 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail',['model'=>$post])
    @endcomponent
</section>
@endif



@if (count($newyear))
<section class="movie-sections">
    <h3>
        جدیدترین سریال های {{$year}}
        <a href="{{route('S.ShowMore')}}?c={{$year}}&type=serie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($newyear as $post)
            <div class="swiper-slide">
                @component('components.article',['model'=>$post , 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail',['model'=>$post])
    @endcomponent
</section>
@endif


@endsection