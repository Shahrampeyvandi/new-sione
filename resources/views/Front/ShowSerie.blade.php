@extends('Layout.Front')
@section('Title',$title)

@section('content')
@include('Includes.Front.TopPoster')

@if ($post->type == "series" && count($post->seasons))
<section class="movie-Season mt-3">
    <div class="Season-select">
        انتخاب فصل
        <i class="fa fa-angle-down"></i>
    </div>
    <ul class="movie-Season-box">
        @foreach ($post->seasons as $item)
        <li>
        <a href="{{route('ShowSerie',['slug'=>$post->slug,'season'=>$item->number])}}"> {{$item->name}}</a>
        </li>
        @endforeach
    </ul>
    <div class="container-fluid">
        <div class="row">
            @foreach ($seasons as $section)
            <div class="col-12 col-md-4 col-lg-3">
                <div class="Season-movie-box">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-5 col-md-12">
                            <a href="{{$section->play()}}">
                                    <div class="Season-movie-img-box">
                                        <img src="{{asset($section->poster)}}" alt="">
                                        <i class="fa fa-play-circle"></i>
                                    </div>
                                </a>
                            </div>
                            <div class="col-7 col-md-12">
                                <h3>
                                    {{$section->serie->title}} - فصل {{$section->season}} - قسمت {{$section->section}}
                                    <i class="fa fa-cloud-download-alt"></i>
                                </h3>
                                <h4>
                                    {{$post->duration}}
                                </h4>
                            </div>
                            <div class="col-12">
                                <h5>
                                    {{str_limit($section->description,100,'....')}}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
<section class="movie-trailer">
    <h1>
        تریلر، تصاویر و جزییات
    </h1>
    <div class="container-fluid">
        <div class="row">
            @foreach ($post->images as $image)
            <div class="col-3 col-lg-2">
                <img src="{{asset($image->url)}}" alt="{{$post->name}}">
            </div>
            @endforeach
        </div>
    </div>
    <h2>
        {{$post->title}}
    </h2>
    <h3>
        درباره سریال {{$post->title}}
    </h3>

    <div class="col-12 movie-description-color">

        {!! $post->description !!}
    </div>
    <h2>
        دسته بندی:
        @foreach ($post->categories as $category)
        {{$category->name}}
        @endforeach
    </h2>

    @if (count($post->captions))
    <h2>
        زیرنویس:
        @foreach ($post->captions as $caption)
        {{$caption->lang}}
        @endforeach
    </h2>
    @endif
    @if (count($post->actors))
    <div class="container-fluid">
        <div class="row">
            @foreach ($post->actors as $actor)
            <div class="col-3 col-lg-2 d-flex justify-content-center">
                <div class="star-img-box w-p-80">
                    <a href="#">
                        @if ($actor->image)
                        <img src="{{asset($actor->image)}}" alt="{{$actor->name}}">
                        @else
                        <img src="{{asset('assets/images/avatar.png')}}" alt="{{$actor->name}}">
                        @endif
                        <h4>
                            {{$actor->name}}
                        </h4>
                        <h5>
                            بازیگر
                        </h5>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    @endif
  
</section>
@if (count($relatedPosts))
<section class="movie-related">
    <h1>
        همچنین تماشا کنید
    </h1>
    <div class="container-fluid">
        <div class="row">
            @foreach ($relatedPosts as $item)
            <div class="col-3 col-lg-2">
                @component('components.article',['serie'=>$item])
                @endcomponent
            </div>
            @endforeach


        </div>
    </div>
</section>
@endif

@include('Includes.Front.Comments')


@endsection