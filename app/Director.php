<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $guarded = ['id'];

       public static function check($name)
   {
       if($obj = static::where('name',$name)->first()){
            return $obj->id;
       }else{
           return null;
       }
   }

    public function path()
    {
        return route('ShowCast', ['name' => $this->name]) . '?type=director';
    }
}
