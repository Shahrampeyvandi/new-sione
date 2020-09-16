@extends('Layout.Panel')

@section('content')
@include('Includes.Panel.modals')
@include('Includes.Panel.slidermenu')
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت اسلایدر ها</h5>
            <hr>
        </div>

     <table id="example1" class="table table-striped  table-bordered w-100">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>تصویر</th>
                    <th>نوع</th>
                   <th>مربوط به</th>

                    <th>عملیات</th>

                </tr>
            </thead>
            <tbody>
                @foreach($slideshows as $key=>$slideshow)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><img src="{{asset($slideshow->image)}}" style="width:200px;"></td>
                    <td><span class="text-primary">{{$slideshow->post->type == 'series' ? 'سریال' : 'سینمایی'}}</span></td>
                   <td><span class="text-primary">{{$slideshow->post->name . ' - ' . $slideshow->post->year }}</span></td>
                  
               
                   
                    <td>

                         <a href="{{route('Panel.EditSlider',$slideshow->id)}}" class="btn btn-sm btn-info">ویرایش</a>
                        <a href="#" data-id="{{$slideshow->id}}" title="حذف " data-toggle="modal" data-target="#deleteSlider"
                            class="btn btn-sm btn-danger   m-2">

                            <i class="fa fa-trash"></i>

                        </a>

                    </td>
                </tr>
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
    $('#slider-type').change(function(){
        if($(this).val() == "client slider"){
            $('.header_sec').show(200)
        }else{
            $('.header_sec').hide(200)
       
        }
    })

    $("#setting").validate({
		rules: {
            header:{
        required: function(element){
            return $("#slider-type").val() == "client slider";
        }
      },
		},
		messages: {
			header: "لطفا عنوان هدر اسلایدر را وارد نمایید",
		
		}
    });
    

    
         $('#deleteSlider').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#slider_id').val(recipient)

    })
</script>
@endsection