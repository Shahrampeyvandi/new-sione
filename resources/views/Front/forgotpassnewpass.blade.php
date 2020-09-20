@extends('Layout.Front')
@section('Title', $title)

@section('content')
<div class="row">
    <div class="col-md-12">
         <section class="main_login_register" @if ($setting && isset($setting->login_background))
            style="background-image:-webkit-gradient(linear, left top, left bottom, from(#ffffff00), to(black)),url({{asset($setting->login_background)}});background-repeat: no-repeat;background-size: cover;"
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
                
            </div>


            <form action="{{route('forgetpass.submitNewPass')}}" method="post" id="loginForm"
                class="loginform ">
                @csrf
                @if (count($errors))
                <h1>
                    {{ $errors->first() }}
                </h1>
                @endif

                <h3>
                    لطفا رمز عبور جدید خود را وارد نمایید
                </h3>
                <div class="input-place">

                    <input type="hidden" id="mobile" name="mobile" value="{{$mobile}}">
                    <input type="hidden" id="mobile" name="code" value="{{$code}}">


                </div>

                <div class="input-place">
                    <label for="password">
                        رمز عبور
                    </label>
                    <input type="text" id="mainpassword" name="password" autocomplete="off">
                </div>
                <div class="input-place">
                    <label for="cpassword">
                        تایید رمز عبور
                    </label>
                    <input type="text" id="cpassword" name="cpassword" autocomplete="off">
                </div>


                <button class="submit_login btn--ripple" type="submit">
                    تایید
                </button>


            </form>

        </section>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/vendors/bundle.js')}}"></script>
<script src="{{asset('assets/vendors/jquery-validate/jquery.validate.js')}}"></script>
<script>
    $(function() {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                return this.optional(element) || regexp.test(value);
            },
            "Please check your input."
        );
        $(".loginform").validate({
            rules: {
               password: {
             required: true,
             minlength: 8,
             regex: /^[a-zA-Z\d]*$/,
         },
          cpassword: {
             required: true,
             minlength: 8,
             equalTo:'#mainpassword',
         }
            },
            messages: {
                  password: {
             required: "لطفا رمز عبور خود را وارد نمایید",
             minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
             regex: "پسورد بایستی شامل اعداد و حروف لاتین باشد",
         },
          cpassword: {
             required: "لطفا رمز عبور خود را وارد نمایید",
             minlength: "رمز عبور بایستی حداقل 8 کاراکتر باشد",
             equalTo:'رمز عبور یکسان نیست',
         },
            },
        });


    })
</script>
@endsection