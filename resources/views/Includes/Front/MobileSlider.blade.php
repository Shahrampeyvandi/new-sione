<section class="slider d-block d-md-none">
    <div class="swiper-container mobile-slider d-block d-md-none">
        <div class="swiper-wrapper">
            @foreach ($sliders as $slider)
            <div class="swiper-slide" style="background-image:url('{{asset($slider->image)}}');
                background-size: cover;height:300px;position:relative;margin-bottom: 45px;
                ">
                <div class="slider-box slider-flex">
                    <!-- <img class="slider-back-img" src="assets/images/slider/p1.jpg" alt=""> -->
                    <a href="{{$slider->post->play()}}" class="page-movie-play btn--ripple" style="    
                     font-size: 12px;">
                        <i class="fa fa-play"></i>
                        پخش فیلم
                    </a>
                </div>
            </div>
            @endforeach
           

        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
    </div>
</section>