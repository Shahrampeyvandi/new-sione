@extends('Layout.Panel')

@section('content')
<div class="modal fade" id="addDiscount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form class="add-discount" action="{{route('Panel.Discount.Insert')}}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for=""><span class="text-danger">*</span> مربوط به: </label>
                            <select name="for[]" class="js-example-basic-single" multiple dir="rtl">
                              
                                @foreach (\App\Plan::all() as $plan)
                                <option value="{{$plan->id}}"
                                    {{isset($discount) && $discount->plans()->pluck('id')->contains($plan->id) ? 'selected' : ''}}>
                                    {{$plan->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group col-md-12">
                            <label for="">عنوان</label>
                            <input type="text" class="form-control" name="title" id="title" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">درصد تخفیف</label>
                            <input type="number" class="form-control" name="percent" id="percent" value=""
                                placeholder="به صورت عدد وارد نمایید">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="" class="text-danger">کد تخفیف</label>
                            <input type="text" class="form-control" name="code" id="code" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">تاریخ انقضا</label>
                            <input required type="text" class="form-control datepicker-fa" name="date" id="date"
                                value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">محدودیت تعداد</label>
                            <input  type="number" class="form-control " name="count" id="count" value="">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">توضیحات</label>
                            <textarea type="text" class="form-control" name="description" id="description"></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="desc">اطلاع رسانی به کاربران: </label>
                            <select class="custom-select" name="sendsms" id="sendsms">
                                <option value="">لازم نیست</option>
                                <option value="sms">پیامک</option>
                                <option value="email">ایمیل</option>
                                <option value="noty">نوتیفیکیشن</option>
                            </select>
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
                <a href="#" class="deleteposts btn btn-danger text-white">حذف! </a>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="container_icon card-body d-flex justify-content-end">
        <div class="delete-edit" >
            <a href="#" title="جدید " data-toggle="modal" data-target="#addDiscount" class="order-delete   m-2">
                <span class="__icon bg-success">
                    <i class="fa fa-plus"></i> افزودن
                </span>
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">لیست تخفیف ها</h5>
            <hr>
        </div>
        <div style="overflow-x: auto;">
            <table id="example1" class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>ردیف</th>
                        <th> عنوان </th>
                        <th> مربوط به اشتراک </th>
                        <th> کد تخفیف</th>
                        <th>درصد </th>
                        <th>تاریخ انقضا</th>
                        <th>محدودیت</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($discounts as $key=>$discount)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <a href="#" class="text-primary">{{$discount->name}}</a>
                        </td>
                        <td>
                            @foreach ($discount->plans as $plan)
                            {{$plan->name}} <br />
                            @endforeach
                        </td>
                        <td class="text-success">{{$discount->d_code}}</td>
                        <td class="text-success">{{$discount->percent}}</td>
                        <td class="text-info">
                            {{\Morilog\Jalali\Jalalian::forge($discount->expire_date)->format('%B %d، %Y')}}</td>

                        <td>
                            {{$discount->count ? $discount->count : 'نامحدود'}}
                        </td>
                        <td>
                            <a href="{{route('Panel.Discount.Edit',['id' => $discount->id])}}"
                                class="btn btn-sm btn-info">ویرایش</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('js')
<script src="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendors/datepicker/bootstrap-datepicker.fa.min.js')}}"></script>

<script>
    $(".datepicker-fa").datepicker({
            changeMonth: true,
            changeYear: true
            });
   
       


     $('.deleteposts').click(function(e){
            e.preventDefault()
            data = { array:array, _method: 'delete',_token: "{{ csrf_token() }}" };
            url='{{route('Panel.DeleteDiscount')}}';
            request = $.post(url, data);
            request.done(function(res){
            location.reload()
        });
    })
</script>

@endsection