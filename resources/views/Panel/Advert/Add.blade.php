@extends('Layout.Panel')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">افزودن </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" @isset($advert) action="{{route('Panel.EditAdvert',$advert)}}" @else
                action="{{route('Panel.AddAdvert')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <h6 class=""> <span class="text-danger"> *</span> موضوع: </h6>
                                <input required type="text" class="form-control" name="title" id="title"
                                    value="{{$advert->title ?? ''}}">
                            </div>
                        </div>
                       

                        <div class="row mt-3">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> <span class="text-danger"> *</span> پوستر:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="@isset($advert)
                                             {{asset($advert->poster)}} 
                                                @else
                                                 {{asset('assets/images/400x200.png')}} 
                                            @endisset">
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>
                       


                        

                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            @isset($advert)
                            ویرایش
                            @else
                            ثبت
                            @endisset
                            اطلاعات </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/vendors/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('desc',{
            contentsLangDirection: 'rtl',
            filebrowserUploadUrl: '{{route('UploadImage')}}?type=file',
            imageUploadUrl: '{{route('UploadImage')}}?type=image',
        });


</script>
@endsection