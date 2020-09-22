<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $guarded = ['id'];
    
    public $timestamps = false;

   public static function check($name)
   {
       if($obj = static::where('latin',$name)->first()){
            return $obj->id;
       }else{
           return null;
       }
   }

   public function getImage()
   {
       return $this->image ? $this->image : "frontend/assets/images/category/cat13.jpg";
   }

   public function path()
   {
       return route('Category.Show',['name'=>$this->latin]);
   }

   public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }
}
