@extends('Layout.Panel')

@section('content')



<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت فایل ها</h5>
            <hr>
        </div>
      <div class="row">
        <div class="col-md-8">
            <div>
                <span>نام: </span><span>{{$post->name}}</span>
            </div>
            <div>
                <span>دسته بندی ها: </span><span>سیشی</span>
            </div>
            <div>
                <span>نام: </span><span>سیشی</span>
            </div>
            <div>
                <span>نام: </span><span>سیشی</span>
            </div>

        </div>
        <div class="col-md-4">
        <img src="{{$post->poster}}" alt="">
        </div>

      </div>
        <div style="text-align: center">
        </div>
    </div>
</div>

    @endsection
    @section('css')

    @endsection

    @section('js')


    @endsection