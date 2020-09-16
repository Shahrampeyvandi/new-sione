<?php

namespace App\Http\Controllers\Front;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function Save(Request $request, Post $post)
    {

        if (auth()->guard('admin')->check()) {
            $post->comments()->create([
                'text' => $request->comment,
                'user_id' => 0
            ]);
        }

        if (auth()->check()) {
            $post->comments()->create([
                'text' => $request->comment,
                'user_id' => auth()->user()->id
            ]);
        }
        toastr()->success('نظر شما درانتظار تایید میباشد');
        return back();
    }

    public function getCommentAjax(Request $request , Post $post)
    {
        // dd($request->all());
       $comments = $post->comments()->offset($request->data)->take(10)->get();

        $list = '';
        foreach ($comments as $key => $comment) {
            $list .= ' <div class="comments-detail">
            <div class="user-comment-img">
                <i class="fa fa-user-circle"></i>
            </div>
            <div class="comments-detail-box">
                <p class="user-detail-comm">
                    '.$comment->user().' - '. $comment->timeAndData().'
                </p>
                <p class="comment-user">
                    '. $comment->text .'
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
        </div>';
        }

        return response()->json(['data'=>$list],200);
    }
}
