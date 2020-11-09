<!-- begin::sidebar -->
<div class="sidebar">
    <ul class="nav nav-pills nav-justified m-b-30" id="pills-tab" role="tablist">

        <li class="nav-item">
            <a class="nav-link" id="notifications-tab" data-toggle="pill" href="#notifications" role="tab"
                aria-controls="notifications" aria-selected="false">
                <i class="fa fa-bell"></i>
            </a>
        </li>

    </ul>
    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
            <div class="tab-pane-body">
                <h5 class="font-weight-bold m-b-20">اعلان ها</h5>

                <div>
                    <ul class="list-group list-group-flush m-b-10">
                        @foreach ($merge_noty as $item)
                        <li class="list-group-item d-flex p-l-r-0">
                            <div>
                                <p class="m-b-0">
                                    <span class="badge small badge-danger">جدید</span>
                                    @if ($item instanceof \App\BugReport)
                                <span class="titl" style="font-size: 0.8rem;margin-right: 1rem;">گزارش خطا  {{\App\Post::find($item->post_id)->name}}</span>
                                    @else
                                    <span class="titl" style="font-size: 0.8rem; margin-right: 1rem;"> درخواست
                                        فیلم</span>
                                    @endif
                                    <br>
                                    <span class="content">{{str_limit($item->name,30,'...')}}</span>
                                </p>
                                <ul class="list-inline small">
                                    <li class="list-inline-item text-muted">
                                        {{\Morilog\Jalali\Jalalian::forge($item->created_at)->ago()}}</li>
                                    <li class="list-inline-item">
                                        @if ($item instanceof \App\BugReport)
                                        <a href="#" onclick="readNoty(event,'{{$item->id}}','bug')">علامت خوانده شده</a>
                                        @else
                                        <a href="#" onclick="readNoty(event,'{{$item->id}}','req')">علامت خوانده شده</a>

                                        @endif
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" @if ($item instanceof \App\BugReport)
                                            onclick="showNotification(event,'{{$item->id}}','bug')" @else
                                            onclick="showNotification(event,'{{$item->id}}','req')" @endif>مشاهده</a>
                                    </li>
                                     <li class="list-inline-item">
                                        <a href="#" class="text-danger" @if ($item instanceof \App\BugReport)
                                            onclick="deleteNoty(event,'{{$item->id}}','bug')" @else
                                            onclick="deleteNoty(event,'{{$item->id}}','req')" @endif>حذف</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                </div>

            </div>
            {{-- <div class="tab-pane-footer">
                <a href="#" class="btn btn-primary btn-block">علامت خوانده شده به همه</a>
            </div> --}}
        </div>

    </div>
</div>
<!-- end::sidebar -->