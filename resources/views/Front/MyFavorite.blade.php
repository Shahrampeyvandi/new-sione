@extends('Layout.Front')
@section('Title','لیست من')


@section('content')



<section class="movie-sections favorite-section mt-7">
    @if (count($myfavorites))
    <h3>
        لیست من
        <a href="#">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="container-fluid">
        <div class="row ">
            @foreach ($myfavorites as $post)
            <div class="col-6 col-md-2">
                @component('components.article',['model'=>$post , 'ajax'=>0])
                @endcomponent
            </div>
            @endforeach
        </div>
    </div>
    @endif
</section>
@endsection