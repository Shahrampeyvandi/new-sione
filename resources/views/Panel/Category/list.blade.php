@extends('Layout.Panel')

@section('content')
@include('Includes.Panel.categoriesmenu')

@include('Includes.Panel.modals')


<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">لیست دسته بندی ها</h5>
            <hr>
        </div>
        <div style="overflow-x: auto;">
            <table id="example1" class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>ردیف</th>
                        <th> عنوان </th>
                        <th>تصویر</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $key=>$category)
                    <tr>

                        <td>{{$key+1}}</td>
                        <td>
                            <a href="#" class="text-primary">{{$category->name}}</a>
                        </td>


                        <td class="text-info">
                            @if ($category->image)
                            <img src="{{asset($category->image)}}" style="width:200px;">
                            @else
                            --
                            @endif
                        </td>

                        <td>
                            <a href="{{route('Panel.EditCat',$category)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                            <a href="#" data-id="{{$category->id}}" title="حذف " data-toggle="modal"
                                data-target="#deleteCategory" class="btn btn-sm btn-danger   m-2">

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
    $('table input[type="checkbox"]').change(function(){
            if( $(this).is(':checked')){
            $(this).parents('tr').css('background-color','#41f5e07d');
            }else{
                $(this).parents('tr').css('background-color','');

            }
            array=[]
            $('table input[type="checkbox"]').each(function(){
                if($(this).is(':checked')){
                array.push($(this).attr('data-id'))

               }
               if(array.length !== 0){
                $('.delete-edit').show()
                if (array.length !== 1) {
                    $('.container_icon').removeClass('justify-content-end')
                    $('.container_icon').addClass('justify-content-between')
                    $('.edit-personal').hide()
                }else{

                    $('.container_icon').removeClass('justify-content-end')
                    $('.container_icon').addClass('justify-content-between')
                    $('.edit-personal').show()
                    
                   
                }
            }
            else{
                $('.container_icon').removeClass('justify-content-between')
                $('.container_icon').addClass('justify-content-end')
                $('.delete-edit').hide()
            }
        })
            
    })
    
       
 $('#deleteCategory').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#category_id').val(recipient)

    })
</script>

@endsection