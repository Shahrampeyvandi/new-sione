<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/index.css')}}">
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/swiper.min.js')}}"></script>
    <script src="{{asset('assets/js/all.min.js')}}"></script>
    <script src="{{asset('assets/js/index.js')}}"></script>
     <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title','sione | blog')</title>
</head>

<body>
    @include('Includes.Blog.Header')

    @yield('content')

    @include('Includes.Blog.Footer')
</body>

</html>