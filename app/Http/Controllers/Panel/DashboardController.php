<?php

namespace App\Http\Controllers\Panel;

use App\Blog;
use App\BugReport;
use App\Post;
use App\User;
use App\Visit;
use App\Category;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Http\Controllers\Controller;
use App\MovieRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

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
        } else {
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

    public function get_content_noty(Request $request)
    {
        // dd($request->all());
        if ($request->type == 'bug') {
            $model = BugReport::find($request->id);
            $content = $model->name;
            $user = User::find($model->user_id);
            $name = $user->first_name;
            $family = $user->last_name;
        }

        if ($request->type == 'req') {
            $model = MovieRequest::find($request->id);
            $content = $model->name;
            $user = User::find($model->user_id);
            $name = $user->first_name;
            $family = $user->last_name;
        }

        $content = "<div class='text-right'>$content</div>";
        $user = '<div class="text-right">' . $name . ' ' . $family . '</div>';
        return Response::json(['content' => $content, 'user' => $user], 200);
    }

    public function read_noty(Request $request)
    {
        if ($request->type == 'bug') {
            $model = BugReport::find($request->id);
            $model->new = 0;
            $model->update();
        }

        if ($request->type == 'req') {
            $model = MovieRequest::find($request->id);
            $model->new = 0;
            $model->update();
        }

        return Response::json('success', 200);
    }

    public function delete_noty(Request $request)
    {
        if ($request->type == 'bug') {
            $model = BugReport::find($request->id);
            $model->delete();
        }

        if ($request->type == 'req') {
            $model = MovieRequest::find($request->id);
            $model->delete();
        }

        return Response::json('success', 200);
    }
}
