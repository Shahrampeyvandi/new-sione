<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $fillable = ['mobile','password','first_name','last_name'];

    public function name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    
     public function favorite()
    {
        return $this->belongsToMany(Post::class, 'user_favorite', 'user_id', 'post_id');
    }
    public function type()
    {
        return 'admin';
    }
      public function noty()
    {
        return $this->hasMany(Notification::class,'reciver_id');
    }

    public function newNoty()
    {
       $noty = $this->noty()->where('created_at', '=' , Carbon::now())->first();
    }

}
