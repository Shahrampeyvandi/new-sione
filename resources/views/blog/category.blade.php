@extends('Layout.Blog')
@section('title',$title)

@section('content')
<div class="min-h-80">
    @if ($first_post)
<div class="top_img-place">
    <img src="{{asset(unserialize($first_post->poster)['poster'])}}" alt="{{$category_name}}">
    <div class="cover-img-top"></div>
    <div class="cover-img-bottom"></div>
    <h3>
        {{$category_name}}
    </h3>
</div>
<section class="blog-page-elements">
    <div class="container-fluid">
        <div class="row">
            @foreach ($posts as $item)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="blog-page-elements-box">
                <a href="{{$item->url()}}">
                        <div class="img-place-blog">
                            <img src="{{asset(unserialize($item->poster)['resize'])}}" alt="{{$item->title}}">
                            <div class="img-place-blog-cover"></div>
                            @if ($category_name == 'ویدیوها')
                                <div class="play-show-blog">
                                <i class="fa fa-video"></i>
                            </div>
                            <span>
                                پیش نمایش
                            </span>
                            @endif
                        </div>
                        <h3>
                           {{$item->title}}
                        </h3>
                        <span class="date-blog-post">
                            {{$item->get_shamsi_date()}}
                        </span>
                        <h4>
                          {!!str_limit(html_entity_decode($item->remove_image_from_desc(), ENT_QUOTES, 'UTF-8'),30,' ... ')!!}
                        </h4>
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endif
</div>
@endsection