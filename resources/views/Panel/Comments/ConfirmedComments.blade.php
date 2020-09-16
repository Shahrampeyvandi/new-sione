@extends('Layout.Panel')

@section('content')
@include('Includes.Panel.Comments.Header')
                @foreach($comments as $key=>$comment)
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox custom-control-inline" style="margin-left: -1rem;">
                            <input data-id="{{$comment->id}}" type="checkbox" id="comment_{{ $key}}"
                                name="customCheckboxInline1" class="custom-control-input" value="1">
                            <label class="custom-control-label" for="comment_{{$key}}"></label>
                        </div>
                    </td>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$comment->name}}</a>
                    </td>
                    <td>{{$comment->views}}</td>
                    <td class="text-success">{{$comment->votes()->count()}}</td>
                    <td>
                        @foreach ($comment->categories as $category)
                        {{$category->name}} ,
                        @endforeach
                    </td>
                    <td>
                        @foreach ($comment->languages as $language)
                        {{$language->name}}
                        @endforeach
                    </td>
                    <td>
                        <a href="{{route('Panel.EditMovie',$comment)}}" class="btn btn-sm btn-info">ویرایش سریع </a>
                        <a href="{{route('Panel.EditMovie',$comment)}}" class="btn btn-sm btn-primary">پاسخ</a>
                        <a href="{{route('Panel.EditMovie',$comment)}}" class="btn btn-sm btn-success">پذیرفتن</a>

                        {{-- <a href="{{route('Panel.UploadVideo')}}?id={{$comment->id}}"
                            class="btn btn-sm btn-outline-info">ویدیوها</a> --}}

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