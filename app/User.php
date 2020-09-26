<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded  = [
        'id'
    ];

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    public function type()
    {
        return $this->role == 'مشترک' ? 'moshtarak' : '';
    }
    public function planStatus()
    {
        $expire = Carbon::parse($this->expire_date)->timestamp;
        $now = Carbon::now()->timestamp;
        if ($expire > $now) {
            return true;
        } else {
            return false;
        }
    }

    public function noty()
    {
        return $this->hasMany(Notification::class, 'reciver_id');
    }
     public function movie_requests()
    {
        return $this->hasMany(MovieRequest::class, 'user_id');
    }


    public function newNoty()
    {
        return  Notification::where('reciver_id', $this->id)->whereDate('created_at', '=', \Carbon\Carbon::today())->count();
    }

    public function favorite()
    {
        return $this->belongsToMany(Post::class, 'user_favorite', 'user_id', 'post_id');
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'user_plan', 'user_id', 'plan_id')->withPivot('expire_date');
    }
    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'user_discount', 'user_id', 'discount_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
