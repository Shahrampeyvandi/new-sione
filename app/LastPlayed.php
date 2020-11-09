<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastPlayed extends Model
{
    protected $guarded = ['id'];


    public function path()
    {


        $post = Post::find($this->post_id);
        if ($post->type !== 'movies') {
            if ($this->season_id !== null) {

                $season = Season::find($this->season_id);
                $section = Episode::find($this->section_id);
                
                return route('S.Series.Play') . '?slug=' . $post->slug . '&season=' . $season->name . '&section=' . $section->section . '';
            } else {
                $section = Episode::find($this->section_id);
                return route('S.Series.Play') . '?slug=' . $post->slug . '&section=' . $section->section . '';
            }
        } else {
            return route('S.Play', ['slug' => $post->slug]);
        }
    }
}
