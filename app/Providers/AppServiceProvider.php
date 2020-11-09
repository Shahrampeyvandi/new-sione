<?php

namespace App\Providers;

use App\BugReport;
use App\Caption;
use App\Category;
use App\MovieRequest;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); 

         View::composer('*', function ($view) {
            $genres = Category::has('posts')->get();
            $captions = Caption::pluck('lang')->toArray();
            if(count($captions)) {
                $captions = array_unique($captions);
            }else{
                $captions = [];
            }
           
            $year = Carbon::now()->year;


        if(Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
        }
        elseif(Auth::check()) {
            $user = Auth::user();
        }else{
            $user = null;
        }

        $setting = Setting::first();

        $movie_requests = MovieRequest::where('new',1)->get();
        $reports = BugReport::where('new',1)->get();
        $merge_noty = $movie_requests->concat($reports)->sortByDesc('created_at');
        
    

        $view->with(['user'=> $user,'setting'=>$setting,'year'=>$year,'genres'=>$genres,'captions'=>$captions,'merge_noty'=>$merge_noty]);
    });
    }
}
