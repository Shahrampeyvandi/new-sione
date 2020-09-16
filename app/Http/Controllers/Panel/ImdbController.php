<?php

namespace App\Http\Controllers\Panel;

use Image;
use Goutte;
use App\Post;
use App\Actor;
use App\Writer;
use App\Category;
use App\Director;
use App\Language;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ImdbController extends Controller
{

    public function AddMovie()
    {

        $actors = Actor::all();
        $writers = Writer::all();
        $directors = Director::all();
        $languages = Language::all();

        return view('Panel.Movies.add', compact(['writers', 'directors', 'actors', 'languages']));
    }



    public function testApi($id)
    {

        // $url = 'http://www.omdbapi.com/?i=tt0944947&Season=1&apikey=72a95dff';
        // $url = str_replace(' ', '%20', $url);
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);
        // $result = json_decode($response);
        // curl_close($ch); // Close the connection
        // dd($result);

        // $dd = \L5Imdb::person('1125275')->all();
        // dd($dd);
        // $actor = \L5Imdb::searchPerson('daniel Radcliffe')->all()[0];
        // dd($actor);
    }
    public function Get(Request $request)
    {



        // check in db
        if (Post::where('imdbID', $request->code)->count()) {
            return response()->json(['error' => 'این مورد از قبل ثبت شده است']);
        }

        $array = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://www.omdbapi.com/?i=' . $request->code . '&apikey=72a95dff');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch); // Close the connection

        if ($result->Writer) {
            $writers = \explode(',', $result->Writer);
            foreach ($writers as $key => $item) {
                $item = trim(preg_replace('/\s*\([^)]*\)/', '', $item));
                $check = Writer::whereName($item)->first();
                if ($check) {
                    $array['writers'][] = ['name' => $item, 'src' => $check->image];
                } else {
                    $array['writers'][] = ['name' => $item, 'src' => ''];
                }
            }
        } else {
            $array['writers'][] = '';
        }

        $array['released'] = $result->Released;
        $array['imdbRating'] = $result->imdbRating;
        $array['imdbID'] = $result->imdbID;
        $array['imdbVotes'] = $result->imdbVotes;
        $array['Awards'] = $result->Awards;

        $array['Released'] = $result->Released;

        $dd = \L5Imdb::title($request->code)->all();
        // dd($dd,$result);
        if (isset($request->type)) {
            if ($request->type == 'documentary') {
                if ($dd['genre'] !== 'Documentary') {
                    return response()->json(['error' => 'کد مربوط به مستند نمیباشد']);
                }
            } else {
                if ($dd['genre'] == 'Documentary') {
                    return response()->json(['error' => 'کد مربوط به مستند میباشد']);
                }
            }
        }

        if (isset($dd['creator'][0]['imdb'])) {
            $creator =   \L5Imdb::person($dd['creator'][0]['imdb'])->all();
            $id = Director::check($creator['name']);
            $array['directors'][] = ['name' => $creator['name'] !== 'N/A' ? $creator['name'] : null ];
            if (!$id && $creator['name'] !== 'N/A') {
                if (array_key_exists('photo', $creator) && $creator['photo'] ) {
                    $img = "creators/" . basename($creator['photo']);
                    file_put_contents($img, $this->url_get_contents($creator['photo']));
                    $resize = $this->image_resize(200, 300, $img, "creators");
                    File::delete(public_path() . '/' . $img);
                }

                
                    Director::create([
                        'name' => $creator['name'],
                        'image' => $resize
                    ]);
                
            }
        } else {
            $array['directors'][] = ['name' => null];
        }


        if (isset($dd['top250'])) {
            $array['top250'] = $dd['top250'];
        } else {
            $array['top250'] = null;
        }

        // $array['is_serial'] = $dd['is_serial'] ? 'series' : 'movies';
        if ($dd['is_serial']) {
            $array['seasons'] = $dd['seasons'];
        } else {
            $array['seasons'] = null;
        }


        if (isset($dd['cast'])) {
            foreach ($dd['cast'] as $key => $actor) {

                $id = Actor::check($actor['name']);
                if (!$id) {
                    if (array_key_exists('photo', $actor) && $actor['photo']) {

                        $img = "actors/" . basename($actor['photo']);
                        file_put_contents($img, $this->url_get_contents($actor['photo']));

                        $resize = $this->image_resize(200, 300, $img, "actors");
                        File::delete(public_path() . '/' . $img);
                    } else {
                        $resize = null;
                    }

                    Actor::create([
                        'name' => $actor['name'],
                        'image' => $resize,
                    ]);
                }
            }
        }

        $latin_cats = $dd['genres'];
        $array['runtime'] = $dd['runtime'];
        $array['title'] = $dd['title'];
        $array['year'] = $dd['year'];
        $array['storyline'] = $dd['storyline'];
        $array['runtime'] = $dd['runtime'];
        $array['photoThumb'] = $dd['photoThumb'];
        $array['photo'] = $dd['photo'];
        $array['languages'] = $dd['languages'];
        $cat_list = '';

        foreach (Category::all() as $key => $category) {

            $cat_list .= ' <div class="custom-control custom-checkbox custom-control-inline ">
                <input type="checkbox" id="cat-' . ($key + 1) . '" name="categories[]" value="' . $category->latin . '" class="custom-control-input scat" 
                ' . (in_array($category->latin, $dd['genres']) ? 'checked' : '') . '>
                <label class="custom-control-label" for="cat-' . ($key + 1) . '">' . $category->name . '</label>
            </div>';
        }
        $array['catlist'] = $cat_list;
        foreach ($dd['cast'] as $key => $cast) {
            $array['casts'][] = [$cast['name'], $cast['photo']];
        }

        foreach ($dd['mainPictures'] as $key => $image) {
            $array['mainPictures'][] = $image['bigsrc'];
        }

        return response()->json($array, 200);
    }
}
