<?php

namespace App\Http\Controllers\Front;

use App\Blog;
use App\Plan;
use App\Post;
use App\Mail\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Discount as AppDiscount;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AjaxController extends Controller
{
    public function getMovieDetail(Request $request)
    {

        $post = Post::find($request->id);

        if ($post) {
            if ($post->type == 'movies') {
                return response()->json([
                    'id' => $post->id,
                    'type' => 'movies',
                    'poster' => asset(unserialize($post->poster)['banner']),
                    'title' => $post->title,
                    'desc' => Str::limit($post->description, 300, '...'),
                    'path' => $post->path(),
                    'play' => $post->play(),
                    'category' => $post->categories->pluck('name'),
                    'stars' => $post->actors->take(10)->pluck('name'),
                    'download' => $post->downloadpath(),
                    'favoritepath' => $post->favoritepath(),
                    'favoritestatus' => $post->checkFavorite($post->id)
                ], 200);
            }
            if ($post->type == 'series' || $post->type == 'documentary') {
                return response()->json([
                    'id' => $post->id,
                    'type' => $post->type,
                    'poster' => asset(unserialize($post->poster)['banner']),
                    'title' => $post->title,
                    'desc' => Str::limit($post->description, 300, '...'),
                    'path' => $post->path(),
                    'category' => $post->categories->pluck('name'),
                    'stars' => $post->actors->take(10)->pluck('name'),
                    'favoritepath' => $post->favoritepath(),
                    'favoritestatus' => $post->checkFavorite()
                ], 200);
            }
        }
    }


    public function addToFavorite(Request $request)
    {

        if (auth()->check()) {
            $user = auth()->user();
        }
        if (auth()->guard('admin')->check()) {
            $user = auth()->guard('admin')->user();
        }

        $obj = DB::table('user_favorite')->where(['user_id' => $user->id, 'post_id' => $request->post_id])->first();
        if ($obj) {
            $user->favorite()->detach($request->post_id);
            return response()->json('detach', 200);
        } else {

            $user->favorite()->attach($request->post_id);
            return response()->json('attach', 200);
        }
    }

    public function Like(Request $request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $guard = 'default';
        } else {
            $user = auth()->guard('admin')->user();
            $guard = 'admin';
        }
        $post = Post::find($request->post_id);
        if ($vote = $post->votes()->where(['user_id' => $user->id, 'user_guard' => $guard])->first()) {
            $vote->status = $request->status;
            $vote->update();
        } else {
            $post->votes()->create([
                'user_id' => $user->id,
                'status' => $request->status,
                'user_guard' => $guard
            ]);
        }

        return response()->json(['status' => $request->status], 200);
    }

    public function checkTakhfif(Request $request)
    {


        $user = auth()->user();


        $plan = Plan::whereId($request->plan_id)->first();

        if ($plan) {
            $discount = $plan->discounts()->where('d_code', $request->code)->first();

            if ($discount) {
                if (Carbon::parse($discount->expire_date)->timestamp < Carbon::now()->timestamp) {
                    return response()->json(
                        ['error' => true, 'data' => 'تاریخ انقضای کد تخفیف رد شده است'],
                        200
                    );
                }
                if ($user->discounts()->where('discount_id', $discount->id)->first()) {
                    return response()->json(
                        ['error' => true, 'data' => 'شما از این کد تخفیف استفاده کرده اید'],
                        200
                    );
                }
                if ($discount->count == 0) {
                    return response()->json(
                        ['error' => true, 'data' => 'متاسفانه تعداد مجاز استفاده از این کد تخفیف به پایان رسیده است'],
                        200
                    );
                }

                $amount = ($plan->priceWithDiscount() * $discount->first()->percent) / 100;

                session()->put('discount_id' . $user->id, $discount->id);
                session()->put('discount' . $user->id, $amount);
                session()->put('amount' . $user->id, $plan->priceWithDiscount() - $amount);
                return response()->json(['error' => false, 'data' => session()->get('amount' . $user->id)], 200);
            } else {
                return response()->json(['error' => true, 'data' => 'کد تخفیف نامعتبر میباشد'], 200);
            }
        }
    }

    public function SearchBlog(Request $request)
    {


        $posts = Blog::where('title', 'like', '%' . $request->word . '%')
            ->orWhere('description', 'like', '%' . $request->word . '%')
            ->latest()->take(4)->get();

        $article = '';
        foreach ($posts as $key => $blog) {
            $article .= '<a class="row-ajax-col"
                    href="' . $blog->url() . '">
                    <div class="col-img f-r"
                        style="background: url(' . asset($blog->poster) . ') no-repeat scroll center center/cover;">
                    </div>
                    <div class="col-cont f-r">
                        <h3 class="f-w">' . Str::limit($blog->title, 30, '...') . '</h3><span
                            class="f-r">' . $blog->get_shamsi_date() . '</span>
                    </div>
                </a>';
        }

        // if(count($posts) > 8) {
        //     $article .='<a class="s-more" href="https://www.namava.ir/blog/?s=اولی">مشاهده نتایج بیشتر</a>';
        // }

        return $article;
    }





    public function Search(Request $request)
    {

        $cat = [];
        $caption = [];
        $year = [];

        // dd($request->data);
        if ($request->data) {
            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'word') {

                    $word = $data['key'];
                } else {
                    $word = null;
                }
            }

            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'genre') {
                    $cat[] = $data['id'];
                }
            }
            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'caption') {
                    $caption[] = $data['id'];
                }
            }
            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'year') {
                    $year[] = $data['year'];
                }
            }
            foreach ($request->data as $key => $data) {
                if ($data['type'] == 'order') {
                    $order = $data['name'];
                }
            }

            if ($word !== null) {
                $posts = Post::where('name', 'like', '%' . $word . '%')
                    ->orWhere('title', 'like', '%' . $word . '%')
                    ->orWhereHas('actors', function ($q) use ($word) {
                        $q->where('name', 'like', '%' . $word . '%')->orWhere('fa_name', 'like', '%' . $word . '%');
                    })->orWhereHas('directors', function ($q) use ($word) {
                        $q->where('name', 'like', '%' . $word . '%')->orWhere('fa_name', 'like', '%' . $word . '%');
                    })->orWhereHas('writers', function ($q) use ($word) {
                        $q->where('name', 'like', '%' . $word . '%')->orWhere('fa_name', 'like', '%' . $word . '%');
                    })->orderBy('year','asc')->take(6)->get();
            } else {


                if (count($cat) > 0 && count($caption) > 0 && count($year) > 0) {
                    $posts = Post::whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->whereBetween('year', [explode(';', $year[0])[0], explode(';', $year[0])[1]])->latest()->take(6)->get();
                } elseif (count($cat) > 0 && count($caption)) {
                    $posts = Post::whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->whereHas('captions', function ($q) use ($caption) {
                        $q->whereIn('lang', $caption);
                    })->latest()->take(6)->get();
                } elseif (count($cat) > 0) {
                    $posts = Post::whereHas('categories', function ($q) use ($cat) {
                        $q->whereIn('id', $cat);
                    })->latest()->take(6)->get();
                } elseif (count($caption) > 0) {
                    $posts = Post::whereHas('captions', function ($q) use ($caption) {
                        $q->whereIn('lang', $caption);
                    })->latest()->take(6)->get();
                } elseif (count($year) > 0) {
                    $posts = Post::whereBetween('year', [explode(';', $year[0])[0], explode(';', $year[0])[1]])->latest()->take(6)->get();
                } else {
                    $posts = [];
                }



                if (isset($order) && $order !==  'default') {
                    if ($order == 'new') {

                        $posts = $posts->sortBy('created_at');
                    }
                    if ($order == 'rate') {

                        $posts = $posts->sortBy('imdbRating');
                    }
                    if ($order == 'yearasc') {

                        $posts = $posts->sortBy('year');
                    }
                    if ($order == 'yeardsc') {

                        $posts = $posts->sortByDesc('year');
                    }
                }
            }



            $articles = $this->createArticles($posts);

            return response()->json($articles, 200);
        }
    }

    public function createArticles($posts)
    {
        $article = '';
        foreach ($posts as $key => $post) {

            $article .= '
             <div class="col-6 col-md-3 col-lg-2">
    <a href="' . $post->path() . '" data-id="1" >
        <div class="movie-sections-box">
            <div class="img-box-movies">
                <img src="' . asset(unserialize($post->poster)['resize']) . '" alt="' . $post->name . '">
                <div class="cover-img-movies-details">
                    <span>
                        ' . $post->name . ' -';
            if ($post->type == 'series'){
                   $article .= \Carbon\Carbon::parse($post->first_publish_date)->format('Y');
            }else{
                   $article .= \Carbon\Carbon::parse($post->released)->format('Y');
              }

            $article .= '</span>
                    <span>
                        <i class="fa fa-heart"></i>
                        89%
                    </span>
                </div>
            </div>
            <h5>
                ' . $post->title . '
            </h5>
        </div>
    </a></div>';
        }
        return $article;
    }
}
