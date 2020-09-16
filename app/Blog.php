<?php

namespace App;

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use Sluggable;
    protected $guarded = ['id'];
    protected $table = 'blogs';

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function category()
    {
        return $this->hasOne(BlogCategory::class,'id','category_id');
    }

    public function links()
    {
        return $this->hasMany(BlogLink::class);
    }

    public function videos()
    {
        return $this->morphMany(Video::class, 'videoble');
    }

    public function get_shamsi_date()
    {
        return Jalalian::forge($this->created_at)->format('%B %d، %Y'); // دی 02، 1391
    }

     public static function withCategory($name)
    {
       return $posts = static::whereHas('category', function ($q) use ($name) {
            $q->where('latin', $name);
        })->latest()->get();
    }

    public function url()
    {
        return route('Blog.show',['category'=> $this->category->latin,'slug'=>$this->slug]);
    }

    public function remove_image_from_desc()
    {
        
       return preg_replace("/<img[^>]+\>/i", "(image) ", $this->description); 
    }
}
