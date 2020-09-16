<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $guarded = ['id'];

    public static function check($name)
    {
        if ($obj = static::where('name', $name)->first()) {
            return $obj->id;
        } else {
            return null;
        }
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'actor_video');
    }
    public function path()
    {
        return route('ShowCast', ['name' => $this->name]) . '?type=actor';
    }
}
