<?php

namespace App\Http\Controllers\Panel;

use App\Post;
use App\Actor;
use App\Image;
use App\Season;
use App\Writer;
use App\Episode;
use App\Quality;
use App\Section;
use App\Setting;
use App\Category;
use App\Director;
use App\Language;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Image as ImageInvention;

class SeriesController extends Controller
{
    public function SeriesList(Request $request)
    {
        if (isset($request->type) && $request->type == 'documentary') {
            $data['series'] = Post::where('type', 'documentary')->latest()->get();
            $data['title'] = 'مستند';
            $data['type'] = 'documentary';
        } else {
            $data['series'] = Post::where('type', 'series')->latest()->get();
            $data['title'] = 'سریال';
            $data['type'] = 'series';
        }

        return view('Panel.Series.List', $data);
    }

    public function Add()
    {
        if (isset(request()->type) && request()->type == 'documentary') {
            $data['type'] = 'documentary';
        } else {
            $data['type'] = 'series';
        }

        $data['actors'] = Actor::all();
        $data['writers'] = Writer::all();
        $data['directors'] = Director::all();
        $data['languages'] = Language::all();

        return view('Panel.Series.add', $data);
    }

    public function Save(Request $request)
    {

        $slug = Str::slug($request->name);
        if (isset($request->t) && $request->t == 'documentary') {
            $destinationPath = "files/documentaries/$slug";
            $post_type = 'documentary';
            $message = 'مستند با موفقیت ثبت شد';
            $q = '&type=documentary';
        } else {
            $destinationPath = "files/series/$slug";
            $post_type = 'series';
            $message = 'سریال با موفقیت ثبت شد';
            $q = '&';
        }




        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }

        $post = new Post;
        $post->post_author = Auth::guard('admin')->user()->id;
        $post->title = $request->title;
        $post->name = $request->name;
        $post->slug = $slug;
        $post->type = $post_type;
        $post->description = $request->desc;
        $post->short_description = $request->short_desc;

        $serialized = $this->serialize_poster($request, $request->file('poster'), $destinationPath);

        if ($request->last_release) {
            $post->year = Carbon::parse($request->last_release)->format('Y');
        } else {
            $post->year = Carbon::parse($request->first_release)->format('Y');
        }
        $post->poster = $serialized;
        $post->duration = $request->duration;
        $post->age_rate = $request->age_rate;
        $post->awards = $request->awards;

        $post->comment_status = isset($request->commentstatus) && $request->commentstatus == '1' ? 'enable' : 'disable';

        if ($post->save()) {

            $this->saveData($request, $destinationPath, $post);
        } else {
            return back();
        }

