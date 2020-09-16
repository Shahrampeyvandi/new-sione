@extends('Layout.Panel')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">
                    
                    @isset($slideshow)
ویرایش
                     @else   
افزودن
                    @endisset
                 
                  
                     
                
                
                </h5>
                <hr />
            </div>
            <form @if (!isset($slideshow))
                id="add-slider"
            @endif   method="post" @isset($slideshow) action="{{route('Panel.EditSlider',$slideshow)}}" @else
                action="{{route('Panel.AddSlider')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">محتوای مرتبط :  </label>
                                <select class="js-example-basic-single" name="post" id="post" required>
                                   @foreach ($posts as $post)
                                     <option value="{{$post->id}}"
                                    @isset($slideshow)
                                        {{$slideshow->post->id == $post->id ? 'selected' : ''}}
                                    @endisset
                                    
                                    
                                    >{{$post->name . ' - ' . $post->year . ' - ( ' . $post->type . ' )'}}</option>

                                   @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="@isset($slideshow)
                                             {{asset($slideshow->image)}} 
                                                @else
                                                 {{asset('assets/images/640x360.png')}} 
                                            @endisset">
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    @isset($slideshow)
                                    ویرایش
                                    @else
                                    ثبت
                                    @endisset
                                    اطلاعات </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
