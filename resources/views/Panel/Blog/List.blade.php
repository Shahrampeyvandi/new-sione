@extends('Layout.Panel')

@section('content')

<div class="modal fade" id="deleteBlog" tabindex="-1" role="dialog" aria-labelledby="deleteBlogLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBlogLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                آیا برای حذف اطمینان دارید؟
            </div>
            <div class="modal-footer">
            <form action="{{route('Panel.DeleteBlog')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="blog_id" id="blog_id" value="">
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
            <h5 class="text-center">مدیریت وبلاگ ها</h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th></th>
                    <th>ردیف</th>
                    <th> عنوان </th>
                    <th>دسته بندی </th>
                    <th>امتیاز</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($blogs as $key=>$blog)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox custom-control-inline" style="margin-left: -1rem;">
                            <input data-id="{{$blog->id}}" type="checkbox" id="blog_{{ $key}}"
                                name="customCheckboxInline1" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="blog_{{$key}}"></label>
                        </div>
                    </td>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$blog->title}}</a>
                    </td>
               

                    <td>
                       
                        {{$blog->category->name}}
                      
                    </td>
                    <td>
                        6.1 از 10
                    </td>
                    <td>
                         <a href="{{route('Panel.EditBlog',$blog)}}" class="btn btn-sm btn-info"><i
                                    class="fa fa-edit"></i></a>
                            <a href="#" data-id="{{$blog->id}}" title="حذف " data-toggle="modal"
                                data-target="#deleteBlog" class="btn btn-sm btn-danger   m-2">
                                <i class="fa fa-trash"></i>
                            </a>
                     
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
            $('#deleteBlog').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#blog_id').val(recipient)

    })
    </script>

@endsection