<?php

namespace App\Http\Controllers\Blog;

use App\Plan;
use App\Post;
use App\Mail\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Discount as AppDiscount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use App\Blog;
use App\BlogCategory;
use App\Comment;

class BlogController extends Controller
{
    public function index()
    {
        $data['title'] = 'sione | blog';
        $data['collection1'] = Blog::latest()->take(3)->get();
        $data['collection2'] = Blog::latest()->skip(3)->take(3)->get();
        $data['naghd_va_barrasi'] = Blog::withCategory('disscuss');
        $data['latest_news'] = Blog::withCategory('news');
        $data['latest_articles'] = Blog::withCategory('articles');
        $data['latest_videos'] = Blog::withCategory('videos');
        $data['latest_post_comments'] = Comment::where('commentable_type','App\Blog')->latest()->take(6)->get();

        return view('blog.index', $data);
    }

    public function Category($name)
    {
       $bcategory = BlogCategory::whereLatin($name)->first();
       if(!$bcategory) abort(404);
        $data['category_name'] = $bcategory->name;
        $data['title'] = "sione | $name";
        $data['posts'] = Blog::withCategory($name);
        $data['first_post'] = $data['posts']->first();

        return view('blog.category',$data);
    }



    public function show($category , $slug)
    {
        
        $data['post'] = Blog::whereSlug($slug)->first();
        if(!$data['post']) abort(404);

        $data['post']->increment('views');
        
        $categories = $data['post']->category->name;

        $relateds = Blog::withCategory($category);
        
        $data['relateds'] = $relateds;
        $data['latest_movies'] = Post::latest()->take(15)->get();

        $data['latest_post_comments'] = $data['post']->comments->take(6);
        return view('blog.post', $data);
    }

    public function showvideo($id)
    {


        return view('blog.movie');
    }

     public function Comment(Request $request, Blog $blog)
    {
        


        if (auth()->guard('admin')->check()) {
            $blog->comments()->create([
                'text' => $request->opinion,
                'user_id' => 0
            ]);
        }

        if (auth()->check()) {
            $blog->comments()->create([
                'text' => $request->opinion,
                'user_id' => auth()->user()->id
            ]);
            toastr()->success('نظر شما درانتظار تایید میباشد');
        }
        return back();
    }

}
