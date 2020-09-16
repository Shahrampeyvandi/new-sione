<?php

namespace App\Http\Controllers\Panel;

use App\Plan;
use App\User;
use App\Discount;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Discount as newDiscount;
use Morilog\Jalali\Jalalian;

class DiscountController extends Controller
{
    function list()
    {
        return view('Panel.Discounts.list')->with('discounts', Discount::all());
    }

    public function Save(Request $request)
    {


        if (Discount::where('d_code', $request->code)->count()) {
            return back();
        }
        if (Plan::count() == 0) {
            return back();
        }

        $discount = new Discount;
        $discount->name = $request->title;
        $discount->percent = $request->percent;
        $discount->expire_date = $this->convertDate($request->date);
        $discount->d_code = $request->code;
        $discount->description = $request->description;
        $discount->count = $request->count;
        $discount->save();

        foreach ($request->for as $key => $plan_id) {

            $discount->plans()->attach($plan_id);
        }



        if (!is_null($request->sendsms)) {
            $users = User::all();
            if ($request->sendsms == "sms") {
                //
            }

            if ($request->sendsms == "email") {

                foreach ($users as $key => $user) {
                    Mail::to($user->email)->send(
                        new newDiscount($discount->percent, Jalalian::forge($this->convertDate($request->date))->format('%B %d، %Y'), $discount->plans, env('APP_URL'))
                    );
                }
            }

            // if ($request->sendsms == "noty") {
            //     $content = 'با سلام <br/>';
            //     $content .= 'اشتراک جدید با نام ' . $discount->name . ' در سایت اضافه شد <br/><br/>';

            //     foreach ($users as $key => $user) {
            //         $notification = new Notification;
            //         $notification->subject = 'اشتراک جدید';
            //         $notification->content = $content;
            //         $notification->sender = 'admin';
            //         $notification->reciver_id = $user->id;
            //         $notification->save();
            //     }
            // }
        }
        toastr()->success('تخفیف جدید با موفقیت ثبت شد');
        return redirect()->route('Panel.DiscountList');
    }

    public function Edit($id)
    {

        return view('Panel.Discounts.Edit', ['discount' => Discount::find($id)]);
    }

    public function SaveEdit($id)
    {

        Discount::whereId($id)->update([
            'name' => request()->title,
            'd_code' => request()->code,
            'percent' => request()->percent,
            'expire_date' => $this->convertDate(request()->date),
            'description' => request()->description,
            'count' => request()->count
        ]);

        $discount = Discount::find($id);
        $discount->plans()->detach();
        foreach (request()->for as $key => $plan_id) {

            $discount->plans()->attach($plan_id);
        }

        return redirect()->route('Panel.DiscountList');
    }

    public function Delete(Request $request)
    {
        foreach ($request->array as $key => $id) {
            $discount = Discount::find($id);
            $discount->plans()->detach();
            $discount->delete();
        }
        toastr()->success('موارد با موفقیت حذف  شد');
        return back();
    }
}
