<!doctype html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">

    <title> sione | @yield('Title')</title>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#121212">
    <!-- <meta name="icon" content="/ms-icon-144x144.png"> -->
    <meta name="keywords" content="سینمایی,سریال,مستند,دوبله فارسی کامل,اشتراک ویژه,به زودی">
	<meta name="description" content="گروه هنری سیوان ارائه دهنده بروزترین فیلم و سریال و مستند های دنیا در جهت پیشرفت دید ایرانیان به سینمای جهان">
    <meta name="author" content="گروه هنری سیوان">
   <link rel="icon" href="{{asset('frontend/assets/images/fav-icon.png')}}" type="image/gif" sizes="16x16">
    
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/range-slider/css/ion.rangeSlider.min.css')}}" type="text/css">

    <link rel="stylesheet" href="{{asset('frontend/assets/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/index.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.css" rel="stylesheet">
    <style>
           .cntr {
	margin: auto;
}

.btn-radio {
	cursor: pointer;
	display: inline-block;

	-webkit-user-select: none;
	user-select: none;
}

.btn-radio:not(:first-child) {
	margin-left: 20px;
}

@media screen and (max-width: 480px) {
	.btn-radio {
		display: block;
		float: none;
	}

	.btn-radio:not(:first-child) {
		margin-left: 0;
		margin-top: 15px;
	}
}

.btn-radio svg {
	fill: none;
	vertical-align: middle;
}

.btn-radio svg circle {
	stroke-width: 2;
	stroke: #C8CCD4;
}

.btn-radio svg path {
	stroke: #008FFF;
}

.btn-radio svg path.inner {
	stroke-width: 6;
	stroke-dasharray: 19;
	stroke-dashoffset: 19;
}

.btn-radio svg path.outer {
	stroke-width: 2;
	stroke-dasharray: 57;
	stroke-dashoffset: 57;
}

.btn-radio input {
	display: none;
}

.btn-radio input:checked + svg path {
	transition: all .4s ease;
}

.btn-radio input:checked + svg path.inner {
	stroke-dashoffset: 38;
	transition-delay: .3s;
}

.btn-radio input:checked + svg path.outer {
	stroke-dashoffset: 0;
}

.btn-radio span {
	display: inline-block;
	vertical-align: middle;
}
        .show {
            display: block !important;
        }

        .hidden {
            display: none !important;
        }
    </style>

    @yield('css')
    <script>
        var mainUrl = "{{route('MainUrl')}}";
    </script>

</head>


<body @if (\Request::route()->getName() == "S.SiteSharing" || \Request::route()->getName() == "S.Account" ||
    \Request::route()->getName() == "S.OrderLists" || \Request::route()->getName() == "MovieRequest")
    class="site-sharing"
    @endif>




    @if(\Request::route()->getName() !== "login" && \Request::route()->getName() !== "forgetpass" &&
    \Request::route()->getName() !== "forgetpass.submitCode" && \Request::route()->getName() !==
    "forgetpass.submitNewPass"

    )
    @include('Includes.Front.Header')
    @endif

    @yield('content')

    @if(\Request::route()->getName() !== "login" && \Request::route()->getName() !== "S.SiteSharing" &&
    \Request::route()->getName() !== "S.OrderLists" && \Request::route()->getName() !== "forgetpass" &&
    \Request::route()->getName() !== "forgetpass.submitCode" && \Request::route()->getName() !==
    "forgetpass.submitNewPass"
    && \Request::route()->getName() !== "S.Account" && \Request::route()->getName() !== "MovieRequest"
    )
    @include('Includes.Front.Footer')
    @endif

    <script src="{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-validate/jquery.validate.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/swiper.js')}}"></script>
    <script src="{{asset('frontend/assets/js/all.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.js"></script>
  
    <script src="{{asset('frontend/assets/js/index.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <!-- begin::range slider -->
    <script src="{{asset('assets/vendors/range-slider/js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('assets/js/examples/range-slider.js')}}"></script>
    <!-- end::range slider -->
    @toastr_render
    @yield('js')
    <script>
         $("#search-box").on("click", function() {
        $(".search-panel").css("display", "block");
       
        $('#search-input').focus()
    });
        var el = document.querySelector('.user-login-show')
        var box = document.querySelector('.profile-dropdown-box')
        el.addEventListener('click',function(){
            if(box.classList.contains('hidden'))
            {
                box.classList.remove('hidden')
                box.classList.add('show')
            }else{
                 box.classList.remove('show')
                                box.classList.add('hidden')
            }
        })
  
        
    </script>

</body>

</html>