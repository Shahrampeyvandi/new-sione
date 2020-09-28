@extends('Layout.Front')
@section('Title',$title)
@section('content')
<!-- The Modal -->
<div id="myModal" class="modal">
    <span class="close-image" onclick="closeImage(event)">&times;</span>
    <img class="modal-content" id="img01">

</div>
@include('Includes.Front.TopPoster')
@if (count($sections))
<section class="movie-Season mt-3">
    @isset($season)
    <div class="Season-select">
        انتخاب فصل
        <i class="fa fa-angle-down"></i>
    </div>
    <ul class="movie-Season-box" id="scroll-tyle">
        @foreach ($post->seasons()->orderBy('number','asc')->get() as $item)
        <li>
            <a href="{{route('ShowMovie',['slug'=>$post->slug])}}?season={{$item->number}}"> {{$item->name}}</a>
        </li>
        @endforeach
    </ul>
    @endisset
    <div class="container-fluid">
        <div class="row">
            @foreach ($sections as $section)
            <div class="col-12 col-md-4 col-lg-3 Season-movie-box">

                <a href="{{$section->play()}}">
                    <div class="Season-movie-img-box">
                        <img src="{{$section->image()}}" alt="">
                        <i class="fa fa-play-circle"></i>
                    </div>
                </a>

                <h3>
                    @if ($post->has_season())
                    {{$section->serie->title}} - فصل {{$season->number}} - قسمت {{$section->section}}
                    @else
                    {{$section->serie->title}} - قسمت {{$section->section}}
                    @endif


                    <a href="#" class="section-download" data-episode="{{$section->id}}" data-id="{{$section->id}}"
                        onclick="call(event)">
                        <i class="fa fa-cloud-download-alt"></i>
                    </a>
                </h3>
                @if ($section->duration)
                <h4>
                    {{$section->duration}} دقیقه
                </h4>
                @endif

                <h5>
                    {!! html_entity_decode(str_limit($section->description,100), ENT_QUOTES, 'UTF-8')!!}

                </h5>
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
            @if ($post->trailer)
            <div class="col-6 col-lg-2 trailer-wrapper">
                <a href="{{$post->play_trailer()}}">
                    <img class="show-img" src="{{asset(unserialize($post->poster)['resize'])}}" alt="{{$post->name}}">
                    <i class="fa fa-play-circle"></i>
                </a>
            </div>
            @endif
            @foreach ($post->images as $image)
            <div class="col-6 col-lg-2">
                <a href="#" onclick="showImage(event)">
                    <img class="show-img" src="{{asset($image->url)}}" alt="{{$post->name}}">
                </a>
            </div>
            @endforeach
        </div>
    </div>



    @if (count($post->actors))
    <div class="container-fluid">
        <h2>
            بازیگران:
        </h2>
        <div class="row">

            @foreach ($post->directors as $director)
            <div class="col-6 col-lg-2 d-flex justify-content-center">
                <div class="star-img-box ">
                    <a href="{{$director->path()}}">
                        @if ($director->image)
                        <img src="{{asset($director->image)}}" alt="{{$director->name}}">
                        @else
                        <img src="{{asset('assets/images/avatar.png')}}" alt="{{$director->name}}">
                        @endif
                        <h4>
                            {{$director->name}}
                        </h4>
                        <h5>
                            کارگردان
                        </h5>
                    </a>
                </div>
            </div>
            @endforeach

            @foreach ($post->actors()->take(12)->get() as $actor)
            <div class="col-6 col-lg-2 d-flex justify-content-center">
                <div class="star-img-box ">
                    <a href="{{$actor->path()}}">
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
            <div class="col-12 col-lg-2">
                @component('components.article',['model'=>$item])
                @endcomponent
            </div>
            @endforeach


        </div>
    </div>
</section>
@endif

@include('Includes.Front.Comments')


@endsection