@extends('Layout.Front')
@section('Title',$title)

@section('content')

<div class="showmore-wrapper">
    @if (count($posts))
    <section class="movie-sections">
        <h3>
            {{$title}}

        </h3>
        <div class="row">

            @foreach ($posts as $post)
           <div class="col-6 col-md-2 mb-5">
                @component('components.article',['model'=>$post])
            @endcomponent
           </div>
            @endforeach

        </div>

    </section>
    @endif
</div>



@endsection