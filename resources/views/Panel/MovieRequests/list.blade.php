@extends('Layout.Panel')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">درخواست فیلم</h5>
            <hr>
        </div>

        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>

                    <th>ردیف</th>
                    <th> نویسنده </th>
                    <th>نام فیلم</th>

                    <th>عملیات</th>


                </tr>
            </thead>

            <tbody>
                @foreach($movie_requests as $key=>$comment)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        @php
                           $member= \App\User::where('id',$comment->user_id)->first();
                        @endphp
                        {{$member->first_name .'  '. $member->last_name}}
                    </td>
                    <td>
                        {{$comment->name}}
                    </td>
                    <td>

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
    $('.delete-comment').click(function(e){
            e.preventDefault()
            data = { array:array, _method: 'delete',_token: "{{ csrf_token() }}" };
            url='{{route('Panel.DeletePost')}}';
            request = $.post(url, data);
            request.done(function(res){
            location.reload()
        });
    })
</script>

@endsection