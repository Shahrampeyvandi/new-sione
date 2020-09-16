<?php

namespace App;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];
    
    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        if($this->user_id){
            return $this->member->first_name . ' ' . $this->member->last_name;
        }else{
            return 'مدیریت';
        }

    }

   

    public function timeAndData()
    {
        return Jalalian::forge($this->created_at)->format('%B %d') . ' ساعت ' . Carbon::parse($this->created_at)->format('H:i'); 
    }

      public function member()
    {
        return $this->belongsTo('App\User');
    }
    public function setTextAttribute($value)
    {
        return $this->attributes['text']= nl2br($value);
    }

    public function votes()
    {
        return $this->belongsToMany(Vote::class, 'comment_vote', 'comment_id', 'vote_id');
    }
}
