<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];
    protected $with = ['categories', 'languages', 'actors', 'directors', 'episodes'];
    protected $casts = [
        'awards' => 'array',
    ];


    public function checkDubleFarsi()
    {
        $count = $this->categories()->where('latin', 'Double')->count();
        if ($count) {
            return true;
        } else {
            return false;
        }
    }

    public function relatedPosts()
    {

        $collections = $this->collections;
        $coll_pluck = $collections->pluck('id');
        $collection_posts = static::whereHas('collections', function ($q) use ($coll_pluck) {
            $q->whereIn('id', $coll_pluck);
        })->where('id', '!=', $this->id)->where(['type' => $this->type, 'comming_soon' => 0])->orderBy('year','asc')->take(6)->get();

        if (count($collection_posts)) {
            return $collection_posts;
        } else {
            $categories = $this->categories;
            $cat_pluck = $categories->pluck('id');
            return  static::whereHas('categories', function ($q) use ($cat_pluck) {
                $q->whereIn('id', $cat_pluck);
            })->where('id', '!=', $this->id)->where(['type' => $this->type, 'comming_soon' => 0])->orderBy('year','asc')->take(6)->get();
        }
    }



    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }
    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'post_collection', 'post_id', 'collection_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
    public function captions()
    {
        return $this->morphMany(Caption::class, 'captionable');
    }
    public function seasons()
    {
        return $this->hasMany(Season::class);
    }
    public function awards()
    {
        return $this->hasMany(Award::class);
    }
    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }
    public function videos()
    {
        return $this->morphMany(Video::class, 'videoble');
    }
    // image and comment may be for videos or blogs

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // votes may be for videos or comments
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'post_actor', 'post_id', 'actor_id');
    }

    public function writers()
    {
        return $this->belongsToMany(Writer::class, 'post_writer', 'post_id', 'writer_id');
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class, 'post_director', 'post_id', 'director_id');
    }
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'post_language', 'post_id', 'language_id');
    }
    public function trailer()
    {
        return $this->hasOne(Trailer::class);
    }

    public function path()
    {
        if ($this->type == 'movies') {
            return route('ShowMovie', $this->slug);
        }

        if ($this->type == 'documentary' || $this->type == 'series') {

            $season = $this->seasons()->orderBy('number', 'desc')->first();
            if ($season) {
                $id = $season->number;
                return route('ShowMovie', ['slug' => $this->slug]) . '?season=' . $id . '';
            } else {
                return route('ShowMovie', ['slug' => $this->slug]);
            }
        }
    }

    public function has_season()
    {
        if (count($this->seasons)) {
            return true;
        } else {
            return false;
        }
    }

    public function play_trailer()
    {
        return route('S.Trailer', ['slug' => $this->slug]);
    }

    public function get_age_rate()
    {
        $age = $this->age_rate;
        if ($age == 'all') {
            return 'مناسب برای تمام سنین';
        }
        if ($age == '18') {
            return 'مناسب بالای 18 سال';
        }
        if ($age == '12') {
            return 'مناسب بالای 12 سال';
        }
    }

    public function show_poster($size)
    {
        if ($size == 'resize') {
            return asset(unserialize($this->poster)['resize']);
        }
        if ($size == 'banner') {
            return asset(unserialize($this->poster)['banner']);
        }
    }
    public function play()
    {
        if ($this->comming_soon == '1') {
            if ($this->trailer) {
                return route('S.Trailer', ['slug' => $this->slug]);
            } else {
                return '#';
            }
        }
        if ($this->type == 'movies') {
            return route('S.Play', ['slug' => $this->slug]);
        }
        return '#';
    }

    public function downloadpath()
    {

        if ($this->type == 'movies') {
            return route('DownLoad', ['id' => $this->id]);
        }
    }

    public function favoritepath()
    {

        return route('S.addToFavorite');
    }


    public function checkFavorite()
    {

        if (auth()->check()) {
            $user = auth()->user();
        }
        if (auth()->guard('admin')->check()) {
            $user = auth()->guard('admin')->user();
        }
        if ($user->favorite->contains('id', $this->id)) {
            return true;
        } else {
            return false;
        }
    }




    public static function withCategory($name)
    {
        $posts = Post::whereHas('categories', function ($q) use ($name) {
            $q->where('latin', $name);
        })->latest()->get();
    }


    public function last_updated()
    {
        $last_season = $this->seasons()->orderBy('number', 'desc')->first();
        if ($last_season) {
            $episode = $last_season->sections()->orderBy('section', 'desc')->first();
            return 'فصل ' . $last_season->number . ' قسمت ' . $episode->section . ' ';
        }
        $last_section = $this->episodes()->orderBy('section', 'desc')->first();
        if ($last_section) {
            return ' قسمت ' . $last_section->section . ' ';
        }
        return null;
    }




    public function likes()
    {
        return $this->votes()->where('status', 1)->count();
    }
}
