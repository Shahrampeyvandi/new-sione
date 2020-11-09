@extends('Layout.Front')
@section('Title',$title)


@section('content')


@include('Includes.Front.DesktopSlider')
@include('Includes.Front.MobileSlider')



@if (count($newmovies))
<section class="movie-sections">
    <h3>
        تازه ترین فیلم ها
        <a href="{{route('S.ShowMore')}}?c=new&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($newmovies as $movie)
            <div class="swiper-slide">
                @component('components.article',['model'=>$movie,'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail')
    @endcomponent
</section>
@endif

@if (count($latestdoble))
<section class="movie-sections">
    <h3>
        دوبله فارسی بدون سانسور
        <a href="{{route('S.ShowMore')}}?c=doble&type=movie">
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
    @component('components.showDetail')
    @endcomponent
</section>
@endif



@if (count($newyear))
<section class="movie-sections">
    <h3>
        {{$year}}
        <a href="{{route('S.ShowMore')}}?c={{$year}}&type=movie">
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
    @component('components.showDetail')
    @endcomponent
</section>
@endif



@if (isset($cat) && count($cat))
@foreach ($cat as $key=>$category)
@if (count($category))
<section class="movie-sections">

    <h3>
        {{\App\Category::whereLatin($key)->first()->name}}
        <a href="{{route('S.ShowMore')}}?c={{strtolower($key)}}&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($category as $animation)
            <div class="swiper-slide">
                @component('components.article',['model'=>$animation , 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail')
    @endcomponent
</section>
@endif
@endforeach
@endif






@if (isset($top250) && count($top250))
<section class="movie-sections">
    <h3>
        برترین فیلم های Imdb
        <a href="{{route('S.ShowMore')}}?c=top250&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            @foreach ($top250 as $post)
            <div class="swiper-slide">
                @component('components.article',['model'=>$post , 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    @component('components.showDetail')
    @endcomponent
</section>
@endif


@endsection