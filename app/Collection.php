<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $guarded = ['id'];

    protected $with = 'posts';
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_collection', 'collection_id', 'post_id');
    }

    public function url()
    {
        return route('Show-Collection', ['id' => $this->id]);
    }
}
