<?php

namespace App\Http\Schedules;

use App\User;
use App\Plan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class CheckUserExpireScheduler
{

    protected $controller;


    public function __invoke()
    {
        $this->controller = new Controller;

        $now = Carbon::now()->timestamp;

        $users = User::all();

        $twodaysts = 172800;
        $onedayts = 86400;

        foreach ($users as $user) {

            $expire = Carbon::parse($user->expire_date)->timestamp;
            $ets = $expire - $now;

            if ($ets < $twodaysts && $ets > $onedayts) {

                $patterncode = "97b8c9m9a5";
                $data = array("name" => "نام طرف", "number" => "نام اشتراک");
                $this->controller->sendSMS($patterncode,$user->mobile,$data);
            }
        }





        echo date('Y-m-d H:00:00') . "asdas" . PHP_EOL;



        //$this->controller->sendSMS();
    }
}
