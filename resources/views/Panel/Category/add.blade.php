@extends('Layout.Panel')

@section('content')
@include('Includes.Panel.categoriesmenu')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">
                    @isset($category)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                    دسته بندی </h5>
                <hr />
            </div>
            <form id="add-plan" method="post" @isset($category) action="{{route('Panel.EditCat',$category)}}" @else
                action="{{route('Panel.AddCat')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="name" id="name" 
                                    placeholder="نام "
                                    @isset($category)
                                     value="{{$category->name}}"
                                    @endisset
                                    >
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" class="form-control" name="latin" id="latin" 
                                    placeholder="نام لاتین"
                                    
                                     @isset($category)
                                     value="{{$category->latin}}"
                                    @endisset>
                            </div>
                        </div>
                        <div class="form-row col-6">
                            <div class="col-md-3">
                                <label for=""> پوستر : </label>
                            </div>
                            <div class="col-md-9">
                                <img alt="" id="preview" width="100%" style="max-height: 400px" src="@if(isset($category) && $category->image)
                                             {{asset($category->image)}} 
                                                @else
                                                 {{asset('assets/images/300x200.png')}} 
                                            @endif">
                                <input type="file" name="poster" id="poster" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            @isset($category)
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
@section('css')
<style>
    label.error {
        font-size: 12px;
        color: red;
        /* position: absolute; */
        /* top: -50px; */
        /* right: 70px; */
        margin-left: 50px;
    }
</style>
@endsection