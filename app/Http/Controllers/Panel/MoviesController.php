<?php

namespace App\Http\Controllers\Panel;

use Goutte;
use App\Post;
use App\Actor;
use App\Caption;
use App\Image;
use App\Video;
use App\Writer;
use App\Episode;
use App\Quality;
use App\Category;
use App\Director;
use App\Language;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image as ImageInvention;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class MoviesController extends Controller
{

    function MoviesList(Request $request)
    {

        $movies = Post::where('type', 'movies')->latest()->get();


        return view('Panel.Movies.List', compact(['movies']));
    }



    public function Add()
    {



        $actors = Actor::all();
        $writers = Writer::all();
        $directors = Director::all();
        $languages = Language::all();

        return view('Panel.Movies.add', compact(['writers', 'directors', 'actors', 'languages']));
    }




    public function Save(Request $request)
    {

        // dd($request->all());

        $slug = Str::slug($request->name);
        $destinationPath = "files/movies/$slug";
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }

        $post = new Post;
        $post->post_author = Auth::guard('admin')->user()->id;
        $post->title = $request->title;
        $post->name = $request->name;
        $post->slug = $slug;
        $post->type = 'movies';
        $post->description = $request->desc;
        $post->short_description = $request->short_desc;


        $serialized = $this->serialize_poster($request, $request->file('poster'), $destinationPath);


        $post->year = Carbon::parse($request->released)->format('Y');
        $post->poster = $serialized;
        $post->duration = $request->duration;

        $post->awards = $request->awards;
        $post->comment_status = isset($request->commentstatus) && $request->commentstatus == '1' ? 'enable' : 'disable';

        if ($post->save()) {
            $this->saveData($request, $destinationPath, $post);
        } else {
            return back();
        }
        toastr()->success('پست با موفقیت ثبت شد');
        return Redirect::route('Panel.MoviesList');
    }

    public function Edit(Post $post)
    {


        return view('Panel.Movies.add', compact(['post']));
    }



    public function AddEpisode()
    {
        $id = request()->id;
        if ($id) {
            $post = Post::find($id);
            $episodes = $post->episodes;
        } else {
            $episodes = [];
            $post = null;
        }
        return view('Panel.Files.AddEpisode', compact(['id', 'episodes', 'post']));
    }

    public function SaveEpisode(Request $request)
    {

        $post = Post::find($request->post);
        if (request()->hasFile('thumb')) {
            $destinationPath = 'files/series/thumbs';
            $picextension = request()->file('thumb')->getClientOriginalExtension();
            $fileName = $post->name . '-' . $request->season . '-' . $request->section . date("Y-m-d") . '_' . time() . '.' . $picextension;
            request()->file('thumb')->move($destinationPath, $fileName);
            $thumb = "$destinationPath/$fileName";
        } else {
            $thumb = '';
        }

        $episode = $post->episodes()->create([
            'name' => $request->name,
            'duration' => '00',
            'description' => $request->description,
            'poster' => $thumb,
            'season' => $request->season,
            'section' => $request->section,
        ]);

        return Redirect::route('Panel.UploadVideo', ['id' => $post->id, 'episode' => $episode->id]);
    }

    public function EditMovie(Request $request, Post $post)
    {


        // dd($request->all());
        // $slug = Str::slug($post->name);
        $destinationPath = "files/movies/$request->slug";
        if ($request->hasFile('poster')) {
            File::deleteDirectory(public_path("files/movies/$post->slug/"));
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $serialized = $this->serialize_poster($request, $request->file('poster'), $destinationPath);

            $Poster = $serialized;
        } else {
            $Poster = $post->poster;
        }

        $post->post_author = Auth::guard('admin')->user()->id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->name = $request->name;
        $post->type = 'movies';
        $post->description = $request->desc;
        $post->short_description = $request->short_desc;

        $post->released = Carbon::parse($request->released)->toDateTimeString();



        $post->poster = $Poster;
        $post->duration = $request->duration;

        $post->awards = $request->awards;
        $post->comment_status = isset($request->commentstatus) && $request->commentstatus == '1' ? 'enable' : 'disable';

        $post->update();

        $this->editData($request, $destinationPath, $post);

        toastr()->success('پست با موفقیت ویرایش شد');
        return Redirect::route('Panel.MoviesList');
    }

    public function DeletePost(Request $request)
    {

        $post = Post::find($request->post_id);
        $post->sliders()->delete();
        if ($post->type == 'series') {

            $destinationPath = "files/series/$post->slug/";
        }
        if ($post->type == 'movies') {

            $destinationPath = "files/videos/$post->slug/";
        }
        if ($post->type == 'documentary') {

            $destinationPath = "files/documentaries/$post->slug/";
        }
        File::deleteDirectory(public_path($destinationPath));



        if ($post->type == 'series' || $post->type == 'documentary') {
            if (count($post->seasons)) {
                foreach ($post->seasons as $key => $season) {
                    foreach ($season->sections as $key => $section) {
                        $section->videos()->delete();
                        $section->captions()->delete();
                    }
                    $season->sections()->delete();
                    $season->delete();
                }
            }
            $post->episodes()->delete();
        }
        $post->categories()->detach();
        $post->actors()->detach();
        $post->delete();

        toastr()->success('پست با موفقیت حذف شد');
        return back();
    }

    public function DeleteVideo(Request $request)
    {

        $video = Video::find($request->id);
        File::delete(public_path() . $video->url);
        foreach ($video->captions as $key => $caption) {
            $caption->delete();
        }
        $video->delete();
        return response()->json('ویدیو با موفقیت حذف شد');
    }

    public function DeleteImage(Request $request)
    {
        $image = Image::find($request->id);
        File::delete(public_path() .'/'. $image->url);
        $image->delete();
        return response()->json('تصویر با موفقیت حذف شد');
    }


    public function AddCatAjax(Request $request)
    {

        $cat = new Category;
        $cat->name = $request->name;
        $cat->latin = ucwords(strtolower($request->latin));
        $cat->save();

        return 'true';
    }


    public function checkNameAjax(Request $request)
    {
        // check in db
        if (Post::where('name', $request->name)->count()) {
            return response()->json(['error' => 'این مورد از قبل ثبت شده است']);
        }
    }

    public function DeleteCaption(Request $request)
    {
        $caption = Caption::find($request->id);
        File::delete(public_path() . $caption->url);
        $caption->delete();
        return response()->json('success', 200);
    }

    public function converSubtitle(Request $request, $destinationPath)
    {

        foreach ($request->captions as $key => $caption) {
            if (array_key_exists(1, $caption) &&   array_key_exists(2, $caption)  &&  !is_null($caption[1]) && !is_null($caption[2])) {
                $ext = 'vtt';
                $fileName = 'vtt_' . date("Y-m-d") . '_' . time() . '.' . $ext;
                //-------------------
                $fileHandle = fopen($caption[2], 'r');

                if ($fileHandle) {
                    $lines = array();
                    while (($line = fgets($fileHandle, 8192)) !== false) $lines[] = $line;
                    if (!feof($fileHandle)) exit("Error: unexpected fgets() fail\n");
                    else ($fileHandle);
                }
                $length = count($lines);
                for ($index = 1; $index < $length; $index++) {
                    if ($index === 1 || trim($lines[$index - 2]) === '') {
                        $lines[$index] = str_replace(',', '.', $lines[$index]);
                    }
                }
                for ($index = 0; $index < $length; $index++) {
                    $ttttt = trim($lines[$index]);
                    if (ctype_digit($ttttt)) {
                        echo 'n= ' . $index . ' is=' . $lines[$index] . '</br>';
                        $lines[$index] = '';
                    }
                }
                $header = "WEBVTT\n\n";
                $vttPath = "$destinationPath/$fileName";
                file_put_contents($vttPath, $header . implode('', $lines));
            }
        }
    }
}
