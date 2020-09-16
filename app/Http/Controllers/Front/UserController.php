<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $payments = Payment::where('user_id',auth()->user()->id)->latest()->get();
        return view('Front.orders',['payments'=>$payments]);
    }
}
