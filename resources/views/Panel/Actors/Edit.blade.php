@extends('Layout.Panel')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center"> ویرایش اطلاعات</h5>
                <hr />
            </div>
            <form id="edit-member" method="post" action="{{route('Panel.EditActor',$artist->id)}}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="{{$type}}">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for=""><span class="text-danger">*</span> نام </label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$artist->name ?? ''}}"
                            placeholder="نام ">
                    </div>

                </div>
                <div class="row">
            <div class="form-group col-md-6">
              <label for=""> نام فارسی</label>
              <input type="text" class="form-control" name="fa_name" id="name" value="{{$artist->fa_name ?? ''}}" placeholder="نام ">
            </div>

          </div>


                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="bio">بیوگرافی: </label>
                        <textarea class="form-control" name="bio" id="bio" cols="30"
                            rows="8">{!!$artist->bio!!}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for=""> تصویر: </label>
                            </div>
                            <div class="col-md-3">
                                <img alt="" id="preview" width="100%" style="max-height: 400px" src="@isset($artist)
                                             {{asset($artist->image)}} 
                                                @else
                                                 {{asset('assets/images/640x360.png')}} 
                                            @endisset">
                                <input type="file" name="poster" id="poster" />

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center my-3">
                    <button type="submit" class="btn btn-primary">
                        ویرایش

                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection