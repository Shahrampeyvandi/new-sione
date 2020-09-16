<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SerieController extends Controller
{
    public function Show($slug, $season = 1)
    {
        $post = Post::whereSlug($slug)->first();
        if (is_null($post)) {
            abort(404);
        }
        $relatedPosts = $post->relatedPosts();
        // dd($relatedPosts);
        if (count($post->episodes)) {
            $seasons = $post->episodes()->where('season', $season)->orderBy('section','asc')->get();
        } else {
            $seasons = [];
        }
       
        $title = $post->title;

        return view(
            'Front.ShowMovie',
            ['post' => $post, 'relatedPosts' => $relatedPosts, 'seasons' => $seasons, 'title' => $title]
        );
    }

    public function All()
    {
        $year = Carbon::now()->year();
        $data['newsione'] = Post::where(['type'=>'series','comming_soon' => 0])->latest()->take(10)->get();
        $newseries = Post::where(['type'=>'series','comming_soon'=>0])->latest()->take(10)->get();
        $newyear = Post::where(['year' => $year, 'type' => 'series','comming_soon'=>0])->latest()->take(10)->get();
        $latestdoble = Post::whereHas('categories', function ($q) {
            $q->where('name', 'دوبله فارسی');
        })->where(['type'=>'series','comming_soon'=>0])->latest()->take(10)->get();

        $sliders = Slider::whereHas('post', function ($q) {
            $q->where(['type'=>'series']);
        })->latest()->take(5)->get();

        if (count($sliders)) {
            $data['sliders'] = $sliders;
        } else {
            $data['sliders'] = Slider::latest()->take(5)->get();
        }

        $data['newseries'] = $newseries;
        $data['latestdoble'] = $latestdoble;
        $data['newyear'] = $newyear;
        $data['year'] = $year;

        return view('Front.AllSeries', $data);
    }
}
