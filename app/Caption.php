<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caption extends Model
{
    protected $guarded = ['id'];
      public function captionable()
    {
        return $this->morphTo();
    }
}
