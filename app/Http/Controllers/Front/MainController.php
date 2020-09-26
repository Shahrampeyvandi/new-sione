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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Writer;
use Illuminate\Support\Facades\Route;
use function GuzzleHttp\Psr7\try_fopen;

class MainController extends Controller
{
    public function index()
    {


        $data['year'] = Carbon::now()->year;
        $data['newsione'] = Post::where(['comming_soon' => 0])->latest()->take(10)->get();
        $data['newseries'] = Post::where(['type' => 'series', 'comming_soon' => 0])->latest()->take(10)->get();
        $data['newyear'] = Post::where(['year' => $data['year'], 'comming_soon' => 0])->latest()->take(10)->get();

        $data['latestdoble'] = Post::whereHas('categories', function ($q) {
            $q->where('name', 'دوبله فارسی');
        })->where(['comming_soon' => 0])->latest()->take(10)->get();
        $data['newmovies'] = Post::where(['type' => 'movies', 'comming_soon' => 0])->latest()->take(10)->get();
        $data['sliders'] = Slider::latest()->get();
        $data['adverts'] = AdvertImage::orderBy('created_at', 'DESC')->take(12)->get();
        $data['updated_series'] = Post::where('comming_soon', 0)->where('type', '!=', 'movies')->whereHas('episodes', function ($q) {
            $q->where('created_at', '>', Carbon::now()->subDays(30));
        })->latest()->take(10)->get();
        $data['top250'] = Post::where('comming_soon', 0)->where('top_250', '!=', null)->orderBy("top_250", "desc")->take(10)->get();
        $data['animations'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Animation');
        })->inRandomOrder()->take(10)->get();

        $data['documentaries'] =  Post::where(['type' => 'documentary', 'comming_soon' => 0])->inRandomOrder()->take(10)->get();
        $data['actions'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Action');
        })->inRandomOrder()->take(10)->get();
        $data['scifis'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Sci-Fi');
        })->inRandomOrder()->take(10)->get();
        $data['horrors'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Horror');
        })->inRandomOrder()->take(10)->get();
        $data['comedies'] = Post::whereHas('categories', function ($q) {
            $q->where('latin', 'Comedy');
        })->inRandomOrder()->take(10)->get();
        $data['blogs'] = Blog::latest()->take(10)->get();

        $data['collections'] = Collection::has('posts')->inRandomOrder()->take(12)->get();
        $data['title'] = 'صفحه اصلی';

        // dd($data);
        return view('Front.index', $data);
    }

    public function Play()
    {
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
        }
        if ($model->type !== 'movies') {
            if (isset(request()->season)) {
                $season = $model->seasons->where('name', request()->season)->first();
                if (!$season) {
                    abort(404);
                }
                $post = $season->sections->where('section', request()->section)->first();
                if (!$post) {
                    abort(404);
                }
                $title = "Sione | $model->title - $post->name ";
                $videos = $post->videos;
            } else {
                $post = $model->episodes()->where('section', request()->section)->first();
                $videos = $post->videos;
                $title = "Sione | $model->title - $post->name ";
            }
        }


        return view('Front.play', compact(['videos', 'post', 'title']));
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

        $year = Carbon::now()->year;
        $c = request()->c;
        $type = request()->type;

        if ($c == 'collections') {
            if ($type == 'all') {
                $data['posts'] = Collection::latest()->get();
                $data['title'] = 'مجموعه فیلم ها';
                $data['type'] = 'collection';
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
        if ($c == 'doble') {
            if ($type == 'all') {
                $data['posts'] = Post::whereHas('categories', function ($q) {
                    $q->where('name', 'دوبله فارسی');
                })->where(['comming_soon' => 0])->latest()->get();
                $data['title'] = 'دوبله فارسی';
            }
            if ($type == 'movie') {
                $data['posts'] = Post::whereHas('categories', function ($q) {
                    $q->where('name', 'دوبله فارسی');
                })->where(['comming_soon' => 0, 'type' => 'movies'])->latest()->get();
                $data['title'] = 'دوبله فارسی';
            }
            if ($type == 'serie') {
                $data['posts'] = Post::whereHas('categories', function ($q) {
                    $q->where('name', 'دوبله فارسی');
                })->where(['comming_soon' => 0, 'type' => 'series'])->latest()->get();
                $data['title'] = 'دوبله فارسی';
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
        if ($c == 'action') {
            if ($type == 'all') {
                $data['posts'] =  Post::where(['comming_soon' => 0])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Action');
                })->latest()->get();
                $data['title'] = 'اکشن';
            }

            if ($type == 'movie') {
                $data['posts'] =  Post::where(['comming_soon' => 0, 'type' => 'movies'])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Action');
                })->latest()->get();
                $data['title'] = 'اکشن';
            }
        }
        if ($c == 'animation') {
            if ($type == 'all') {
                $data['posts'] =  Post::where(['comming_soon' => 0])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Animation');
                })->latest()->get();
                $data['title'] = 'انیمیشن';
            }

            if ($type == 'movie') {
                $data['posts'] =  Post::where(['comming_soon' => 0, 'type' => 'movies'])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Animation');
                })->latest()->get();
                $data['title'] = 'انیمیشن';
            }
        }
        if ($c == 'sci-fi') {
            if ($type == 'all') {
                $data['posts'] =  Post::where(['comming_soon' => 0])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Sci-Fi');
                })->latest()->get();
                $data['title'] = 'ابر قهرمانی';
            }

            if ($type == 'movie') {
                $data['posts'] =  Post::where(['comming_soon' => 0, 'type' => 'movies'])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Sci-Fi');
                })->latest()->get();
                $data['title'] = 'ابر قهرمانی';
            }
        }
        if ($c == 'horror') {
            if ($type == 'all') {
                $data['posts'] =  Post::where(['comming_soon' => 0])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Horror');
                })->latest()->get();
                $data['title'] = 'ترسناک';
            }

            if ($type == 'movie') {
                $data['posts'] =  Post::where(['comming_soon' => 0, 'type' => 'movies'])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Horror');
                })->latest()->get();
                $data['title'] = 'ترسناک';
            }
        }

        if ($c == 'comedy') {
            if ($type == 'all') {
                $data['posts'] =  Post::where(['comming_soon' => 0])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Comedy');
                })->latest()->get();
                $data['title'] = 'کمدی';
            }

            if ($type == 'movie') {
                $data['posts'] =  Post::where(['comming_soon' => 0, 'type' => 'movies'])->whereHas('categories', function ($q) {
                    $q->where('latin', 'Comedy');
                })->latest()->get();
                $data['title'] = 'کمدی';
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

        return view('Front.ShowMore', $data);
    }
}
