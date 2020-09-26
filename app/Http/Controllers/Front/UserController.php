<?php

namespace App\Http\Controllers\Front;

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
    $payments = Payment::where('user_id', auth()->user()->id)->latest()->get();
    return view('Front.orders', ['payments' => $payments]);
  }
  public function MovieRequest()
  {
    $data['title'] = 'درخواست فیلم';
    return view('Front.movie-request',$data);
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
      toastr()->success('درخواست شما با موفقیت ثبت شد');
      return back();
    }
  }
}
