<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChildController extends Controller
{
    public function Show()
    {
        $posts  =  Post::withCategory('Animation');
        $sliders = Slider::withCategory('Animation');
        if(count($sliders)) {

            $data['sliders'] = $sliders;
        }else{
           $data['sliders'] = Slider::latest()->take(5)->get();
        }
      
        $data['posts'] = $posts;
        $data['title'] = 'کودک';
        

        return view('Front.index', $data);
    }
}
