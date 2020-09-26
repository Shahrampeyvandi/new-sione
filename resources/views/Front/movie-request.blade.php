@extends('Layout.Front')
@section('Title',$title)

@section('content')
<div class="container">
 
  <div class="movie-req">
    <form action="{{route('MovieRequest')}}" method="post">
      @csrf
      @if (count($errors))
      <h1>
        {{ $errors->first() }}
      </h1>
      @endif
      <div class="i">
        <label for="name" class="mb-2">
          لطفا نام فیلم یا سریال را وارد نمایید
        </label>
        <input type="text" id="name" name="name" class="form-control mb-3" autocomplete="off" dir="rtl">
      </div>
      <button class="submit_login btn--ripple" type="submit">
        تایید
      </button>
    </form>
  </div>


</div>
@endsection