@extends('Layout.Front')
@section('Title',$title)


@section('content')


@include('Includes.Front.DesktopSlider')
@include('Includes.Front.MobileSlider')

@include('Includes.Front.TopSlider')

@if (isset($posts))
<section class="movie-sections">
    <h3>
        تازه ترین سریال ها
     
    </h3>
    <div class="swiper-container">
         <div class="row">
               @foreach ($posts as $post)
            <div class="col-6 col-md-2">
            @component('components.article',['model'=>$post])
            @endcomponent
            </div>
            @endforeach
         </div>
</div>
@component('components.showDetail')
    @endcomponent

</section>
@endif




@endsection

