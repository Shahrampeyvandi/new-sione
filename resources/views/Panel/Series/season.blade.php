@extends('Layout.Panel')

@section('content')


<div class="modal fade" id="delete-season" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                در صورت حذف فصل تمام قسمت های آن حذف خواهد شد!!
            </div>
            <div class="modal-footer">
                <form action="{{route('Panel.DeleteSeason')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="season_id" id="season_id" value="">
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
                    @isset($season)
                    ویرایش
                    @else
                    افزودن
                    @endisset
                    فصل</h5>
                <hr />
            </div>
            <form id="upload-file" method="post" @isset($season) action="{{route('Panel.EditSeason',$season)}}" @else
                action="{{route('Panel.AddSeason',$id)}}" @endisset enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">عنوان : </label>
                                <input type="text" class="form-control" name="title" id="title"
                                    value="{{$season->name ?? ''}}">
                            </div>
                        </div>
                        @if (!isset($season))
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">شماره فصل: </label>
                                @if (!is_null($totalSeasons))
                                <select name="number" id="number" class="form-control">

                                    @for ($i = 1; $i <= $totalSeasons; $i++) <option value="{{$i}}">فصل {{$i}}</option>
                                        @endfor
                                </select>
                                @else
                                <input type="text" class="form-control" name="number" id="number"
                                    value="{{$season->number ?? ''}}">
                                @endif
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">تاریخ پخش: </label>
                                <input type="text" class="form-control datepicker" name="release" id="release"
                                    @isset($season)
                                    value="{{\Carbon\Carbon::parse($season->publish_date)->format('d F Y')}}" @endisset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">توضیحات : </label>
                                <textarea class="form-control" name="desc" id="desc" cols="30"
                                    rows="8">{{$season->description ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">

                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> پوستر فصل: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px"
                                            @if(isset($season) && $season->poster)
                                        src="{{asset($season->poster)}}" @else
                                        src="{{asset('assets/images/640x360.png')}}" @endif>
                                        <input type="file" name="poster" id="poster" />

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <table id="example1" class="table table-striped table-bordered w-100">
                            <thead>
                                <tr>
                                    <th>ردیف</th>
                                    <th style="max-width: 100px;"> نام </th>
                                    <th> شماره </th>
                                    <th>نام سریال</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seasons as $key=>$season)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <a href="#" class="text-primary">{{$season->name}}</a>
                                    </td>
                                    <td>
                                        {{$season->number}}
                                    </td>
                                    <td>
                                        {{$season->serie->title}}
                                    </td>
                                    <td style="text-align: center">
                                        <a href="{{route('Panel.EditSeason',$season)}}" title="ویرایش"
                                            class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                        <a href="{{route('Panel.AddSection',$season->serie->id)}}?season={{$season->id}}"
                                            title="قسمت ها" class="btn btn-sm btn-primary"> <i
                                                class="fas fa-plus"></i></a>
                                        <a href="#" data-id="{{$season->id}}" data-toggle="modal" title="حذف"
                                            data-target="#delete-season" class="btn btn-danger btn-sm"><i
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
        
               
   
  $('#delete-season').on('shown.bs.modal', function (event) {
var button = $(event.relatedTarget)
  var recipient = button.data('id')
  $('#season_id').val(recipient)

    })

 
              

           
</script>
@endsection