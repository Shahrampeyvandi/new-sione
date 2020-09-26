<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function All()
    {
        $categories = Category::has('posts')->get();
       
        return view('Front.Categories', ['categories' => $categories]);
    }

    public function Show(Request $request, $name)
    {
        $category = Category::where('latin', $name)->first();
        if ($category) {
            $sliders = Slider::withCategory($name);
            $data['sliders'] = $sliders;
            $data['title'] = $name ;
            $data['category_name'] = $category->name;
           $data['posts'] = $category->posts()->paginate(30);
         
            return view('Front.showCategory', $data);
        } else {
            abort(404);
        }
    }
}
