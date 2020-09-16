<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $guarded = ['id'];

    public function sections()
    {
        return $this->hasMany(Episode::class,'season');
    }


    public function serie()
    {
        return $this->belongsTo(Post::class,'post_id');
    }
}
