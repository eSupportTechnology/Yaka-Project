@extends ('newFrontend.master')

@section('content')
    <style>
        .banner-section {
            background: linear-gradient(to bottom, rgb(102, 17, 17), rgb(171, 18, 18), rgb(253, 6, 6));
            padding: 30px;
            text-align: center;
            color: white;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .content-box {
            max-width: 80%;
            margin: auto;
        }



        /* Responsive adjustments */
        @media (max-width: 768px) {
            .text h1 {
                font-size: 25px;
            }

            .text p {
                font-size: 10px;
            }

            .banner-section {
                height: auto;
                padding: 50px 20px;
            }
        }

        @media (max-width: 480px) {
            .text h1 {
                font-size: 15px;
            }

            .text p {
                font-size: 8px;
            }

            .banner-section {
                height: auto;
                padding: 40px 15px;
            }
        }


        .banner-container {
            width: 100%;
            background-color: #ffff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 0;
            margin-top: 30px;
            margin-bottom: 50px;

        }

        .banner {
            width: 80%;
            max-width: 1000px;
            height: 150px;
            background: url('banner-image.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 24px;
            padding: 20px;
        }

        .banner-text {
            flex: 1;
            text-align: left;
        }

        .banner-logo {
            font-size: 40px;
            font-weight: bold;
        }

        .banner-hashtags {
            flex: 1;
            text-align: right;
            font-size: 18px;
        }


        @media (max-width: 768px) {
            .banner {
                flex-direction: column;
                height: auto;
                padding: 20px;
                text-align: center;
            }

            .banner-text,
            .banner-hashtags {
                text-align: center;
                font-size: 16px;
            }
        }

        .ad-banner-container {
            width: 100%;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px 0;
            margin-top: 0px;
            margin-bottom: 30px;
        }

        .ad-banner {
            width: 60%;
            /* Reduced width */
            max-width: 600px;
            /* Smaller banner width */
            height: 80px;
            /* Reduced height */
            background: url('banner-image.jpg') no-repeat center center/cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 10px;
            padding: 5px;
        }



        /* Style for each ad card */
        .ad-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: right;
            margin-bottom: 10px;
        }

        .ad-card h3 {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .ad-card p {
            margin: 5px 0;
        }

        .price {
            font-size: 1.1rem;
            color: #d9534f;
            font-weight: bold;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }

        /* Card image styling if needed */
        .ad-card img {
            max-width: 50%;
            border-radius: 8px;
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        .card-container {
            display: flex;
            width: 200%;
            transition: transform 0.5s ease-in-out;
        }

        .ad-card {
            width: 20%;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex-shrink: 0;
        }

        .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            clip-path: polygon(100% 0%, 100% 100%, 50% 80%, 0 100%, 0 0);
        }

        @media (max-width: 766px) {
            .clearfix.inner-content.responsive-category {
                justify-content: flex-start;
                /* Align items to the start */
                gap: 8px;
                /* Add spacing between items */
            }

            .category-block-one {
                flex: 0 0 calc(50% - 4px);
                /* Two columns with gap consideration */
                max-width: calc(50% - 4px);
                /* Ensure items don't exceed half width */
                box-sizing: border-box;
            }
        }

        @media (max-width: 472px) {
            .responsive-category {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .category-block-one {
                margin: 4px !important;
                padding: 8px !important;
            }

            .category-block-one h5 {
                min-height: auto !important;
                font-size: 13px !important;
                margin: 4px 0 !important;
            }

            .category-block-one .icon-box img {
                width: 70px !important;
                height: 70px !important;
            }
        }

        @keyframes blinkGreen {

            0%,
            100% {
                border-color: #00ff44;
            }

            50% {
                border-color: transparent;
            }
        }

        @keyframes blinkBlue {

            0%,
            100% {
                border-color: #007bff;
            }

            50% {
                border-color: transparent;
            }
        }

        @keyframes blinkRed {

            0%,
            100% {
                border-color: red;
            }

            50% {
                border-color: transparent;
            }
        }

        .custom-carousel {
            position: relative;
            width: 100%;
            /* max-height: 400px; */
            overflow: hidden;
        }

        .carousel-slide-top {
            display: none;
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-slide-sup {
            display: none;
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: opacity 0.5s ease-in-out;
        }

        .carousel-slide-top.active {
            display: block;
        }

        .carousel-slide-sup.active {
            display: block;
        }
        .carousel-thumbnails {
            overflow-x: auto;
            padding: 10px 0;
        }
        .carousel-thumbnails {
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .super-thumb {
            transition: border 0.3s ease;
            border: 2px solid transparent;
        }

        .super-thumb.active-thumb {
            border-color: red;
        }
        .top-thumb {
            transition: border 0.3s ease;
            border: 2px solid transparent;
        }

        .top-thumb.active-thumb {
            border-color: green;
        }
        .top-thumb {
            transition: border 0.3s ease;
        }

        .active-thumb {
            border: 2px solid red !important;
        }
        @media (max-width: 399px) {
            #topAdsThumbnails {
                display: none !important;
            }
            #superAdsThumbnails {
                display: none !important;
            }
        }

</style>

    </style>

    <!-- banner-section -->
    <section class="banner-section">
        <div class="auto-container">
            <div class="content-box">
                <div class="text">
                    <h1 style="font-size:45px">@lang('You can #Buy, #Sell, #Rent, #Booking anything from here.')</h1>
                    <p>@lang('messages.Buy and sell everything from used cars to mobile phones')
                    </p>
                </div>

            </div>
        </div>
    </section>
    <!-- banner-section end -->

    <!-- ad - banner-section start -->
    <section class="mb-0 ad-banner-container">
        <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    @if ($banner->type == 0)
                        @if (isset($banner->url))
                            <a href="{{ $banner->url }}" target="_blank">
                        @endif
                        <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('banners/' . $banner->img) }}" class="mx-auto d-block" alt="Banner Image">
                        </div>
                        @if (isset($banner->url))
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- ad - banner-section end -->

    <!-- category-section -->
    <section class="category-section centred sec-pad" style="padding-top:30px;">
        <div class="auto-container">
            <div class="sec-title">
                <span>@lang('messages.Categories')</span>
                <h2>@lang('messages.Explore by Category')</h2>
            </div>

            <div class="clearfix inner-content responsive-category"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 30px; padding: 8px; justify-items: center;">
                @foreach ($categories->take(14) as $category)
                    <div class="category-block-one" style="width: 100%; break-inside: avoid;">
                        <a href="{{ route('browse-ads', ['category' => $category->id]) }}" style="text-decoration: none;">
                            <div class="inner-box">
                                <div class="shape">
                                    <div class="shape-1"
                                        style="background-image: url('{{ asset('newFrontend/Clasifico/assets/images/shape/shape-1.png') }}');">
                                    </div>
                                    <div class="shape-2"
                                        style="background-image: url('{{ asset('newFrontend/Clasifico/assets/images/shape/shape-2.png') }}');">
                                    </div>
                                </div>

                                <div class="icon-box">
                                    <img src="{{ asset('images/Category/' . $category->image ?? 'default.png') }}"
                                        alt="{{ $category->name }}" style="width: 70px; height: 70px; object-fit: contain;">
                                </div>

                                <h5
                                    style="min-height: 60px; display: -webkit-box;
                                            -webkit-line-clamp: 2; -webkit-box-orient: vertical;
                                            overflow: hidden; text-overflow: ellipsis; ">
                                    @lang('messages.' . $category->name)
                                </h5>

                                <span>{{ $category->ads_count }}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
    </section>
    <section class="superad-section">
        <div class="row auto-container">
            <div class="col-md-6 d-flex flex-column-reverse justify-content-center">
                <div class="first-row">
                    <div id="superAdsCarousel" class="custom-carousel-container">
                        @foreach ($superAds as $index => $adss)
                            <div class="custom-slide @if ($index == 0) active @endif"
                                style="position: relative; border: 4px solid #0b128e; border-radius: 4px; overflow: hidden; padding: 0; margin: 2px; animation: blinkBlue 1.5s infinite; height: 500px; background-color: white; display: none;">

                                <a href="/browse_ads_details/{{ $adss->adsId }}" style="display: block; height: 100%;">
                                    <img src="{{ asset('storage/'.$adss->mainImage) }}"
                                        class="d-block w-100"
                                        style="height: 100%; width: 100%; object-fit: contain; background-color: white;"
                                        alt="Slide {{ $index + 1 }}">

                                    <button class="sale"
                                        style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                                        Sale
                                    </button>

                                    <div class="badge" style="position: absolute; top: 10px; left: 10px; z-index: 2;">
                                        <img src="{{ asset('02.png') }}" alt="Top Ad" style="width: 20px; height: 20px;">
                                    </div>

                                    <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%;
                                                background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent);
                                                border-radius: 5px;">
                                    </div>
                                </a>

                                <!-- Ad Details (must be inside the slide) -->
                                <div class="p-2 details"
                                    style="position: absolute; bottom: 0; left: 0; width: 100%;
                                        background: rgba(0, 0, 0, 0.6); color: white; z-index: 3;
                                        text-align: center;">

                                    <p>{{ $adss->category->name ?? 'Uncategorized' }} &raquo; {{ $adss->subcategory->name ?? '' }}</p>

                                    <h3 style="font-weight: bold; font-size: 1.1rem; color: white;">
                                        {{ $adss->title }}
                                    </h3>

                                    <p class="price" style="color: white; font-size: 1.2rem;">
                                        @lang('messages.Rs') {{ number_format($adss->price, 2) }}
                                    </p>

                                    <p><i class="fas fa-clock"></i> {{ $adss->created_at->diffForHumans() }}</p>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3 d-flex justify-content-center gap-2 flex-wrap carousel-thumbnails" id="superAdsThumbnails" style="gap: 10px;">
                        @foreach ($superAds as $index => $adss)
                        <img src="{{ asset('storage/'.$adss->mainImage) }}"
                            data-index="{{ $index }}"
                            alt="Thumb {{ $index + 1 }}"
                            class="super-thumb @if ($index == 0) active-thumb @endif"
                            style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; cursor: pointer; flex-shrink: 0; border: 2px solid red;">
                        @endforeach
                    </div>
                </div>


                <div class="second-row">
                    <p style="font-size:16px; text-align:justify;">@lang('messages.para2')
                    </p>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column justify-content-start align-items-center ">
                <div class="first-row">
                    <h2 class="heading"><b>@lang('messages.indextitle') <br>
                            @lang('messages.Best') <span> @lang('messages.Super')</span></b></h2>
                </div>
                <div class="second-row">
                    <div id="super-banner" class="custom-carousel">
                        @foreach ($topbanners as $index => $banner)
                            <img src="{{ asset('banners/' . $banner->img) }}"
                                class="carousel-slide-sup @if ($index === 0) active @endif"
                                alt="Banner {{ $index + 1 }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5 topad-section">
        <div class="row auto-container">
            <div class="col-md-6 d-flex flex-column justify-content-start align-items-center ">
                <div class="first-row">
                    <h2 class="heading"><b>Top Ads</b></h2>
                </div>
                <div class="second-row">
                    <div id="top-banner">
                        @foreach ($superbanners as $index => $banner)
                            <img src="{{ asset('banners/' . $banner->img) }}"
                                class="carousel-slide-top @if ($index === 0) active @endif"
                                alt="Banner {{ $index + 1 }}">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-column-reverse justify-content-center">
                <div class="second-row">

                    <!-- Ad Section -->
                    <div id="topAds" class="carousel slide">
                        <div class="carousel-inner">

                            @foreach ($topAds as $index => $ad)
                                <div class="carousel-item @if ($index == 0) active @endif"
                                    style="position: relative; border: 4px solid #00ff44; border-radius: 4px; overflow: hidden;
                                        padding: 0; margin: 2px; animation: blinkGreen 1.5s infinite; height: 500px; background-color: white;">

                                    <!-- Link to Ad Details -->
                                    <a href="/browse_ads_details/{{ $ad->adsId }}" style="display: block; height: 100%; width: 100%;">
                                        <!-- Full-size Image -->
                                        <img src="{{ asset('storage/'.$ad->mainImage) }}"
                                            class="d-block w-100"
                                            style="height: 100%; width: 100%; object-fit: contain; background-color: white;"
                                            alt="Top Ad Image">

                                        <!-- Sale Badge -->
                                        <button class="sale"
                                            style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px;
                                                background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                                            Sale
                                        </button>

                                        <!-- Top Ad Badge -->
                                        <div class="badge" style="position: absolute; top: 10px; left: 10px; z-index: 2;">
                                            <img src="{{ asset('01.png') }}" alt="Top Ad" style="width: 20px; height: 20px;">
                                        </div>

                                        <!-- Overlay Gradient -->
                                        <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%;
                                                    background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent); border-radius: 5px;">
                                        </div>

                                        <!-- Ad Details Overlay -->
                                        <div class="p-2 details"
                                            style="position: absolute; bottom: 0; left: 0; width: 100%;
                                                background: rgba(0, 0, 0, 0.6); color: white; z-index: 3; text-align: center;">
                                            <p>{{ $ad->category->name ?? 'Uncategorized' }} &raquo; {{ $ad->subcategory->name ?? '' }}</p>
                                            <h3 style="font-weight: bold; font-size: 1.1rem; color: white;">
                                                {{ $ad->title }}
                                            </h3>
                                            <p class="price" style="color: white; font-size: 1.2rem;">
                                                @lang('messages.Rs') {{ number_format($ad->price, 2) }}
                                            </p>
                                            <p><i class="fas fa-clock"></i> {{ $ad->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Thumbnails -->
                    <div class="mt-3 d-flex justify-content-center flex-wrap" id="topAdsThumbnails"
                        style="gap: 10px; margin-top: 20px; z-index: 10;">

                        @foreach ($topAds as $index => $ad)
                                <img src="{{ asset('storage/'.$ad->mainImage) }}"
                                    class="top-thumb @if ($index == 0) active-thumb @endif"
                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px; cursor: pointer; border: 2px solid #ccc;">
                        @endforeach

                    </div>

                </div>

                <div class="second-row">
                    <p style="font-size:16px; text-align:justify;">@lang('messages.para1')
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- feature-style-two -->
    <section class="feature-style-two">
        <div class="auto-container">
            {{--  <div class="sec-title centred">
                    <span>@lang('messages.Urgent')</span>
                    <h2>@lang('messages.Urgent') Ads</h2>
                    <p>@lang('messages.para3')</p>
                </div>  --}}
            <div class="tabs-box">

                <div class="tabs-content">
                    <div class="tab active-tab" id="tab-1">

                        <div class="clearfix row justify-content-center">
                            @foreach ($latestAds as $ads)
                                <a href="/browse_ads_details/{{ $ads->adsId }}">
                                    <div class="col-lg-3 col-md-5 col-sm-12 feature-block justify-content-center">
                                        <div class="feature-block-one wow">
                                            <div class="inner-box"
                                                style="border: 4px solid red; border-radius: 4px; overflow: hidden; animation: blinkRed 1.5s infinite;">
                                                <div class="image-box">
                                                    <figure class="image"><img
                                                            src="{{ asset('storage/' . $ads->mainImage) }}" alt=""
                                                            style="width: 370px; height: 220px; object-fit: contain;">
                                                    </figure>

                                                    <div class="feature" style="background-color: rgb(171, 18, 18);">Urgent
                                                    </div>

                                                </div>
                                                <div class="lower-content"
                                                    style="display: flex; flex-direction: column; justify-content: space-between;height: 200px;">


                                                    <h3
                                                        style="
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 2;
                                                    -webkit-box-orient: vertical;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    max-height: 55px;
                                                    margin-top: 20px;
                                                    margin-bottom: 10px;">
                                                        <a
                                                            href="{{ route('ads.details', ['adsId' => $ads->adsId]) }}">{{ $ads->title }}</a>
                                                    </h3>

                                                    <ul class="clearfix info">

                                                        <li><i class="fas fa-map-marker-alt"></i>
                                                            @php
                                                                $locale = App::getLocale();
                                                                $locationName = 'name_' . $locale;
                                                            @endphp
                                                            {{ $ads->sub_location ? $ads->sub_location->$locationName : 'N/A' }},
                                                            {{ $ads->main_location ? $ads->main_location->$locationName : 'N/A' }}
                                                        </li>
                                                    </ul>
                                                    <div class="lower-box">
                                                        <h5><span>Price:</span>@lang('messages.Rs') {{ $ads->price }}</h5>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <!-- ad - banner-section start -->
    <section class="mb-0 ad-banner-container">
        <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    @if ($banner->type == 0)
                        <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('banners/' . $banner->img) }}" class="mx-auto d-block" alt="Banner Image">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide-sup');
            const totalSlides = slides.length;
            let currentIndex = 0;
            let interval = null;

            const showSlide = (index) => {
                slides.forEach((slide, i) => {
                    slide.classList.remove('active');
                    if (i === index) {
                        // Reset GIF to play again
                        const currentSrc = slide.src;
                        slide.src = '';
                        slide.src = currentSrc;
                        slide.classList.add('active');
                    }
                });
            };

            const startCarousel = () => {
                interval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    showSlide(currentIndex);
                }, 5000); // change every 5 seconds
            };

            const stopCarousel = () => {
                clearInterval(interval);
            };

            showSlide(currentIndex);
            startCarousel();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide-top');
            const totalSlides = slides.length;
            let currentIndex = 0;
            let interval = null;

            const showSlide = (index) => {
                slides.forEach((slide, i) => {
                    slide.classList.remove('active');
                    if (i === index) {
                        // Reset GIF to play again
                        const currentSrc = slide.src;
                        slide.src = '';
                        slide.src = currentSrc;
                        slide.classList.add('active');
                    }
                });
            };

            const startCarousel = () => {
                interval = setInterval(() => {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    showSlide(currentIndex);
                }, 5000); // change every 5 seconds
            };

            const stopCarousel = () => {
                clearInterval(interval);
            };

            showSlide(currentIndex);
            startCarousel();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('#superAdsCarousel .custom-slide');
            const thumbnails = document.querySelectorAll('#superAdsThumbnails .super-thumb');
            let currentIndex = 0;
            let interval = null;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.style.display = (i === index) ? 'block' : 'none';
                    slide.classList.toggle('active', i === index);
                });

                thumbnails.forEach((thumb, i) => {
                    if (i === index) {
                        thumb.classList.add('active-thumb');
                        thumb.style.border = '2px solid red';
                    } else {
                        thumb.classList.remove('active-thumb');
                        thumb.style.border = 'none';
                    }
                });

                currentIndex = index;
            }

            function nextSlide() {
                let nextIndex = (currentIndex + 1) % slides.length;
                showSlide(nextIndex);
            }

            function startCarousel() {
                interval = setInterval(nextSlide, 5000);
            }

            function stopCarousel() {
                clearInterval(interval);
            }

            // Thumbnail click event
            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', () => {
                    stopCarousel();
                    showSlide(index);
                    startCarousel(); // Optional: restart auto-play
                });
            });

            showSlide(currentIndex);
            startCarousel();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const slides = document.querySelectorAll('#topAds .carousel-item');
            const thumbnails = document.querySelectorAll('#topAdsThumbnails .top-thumb');
            let currentIndex = 0;
            let interval;

            const showSlide = (index) => {
                slides.forEach((slide, i) => {
                    slide.classList.remove('active');
                    if (i === index) {
                        slide.classList.add('active');
                    }
                });

                thumbnails.forEach((thumb, i) => {
                    thumb.classList.remove('active-thumb');
                    if (i === index) {
                        thumb.classList.add('active-thumb');
                    }
                });

                currentIndex = index;
            };

            const startCarousel = () => {
                interval = setInterval(() => {
                    const nextIndex = (currentIndex + 1) % slides.length;
                    showSlide(nextIndex);
                }, 5000);
            };

            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', () => {
                    showSlide(index);
                    clearInterval(interval);
                    startCarousel(); // Restart carousel on manual click
                });
            });

            showSlide(currentIndex);
            startCarousel();
        });
    </script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
@endsection
