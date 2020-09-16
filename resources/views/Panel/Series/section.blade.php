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
                برای حذف قسمت مطمئن هستید؟
            </div>
            <div class="modal-footer">
                <form action="{{route('Panel.DeleteSection')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="section_id" id="section_id" value="">
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
                <h5 class="text-center">
                    @isset($section)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                    قسمت</h5>
                <hr />

            </div>
            <form id="upload-section" method="post" @isset($section) action="{{route('Panel.EditSection',$section)}}"
        @else action="{{route('Panel.AddSection',$serie->id)}}" @endisset enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="{{$serie->type ?? ''}}">

          <input type="hidden" name="serie" value="{{$serie->id ?? ''}}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""> قسمت: </label>
                                @isset($episodes)
                                @if (count($episodes))
                                <input type="hidden" name="season" value="{{$season->id ?? ''}}">
                                <select name="number" id="number" class="form-control"
                                    onchange="showSectionData(event,'{{$serie->id}}','{{$season->number}}')">
                                    <option value="">باز کردن فهرست انتخاب
                                    </option>
                                    @foreach ($episodes as $item)
                                    <option value="{{$item->Episode}}">قسمت {{$item->Episode}} - {{$item->Title}}
                                    </option>
                                    @endforeach
                                </select>
                                @else
                                <input type="number" class="form-control" name="number" id="number" value="">
                                @endif
                                @endisset
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">عنوان : </label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{$section->name ?? ''}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">تاریخ پخش: </label>
                                <input type="text" class="form-control datepicker" name="release" id="release"
                                    @isset($section)
                                    value="{{\Carbon\Carbon::parse($section->publish_date)->format('d F Y')}}"
                                    @endisset />
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : </label>
                                <textarea class="form-control" name="desc" id="desc" cols="30"
                                    rows="8">{{$section->description ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                @isset($section)
                                <img src="{{$section->poster}}" alt="">
                                @endisset
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر قسمت: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px"
                                            @if(isset($section) && $section->poster)
                                        src="{{asset($section->poster)}}" @else
                                        src="{{asset('assets/images/640x360.png')}}" @endif>
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="imdbID" id="imdbID">
                        <input type="hidden" name="runtime" id="runtime">
                        <input type="hidden" name="imdbRating" id="imdbRating">
                        <input type="hidden" name="posterImdb" id="posterImdb">
                        @isset($id)
                        <input type="hidden" name="serie" id="serie" value="{{$id}}">
                        @endisset
                        @isset($section)
                        @include('Includes.Panel.Video' ,['post'=>$section])
                        @else
                        @include('Includes.Panel.Video')
                        @endisset
                    </div>
                    <div class="col-md-6">
                        <table id="example1" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>

                                    <th>ردیف</th>
                                    <th style="max-width: 100px"> عنوان </th>
                                    <th> فصل </th>
                                    <th style="max-width: 70px">نام سریال</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sections as $key=>$section)

                                <tr>

                                    <td>{{$key+1}}</td>
                                    <td>
                                        {{$section->name}}
                                    </td>
                                    <td>
                                        <a href="#"
                                            class="text-primary">{{!is_null($section->seasonobj) ? $section->seasonobj->number : '-'}}</a>
                                    </td>
                                    <td>
                                        {{!is_null($section->serie) ? $section->serie->name : ''}}

                                    </td>
                                    <td>
                                        <a href="{{route('Panel.EditSection',$section)}}" title="ویرایش"
                                            class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="#" data-id="{{$section->id}}" data-toggle="modal" title="حذف"
                                            data-target="#deletemodal" class="btn btn-danger btn-sm"><i
                                                class="fas fa-trash"></i></a>



                                    </td>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"> ذخیره
                        </button>
                    </div>
                </div>
        </div>
    </div>
    </form>
</div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('js')
<script src="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendors/ckeditor/ckeditor.js')}}"></script>
<script>
    $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true
            });

    CKEDITOR.replace('desc',{
            contentsLangDirection: 'rtl',
            filebrowserUploadUrl: '{{route('UploadImage')}}?type=file',
            imageUploadUrl: '{{route('UploadImage')}}?type=image',
        });
        
               
   

// $(document).on('change','#serie',function(){
//  var thiss = $(this)
// var data = $(this).val();
//  data = { data:data,_token: "{{ csrf_token() }}" };
//             url='{{route('Panel.Ajax.Series')}}';
//             request = $.post(url, data);
//             request.done(function(res){
//               const Options = res.map(item => {
//                     return  `<option value="${item.id}">${item.name}</option>`
//                 });
//                 stringOptions = Options.join('');
//                 $('#season').html(stringOptions)
//         });
   
//  })

  $('#deletemodal').on('shown.bs.modal', function (event) {
var button = $(event.relatedTarget)
  var recipient = button.data('id')
  $('#section_id').val(recipient)
    })

function showSectionData(event,serieId,seasonNumber) {
    data = { episode:$(event.target).val(),serieId:serieId,seasonNumber:seasonNumber,_token: "{{ csrf_token() }}" };
            url='{{route('Panel.getSectionImdbData')}}';
            request = $.post(url, data);
            request.done(function(res){
            // location.reload()
            // console.log(res.released)
            $('#title').val(res.title)
             CKEDITOR.instances['desc'].setData(res.desc)
            $('#preview').attr('src',res.poster)
             $('#posterImdb').val(res.poster)
             $('#release').val(res.released)
        //    $( "#release" ).datepicker("setDate", $.datepicker.parseDate( "yy-mm-dd", "2017-11-16" ));
             $('#imdbID').val(res.imdbID)
             $('#runtime').val(res.runtime)
             $('#imdbRating').val(res.imdbRating)

        });
}
function deleteVideo(event , videoId) {
    event.preventDefault()
    
    var el = $(event.target);
     data = { id:videoId,_method:'delete',_token: "{{ csrf_token() }}" };
            url="{{route('Panel.DeleteVideo')}}";
            request = $.post(url, data);
            request.done(function(res){
                if($('.upload-season-file').length == 1) {
                    el.parent('.upload-season-file').find('#video-url').val('')
                    el.parent('.upload-season-file').find('#video-url').val('')

                }else{

                    el.parent('.upload-season-file').remove()
                    el.parent().next('.clone').remove()
                }

        });
}

           
</script>
@endsection