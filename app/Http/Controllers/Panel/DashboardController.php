<?php

namespace App\Http\Controllers\Panel;

use App\Blog;
use App\Post;
use App\User;
use App\Visit;
use App\Category;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function Index()
    {

        if (!request()->hasCookie($_SERVER['REMOTE_ADDR'])) {
            Visit::create([
                'ip' => $_SERVER['REMOTE_ADDR'],
                'day' => Jalalian::now()->format('%A')
            ]);

            cookie()->queue(cookie($_SERVER['REMOTE_ADDR'], null, 15));
        }
        $day_array = [];
        $day_visits = [];
        for ($i = 0; $i < 7; $i++) {
            array_push($day_array, Jalalian::now()->subDays($i)->format('%A'));
            array_push($day_visits, Visit::where('day', Jalalian::now()->subDays($i)->format('%A'))->count());
        }
        $day_json = json_encode(array_reverse($day_array));
        $visits_json = json_encode(array_reverse($day_visits));

        //   get 5 film where has most votes
        $posts = Post::all();
        if (count($posts)) {
            foreach ($posts as $key => $post) {
                $votes[$post->id] =  $post->votes()->count();
            }

            uasort($votes, function ($a, $b) {
                if ($a == $b) {
                    return 0;
                }
                return ($a > $b) ? -1 : 1;
            });


            $largest = array_slice($votes, 0, 5, true);

            foreach ($largest as $key => $value) {
                $post = Post::find($key);
                $mostvotes[] = $value;
                $postnames[] = $post->title;
            }
            $json_votes = json_encode($mostvotes);
            $json_posts = json_encode($postnames);
        }else{
               $json_votes = '';
               $json_posts = '';
        }

        $movies = Post::where('type', 'movies')->count();
        $series = Post::where('type', 'series')->count();
        $blogs = Blog::count();
        $users = User::count();

        return \view('Panel.Dashboard', compact([
            'movies',
            'series',
            'blogs',
            'users',
            'day_json',
            'visits_json',
            'json_votes',
            'json_posts'

        ]));
    }
}
