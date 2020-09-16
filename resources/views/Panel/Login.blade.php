<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ورود</title>
    <link rel="stylesheet" href="{{asset('assets/vendors/bundle.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" type="text/css">
    <link rel="shortcut icon" href="{{asset('assets/media/image/favicon.png')}}">
    <meta name="theme-color" content="#3f51b5" />
</head>

<body class="icon-side-menu pt-0">

    <!-- begin::page loader-->
    <div class="page-loader">
        <div class="spinner-border"></div>
        <span>در حال بارگذاری ...</span>
    </div>
    <!-- end::page loader -->

    <!-- begin::main content -->
    <main class="main-content">
        <div class="container h-100-vh">
            <div class="row align-items-center h-100-vh">

                <div class="col-md-4 offset-lg-4 p-t-b-25">
                    <div class="d-flex align-items-center m-b-20">
                    <img src="{{asset('assets/media/image/dark-logo.png')}}" class="m-l-15" width="40" alt="">
                        <h3 class="m-0">مدیریت </h3>
                    </div>
                    @include('Includes.Panel.errors')
                <form id="loginForm" action="{{route('Admin.Login')}}" method="POST">
                    @csrf
                        <div class="form-group mb-4">
                            <input type="number" name="mobile" class="form-control form-control-lg" id="exampleInputEmail1" autofocus
                                placeholder="شماره تلفن">
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1"
                                placeholder="رمز عبور">
                        </div>
                        <button class="btn btn-primary btn-lg btn-block btn-uppercase mb-4">ورود</button>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="rememberme" id="customCheck">
                                <label class="custom-control-label" for="customCheck">به خاطر سپاری</label>
                            </div>
                            {{-- <a href="#" class="auth-link text-black">فراموشی رمز عبور؟</a> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="{{asset('assets/vendors/bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
</body>

</html>