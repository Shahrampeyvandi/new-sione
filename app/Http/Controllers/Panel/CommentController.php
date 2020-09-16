<?php

namespace App\Http\Controllers\Panel;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{


    public function UnconfirmedComments()
    {
        return view('Panel.Comments.UnconfirmedComments',['comments'=>Comment::where('confirm',false)->latest()->get()]);
    }


      public function ConfirmedComments()
    {
        return view('Panel.Comments.ConfirmedComments',['comments'=>Comment::where('confirm',true)->latest()->get()]);
    }
    //  public function Index()
    // {

    //     if($content == '' ){
    //         $comments=Comments::where('confirmed',1)->get();
    //    }
    //    if($content == 'unconfirmed'){
    //     $comments=Comments::where('confirmed',0)->get();
    // }
    //    if($content == 'rejected'){
    //     $comments=Comments::where('confirmed',2)->get();
    // }

        

    //     return view('Panel.Comments',compact('comments'));
    // }

    // public function unconfirm(Request $request)
    // {
       
    //     Comments::where('id',$request->comment_id)->orWhere('parent_id',$request->comment_id)->delete();
    //     return back();
    // }
    // public function confirm($id)
    // {
     
    //     Comments::where('id',$id)->update(['confirmed'=>1]);
    //     return back();
    // }
}
