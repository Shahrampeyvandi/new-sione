@extends('Layout.Front')
@section('Title',$title)


@section('content')



<section class="movie-sections m--t m-h-50">
    @if (count($commingsoon))


    @foreach ($commingsoon as $post)
    <div class="container comming-soon-item">
        <div class="row">
            <div class="col-md-3">
                <div class="img-container"><img src="{{asset($post->poster)}}" alt="{{$post->title}}" class="">
                    <div class=" rounded"></div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="detail-wrapper">
                    <h2 class="">{{$post->title}}</h2>
                    <div class="">
                        {!! html_entity_decode(str_limit($post->description,350,' ...'), ENT_QUOTES, 'UTF-8') !!}
                    </div>
                    <div class="date">
                        <p class="">تاریخ انتشار:

                            @if ($post->type == "series")

                            {{\Morilog\Jalali\Jalalian::forge($post->first_publish_date)->format('%B %d، %Y')}}
                            @else
                            {{\Morilog\Jalali\Jalalian::forge($post->released)->format('%B %d، %Y')}}
                            @endif
                        </p>
                    </div>

                    <a href="{{$post->play()}}" class="page-movie-play btn--ripple mr-0">
                        <i class="fa fa-play"></i>
                        پیش نمایش
                    </a>

                </div>
            </div>
        </div>
    </div>
    @endforeach

    @endif
</section>



@endsection