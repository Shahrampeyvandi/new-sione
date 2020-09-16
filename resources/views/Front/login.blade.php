@extends('Layout.Front')
@section('Title',$title)

@section('content')
<div class="row h-100">
    <div class="col-md-12">
        <section class="main_login_register" @if ($setting && isset($setting->login_background))
            style="background-image:url({{asset($setting->login_background)}});background-repeat: no-repeat;background-size: cover;"
            @else
            style="background-image:radial-gradient(at bottom, #1993ff, #121212 70%);"
            @endif
            >
            <div class="btn-loader-place">
                <h1>
                    <a href="{{route('MainUrl')}}">
                        <img class="site-logo" src="{{asset('assets/images/aa-300x157.png')}}" alt="site-logo">
                    </a>
                </h1>
                <button type="button" class="register-form-load btn--ripple">
                    ثبت نام
                </button>
                <button type="button" class="login-form-load btn--ripple">
                    ورود
                </button>
            </div>

            <form action="{{route('login')}}" method="post" id="loginForm" class="loginform">
                @csrf
                @if (count($errors))
                <h1>
                    {{ $errors->first() }}
                </h1>
                @endif
                <h3>
                    لطفا شماره تلفن خود و رمز عبور را وارد نمایید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        شماره تلفن همراه
                    </label>
                    <input type="tex" id="mobile" name="mobile" autocomplete="off" dir="rtl"
                        placeholder="+98**********">
                </div>
                <div class="input-place">
                    <label for="password">
                        رمز عبور
                    </label>
                    <input type="text" id="password" name="password" autocomplete="off" dir="rtl">
                </div>
                <button class="submit_login btn--ripple" type="submit">
                    ورود
                </button>
                <a class="forget-pass" href="#">
                    رمز عبور خود را فراموش کرده ام
                </a>
            </form>
            <form action="{{route('forgetpass')}}" method="post" id="loginForm" class=" forget-pas"
                style="display: none">
                @csrf
                @if (count($errors))
                <h1>
                    {{ $errors->first() }}
                </h1>
                @endif

                <h3>
                    لطفا شماره تلفن خود را وارد نمایید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        شماره تلفن همراه
                    </label>
                    <input type="tex" id="mobile" name="mobile" autocomplete="off" dir="rtl"
                        placeholder="+98**********">
                </div>
                <button class="submit_login btn--ripple" type="submit">
                    تایید
                </button>
            </form>
            <form action="{{route('S.Register')}}" method="post" id="registerForm">
                @csrf
                @if (count($errors))
                <h1>
                    {{ $errors->first() }}
                </h1>
                @endif
                <h1 class="text-center m-0">
                    ثبت نام
                </h1>
                <div class="input-place">
                    <label for="Mobile-register">
                        شماره تلفن همراه
                    </label>
                    <input type="text" id="Mobile-register" name="mobile" autocomplete="off"
                        placeholder="+98**********">
                </div>
                <div class="input-place">
                    <label for="fName">
                        نام
                    </label>
                    <input type="text" id="fName" name="fname" autocomplete="off" placeholder="نام">
                </div>
                <div class="input-place">
                    <label for="lName">
                        نام خانوادگی
                    </label>
                    <input type="text" id="lName" name="lname" autocomplete="off" placeholder="نام خانوادگی">
                </div>
                <div class="input-place">
                    <label for="password">
                        رمز عبور
                    </label>
                    <input type="text" id="mainpassword" name="password" autocomplete="off" placeholder="رمز عبور">
                </div>
                <div class="input-place">
                    <label for="cpassword">
                        تایید پسورد
                    </label>
                    <input type="text" id="cpassword" name="cpassword" autocomplete="off" placeholder="تایید پسورد">
                </div>
                <button class="submit_register btn--ripple" type="submit">
                    ثبت نام
                </button>
            </form>
        </section>
    </div>
</div>
@endsection