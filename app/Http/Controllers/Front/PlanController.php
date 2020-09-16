<?php

namespace App\Http\Controllers\Front;

use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Purchase;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{

    function __construct(Request $request)
    {
        $this->middleware('userauth');
    }

    public function All()
    {
        $data['plans'] = Plan::orderBy('days','ASC')->get();
        $data['title'] = 'خرید اشتراک';
        return view('Front.Plans', $data);
    }

    public function Buy(Request $request)
    {
        $plan = Plan::whereId($request->plan_name)->first();
        if ($plan) {
            $expire_date = Carbon::now()->addDays($plan->days);
            $user = auth()->user();
            $query = DB::table('user_plan')->where('user_id', '=', $user->id)->where('plan_id', '=', $plan->id)
                ->where('expire_date','>', Carbon::now())->first();
            if ($query) {
                toastr()->success('این اشتراک توسط شما خریداری شده است');
                return back();
            }


            // zarin pal 
            $this->pay($plan);
            $user->plans()->attach($plan->id, ['expire_date' => $expire_date]);
            // send sms 
            $this->sendNoty($user, $plan);
            return redirect()->route('MainUrl');
        } else {
            return back();
        }
    }

   
    
}
