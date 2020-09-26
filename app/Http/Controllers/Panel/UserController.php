<?php

namespace App\Http\Controllers\Panel;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

class UserController extends Controller
{
    function list()
    {
        $users = User::all();

        return view('Panel.Users.Lists', compact('users'));
    }
    public function Delete(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json('کاربر با موفقیت حذف شد');
    }

    public function Add(Request $request)
    {

        $rules = array(
            'mobile'             => 'required | unique:users,mobile',
            'password'         => 'required | min:8',

        );
        $messages = array(
            'mobile.required'             => 'شماره همراه الزامی است',
            'mobile.unique'             => 'متاسفانه کابری با این شماره تماس ثبت نام کرده است',
            'password.min'         => 'رمز عبور غیر مجاز است ',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()
                ->withErrors($validator);
        }
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        if (isset($request->days) && $request->days > 0) {

            $expire_date = Carbon::now()->addDays($request->days);
        } else {
            $expire_date = null;
        }
        $user->expire_date = $expire_date;

        $user->save();



        if ($request->has("sendsms") && $request->sendsms == 1) {
            $patterncode = "kjdc6fbf5v";
            $data = array("name" => $user->first_name, "username" => $request->mobile, "password" => $request->password);
            $this->sendSMS($patterncode, $user->mobile, $data);
        }

        toastr()->success('کاربر با موفقیت اضافه شد');
        return back();
    }

    public function Edit($id)
    {
        $member = User::find($id);
        
        return view('Panel.Users.Edit',compact('member'));
    }

    public function SaveEdit(Request $request, User $user)
    {

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        if ($request->password && !is_null($request->password)) {
            $user->password =  Hash::make($request->password);
        }
        $user->email = $request->email;
        $user->expire_date = $this->convertDate($request->date);
        $user->update();

        if ($request->has("sendsms") && $request->sendsms == 1) {
            $patterncode = "nj36jd5q3c";
            $data = array("name" => $user->first_name, "password" => $request->password, "expire_date" => $request->date);
            $this->sendSMS($patterncode, $user->mobile, $data);
        }

        toastr()->success('کاربر با موفقیت ویرایش شد');
        return back();
    }

  
}
