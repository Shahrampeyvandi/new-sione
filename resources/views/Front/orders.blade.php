@extends('Layout.Front')
@section('Title',$title)

@section('content')

<section class="profile-section" style="width: 70%">

    <h1>
        لیست سفارشات
    </h1>
    <style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>

    <div class="card">

        <div class="card-body" style="overflow-x:auto;">

            <table id="example1" >
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

@section('js')
    
    <script src="{{asset('assets/vendors/dataTable/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendors/dataTable/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/vendors/dataTable/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/examples/datatable.js')}}"></script>
    
@endsection