@extends('Layout.Front')
@section('Title','دسته بندی ها')

@section('content')
<section class="category">
    <div class="container-fluid">
        <div class="row">
            @foreach ($categories as $category)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="category-box">
                <a href="{{$category->path()}}">
                        <img src="{{asset($category->getImage())}}" alt="">
                        <h3>
                            {{$category->name}}
                        </h3>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection