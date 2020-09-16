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
                <h5 class="text-center">افزودن قسمت جدید </h5>
                <hr />
            </div>
         

            @if (isset($episodes) && count($episodes))
            <div style="overflow-x: auto;">
                <table id="example1" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                             <th> عنوان </th>
                            <th> فصل </th>
                            <th> قسمت </th>
                            <th>ویدیوها</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($episodes as $key=>$episode)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                <a href="" class="text-primary">{{$episode->name}}</a>
                            </td>
                            <td>
                                <a href="#" class="text-primary">{{$episode->season}}</a>
                            </td>
                            <td>
                                <a href="" class="text-primary">{{$episode->section}}</a>
                            </td>
                            <td>
                            <a href="{{route('Panel.UploadVideo')}}?id={{$id}}&episode={{$episode->id}}" class="btn btn-success btn-sm px-2"> <i class="fas fa-video"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <form class="add-video" action="{{route('Panel.UploadEpisode')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="post" value="{{$id}}">
                
                <div class="files-wrapper">

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <h6 class="">عنوان قسمت </h6>
                            <input type="text" required class="form-control mb-2" name="name" id="name" placeholder="">
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <h6 class="">فصل</h6>
                            <input type="number" required class="form-control mb-2" name="season" id="season"
                                placeholder="شماره فصل">
                        </div>
                        <div class="col-md-4">
                            <h6 class="">قسمت</h6>
                            <input type="number" required class="form-control mb-2" name="section" id="section"
                                placeholder="شماره قسمت">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">توضیحات</label>
                            <textarea type="text" class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for=""> تصویر قسمت: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="thumb" class="dropify" data-default-file="" />
                            </div>
                        </div>
                      
                    </div>
                      <div class="row">
                             <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">  ادامه  &nbsp;<i class="fas fa-arrow-circle-left"></i> </button>
                    </div>
                        </div>

                </div>

            </form>
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
   
</script>
@endsection