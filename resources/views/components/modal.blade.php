<div class="modal fade" id="delete{{$name}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$name}}Label"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete{{$name}}Label">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @isset($title)
                {{$title}}
                @else
                برای حذف مورد مطمئن هستید
                @endisset
            </div>
            <div class="modal-footer">
                <form action="{{route('Panel.DeleteCat')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="{{$name}}_id" id="{{$name}}_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>
