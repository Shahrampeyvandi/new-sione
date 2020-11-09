@extends('Layout.Front')
@section('Title',$title)

@section('content')

<div class="showmore-wrapper">
    @if ($c !== 'collections') 
    <div class="text-white">
        <div class="col-md-12 text-right mr-0 mr-md-3">
            <span>مرتب سازی بر اساس سال ساخت </span> 
            <label for="rdo-1" class="btn-radio">
            <input  type="radio" id="rdo-1" value="desc" 
            {{isset($order) && $order == 'desc' ? 'checked' : ''}}
            onclick="javascript:window.location.href='{{route('S.ShowMore')}}?c={{$c}}&type={{$type}}&order=desc'">
                <svg width="20px" height="20px" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="9"></circle>
                    <path
                        d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                        class="inner"></path>
                    <path
                        d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                        class="outer"></path>
                </svg>
                <span>نزولی</span>
            </label>
            <label for="rdo-2" class="btn-radio">
                <input  type="radio" id="rdo-2" value="asc"
                {{isset($order) && $order == 'asc' ? 'checked' : ''}}
                onclick="javascript:window.location.href='{{route('S.ShowMore')}}?c={{$c}}&type={{$type}}&order=asc'">
                <svg width="20px" height="20px" viewBox="0 0 20 20">
                    <circle cx="10" cy="10" r="9"></circle>
                    <path
                        d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z"
                        class="inner"></path>
                    <path
                        d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z"
                        class="outer"></path>
                </svg>
                <span>صعودی</span>
            </label>
           
        </div>
    </div>
        
    @endif
    @if (count($posts))
    <section class="movie-sections">
        <h2>
            {{$title}}
        </h2>
        @isset($collection)
        <p class="text-white mb-5">{{$collection->description}}</p>
        @endisset
        <div class="row">
            @if (isset($q) && $q == 'collection')
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