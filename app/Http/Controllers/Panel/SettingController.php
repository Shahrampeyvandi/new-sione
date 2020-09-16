<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    public function Show()
    {
        $setting = Setting::first();
        if ($setting) {
        } else {

            $setting = new Setting;
            $setting->save();
        }

        return view('Panel.Setting.Show', compact('setting'));
    }

    public function Save(Request $request)
    {

        
        $setting = Setting::first();
        if($request->hasFile('login_poster')){
            $login_poster = $this->SavePoster($request->file('login_poster'),'login_poster-','frontent/login');
        }else{
            if($setting) {

                $login_poster = $setting->login_background;
            }else{
                $login_poster = '';
            }
        }
        if ($setting) {
            $setting->footer_text = $request->footer_label;
            $setting->login_background = $login_poster;
            $setting->update();
        } else {
            $setting = new Setting;
            $setting->footer_text = $request->footer_label;
            $setting->login_background = $login_poster;
            $setting->save();
        }

        toastr()->success('اطلاعات با موفقیت به روز شد');
        return back();
    }
}
