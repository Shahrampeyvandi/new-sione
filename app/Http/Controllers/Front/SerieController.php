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
            $seasons = $post->episodes()->where('season', $season)->orderBy('section', 'asc')->get();
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
        if (\Request::route()->getName() == 'AllSeries') {
            $type = 'series';
            $data['title'] = 'سریال';
        }
        if (\Request::route()->getName() == 'AllDocumentaries') {
            $type = 'documentary';
            $data['title'] = 'مستند';
        }
        $data['updated_series'] = Post::where(['type' => $type, 'comming_soon' => 0])->whereHas('episodes', function ($q) {
            $q->where('created_at', '>', Carbon::now()->subDays(15));
        })->latest()->take(10)->get();

        $data['newseries'] = Post::where(['type' => $type, 'comming_soon' => 0])->latest()->take(10)->get();

        $data['sliders'] = Slider::LastSliders($type);
       

        return view('Front.AllSeries', $data);
    }
}
