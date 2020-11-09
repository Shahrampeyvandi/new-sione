<?php

namespace App\Http\Controllers\Front;

use App\Blog;
use App\Post;
use App\Actor;
use App\Slider;
use ZipArchive;
use App\Episode;
use App\Director;
use Carbon\Carbon;
use App\Collection;
use App\AdvertImage;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LastPlayed;
use App\Writer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use function GuzzleHttp\Psr7\try_fopen;

class MainController extends Controller
{
    public function index()
    {

        // dd(auth()->guard('admin')->user());


        $data['year'] = Carbon::now()->year;
        $data['newsione'] = Post::where(['comming_soon' => 0])->latest()->take(10)->get();
        $data['newseries'] = Post::where(['type' => 'series', 'comming_soon' => 0])->latest()->take(10)->get();
        $data['newyear'] = Post::where(['year' => $data['year'], 'comming_soon' => 0])->latest()->take(10)->get();


        $data['newmovies'] = Post::where(['type' => 'movies', 'comming_soon' => 0])->latest()->take(10)->get();
        $data['sliders'] = Slider::latest()->get();
        $data['adverts'] = AdvertImage::orderBy('created_at', 'DESC')->take(12)->get();
        $data['updated_series'] = Post::where('comming_soon', 0)->where('type', '!=', 'movies')->whereHas('episodes', function ($q) {
            $q->where('created_at', '>', Carbon::now()->subDays(30));
        })->latest()->take(10)->get();
        $data['top250'] = Post::where('comming_soon', 0)->where('top_250', '!=', null)->orderBy("top_250", "desc")->take(10)->get();
        $data['animations'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Animation');
        })->whereType('movies')->inRandomOrder()->take(10)->get();

