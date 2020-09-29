<?php

namespace App\Http\Controllers\Front;

use App\Admin;
use App\ForgotCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function Login()
    {
        // dd(auth()->user());

   
        if (Auth::guard('admin')->check()) {
            return redirect()->route('BaseUrl');
        }
        if (Auth::check()) {
            $expire = Carbon::parse(Auth::user()->expire_date)->timestamp;
            $now = Carbon::now()->timestamp;
            if ($expire > $now) {
                return redirect()->route('MainUrl');
            } else {
                return redirect()->route('S.SiteSharing');
            }
        }

        $logindata = json_decode(Cookie::get('login'));
        if($logindata){
            $data['phone'] = $logindata->phone;
            $data['password'] = $logindata->password;    
        }else{
            $data['phone'] = null;
            $data['password'] = null;    
        }
        $data['title'] = 'ورود';


        return view('Front.login', $data);
    }

    public function Verify(Request $request)
    {

        $rules = array(
            'mobile'             => 'required',
            'password'         => 'required | min:8',
        );
        $messages = array(
            'mobile.required'             => 'شماره همراه الزامی است',
            'password.min'         => 'رمز عبور غیر مجاز است ',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('login')
                ->withErrors($validator);
        }
        $admin = Admin::where('mobile', $request->mobile)->first();
        if ($admin) {
            if (Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->attempt(['mobile' => $request->mobile, 'password' => $request->password]);
                auth()->guard('admin')->logoutOtherDevices($request->password);
                return redirect()->route('MainUrl');
            }
        }

        $member = User::where('mobile', $request->mobile)->first();
        if ($member) {
            if (Hash::check($request->password, $member->password)) {
                auth()->attempt(['mobile' => $request->mobile, 'password' => $request->password]);
                auth()->logoutOtherDevices($request->password);
                $expire = Carbon::parse(Auth::user()->expire_date)->timestamp;
                $now = Carbon::now()->timestamp;

                $data = array(
                    "phone" => $request->mobile,
                    "password" => $request->password
                );
                $cookieTime = 10000;
                Cookie::queue('login', json_encode($data), $cookieTime);

                $member->lastloginip=$request->ip();
                $member->update();



                if ($expire > $now) {
                    return redirect()->route('MainUrl');
                } else {
                    return redirect()->route('S.SiteSharing');
                }
            } else {
                return Redirect::route('login')->withErrors(['رمز عبور اشتباه است']);
            }
        } else {
            return Redirect::route('login')->withErrors(['کاربری با این شماره موبایل وجود ندارد']);
        }
    }

    public function Register(Request $request)
    {

        $rules = array(
            'mobile'             => 'required | unique:users,mobile',
            'password'         => 'required | min:8',
            'fname' => 'required',
            'lname' => 'required'
        );
        $messages = array(
            'mobile.required'             => 'شماره همراه الزامی است',
            'mobile.unique'             => 'متاسفانه کابری با این شماره تماس ثبت نام کرده است',
            'password.min'         => 'رمز عبور غیر مجاز است ',
        );
        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::to('login')
                ->withErrors($validator);
        }


        


        $user = User::create([
            'mobile' => $request->mobile,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'password' => Hash::make($request->password),
            'lastloginip'=> $request->ip(),
            'expire_date' => Carbon::now(),
        ]);

        //------ ارسال پیامک ثبت نام کاربر جدید
        $patterncode = "kjdc6fbf5v";
        $data = array("name" => $request->fname, "username" => $request->mobile, "password" => $request->password);
        $this->sendSMS($patterncode, $request->mobile, $data);

        if ($user) {
            Auth::login($user);

            // send sms

            return redirect()->route('S.SiteSharing');
        } else {
            return back();
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        Auth::logout();
        return redirect()->route('login');
    }

    public function ForgetPassword(Request $request)
    {


        $rules = array(
            'mobile'             => 'required',
            'password'         => 'required | min:8',
        );
        $messages = array(
            'mobile.required'             => 'شماره همراه الزامی است',
            'password.min'         => 'رمز عبور غیر مجاز است ',
        );


        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {

            $code = ForgotCode::createCode($request->mobile);

            if ($code == false) {
                return Redirect::back()->withErrors(['کد بازنشانی رمز قبلا برای شما ارسال شده است. لطفا بعدا مجددا امتحان فرمایید']);
                return 'کد قبلا برای شما ارسال شده است. لطفا بعدا مجددا امتحان فرمایید';
            }

            //------ ارسال پیامک ثبت نام کاربر جدید
            $patterncode = "i0hm6b2p4v";
            $data = array("name" => $user->first_name, "code" => $code->v_code);
            $this->sendSMS($patterncode, $user->mobile, $data);
        } else {
            return Redirect::back()->withErrors(['کاربری با این شماره یافت نشد!']);
        }

        $title = 'فراموشی رمز عبور';
        $mobile = $request->mobile;

        return view('Front.forgotpasscode', compact(['title', 'mobile']));
    }

    public function ForgetPasswordSubmitCode(Request $request)
    {

        $code = $request->code;

        $user = User::where('mobile', $request->mobile)->first();

        $Code_OBJ = ForgotCode::where('v_code', $request->code)->latest()->first();

        if ($Code_OBJ) {
        } else {
            return Redirect::back()->withErrors(['کد وارد شده صحیح نمی باشد']);
        }

        $title = 'فراموشی رمز عبور';
        $mobile = $request->mobile;
        $code = $request->code;
        return view('Front.forgotpassnewpass', compact(['title', 'mobile', 'code']));
    }


    public function ForgetPasswordSubmitnewPass(Request $request)
    {


        $rules = array(
            'password'         => 'required | min:8',
        );
        $messages = array(
            'password.min'         => 'رمز عبور غیر مجاز است ',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::back()->withErrors($validator);
            return Redirect::to('login')
                ->withErrors($validator);
        }

        $user = User::where('mobile', $request->mobile)->first();

        $Code_OBJ = ForgotCode::where('v_code', $request->code)->latest()->first();

        if ($Code_OBJ) {
        } else {
            return Redirect::back()->withErrors(['کد وارد شده صحیح نمی باشد']);
        }


        $user->password = Hash::make($request->password);
        $user->update();
        Auth::login($user);
        $expire = Carbon::parse(Auth::user()->expire_date)->timestamp;
        $now = Carbon::now()->timestamp;
        if ($expire > $now) {
            toastr()->success('رمز عبور شما با موفقیت تغییر کرد');
            return redirect()->route('MainUrl');
        } else {
            toastr()->success('رمز عبور شما با موفقیت تغییر کرد');
            return redirect()->route('S.SiteSharing');
        }
    }
}
