@extends('Layout.Front')
@section('Title',$title)

@section('content')

<div class="showmore-wrapper">
    @if (count($posts))
    <section class="movie-sections">
        <h3>
            {{$title}}
        </h3>
        @isset($collection)
        <p class="text-white mb-5">{{$collection->description}}</p>
        @endisset
        <div class="row">
            @if (isset($type) && $type == 'collection')
            @foreach ($posts as $post)
            <div class="col-6 col-md-3 mb-5">
                @component('components.collection',['collection'=>$post , 'ajax'=>1])
                @endcomponent
            </div>
            @endforeach
            @else

            @foreach ($posts as $post)
            <div class="col-6 col-md-2 mb-5">
                @component('components.article',['model'=>$post])
                @endcomponent
            </div>
            @endforeach
            @endif

        </div>

    </section>
    @endif
</div>



@endsection