<div class="col-12 col-lg-3">
    
    <div class="blog-place">
        <h1>
            <i class="fa fa-star"></i>
            <span class="blog-place-title">
                آخرین دیدگاه ها
            </span>
            <span class="blog-place-Name">
                RECENT COMMENTS
            </span>
        </h1>
        @foreach($latest_post_comments as $recentcomment)
        <a class="quotation-blog" href="#">
            <i class="fa fa-quote-right"></i>
            <span class="quotation-blog-title">
                {{mb_substr($recentcomment->text,'0','40')}}
            </span>
            <span class="quotation-blog-text">
                {{$recentcomment->commentable->title}}
            </span>
        </a>

        @endforeach

    </div>
    <div class="blog-place">
        <h1>
            <i class="fa fa-star"></i>
            <span class="blog-place-title">
                پربازدیدترین مطالب
            </span>
            <span class="blog-place-Name">
                POPULAR POSTS
            </span>
        </h1>

        @foreach(App\Blog::orderBy('views', 'DESC')->take(5)->get() as $mostvisit)
    <a class="blog-movie" href="{{$mostvisit->url()}}">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 no-padding">
                        <div class="blog-img-box">
                            <img src="{{asset(unserialize($mostvisit->poster)['resize'])}}" alt="">
                            <div class="cover-img-blog"></div>
                        </div>
                    </div>
                    <div class="col-8 no-padding">
                        <h4>
                            {{$mostvisit->title}}
                        </h4>
                    </div>
                </div>
            </div>
        </a>
        @endforeach

    </div>
    <div class="blog-place">
        <h1>
            <i class="fa fa-star"></i>
            <span class="blog-place-title">
                آخرین مطالب
            </span>
            <span class="blog-place-Name">
                LAST POSTS
            </span>
        </h1>
        @foreach(App\Blog::latest()->take(5)->get() as $lastpost)
    <a class="blog-movie" href="{{$lastpost->url()}}">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 no-padding">
                        <div class="blog-img-box">
                            <img src="{{asset(unserialize($lastpost->poster)['resize'])}}" alt="">
                            <div class="cover-img-blog"></div>
                        </div>
                    </div>
                    <div class="col-8 no-padding">
                        <h4>
                            {{$lastpost->title}}
                        </h4>
                    </div>
                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>