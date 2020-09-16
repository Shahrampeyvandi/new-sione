@extends('Layout.Panel')

@section('content')


<div class="card">
    <div class="card-title">
        <h5 class="text-center">ویرایش</h5>
        <hr>
    </div>
    <div class="card-body">
        <form class="add-discount" action="{{route('Panel.Discount.Edit',$discount->id)}}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
            </div>

            <div class="row">


                <div class="form-group col-md-12">
                    <label for="">عنوان</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{$discount->name}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="">درصد تخفیف</label>
                    <input type="number" class="form-control" name="percent" id="percent" value="{{$discount->percent}}"
                        placeholder="به صورت عدد وارد نمایید">
                </div>
                <div class="form-group col-md-3">
                    <label for="" class="text-danger">کد تخفیف</label>
                    <input type="text" class="form-control" name="code" id="code" value="{{$discount->d_code}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="">محدودیت تعداد</label>
                    <input required type="number" class="form-control " name="count" id="count"
                        value="{{$discount->count}}">
                </div>
                <div class="form-group col-md-3">
                    <label for="">تاریخ انقضا</label>
                    <input required type="text" class="form-control datepicker-fa" name="date" id="date"
                        value="{{$discount->date}}">
                </div>
                <div class="form-group col-md-12">
                    <label for="">توضیحات</label>
                    <textarea type="text" class="form-control" name="description" id="description">
                                {{$discount->description}}
                            </textarea>
                </div>

            </div>
            <button type="submit" class=" btn btn-success text-white">ذخیره <i class="fas fa-edit"></i></button>



        </form>
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
    var date = <?php echo json_encode($discount->expire_date) ?>;
    $(".datepicker-fa").datepicker({
        
            changeMonth: true,
            changeYear: true
            }).datepicker('setDate',date);
</script>

@endsection