<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = ['id'];

    public function votable()
    {
        return $this->morphTo();
    }
}
