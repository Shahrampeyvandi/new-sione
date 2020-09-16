@if (count($sliders))
    <section class="slider d-none d-md-block">
    <div class="swiper-container header-slider">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="slider-box">
                    <div class="shadow-bottom-slider"></div>
                    <img class="slider-back-img" src="{{asset($slider->image)}}" alt="{{$slider->post->title}}">
                    <div class="movie-details-box-slider">
                        <a href="#">
                            <img src="#" alt="">
                        </a>
                        <h4>
                            {{$slider->post->title}}
                        </h4>
                        <h5>
                            {!! str_limit($slider->post->description,250) !!}
                        </h5>
                   @if ($slider->post->type == 'movies')
                        <a href="{{$slider->post->play()}}" class="page-movie-play btn--ripple">
                            <i class="fa fa-play"></i>
                            پخش فیلم
                        </a>
                   @endif
                        
                    <a href="{{route('S.SiteSharing')}}" class="more-detail-movie btn--ripple">
                            <i class="fa fa-star"></i>
                            خرید اشتراک
                        </a>
                    <a href="{{$slider->post->path()}}" class="more-detail-movie btn--ripple">
                            <i class="fa fa-exclamation"></i>
                            جزئیات بیشتر
                        </a>
                        @if (count($slider->post->actors))
                            <h6>
                            ستارگان: </h6>
                            @php
                            $countactors = count($slider->post->actors);
                            @endphp
                           <h5>
                                @foreach ($slider->post->actors->take(10) as $key =>$item)
                            <span href="#">
                                {{$item->name }}
                                {{ $key == ($countactors -1)  ? ' ' : ' - '}}
                            </span>
                            @endforeach
                           </h5>

                       
                        @endif
                        @if ($slider->post->directors)
                            <h6>
                            کارگران:
                            @php
                          
                            $countdirectors = count($slider->post->directors);
                            @endphp
                            @foreach ($slider->post->directors as $key=> $item)
                            <a href="#">

                                {{$item->name }}
                                {{$countdirectors -1  == $key ? ' ' : ' - '}}
                            </a>
                            @endforeach
                        </h6>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        <div class="next-header-slide">
            <i class="fa fa-angle-right"></i>
        </div>
        <div class="prev-header-slide">
            <i class="fa fa-angle-left"></i>
        </div>
    </div>
</section>
@endif