<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use App\Episode;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function Show($slug)
    {

    
        
        $data['post'] = Post::whereSlug($slug)->first();
        if (is_null($data['post'])) {
            abort(404);
        }
        $data['title'] = $data['post']->title;
        $data['relatedPosts'] = $data['post']->relatedPosts();
        if (isset(request()->season)) {
            $data['season'] = $data['post']->seasons()->where('number',request()->season)->first();
            
            $data['sections'] = $data['season']->sections()->orderBy('section', 'asc')->get();
        } else {
            if (count($data['post']->episodes)) {
                $data['sections'] = $data['post']->episodes()->orderBy('section', 'asc')->get();
                // dd($data['sections']);
            } else {

                $data['sections'] = [];
            }
        }

        if(auth()->check()){
            $data['guard'] = 'default';
        }else{
            $data['guard'] = 'admin';
        }
       
      

        return view('Front.ShowMovie', $data);
    }

    public function All()
    {
       

         $data['year'] = Carbon::now()->year;
        $data['newsione'] = Post::where(['comming_soon' => 0,'type'=>'movies'])->latest()->take(10)->get();
        $data['newmovies'] = Post::where(['type' => 'movies', 'comming_soon' => 0])->latest()->take(10)->get();
        $data['newyear'] = Post::where(['type' => 'movies','year' => $data['year'], 'comming_soon' => 0])->latest()->take(10)->get();
      
        $data['latestdoble'] = Post::whereHas('categories', function ($q) {
            $q->where('name', 'دوبله فارسی');
        })->where(['comming_soon' => 0])->latest()->take(10)->get();
        $data['newmovies'] = Post::where(['type' => 'movies', 'comming_soon' => 0])->latest()->take(10)->get();
    
        $data['top250'] = Post::where(['comming_soon'=> 0,'type'=>'movies'])->where('top_250', '!=', null)->orderBy("top_250", "desc")->take(10)->get();

        
        foreach (Category::all() as $key => $category) {
             $data['cat'][$category->latin] = Post::whereHas('categories', function ($q) use($category) {
            $q->where('latin',$category->latin);
        })->where(['comming_soon' => 0,'type'=>'movies'])->latest()->take(10)->get();
        }
        
       
        $data['title'] = 'فیلم ها';
        $sliders = Slider::LastSliders('movies');
        if (count($sliders)) {

            $data['sliders'] = $sliders;
        } else {
            $data['sliders'] = Slider::latest()->take(5)->get();
        }
        

        return view('Front.AllMovies', $data);
    }
}
