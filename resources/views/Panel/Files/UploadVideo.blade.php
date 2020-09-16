@extends('Layout.Panel')

@section('content')
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                برای حذف ویدئو مطمئن هستید؟
            </div>
            <div class="modal-footer">
                <form action="{{route('Panel.DeleteVideo')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="video_id" id="video_id" value="">
                    <button type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">افزودن ویدیو</h5>
                <hr />
            </div>
            @if (isset($videos) && count($videos))
            <div style="overflow-x: auto;" class="mb-3">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th> url </th>
                            <th>کیفیت</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $key=>$video)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <a href="{{$video->url}}" class="text-primary">{{$video->url}}</a>
                            </td>
                            <td>
                                {{$video->quality->quality}}
                            </td>
                            <td>
                                <a href="#" data-id="{{$video->id}}" data-toggle="modal" data-target="#deletemodal"
                                    class="btn btn-danger btn-sm">حذف</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <form class="add-video" action="{{route('Panel.UploadVideo')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post" value="{{$id}}">
                @if (isset($episode_id) && $episode_id !== null)
                <input type="hidden" name="episode" value="{{$episode_id}}">
                @endif
                <div class="files-wrapper">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for=""> فایل: </label>
                                </div>
                                <div class="col-md-9">
                                    <input required type="file" name="file" id="file" class="dropify"
                                        data-default-file="" data-allowed-file-extensions="mp4" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            @foreach (\App\Quality::all() as $key => $item)
                            <div class="custom-control custom-radio custom-control">
                                <input type="radio" id="{{$key+1}}" name="quality" value="{{$item->quality}}"
                                    class="custom-control-input" {{$key == 0 ? 'checked' : ''}}>
                                <label class="custom-control-label" for="{{$key+1}}">{{$item->quality}}</label>
                            </div>
                            @endforeach
                            <div class="wraper">
                                @foreach (\App\Quality::all() as $quality)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="language" name="language" value="{{$quality->id}}"
                                        {{isset($post) && $post->languages()->pluck('id')->contains($quality->id) ? 'checked' : ''}}
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="language">
                                        {{$quality->name}}</label>
                                </div>
                                @endforeach
                            </div>
                            <input type="number" class="form-control" placeholder="کیفیت جدید">
                            <a href="#" onclick="addQuality(event)" class="d-block btn btn-sm btn-success mt-2"><i
                                    class="fas fa-plus-circle"></i></a>
                        </div>
                        <div
                            class="form-group {{!is_null($post) && $post->type == "series" ? " col-md-12" : "col-md-12"}}">
                            <button class="btn btn-sm btn-success text-white" type="submit"> آپلود &nbsp; <i
                                    class="fas fa-upload"></i></button>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0"
                                    aria-valuemax="100" style="width: 0%">
                                    0%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            {{-- <a href="#" class="btn btn-sm btn-info text-white mb-5" onclick="addFile(event,this)">اضافه
                    کردن فایل دیگر</a> --}}
        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('js')
<script>
    $('#deletemodal').on('shown.bs.modal', function (event) {
var button = $(event.relatedTarget)
  var recipient = button.data('id')
  $('#video_id').val(recipient)

    })


   
    $("form").ajaxForm({
        beforeSerialize: function ($Form, options) {},
        beforeSend: function () {},
        uploadProgress: function (event, position, total, percentComplete) {
            $(".progress-bar").text(percentComplete + "%");
            $(".progress-bar").css("width", percentComplete + "%");
        },
        success: function (data) {
      
        },
        error: function (data) {},
    });

    function deleteVideo(id) { 
        
    }
</script>
@endsection