        $data['documentaries'] =  Post::where(['type' => 'documentary', 'comming_soon' => 0])->inRandomOrder()->take(10)->get();
        $data['actions'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Action');
        })->whereType('movies')->inRandomOrder()->take(10)->get();
        $data['latestdoble'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Double');
        })->whereType('movies')->inRandomOrder()->take(10)->get();
        $data['scifis'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Sci-Fi');
        })->whereType('movies')->inRandomOrder()->take(10)->get();
        $data['horrors'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Horror');
        })->whereType('movies')->inRandomOrder()->take(10)->get();
        $data['comedies'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Comedy');
        })->whereType('movies')->inRandomOrder()->take(10)->get();
        $data['blogs'] = Blog::latest()->take(10)->get();

        $data['collections'] = Collection::has('posts')->inRandomOrder()->take(12)->get();
        $data['title'] = 'صفحه اصلی';

        // dd($data);
        if (Auth::guard('admin')->check()) {
            $role = 'admin';
            $user_id = Auth::guard('admin')->user()->id;
        } else {
            $role = 'member';
            $user_id = Auth::user()->id;
        }

        $data['last_played'] = LastPlayed::where(['user_id' => $user_id, 'user_role' => $role])->orderBy('updated_at', 'desc')->get();



        return view('Front.index', $data);
    }

    public function Play()
    {
        if (Auth::guard('admin')->check()) {
            $role = 'admin';
            $user_id = Auth::guard('admin')->user()->id;
        } else {
            $role = 'member';
            $user_id = Auth::user()->id;
        }

        $model = Post::where('slug', request()->slug)->first();
        if (!$model) {
            abort(404);
        }
        $post = $model;
        if ($model->type == 'movies') {

            $title = "Sione | $model->title";
            $videos = $model->videos;


            if (count($videos) == 0) {
                return back();
            }
            $season_id = null;
            $section_id = null;
            $last_played =  LastPlayed::where(['post_id' => $model->id, 'user_id' => $user_id, 'user_role' => $role])->first();
            $current_time = $last_played ? $last_played->time : 0;
        }
        if ($model->type !== 'movies') {
            if (isset(request()->season)) {
                $season = $model->seasons->where('name', request()->season)->first();
                $season_id = $season->id;
                if (!$season) {
                    abort(404);
                }
                $post = $season->sections->where('section', request()->section)->first();
                $section_id = $post->id;
                if (!$post) {
                    abort(404);
                }
                $title = "Sione | $model->title - $post->name ";
                $videos = $post->videos;
                $last_played =  LastPlayed::where(['post_id' => $model->id, 'section_id' => $section_id, 'season_id' => $season_id, 'user_id' => $user_id, 'user_role' => $role])->first();
                 $current_time = $last_played ? $last_played->time : 0;
            } else {
                $season_id = null;
                $post = $model->episodes()->where('section', request()->section)->first();
                $section_id = $post->id;
                $videos = $post->videos;
                $title = "Sione | $model->title - $post->name ";
                $last_played =  LastPlayed::where(['post_id' => $model->id, 'section_id' => $section_id, 'user_id' => $user_id, 'user_role' => $role])->first();
                 $current_time = $last_played ? $last_played->time : 0;
            }
        }
        $type = $model->type;
        $post_id = $model->id;


        return view('Front.play', compact(['videos', 'post', 'post_id', 'title', 'type', 'season_id', 'section_id','current_time']));
    }

    public function Trailer()
    {

        $model = Post::where('slug', request()->slug)->first();
        if (!$model) {
            abort(404);
        }

        $trailer = $model->trailer;
        if (!$trailer) {
            abort(404);
        }

        $data['post'] = $model;
        $data['type'] = 'trailer';
        $data['post_id'] = null;
        $data['season_id'] = null;
        $data['section_id'] = null;

        $data['trailer_url'] = $trailer->url;
        $data['title'] = $data['post']->title;


        return view('Front.play', $data);
    }
    public function getDownLoadLinks(Request $request)
    {

        if (isset($request->episode) && $request->episode !== null) {
            $post = Episode::find($request->episode);
        } else {
            $post = Post::find($request->id);
        }
        $links = '';

        foreach ($post->videos as $key => $video) {
            $links .= '
            <a class="download-link" href="' . route('DownLoad', $post->id) . '?url=' . $video->url . '">دانلود با کیفیت ' . $video->quality->name . '</a>
            ';
        }
        foreach ($post->captions as $key => $caption) {
            $links .= '
            <a class="download-link" href="' . route('DownLoad', $post->id) . '?subtitle=' . $caption->url . '">دانلود زیرنویس ' . $caption->lang . '</a>
            ';
        }

        return $links;
    }



    public function DownLoad($id)
    {


        $post = Post::find($id);
        if (isset(request()->url)) {

            $url = request()->url;
        }
        if (isset(request()->subtitle)) {

            $url = asset(request()->subtitle);
        }

        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . basename($url) . "\"");

        readfile($url);
        exit();

        $path      = parse_url($url, PHP_URL_PATH);
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename  = pathinfo($path, PATHINFO_FILENAME);
        $filename = $post->slug . '.' . $extension;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($url));
        ob_clean();
        flush();
        readfile($url);

        // $tempImage = tempnam(sys_get_temp_dir(), $filename);
        // copy($url, $tempImage);
        // return response()->download($tempImage, $filename);
    }

    public function MyFavorite()
    {
        if (auth()->check()) {

            $myfavorites = auth()->user()->favorite;
        }
        if (auth()->guard('admin')->check()) {
            $myfavorites = auth()->guard('admin')->user()->favorite;
        }
        return view('Front.MyFavorite', compact('myfavorites'));
    }

    public function ShowMore()
    {
        // dd(request()->all());

        $year = Carbon::now()->year;
        $c = request()->c;
        $type = request()->type;
        $data['type'] = $type;
        $data['c'] = $c;

        $categories = Category::pluck('latin')->toArray();
        $categories = array_map('strtolower', $categories);
        // dd($categories);
        if (in_array($data['c'], $categories)) {

            if ($type == 'all') {
                $data['posts'] = Post::whereHas('categories', function ($q) {
                    $q->where('latin', request()->c);
                })->where(['comming_soon' => 0])->latest()->get();;
                $data['title'] = Category::whereLatin(request()->c)->first()->name;
            }
            if ($type == 'movie') {
                $data['posts'] = Post::whereHas('categories', function ($q) {
                    $q->where('latin', request()->c);
                })->where(['comming_soon' => 0, 'type' => 'movies'])->latest()->get();
                $data['title'] = Category::whereLatin(request()->c)->first()->name;
            }
            if ($type == 'serie') {
                $data['posts'] = Post::whereHas('categories', function ($q) {
                    $q->where('latin', request()->c);
                })->where(['comming_soon' => 0, 'type' => 'series'])->latest()->get();
                $data['title'] = Category::whereLatin(request()->c)->first()->name;
            }
        }






        if ($c == 'collections') {
            if ($type == 'all') {
                $data['posts'] = Collection::latest()->get();
                $data['title'] = 'مجموعه فیلم ها';
                $data['q'] = 'collection';
            }
        }
        if ($c == $year) {
            if ($type == 'all') {
                $data['posts'] = Post::where('year', $year)->latest()->get();
                $data['title'] = 'فیلم های امسال';
            }

            if ($type == 'movie') {
                $data['posts'] = Post::where(['year' => $year, 'type' => 'movies'])->latest()->get();
                $data['title'] = 'فیلم های امسال';
            }
            if ($type == 'serie') {
                $data['posts'] = Post::where(['year' => $year, 'type' => 'serie'])->latest()->get();
                $data['title'] = 'سریال های امسال';
            }
        }


        if ($c == 'updated') {
            if ($type == 'serie') {
                $data['posts'] =  Post::where(['type' => 'series', 'comming_soon' => 0])->whereHas('episodes', function ($q) {
                    $q->where('created_at', '>', Carbon::now()->subDays(7));
                })->latest()->get();
                $data['title'] = 'سریال های بروز شده';
            }
        }


        if ($c == 'top250') {
            if ($type == 'all') {
                $data['posts'] = Post::where('comming_soon', 0)->where('top_250', '!=', null)->orderBy("top_250", "desc")->get();
                $data['title'] = 'فیلم های برتر Imdb';
            }

            if ($type == 'movie') {
                $data['posts'] = Post::where('type', 'movies')->where('comming_soon', 0)->where('top_250', '!=', null)->orderBy("top_250", "desc")->get();
                $data['title'] = 'فیلم های برتر Imdb';
            }
        }

        if ($c == 'new') {
            if ($type == 'movie') {
                $data['posts'] = Post::where('type', 'movies')->latest()->get();
                $data['title'] = 'تازه ترین ها';
            }
            if ($type == 'serie') {
                $data['posts'] = Post::where('type', 'series')->latest()->get();
                $data['title'] = 'تازه ترین ها';
            }
            if ($type == 'documentary') {
                $data['posts'] = Post::where('type', 'documentary')->latest()->get();
                $data['title'] = 'مستندها';
            }
        }

        if ($c == 'newsione') {
            if ($type == 'all') {
                $data['posts'] = Post::where(['comming_soon' => 0])->latest()->take(10)->get();
                $data['title'] = 'تازه های سیوان';
            }
        }



        if (isset(request()->order)) {
            if (request()->order == 'asc') {
                $data['posts'] = $data['posts']->sortBy('year');
            }
            if (request()->order == 'desc') {
                $data['posts'] = $data['posts']->sortByDesc('year');
            }
            $data['order'] = request()->order;
        }



        return view('Front.ShowMore', $data);
    }

    public function CommingSoon()
    {
        $data['commingsoon'] = Post::where('comming_soon', 1)->latest()->get();
        $data['title'] = 'به زودی ';
        return view('Front.CommingSoon', $data);
    }
    public function ShowCast($name)
    {

        if (request()->type == 'actor') {
            $cast = Actor::whereName($name)->first();
            if ($cast) {
                $data['cast'] = $cast;
                $data['title'] = $name;
                $data['posts'] = Post::whereHas('actors', function ($q) use ($name) {
                    $q->where('name', $name);
                })->orderBy('year', 'desc')->get();
            } else {
                abort(404);
            }
        }
        if (request()->type == 'director' || request()->type == 'writer') {
            $cast = Director::whereName($name)->first();
            if ($cast) {
                $data['cast'] = $cast;
                $data['title'] = $name;
                $data['posts'] = Post::whereHas('directors', function ($q) use ($name) {
                    $q->where('name', $name);
                })->orWhereHas('writers', function ($q) use ($name) {
                    $q->where('name', $name);
                })->orderBy('year', 'desc')->get();
            }
        }



        return view('Front.Cast', $data);
    }

    public function ShowCollection($id)
    {
        if (!$id) abort(404);
        $collection = Collection::find($id);
        if (!$collection) abort(404);
        $data['collection'] = $collection;
        if ($collection->for == 'movies') {

            $data['posts'] = $collection->posts()->orderBy('released', 'asc')->get();
        } else {
            $data['posts'] = $collection->posts()->orderBy('year', 'asc')->latest()->get();
        }
        $data['title'] = $collection->name;
        $data['c'] = 'collections';
        $data['type'] = 'collection';

        return view('Front.ShowMore', $data);
    }

    public function LastPlayed()
    {

        // dd(request()->all());
        if (request()->type == 'trailer') {
            return false;
        }

        if (Auth::guard('admin')->check()) {
            $role = 'admin';
            $user_id = Auth::guard('admin')->user()->id;
        } else {
            $role = 'member';
            $user_id = Auth::user()->id;
        }

        $check =  LastPlayed::where(['post_id' => request()->id, 'user_id' => $user_id, 'user_role' => $role])->first();

        if (request()->q == 'remove') {
            $check->delete();
            return 'deleted';
        }

        if ($check) {
            $check->time = request()->time;
            $check->update();
        } else {
            if ((int)request()->time > 5) {
                $lastplayed = new LastPlayed;
                $lastplayed->user_id = $user_id;
                $lastplayed->time = request()->time;
                $lastplayed->user_role = $role;
                $lastplayed->post_id = request()->id;

                if (request()->type !== 'movies') {
                    $lastplayed->season_id = request()->season;
                    $lastplayed->section_id = request()->section;
                }
                $lastplayed->save();
            }
        }

        return 'success';
    }
}
