@extends('Layout.Front')
@section('Title', $title)

@section('content')
<div class="row h-100">
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

       
            <form action="{{route('forgetpass.submitCode')}}" method="post" id="loginForm" class="loginform">
                @csrf
                @if (count($errors))
                <h1>
                    {{ $errors->first() }}
                </h1>
                @endif
                <input type="hidden" id="mobile" name="mobile" value="{{$mobile}}">

                <h3>
                    کد فعال سازی برای شماره {{$mobile}} ارسال گردید
                </h3>
                <div class="input-place">
                    <label for="Mobile">
                        کد فعال سازی
                    </label>
                    <input type="text" id="mobile" name="code" autocomplete="off" dir="rtl" placeholder="12345">
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

@endsection