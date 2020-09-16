@extends('Layout.Panel')

@section('content')
<!-- modals -->


<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form id="edit-member" method="post" action="{{route('Panel.AddActor')}}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-body">

          <div class="row">
            <div class="form-group col-md-6">
              <label for=""><span class="text-danger">*</span> نقش </label>

              <select name="type" id="type" class="custom-select form-control">
                <option value="actor">actor</option>
                <option value="director">director</option>
                <option value="writer">writer</option>
              </select>
            </div>

          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for=""><span class="text-danger">*</span> نام </label>
              <input type="text" class="form-control" name="name" id="name" value="" placeholder="نام ">
            </div>

          </div>


          <div class="row">
            <div class="form-group col-md-12">
              <label for="bio">بیوگرافی: </label>
              <textarea class="form-control" name="bio" id="bio" cols="30" rows="8"></textarea>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-12">
              <div class="form-row">
                <div class="col-md-3">
                  <label for=""> تصویر: </label>
                </div>
                <div class="col-md-3">

                  <input type="file" name="poster" id="poster" />

                </div>
              </div>
            </div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class=" btn btn-success text-white">ثبت</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        موارد علامت زده شده حذف شوند؟
      </div>
      <div class="modal-footer">
        <form action="" method="post">
          @csrf
          @method('delete')
          <input type="hidden" name="video_id" id="video_id" value="">
          <a href="#" class="deleteposts btn btn-danger text-white">حذف! </a>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content edit-modal-user"></div>
  </div>
</div>

<!-- end modals -->

<div class="container-fluid">
  <div class="card">
    <div class="container_icon card-body d-flex justify-content-end">
      <div class="delete-edit" style="display:none;">
        <a href="#" title="حذف " data-toggle="modal" data-target="#exampleModal" class="order-delete   m-2">
          <span class="__icon bg-danger">
            <i class="fa fa-trash"></i>
          </span>
        </a>
      </div>
      <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-user">افزودن <i
          class="fas fa-plus"></i></a>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="card-title">
        <h5 class="text-center">مدیریت کاربران</h5>
        <hr />
      </div>
      <div style="overflow-x: auto;">
        <table id="example1" class="table table-striped table-bordered">
          <thead>
            <tr>

              <th>ردیف</th>
              <th>
                نام
              </th>
              <th>
                نقش
              </th>

              <th>بیوگرافی</th>
              <th style="width: 100px">تصویر</th>
              <th></th>
            </tr>
          </thead>
          <tbody class="tbody">
            @foreach ($users as $key=>$user)
            <tr>

              <td>{{$key+1}}</td>
              <td>{{$user->name}}</td>
              <td>@if ($user instanceof \App\Actor)
                بازیگر
                @elseif($user instanceof \App\Director)
                کارگردان
                @else
                نویسنده
                @endif</td>

              <td>{{str_limit($user->bio,50,' ... ')}}</td>
              <td>
                @if (isset($user->image)) <img width="75px" class="img-fluid " src="
                      {{asset($user->image)}} " />
                @else <img width="75px" class="img-fluid " src="
                      {{asset("assets/images/avatar.png")}} " /> @endif
              </td>
              <td>
                <a href="{{route('Panel.EditActor',$user->id)}}?type=@if ($user instanceof \App\Actor)
actor
@elseif($user instanceof \App\Director)
director
@else
writer
@endif" class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
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
    
     $('.deleteposts').click(function(e){
            e.preventDefault()
            data = { array:array, _method: 'delete',_token: "{{ csrf_token() }}" };
            url='{{route('Panel.DeleteUser')}}';
            request = $.post(url, data);
            request.done(function(res){
            location.reload()
        });
    })
</script>

@endsection