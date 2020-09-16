@extends('Layout.Front')

@section('content')
<style>
    th,td{
        padding: 10px;
    }
</style>
  <a href="{{route('MainUrl')}}" class="logo-float-right">
                            <img class="site-logo" src="{{asset('assets/images/aa-300x157.png')}}" alt="site-logo">

</a>
<section class="profile-section" style="width: 70%">

    <h1>
        لیست سفارشات
    </h1>
    
    <div class="plans">
        <div >

            <table class=" w-100 table-responsive">
                <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>شماره سفارش</th>
                        <th>زمان ثبت سفارش</th>
                        <th>وضعیت سفارش</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $key=>$item)
                    <tr>
                        <td>{{($key+1)}}</td>
                        <td>{{$item->transaction_code}}</td>
                        <td>{{\Morilog\Jalali\Jalalian::forge($item->created_at)->format('%B %d، %Y')}}</td>
                        <td>
                            @if ($item->success == '1')
                            <span class="text-success">موفق</span>
                            @else    
                             <span class="text-danger">ناموفق</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>
    </div>



</section>
@endsection