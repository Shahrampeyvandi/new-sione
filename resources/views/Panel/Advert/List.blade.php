@extends('Layout.Panel')

@section('content')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                موارد علامت زده شده حذف شوند؟
            </div>
            <div class="modal-footer">
            <form action="{{route('Panel.DeleteAdvert')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" id="id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="container_icon card-body d-flex justify-content-end">
        <div class="delete-edit" style="display:none;">
            <a href="#" title="حذف " data-toggle="modal" data-target="#exampleModal" class="order-delete   m-2">
                <span class="__icon bg-danger">
                    <i class="fa fa-trash"></i>
                </span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت تبلیغات</h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                   
                    <th>ردیف</th>
                    <th> موضوع </th>

                    <th>تصویر</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($adverts as $key=>$advert)
                <tr>

                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$advert->title}}</a>
                    </td>


                    <td>
                        <img width="150px" src="{{asset($advert->poster)}}" alt="">


                    </td>

                    <td>
                        <a href="{{route('Panel.EditAdvert',$advert)}}" class="btn btn-sm btn-info"><i
                                class="fa fa-edit"></i></a>
                        <a href="#" data-id="{{$advert->id}}" data-toggle="modal" title="حذف" data-target="#deleteModal"
                            class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                    </td>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('css')

@endsection

@section('js')
<script>
 
  $('#deleteModal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#id').val(recipient)

    })
</script>

@endsection