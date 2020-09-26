<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieRequest extends Model
{
    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo('App\User');
    }
}
