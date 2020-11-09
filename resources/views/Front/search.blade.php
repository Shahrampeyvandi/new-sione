@extends('Layout.Front')


@section('content')

<div class="search-panel">
    <button id="close_search">
        <i class="fa fa-times"></i>
    </button>
    <div class="input-place">
        <label for="search-input"></label>
    <input id="search-input" data-url="{{route('S.Search')}}" type="search" name="search" required autocomplete="off"
            placeholder="فیلم، سریال، بازیگر،ژانر">
    </div>
    <div class="filter-place-box">
        <div class="filter-place-elements">
            <div class="filter-search">
                فیلتر ها
                <i class="fa fa-angle-down"></i>
            </div>
        </div>
        <div class="filter-delete-place">

        </div>
    </div>
    <div class="filter-box">
        <div class="menu-filters">
            <ul>
                <li id="genre">
                    ژانرها
                    <i class="fa fa-angle-left"></i>
                </li>
                {{-- <li id="Country">
                                        کشور سازنده
                                        <i class="fa fa-angle-left"></i>
                                    </li> --}}
                <li id="Sound">
                    زیرنویس
                    <i class="fa fa-angle-left"></i>
                </li>
                <li id="Construction">
                    سال ساخت
                    <i class="fa fa-angle-left"></i>
                </li>
                <li id="Order">
                    مرتب سازی
                    <i class="fa fa-angle-left"></i>
                </li>
            </ul>
        </div>
        <div class="filter-body">
            <div class="filter-body-box genre-box">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($genres as $genre)
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                            <div class="checkbox-place">
                                <label>
                                    <input data-id="{{$genre->id}}" data-type="genre" data-url="{{route('S.Search')}}"
                                        id="genre_{{$genre->id}}" name="gnere_{{$genre->id}}" class="filter"
                                        type="checkbox" value="{{$genre->name}}">
                                    {{$genre->name}}
                                </label>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            {{-- <div class="filter-body-box ManufacturingCountry-box">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                                <div class="checkbox-place">
                                                    <label>
                                                        <input id="country1" name="Country_1" class="filter"  type="checkbox"
                                                            value="کشور1">
                                                        آمریکا
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                                <div class="checkbox-place">
                                                    <label>
                                                        <input id="country2" name="Country_2" class="filter"  type="checkbox"
                                                            value="کشور2">
                                                        کشور2
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                                <div class="checkbox-place">
                                                    <label>
                                                        <input id="country3" name="Country_3" class="filter"  type="checkbox"
                                                            value="کشور3">
                                                        کشور3
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                                <div class="checkbox-place">
                                                    <label>
                                                        <input id="country4" name="Country_4" class="filter"  type="checkbox"
                                                            value="کشور4">
                                                        کشور4
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                                <div class="checkbox-place">
                                                    <label>
                                                        <input id="country5" name="Country_5" class="filter"  type="checkbox"
                                                            value="کشور5">
                                                        کشور5
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                                                <div class="checkbox-place">
                                                    <label>
                                                        <input id="country6" name="Country_6" class="filter"  type="checkbox"
                                                            value="کشور6">
                                                        کشور6
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
            <div class="filter-body-box SoundSubtitles-box">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($captions as $key=>$caption)
                        <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                            <div class="checkbox-place">
                                <label>
                                    <input id="{{$key+1}}" name="{{$key+1}}" class="filter" type="checkbox"
                                        data-id="{{$caption}}" data-type="caption" data-url="{{route('S.Search')}}"
                                        value="{{$caption}}">
                                    {{$caption}}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="filter-body-box YearConstruction-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input data-url="{{route('S.Search')}}" type="text" id="demo_2"
                                    class="range-slider__range">
                            </div>
                            {{-- <div class="range-slider">
                                <input class="range-slider__range" type="range" value="" min="1900"
                                    max="{{$year}}" step="1" data-url="{{route('S.Search')}}">
                            <span class="range-slider__value">0</span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-body-box OrderConstruction-box">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="{{route('S.Search')}}" name="order" value="default" checked>
                            <label for="male">پیش فرض</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="{{route('S.Search')}}" name="order" value="new">
                            <label for="male">تازه ها</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="{{route('S.Search')}}" name="order" value="rate">
                            <label for="male">امتیاز IMDB</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="{{route('S.Search')}}" name="order" value="yearasc">
                            <label for="male">سال ساخت (جدیدترین)</label><br>
                        </div>
                        <div class="form-group checkbox-place">
                            <input type="radio" id="male" data-url="{{route('S.Search')}}" name="order" value="yeardsc">
                            <label for="male">سال ساخت (قدیمی ترین)</label><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row results">

    </div>
</div>
</div>
@endsection