<?php

namespace App\Http\Controllers\Front;

use App\BugReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MovieRequest;
use App\Payment;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function Account()
  {
    $user = Auth::user();
    return view('Front.Account');
  }

  public function Orders()
  {

    $data['title'] = 'گزارش سفارشات';
    $data['payments'] = Payment::where('user_id', auth()->user()->id)->latest()->get();
    return view('Front.orders',$data);
  }
  public function MovieRequest()
  {
    $data['title'] = 'درخواست فیلم';
    return view('Front.movie-request', $data);
  }

  public function SaveRequest(Request $request)
  {
    if (auth()->guard('admin')->check()) {
      toastr()->success('درخواست فیلم فقط برای کاربران سایت میباشد');
      return back();
    } else {

      $req = new MovieRequest();
      $req->name = $request->name;
      $req->user_id = Auth::user()->id;
      $req->save();
      toastr()->info('درخواست شما با موفقیت ثبت شد');
      return back();
    }
  }

  public function send_bug(Request $request)
  {
    if(Auth::guard('admin')->check()) {
      return back();
    }
    $user_id = Auth::user()->id;
    $post_id = $request->id;
    $content = $request->content;

    BugReport::create([
      'user_id' => $user_id,
      'post_id' => $post_id,
      'name' => $content
    ]);
    toastr()->info('گزارش شما با موفقیت ثبت شد');
    return back();
  }
}
