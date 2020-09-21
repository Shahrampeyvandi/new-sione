@extends('Layout.Panel')

@section('content')
@component('components.modal',['name'=>'collection'])
@endcomponent

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

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">لیست مجموعه ها</h5>
            <hr>
        </div>
        <div style="overflow-x: auto;">
            <table id="example1" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th> عنوان </th>
                        <th>تصویر</th>
                        <th>نوع</th>
                        <th>
                            محتوا
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $key=>$collection)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <a href="#" class="text-primary">{{$collection->name}}</a>
                        </td>
                        <td class="text-info">
                            @if ($collection->poster)
                            <img src="{{asset($collection->poster)}}" style="width:200px;">
                            @else
                            --
                            @endif
                        </td>
                        <td>
                            @if ($collection->for == 'movies')
                            <span>فیلم</span>
                                
                            @elseif($collection->for == 'series')
                            <span>سریال</span>
                            @else
                            <span>مستند</span>
                            @endif
                        </td>
                          <td>
                            @foreach ($collection->posts as $post)
                             <a href="#">{{str_limit($post->title,20,'..')}}</a> <br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{route('Panel.EditCollection',$collection)}}" class="btn btn-sm btn-info"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#" data-id="{{$collection->id}}" title="حذف " data-toggle="modal"
                                data-target="#deletecollection" class="btn btn-sm btn-danger   m-2">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align: center">
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
    $('#deletecollection').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#collection_id').val(recipient)

    })
</script>

@endsection