@if ($post->comment_status == 'enable')
    <section class="movie-user-comments">
    <h1>
        @if ($post->comments)
        نظرات کاربران
        @else
        افزودن نظر
        @endif
    </h1>
    <div class="movie-user-comments-box">
        <div class="comments-detail">
            <div class="user-comment-img">
                <i class="fa fa-user-circle"></i>
            </div>
            <div class="comments-detail-box">
            <form id="Comments-Form" action="{{route('SaveComment',$post)}}" method="post">
                @csrf
                    <div class="input-place">
                        <input type="text" id="comment-user" name="comment" autocomplete="off" required>
                        <label for="comment-user">
                            نظرتان راجع به این فیلم چیست؟
                        </label>
                    </div>
                    <span class="send-comment">
                        <button type="submit">
                            ثبت نظر
                        </button>
                    </span>
                </form>
            </div>
        </div>

       <div id="comments">
            @foreach ($post->comments->where('confirm',1)->take(1) as $comment)
        <div class="comments-detail">
            <div class="user-comment-img">
                <i class="fa fa-user-circle"></i>
            </div>
            <div class="comments-detail-box">
                <p class="user-detail-comm">
                   
                    {{$comment->user()}} - {{$comment->timeAndData()}}
                </p>
                <p class="comment-user">
                    {!! $comment->text !!}
                </p>
                <div class="like-comment">
                    <i class="far fa-thumbs-up"></i>
                    <span>
                        0
                    </span>
                    <i class="far fa-thumbs-down"></i>
                    <span>
                        0
                    </span>
                </div>
            </div>
        </div>
        @endforeach
       </div>
       @if (count($post->comments) > 10)
            <a data-data="10" href="#" onclick="getComments(event,'{{route('GetCommentAjax',$post)}}')"  class="more-comment">
                بیشتر
            </a>
       @endif

    </div>
</section>
@endif