        toastr()->success($message);
        return Redirect::route('Panel.SeriesList') .'?id='.$post->id . $q;
    }


    public function Edit(Post $post)
    {
        return view('Panel.Series.add', compact(['post']));
    }

    public function EditSerie(Request $request, Post $post)
    {

        // dd($request->all());

        $slug = Str::slug($post->name);

        if (isset($request->t) && $request->t == 'documentary') {
            $destinationPath = "files/documentaries/$slug";
            $post_type = 'documentary';
            $message = 'مستند با موفقیت ویرایش شد';
            $q = '?type=documentary';
        } else {
            $destinationPath = "files/series/$slug";
            $post_type = 'series';
            $message = 'سریال با موفقیت ویرایش شد';
            $q = '';
        }

        $destinationPath = "files/series/$slug";
        if ($request->hasFile('poster')) {
            $this->deletePosters($post);


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
        $post->name = $request->name;
        $post->type = $post_type;
        $post->description = $request->desc;
        $post->short_description = $request->short_desc;





        $post->poster = $Poster;
        $post->duration = $request->duration;
        $post->age_rate = $request->age_rate;
        $post->awards = $request->awards;
        $post->comment_status = isset($request->commentstatus) && $request->commentstatus == '1' ? 'enable' : 'disable';

        $post->update();

        $this->editData($request, $destinationPath, $post);

        toastr()->success($message);

       return Redirect::route('Panel.SeriesList') . $q;
    }

    public function InsertSeason(Request $request, $id)
    {

        $post = Post::find($id);
        $slug = Str::slug($post->name);
        $destinationPath = "files/series/$slug";
        $Poster = $this->savePoster($request->file('poster'), 'season_' . $request->number . '_', $destinationPath);


        Season::create([
            'name' => $request->title,
            'number' => $request->number,
            'description' => $request->desc,
            'poster' => $Poster,
            'publish_date' => Carbon::parse($request->release)->toDateTimeString(),
            'post_id' => $request->serie
        ]);
        toastr()->success('فصل با موفقیت اضافه شد');

        return back();
    }


    public function EditSeason(Season $season)
    {
        if (!$season) abort(404);


        $series = Post::where('type', 'series')->latest()->get();
        $seasons = $season->serie->seasons;

        return view('Panel.Series.season', compact(['series', 'seasons', 'season']));
    }


    public function EditSection(Episode $section)
    {
       


        $sections = Episode::where('post_id',$section->post_id)->OrderBy('section', 'ASC')->get();

        return view('Panel.Series.section', compact(['sections', 'section']));
    }

    public function SaveEditSeason(Request $request, Season $season)
    {



        $serie = $season->serie;
        $slug = Str::slug($serie->name);
        $destinationPath = "files/series/$slug";
        if ($request->hasFile('poster')) {
            File::delete(public_path() . '/' . $season->poster);
            $Poster = $this->savePoster($request->file('poster'), 'season_' . $request->number . '_', $destinationPath);
        } else {
            $Poster = $season->poster;
        }
        $season->update([
            'name' => $request->title,
            'description' => $request->desc,
            'poster' => $Poster,
            'publish_date' => Carbon::parse($request->release)->toDateTimeString(),
        ]);
        toastr()->success('فصل با موفقیت ویرایش شد');
        return back();
    }
    public function SaveEditSection(Request $request, Episode $section)
    {

        $serie = $section->serie;
        // dd($section);
        $slug = Str::slug($serie->name);
        $destinationPath = "files/series/$slug";
        if ($request->hasFile('poster')) {
            File::delete(public_path() . '/' . $section->poster);
            $slug = Str::slug($serie->name);
            $destinationPath = "files/series/$slug";
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'section_' . $request->number . '_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move(public_path($destinationPath), $fileName);
            $Poster = "$destinationPath/$fileName";
        } else {
            $Poster = $section->poster;
        }


        Episode::whereId($section->id)->update([
            'name' => $request->title,

            'description' => $request->desc,
            'poster' => $Poster,
            'publish_date' => Carbon::parse($request->release)->toDateTimeString(),

        ]);

        $videos = $section->videos();
        foreach ($videos as $key => $video) {
            $video->captions()->delete();
        }
        $videos->delete();

        foreach ($request->file as $key => $file) {
            if ($id = Quality::check($file[2])) {
                $quality_id = $id;
            } else {
                $quality = Quality::create(['name' => $file[2]]);
                $quality_id = $quality->id;
            }

            $video = $section->videos()->create([
                'url' => $file[1],
                'quality_id' => $quality_id
            ]);
        }

        if (isset($request->captions)) {
            $this->SaveCaption($request, $section, $destinationPath);
        }


        toastr()->success('قسمت با موفقیت ویرایش شد');

        return back();
    }





    public function AddSection($id)
    {

        $data['serie'] = Post::find($id);
        if (isset(request()->season)) {
            $data['season'] = Season::find(request()->season);
            $data['sections'] = $data['season']->sections()->orderBy('section','asc')->get();
        } else {
           
            $data['sections'] = $data['serie']->episodes()->orderBy('section','asc')->get();
        }

        if ($data['serie']->imdbID && isset(request()->season)) {

            $url = 'http://www.omdbapi.com/?i=' . $data['serie']->imdbID . '&Season=' . $data['season']->number . '&apikey=72a95dff';
            // dd($url);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $result = json_decode($response);
            curl_close($ch); // Close the connection

            $data['title'] = $result->Title;
            $data['episodes'] = $result->Episodes;
        } else {
            $data['episodes'] = [];
            $data['title'] = null;
        }
        // dd($episodes);


        return view('Panel.Series.section', $data);
    }

    public function InsertSection(Request $request)
    {
        // dd($request->all());
      

        $post = Post::find($request->serie);
        $slug = Str::slug($post->name);

        if ($request->type == 'documentary') {
            $destinationPath = "files/documentaries/$slug";
        } else {
            $destinationPath = "files/series/$slug";
        }

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);
        }


        if ($request->hasFile('poster')) {
            $picextension = $request->file('poster')->getClientOriginalExtension();
            $fileName = 'section_' . $request->number . '_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $request->file('poster')->move($destinationPath, $fileName);
            $Poster = "$destinationPath/$fileName";
        } elseif ($request->has('posterImdb') && $request->posterImdb !== null) {
            $img = $destinationPath . '/' . 'section_' . basename($request->posterImdb);
            file_put_contents($img, $this->url_get_contents($request->posterImdb));
            $Poster = $img;
        } else {
            $Poster = '';
        }






        $episode =  Episode::create([
            'name' => $request->title,
            'description' => $request->desc,
            'duration' => $request->runtime,
            'poster' => $Poster,
            'publish_date' => $request->release !== 'N/A' ? Carbon::parse($request->release)->toDateTimeString() : '',
            'section' => $request->number,
            'season' => $request->season,
            'post_id' => $request->serie,
            'imdbID' => $request->imdbID,
            'imdbRating' => $request->imdbRating,
        ]);

        if (isset($request->file)) {
            foreach ($request->file as $key => $file) {
                if ($id = Quality::check($file[2])) {
                    $quality_id = $id;
                } else {
                    $quality = Quality::create(['name' => $file[2]]);
                    $quality_id = $quality->id;
                }
                $video = $episode->videos()->create([
                    'url' => $file[1],
                    'quality_id' => $quality_id
                ]);
            }
        }

        if (isset($request->captions)) {
            $this->SaveCaption($request, $episode, $destinationPath);
        }



        toastr()->success('قسمت با موفقیت اضافه شد');

        return back();
    }


    public function GetSeriesAjax(Request $request)
    {

        $seasons = Season::where('post_id', $request->data)->latest()->get();

        return response()->json($seasons, 200);
    }

    public function DeleteSection(Request $request)
    {
        $section = Episode::find($request->section_id);
        File::delete(public_path() . '/' . $section->poster);

        $section->videos()->delete();
        $section->captions()->delete();
        $section->delete();
        toastr()->success('قسمت با موفقیت حذف شد');
        return back();
    }

    public function DeleteSeason(Request $request)
    {
        $season = Season::find($request->season_id);
        File::delete(public_path() . '/' . $season->poster);
        foreach ($season->sections as $key => $section) {

            $section->captions()->delete();
            $section->videos()->delete();
            File::delete(public_path() . '/' . $section->poster);
        }

        $season->sections()->delete();

        $season->delete();



        toastr()->success('فصل با موفقیت حذف شد');
        return back();
    }

    public function AddSeason($id)
    {
        // dd($id);
        $post = Post::find($id);
        if ($post->imdbID) {
            $dd = \L5Imdb::title($post->imdbID)->all();
           
            $totalSeasons = $dd['seasons'];
            $title = $dd['title'];
        } else {
            $totalSeasons = null;
            $title = null;
        }

        $seasons = $post->seasons;

        return view('Panel.Series.season', compact(['seasons', 'id', 'totalSeasons', 'title']));
    }


    public function getSectionImdbData(Request $request)
    {
        //    dd($request->all());


        $serie = Post::find($request->serieId);

        $url = 'http://www.omdbapi.com/?i=' . $serie->imdbID . '&Season=' . $request->seasonNumber . '&Episode=' . $request->episode . '&apikey=72a95dff';
      
        $url = str_replace(' ', '%20', $url);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch); // Close the connection
       
        $array['title'] = $result->Title;

        $array['released'] = \Carbon\Carbon::parse($result->Released)->format('d F Y');
        // dd($array['released']);
        $array['runtime'] = $result->Runtime;
        $array['desc'] = $result->Plot;
        $array['imdbID'] = $result->imdbID;
        $array['poster'] = $result->Poster;
        $array['imdbRating'] = $result->imdbRating;
        $array['year'] = $result->Year;


        return response()->json($array, 200);
    }
}
