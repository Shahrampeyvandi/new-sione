@extends('Layout.Panel')

@section('content')
<div class="card">
    <div class=" card-body ">
        <ul class="nav nav-pills ">
            <li class="nav-item">
                <a href="{{route('Panel.CollectionList')}}" class="nav-link 
            @if(\Request::route()->getName() == "Panel.CollectionList") {{'active'}} @endif">لیست</a>
            </li>
            <li class="nav-item">
                <a href="{{route('Panel.AddCollection')}}" class="nav-link
            @if(\Request::route()->getName() == "Panel.AddCollection") {{'active'}} @endif">جدید <i class="fas fa-plus"></i></a>
            </li>
        </ul>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">
                    @isset($collection)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                    کالکشن</h5>
                <hr />
            </div>
            <form id="add-plan" method="post" @isset($collection) action="{{route('Panel.EditCollection',$collection)}}" @else
                action="{{route('Panel.AddCollection')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="نام "
                                    @isset($collection) value="{{$collection->name}}" @endisset>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">مربوط به:</label>
                                <select class="custom-select" name="for" id="for">
                                    <option value="movies" {{isset($collection) && $collection->for == 'movies' ? 'selected' : ''}}>movie</option>
                                    <option value="series" {{isset($collection) && $collection->for == 'series' ? 'selected' : ''}}>serie</option>
                                    <option value="documentary {{isset($collection) && $collection->for == 'documentary' ? 'selected' : ''}}">documentary</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-row col-6">
                            <div class="col-md-3">
                                <label for=""> پوستر : </label>
                            </div>
                            <div class="col-md-9">
                                <img alt="" id="preview" width="100%" style="max-height: 400px" src="@if(isset($collection) && $collection->poster)
                                             {{asset($collection->poster)}} 
                                                @else
                                                 {{asset('assets/images/300x200.png')}} 
                                            @endif">
                                <input type="file" name="poster" id="poster" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : </label>
                            <textarea class="form-control" name="desc" id="desc" cols="30" rows="8">{{$collection->description ?? ''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            @isset($collection)
                            ویرایش
                            @else
                            ثبت
                            @endisset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection