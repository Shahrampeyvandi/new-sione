@if (isset($adverts) && count($adverts))
<section class="top-slider">
    <div class="swiper-container TopSlider">
        <div class="swiper-wrapper">
            @foreach ($adverts as $advert)
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="{{asset($advert->poster)}}" alt="{{$advert->title}}">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>
@endif