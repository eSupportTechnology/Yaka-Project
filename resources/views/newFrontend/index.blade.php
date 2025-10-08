@extends ('newFrontend.master')

@section('content')
    <style>
        .banner-section {
            background: linear-gradient(to bottom, rgb(102, 17, 17), rgb(171, 18, 18), rgb(253, 6, 6));
            padding: 30px;
            text-align: center;
            color: white;
            height: 250px;
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
                grid-template-columns: repeat(1, 1fr) !important;
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

        @keyframes blinkBlue {

            0%,
            100% {
                border-color: #0b128e;
            }

            50% {
                border-color: #3366ff;
            }
        }

        .nav-btn:hover {
            background: #53303e !important;
            transform: scale(1.1);
        }

        .nav-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .nav-btn:disabled:hover {
            transform: none;
            background: rgba(11, 18, 142, 0.8) !important;
        }

        @keyframes blinkGreen {

            0%,
            100% {
                border-color: #00ff44;
            }

            50% {
                border-color: #33ff66;
            }
        }

        .top-nav-btn:hover {
            background: #00ff44 !important;
            transform: scale(1.1);
        }

        .top-nav-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .top-nav-btn:disabled:hover {
            transform: none;
            background: rgba(0, 255, 68, 0.8) !important;
        }

        @keyframes blinkRed {

            0%,
            100% {
                border-color: red;
            }

            50% {
                border-color: #ff4444;
            }
        }

        .urgent-cards-wrapper {
            will-change: transform;
        }

        .urgent-inner-box {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Large device styles (desktops and large tablets) */
        @media (min-width: 993px) {
            .urgent-card {
                max-width: 280px !important;
                min-width: 250px !important;
            }

            .urgent-inner-box {
                height: 450px !important;
            }

            .large-device-navigation {
                display: block !important;
            }
        }

        /* Medium device styles (tablets) */
        @media (max-width: 992px) and (min-width: 769px) {
            .urgent-cards-group {
                gap: 15px !important;
            }

            .urgent-card {
                max-width: 45% !important;
                min-width: 280px !important;
                flex: 0 0 45%;
            }

            .urgent-inner-box {
                height: 420px !important;
            }

            .large-device-navigation {
                display: none !important;
            }

            .urgent-nav-btn {
                display: none !important;
            }
        }

        @media (max-width: 768px) {
            .cards-container {
                height: 450px !important;
                max-width: 100% !important;
                padding: 0 20px;
            }

            .superad-card {
                width: 250px !important;
                height: 400px !important;
            }

            .superad-card.card-left {
                left: 1rem;
                transform: scale(0.6) translateX(-10rem) !important;
            }

            .superad-card.card-center {
                transform: translateX(-50%) scale(0.8) !important;
            }

            .superad-card.card-right {
                right: 1rem;
                transform: scale(0.6) translateX(10rem) !important;
            }

            .nav-prev {
                display: block;
            }

            .nav-next {
                display: block;
            }

            .top-ads-container {
                height: 450px !important;
                max-width: 100% !important;
                padding: 0 20px;
            }

            .topad-card {
                width: 250px !important;
                height: 400px !important;
            }

            .topad-card.card-left {
                transform: scale(0.6) translateX(-10rem) !important;
            }

            .topad-card.card-center {
                transform: translateX(-50%) scale(0.8) !important;
            }

            .topad-card.card-right {
                transform: scale(0.6) translateX(10rem) !important;
            }

            .top-nav-prev {
                display: block;
            }

            .top-nav-next {
                display: block;
            }

            .urgent-card {
                max-width: 48% !important;
                min-width: 250px !important;
                flex: 0 0 48%;
            }

            .urgent-cards-group {
                gap: 2% !important;
                padding: 0 5px;
                justify-content: space-between !important;
            }

            .urgent-inner-box {
                height: 380px !important;
            }

            .urgent-card-image {
                height: 180px !important;
            }

            .urgent-lower-content {
                height: 200px !important;
                padding: 12px !important;
            }

            .urgent-card-title {
                font-size: 14px !important;
                line-height: 1.3 !important;
                max-height: 40px !important;
                margin: 0 0 10px 0 !important;
            }

            .urgent-card-location {
                margin: 0 0 10px 0 !important;
            }

            .urgent-card-location li {
                font-size: 12px !important;
            }

            .urgent-card-price {
                font-size: 16px !important;
            }

        }

        @media (max-width: 576px) {
            .urgent-card {
                max-width: 47% !important;
                min-width: 200px !important;
                flex: 0 0 47%;
            }

            .urgent-cards-group {
                gap: 3% !important;
                padding: 0 8px;
            }

            .urgent-inner-box {
                height: 350px !important;
            }

            .urgent-card-image {
                height: 160px !important;
            }

            .urgent-lower-content {
                height: 190px !important;
                padding: 10px !important;
            }

            .urgent-card-title {
                font-size: 13px !important;
                max-height: 35px !important;
            }

            .urgent-card-location li {
                font-size: 11px !important;
            }

            .urgent-card-price {
                font-size: 15px !important;
            }

            .urgent-indicators {
                margin-top: 20px !important;
            }

            .urgent-indicator {
                width: 10px !important;
                height: 10px !important;
            }
        }


        @media (max-width: 480px) {
            .superad-card {
                width: 220px !important;
                height: 350px !important;
            }

            .topad-card {
                width: 220px !important;
                height: 350px !important;
            }

            .urgent-card {
                max-width: 46% !important;
                min-width: 150px !important;
                flex: 0 0 47%;
            }

            .urgent-cards-group {
                gap: 3% !important;
                padding: 0 8px;
            }

            .urgent-inner-box {
                height: 350px !important;
            }

            .urgent-card-image {
                height: 160px !important;
            }

            .urgent-lower-content {
                height: 190px !important;
                padding: 10px !important;
            }

            .urgent-card-title {
                font-size: 13px !important;
                max-height: 35px !important;
            }

            .urgent-card-location li {
                font-size: 11px !important;
            }

            .urgent-card-price {
                font-size: 15px !important;
            }

            .urgent-indicators {
                margin-top: 20px !important;
            }

            .urgent-indicator {
                width: 10px !important;
                height: 10px !important;
            }
        }

        /* Ensure smooth transitions */
        .large-device-slider,
        .small-device-slider {
            transition: transform 0.5s ease;
        }
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
                @foreach ($all_banners as $key => $banner)
                    @if ($banner->type == 0)
                        @if (isset($banner->url))
                            <a href="{{ $banner->url }}" target="_blank">
                        @endif
                        <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ url('banners/' . $banner->img) }}" class="mx-auto d-block" alt="Banner Image">
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
        <div class="container">
            <div class="row justify-content-center text-center">
                <h2 class="heading"><b>@lang('messages.indextitle') <br>
                        @lang('messages.Best') <span> @lang('messages.Super')</span></b></h2>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-10">
                        <p style="font-size:16px; text-align:justify;">@lang('messages.para2')</p>
                    </div>
                </div>

                @if (count($superAds) > 0)
                    <div class="cards-container"
                        style="position: relative; height: 600px; margin: 60px auto; max-width: 900px; display: flex; justify-content: center; align-items: center;">

                        @php
                            $displayAds = $superAds->take(3);
                            $totalAds = count($superAds);
                        @endphp

                        @foreach ($displayAds as $index => $adss)
                            <div class="superad-card card-{{ $index == 0 ? 'left' : ($index == 1 ? 'center' : 'right') }}"
                                data-ad-id="{{ $adss->adsId }}"
                                style="position: absolute; width: 320px; height: 500px; border: 4px solid #0b128e; border-radius: 8px; overflow: hidden; background-color: white; animation: blinkBlue 1.5s infinite; transition: all 0.3s ease; cursor: pointer;
                            @if ($index == 0) left: 7rem; transform: scale(0.85) translateX(-30px); opacity: 0.7; z-index: 1;
                            @elseif($index == 1)
                                left: 50%; transform: translateX(-50%) scale(1.1); opacity: 1; z-index: 3;
                            @else
                                right: 7rem; transform: scale(0.85) translateX(30px); opacity: 0.7; z-index: 1; @endif">

                                <a href="/browse_ads_details/{{ $adss->adsId }}"
                                    style="display: block; height: 100%; text-decoration: none; color: inherit;">
                                    <img src="{{ asset('storage/' . $adss->mainImage) }}"
                                        class="d-block w-100 h-100 card-image"
                                        style="object-fit: contain; background-color: white;" alt="{{ $adss->title }}">

                                    <button class="sale"
                                        style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2; display: flex; align-items: center; justify-content: center;">
                                        Sale
                                    </button>

                                    <div class="badge" style="position: absolute; top: 10px; left: 10px; z-index: 2;">
                                        <img src="{{ asset('02.png') }}" alt="Top Ad" style="width: 20px; height: 20px;">
                                    </div>

                                    <div
                                        style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent); border-radius: 5px;">
                                    </div>
                                </a>

                                <div class="p-2 details"
                                    style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(0, 0, 0, 0.6); color: white; z-index: 3; text-align: center; padding: 15px;">

                                    <p class="card-category" style="margin-bottom: 8px; font-size: 14px;">
                                        {{ $adss->category->name ?? 'Uncategorized' }} &raquo;
                                        {{ $adss->subcategory->name ?? '' }}
                                    </p>

                                    <h3 class="card-title"
                                        style="font-weight: bold; font-size: 1.1rem; color: white; margin-bottom: 8px;">
                                        {{ $adss->title }}
                                    </h3>

                                    <p class="price card-price"
                                        style="color: white; font-size: 1.2rem; margin-bottom: 8px;">
                                        @lang('messages.Rs') {{ number_format($adss->price, 2) }}
                                    </p>

                                    <p class="card-time"><i class="fas fa-clock"></i>
                                        {{ $adss->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Navigation and indicators now show for 2 or more ads --}}
                        @if ($totalAds >= 2)
                            <div class="navigation-buttons"
                                style="position: absolute; top: 50%; transform: translateY(-50%); z-index: 5;">
                                <button class="nav-btn nav-prev" onclick="previousSlide()"
                                    style="position: absolute; left: -30rem; background: rgba(11, 18, 142, 0.8); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 16px; transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="nav-btn nav-next" onclick="nextSlide()"
                                    style="position: absolute; right: -30rem; background: rgba(11, 18, 142, 0.8); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 16px; transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>

                            <div class="indicators"
                                style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 5;">
                                @foreach ($superAds as $indicatorIndex => $ad)
                                    <div class="indicator {{ $indicatorIndex == 0 ? 'active' : '' }}"
                                        onclick="goToSlide({{ $indicatorIndex }})"
                                        style="width: 10px; height: 10px; border-radius: 50%; background: {{ $indicatorIndex == 0 ? '#0b128e' : 'rgba(11, 18, 142, 0.3)' }}; cursor: pointer; transition: all 0.3s ease;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- JavaScript now runs for 2 or more ads --}}
                    @if ($totalAds >= 2)
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const superAdsData = @json($superAds->values());
                                let currentIndex = 0;
                                const totalItems = superAdsData.length;

                                function updateCards() {
                                    const cards = document.querySelectorAll('.superad-card');

                                    if (totalItems >= 3) {
                                        // Original logic for 3 or more ads
                                        const leftIndex = (currentIndex - 1 + totalItems) % totalItems;
                                        const centerIndex = currentIndex;
                                        const rightIndex = (currentIndex + 1) % totalItems;

                                        if (cards.length >= 3) {
                                            const leftCard = cards[0];
                                            const centerCard = cards[1];
                                            const rightCard = cards[2];

                                            updateCard(leftCard, superAdsData[leftIndex]);
                                            updateCard(centerCard, superAdsData[centerIndex]);
                                            updateCard(rightCard, superAdsData[rightIndex]);
                                        }
                                    } else if (totalItems === 2) {
                                        // Special handling for exactly 2 ads
                                        const centerIndex = currentIndex;
                                        const sideIndex = (currentIndex + 1) % totalItems;

                                        if (cards.length >= 2) {
                                            // For 2 ads, we'll use the first two card positions
                                            const centerCard = cards[1]; // Middle card
                                            const sideCard = cards[0]; // Left card (we'll reposition it)

                                            updateCard(centerCard, superAdsData[centerIndex]);
                                            updateCard(sideCard, superAdsData[sideIndex]);

                                            // Reposition the side card to the right
                                            sideCard.style.left = 'auto';
                                            sideCard.style.right = '7rem';
                                            sideCard.style.transform = 'scale(0.85) translateX(30px)';

                                            // Hide the third card if it exists
                                            if (cards[2]) {
                                                cards[2].style.display = 'none';
                                            }
                                        }
                                    }

                                    updateIndicators();
                                }

                                function updateCard(cardElement, data) {
                                    if (!cardElement || !data) return;

                                    const img = cardElement.querySelector('.card-image');
                                    const category = cardElement.querySelector('.card-category');
                                    const title = cardElement.querySelector('.card-title');
                                    const price = cardElement.querySelector('.card-price');
                                    const time = cardElement.querySelector('.card-time');
                                    const link = cardElement.querySelector('a');

                                    if (img) {
                                        img.src = `/storage/${data.mainImage}`;
                                        img.alt = data.title;
                                    }

                                    if (category) {
                                        const categoryName = data.category?.name || 'Uncategorized';
                                        const subcategoryName = data.subcategory?.name || '';
                                        category.innerHTML = `${categoryName} &raquo; ${subcategoryName}`;
                                    }

                                    if (title) {
                                        title.textContent = data.title;
                                    }

                                    if (price) {
                                        const formattedPrice = parseFloat(data.price).toLocaleString('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        });
                                        price.innerHTML = `@lang('messages.Rs') ${formattedPrice}`;
                                    }

                                    if (time) {
                                        time.innerHTML = `<i class="fas fa-clock"></i> ${formatTimeAgo(data.created_at)}`;
                                    }

                                    if (link) {
                                        link.href = `/browse_ads_details/${data.adsId}`;
                                    }

                                    cardElement.setAttribute('data-ad-id', data.adsId);
                                }

                                function updateIndicators() {
                                    const indicators = document.querySelectorAll('.indicator');
                                    indicators.forEach((indicator, index) => {
                                        const isActive = index === currentIndex;
                                        indicator.style.background = isActive ? '#0b128e' : 'rgba(11, 18, 142, 0.3)';
                                        indicator.style.transform = isActive ? 'scale(1.2)' : 'scale(1)';
                                    });
                                }

                                function formatTimeAgo(dateString) {
                                    const date = new Date(dateString);
                                    const now = new Date();
                                    const diffInMilliseconds = now - date;
                                    const diffInMinutes = Math.floor(diffInMilliseconds / (1000 * 60));
                                    const diffInHours = Math.floor(diffInMinutes / 60);
                                    const diffInDays = Math.floor(diffInHours / 24);

                                    if (diffInMinutes < 60) {
                                        return diffInMinutes <= 1 ? 'Just now' : `${diffInMinutes} minutes ago`;
                                    } else if (diffInHours < 24) {
                                        return diffInHours === 1 ? '1 hour ago' : `${diffInHours} hours ago`;
                                    } else if (diffInDays < 7) {
                                        return diffInDays === 1 ? '1 day ago' : `${diffInDays} days ago`;
                                    } else {
                                        const diffInWeeks = Math.floor(diffInDays / 7);
                                        return diffInWeeks === 1 ? '1 week ago' : `${diffInWeeks} weeks ago`;
                                    }
                                }

                                function nextSlide() {
                                    currentIndex = (currentIndex + 1) % totalItems;
                                    updateCards();
                                }

                                function previousSlide() {
                                    currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                                    updateCards();
                                }

                                function goToSlide(index) {
                                    currentIndex = index;
                                    updateCards();
                                }

                                // Make functions globally available
                                window.nextSlide = nextSlide;
                                window.previousSlide = previousSlide;
                                window.goToSlide = goToSlide;

                                // Add hover effects
                                const cards = document.querySelectorAll('.superad-card');
                                cards.forEach((card, index) => {
                                    card.addEventListener('mouseenter', function() {
                                        const currentTransform = this.style.transform;
                                        const newTransform = currentTransform
                                            .replace('scale(0.85)', 'scale(1.05)')
                                            .replace('scale(1.1)', 'scale(1.15)');
                                        this.style.transform = newTransform;
                                        this.style.zIndex = '10';
                                        this.style.opacity = '1';
                                    });

                                    card.addEventListener('mouseleave', function() {
                                        if (this.classList.contains('card-left')) {
                                            this.style.transform = 'scale(0.85) translateX(-30px)';
                                            this.style.opacity = '0.7';
                                            this.style.zIndex = '1';
                                        } else if (this.classList.contains('card-center')) {
                                            this.style.transform = 'translateX(-50%) scale(1.1)';
                                            this.style.opacity = '1';
                                            this.style.zIndex = '3';
                                        } else if (this.classList.contains('card-right')) {
                                            this.style.transform = 'scale(0.85) translateX(30px)';
                                            this.style.opacity = '0.7';
                                            this.style.zIndex = '1';
                                        }
                                    });
                                });

                                // Auto-play functionality
                                let autoPlayInterval;

                                function startAutoPlay() {
                                    autoPlayInterval = setInterval(nextSlide, 5000);
                                }

                                function stopAutoPlay() {
                                    clearInterval(autoPlayInterval);
                                }

                                // Pause auto-play on hover
                                const container = document.querySelector('.cards-container');
                                if (container) {
                                    container.addEventListener('mouseenter', stopAutoPlay);
                                    container.addEventListener('mouseleave', startAutoPlay);
                                }

                                // Initialize the carousel
                                updateCards();

                                // Start auto-play
                                startAutoPlay();
                            });
                        </script>
                    @endif
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            @lang('messages.No super ads available at the moment')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="mt-5 topad-section">
        <div class="row auto-container">
            <div class="row justify-content-center text-center">
                <div class="first-row">
                    <h2 class="heading"><b>Top Ads</b></h2>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-10">
                        <p style="font-size:16px; text-align:justify;">@lang('messages.para1')</p>
                    </div>
                </div>

                @if (count($topAds) > 0)
                    <div class="top-ads-container"
                        style="position: relative; height: 600px; margin: 60px auto; max-width: 900px; display: flex; justify-content: center; align-items: center;">

                        @php
                            $totalTopAds = count($topAds);
                            // Always show 3 cards for consistent layout, cycling through available ads
                            $displayTopAds = $topAds->take(3);
                        @endphp

                        @foreach ($displayTopAds as $index => $ad)
                            <div class="topad-card card-{{ $index == 0 ? 'left' : ($index == 1 ? 'center' : 'right') }}"
                                data-ad-id="{{ $ad->adsId }}"
                                style="position: absolute; width: 320px; height: 500px; border: 4px solid #00ff44; border-radius: 8px; overflow: hidden; background-color: white; animation: blinkGreen 1.5s infinite; transition: all 0.3s ease; cursor: pointer;
                            @if ($index == 0) left: 7rem; transform: scale(0.85) translateX(-30px); opacity: 0.7; z-index: 1;
                            @elseif($index == 1)
                                left: 50%; transform: translateX(-50%) scale(1.1); opacity: 1; z-index: 3;
                            @else
                                right: 7rem; transform: scale(0.85) translateX(30px); opacity: 0.7; z-index: 1; @endif">

                                <a href="/browse_ads_details/{{ $ad->adsId }}"
                                    style="display: block; height: 100%; text-decoration: none; color: inherit;">
                                    <img src="{{ asset('storage/' . $ad->mainImage) }}"
                                        class="d-block w-100 h-100 top-card-image"
                                        style="object-fit: contain; background-color: white;" alt="{{ $ad->title }}">

                                    <button class="sale"
                                        style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2; display: flex; align-items: center; justify-content: center;">
                                        Sale
                                    </button>

                                    <div class="badge" style="position: absolute; top: 10px; left: 10px; z-index: 2;">
                                        <img src="{{ asset('01.png') }}" alt="Top Ad"
                                            style="width: 20px; height: 20px;">
                                    </div>

                                    <div
                                        style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(0, 0, 0, 0.5), transparent); border-radius: 5px;">
                                    </div>
                                </a>

                                <div class="p-2 details"
                                    style="position: absolute; bottom: 0; left: 0; width: 100%; background: rgba(0, 0, 0, 0.6); color: white; z-index: 3; text-align: center; padding: 15px;">

                                    <p class="top-card-category" style="margin-bottom: 8px; font-size: 14px;">
                                        {{ $ad->category->name ?? 'Uncategorized' }} &raquo;
                                        {{ $ad->subcategory->name ?? '' }}
                                    </p>

                                    <h3 class="top-card-title"
                                        style="font-weight: bold; font-size: 1.1rem; color: white; margin-bottom: 8px;">
                                        {{ $ad->title }}
                                    </h3>

                                    <p class="price top-card-price"
                                        style="color: white; font-size: 1.2rem; margin-bottom: 8px;">
                                        @lang('messages.Rs') {{ number_format($ad->price, 2) }}
                                    </p>

                                    <p class="top-card-time"><i class="fas fa-clock"></i>
                                        {{ $ad->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach

                        {{-- Show navigation for 2 or more ads --}}
                        @if ($totalTopAds >= 2)
                            <div class="top-navigation-buttons"
                                style="position: absolute; top: 50%; transform: translateY(-50%); z-index: 5;">
                                <button class="top-nav-btn top-nav-prev" onclick="previousTopSlide()"
                                    style="position: absolute; left: -30rem; background: rgba(0, 255, 68, 0.8); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 16px; transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <button class="top-nav-btn top-nav-next" onclick="nextTopSlide()"
                                    style="position: absolute; right: -30rem; background: rgba(0, 255, 68, 0.8); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 16px; transition: all 0.3s ease;">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>

                            <div class="top-indicators"
                                style="position: absolute; bottom: -40px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 5;">
                                @foreach ($topAds as $indicatorIndex => $topAd)
                                    <div class="top-indicator {{ $indicatorIndex == 0 ? 'active' : '' }}"
                                        onclick="goToTopSlide({{ $indicatorIndex }})"
                                        style="width: 10px; height: 10px; border-radius: 50%; background: {{ $indicatorIndex == 0 ? '#00ff44' : 'rgba(0, 255, 68, 0.3)' }}; cursor: pointer; transition: all 0.3s ease;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Include script for 2 or more ads --}}
                    @if ($totalTopAds >= 1)
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const topAdsData = @json($topAds->values());
                                let currentTopIndex = 0;
                                const totalTopItems = topAdsData.length;

                                function updateTopCards() {
                                    if (totalTopItems < 2) return;

                                    let leftIndex, centerIndex, rightIndex;

                                    if (totalTopItems === 2) {
                                        // Special handling for 2 ads: cycle between them
                                        leftIndex = (currentTopIndex + 1) % totalTopItems;
                                        centerIndex = currentTopIndex;
                                        rightIndex = (currentTopIndex + 1) % totalTopItems;
                                    } else {
                                        // Normal handling for 3+ ads
                                        leftIndex = (currentTopIndex - 1 + totalTopItems) % totalTopItems;
                                        centerIndex = currentTopIndex;
                                        rightIndex = (currentTopIndex + 1) % totalTopItems;
                                    }

                                    const topCards = document.querySelectorAll('.topad-card');

                                    // Always update all three visible cards
                                    if (topCards.length >= 1) updateTopCard(topCards[0], topAdsData[leftIndex]);
                                    if (topCards.length >= 2) updateTopCard(topCards[1], topAdsData[centerIndex]);
                                    if (topCards.length >= 3) updateTopCard(topCards[2], topAdsData[rightIndex]);

                                    updateTopIndicators();
                                }

                                function updateTopCard(cardElement, data) {
                                    if (!cardElement || !data) return;

                                    const img = cardElement.querySelector('.top-card-image');
                                    const category = cardElement.querySelector('.top-card-category');
                                    const title = cardElement.querySelector('.top-card-title');
                                    const price = cardElement.querySelector('.top-card-price');
                                    const time = cardElement.querySelector('.top-card-time');
                                    const link = cardElement.querySelector('a');

                                    if (img) {
                                        img.src = `/storage/${data.mainImage}`;
                                        img.alt = data.title;
                                    }

                                    if (category) {
                                        const categoryName = data.category?.name || 'Uncategorized';
                                        const subcategoryName = data.subcategory?.name || '';
                                        category.innerHTML = `${categoryName} &raquo; ${subcategoryName}`;
                                    }

                                    if (title) {
                                        title.textContent = data.title;
                                    }

                                    if (price) {
                                        const formattedPrice = parseFloat(data.price).toLocaleString('en-US', {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        });
                                        price.innerHTML = `@lang('messages.Rs') ${formattedPrice}`;
                                    }

                                    if (time) {
                                        time.innerHTML = `<i class="fas fa-clock"></i> ${formatTopTimeAgo(data.created_at)}`;
                                    }

                                    if (link) {
                                        link.href = `/browse_ads_details/${data.adsId}`;
                                    }

                                    cardElement.setAttribute('data-ad-id', data.adsId);
                                }

                                function updateTopIndicators() {
                                    const indicators = document.querySelectorAll('.top-indicator');
                                    indicators.forEach((indicator, index) => {
                                        const isActive = index === currentTopIndex;
                                        indicator.style.background = isActive ? '#00ff44' : 'rgba(0, 255, 68, 0.3)';
                                        indicator.style.transform = isActive ? 'scale(1.2)' : 'scale(1)';
                                    });
                                }

                                function formatTopTimeAgo(dateString) {
                                    const date = new Date(dateString);
                                    const now = new Date();
                                    const diffInMilliseconds = now - date;
                                    const diffInMinutes = Math.floor(diffInMilliseconds / (1000 * 60));
                                    const diffInHours = Math.floor(diffInMinutes / 60);
                                    const diffInDays = Math.floor(diffInHours / 24);

                                    if (diffInMinutes < 60) {
                                        return diffInMinutes <= 1 ? 'Just now' : `${diffInMinutes} minutes ago`;
                                    } else if (diffInHours < 24) {
                                        return diffInHours === 1 ? '1 hour ago' : `${diffInHours} hours ago`;
                                    } else if (diffInDays < 7) {
                                        return diffInDays === 1 ? '1 day ago' : `${diffInDays} days ago`;
                                    } else {
                                        const diffInWeeks = Math.floor(diffInDays / 7);
                                        return diffInWeeks === 1 ? '1 week ago' : `${diffInWeeks} weeks ago`;
                                    }
                                }

                                function nextTopSlide() {
                                    currentTopIndex = (currentTopIndex + 1) % totalTopItems;
                                    updateTopCards();
                                }

                                function previousTopSlide() {
                                    currentTopIndex = (currentTopIndex - 1 + totalTopItems) % totalTopItems;
                                    updateTopCards();
                                }

                                function goToTopSlide(index) {
                                    currentTopIndex = index;
                                    updateTopCards();
                                }

                                // Make functions globally available
                                window.nextTopSlide = nextTopSlide;
                                window.previousTopSlide = previousTopSlide;
                                window.goToTopSlide = goToTopSlide;

                                // Add hover effects for top ads
                                const topCards = document.querySelectorAll('.topad-card');
                                topCards.forEach((card, index) => {
                                    card.addEventListener('mouseenter', function() {
                                        const currentTransform = this.style.transform;
                                        const newTransform = currentTransform
                                            .replace('scale(0.85)', 'scale(1.05)')
                                            .replace('scale(1.1)', 'scale(1.15)');
                                        this.style.transform = newTransform;
                                        this.style.zIndex = '10';
                                        this.style.opacity = '1';
                                    });

                                    card.addEventListener('mouseleave', function() {
                                        if (this.classList.contains('card-left')) {
                                            this.style.transform = 'scale(0.85) translateX(-30px)';
                                            this.style.opacity = '0.7';
                                            this.style.zIndex = '1';
                                        } else if (this.classList.contains('card-center')) {
                                            this.style.transform = 'translateX(-50%) scale(1.1)';
                                            this.style.opacity = '1';
                                            this.style.zIndex = '3';
                                        } else if (this.classList.contains('card-right')) {
                                            this.style.transform = 'scale(0.85) translateX(30px)';
                                            this.style.opacity = '0.7';
                                            this.style.zIndex = '1';
                                        }
                                    });
                                });

                                // Auto-play functionality for top ads
                                let topAutoPlayInterval;

                                function startTopAutoPlay() {
                                    topAutoPlayInterval = setInterval(nextTopSlide, 5000);
                                }

                                function stopTopAutoPlay() {
                                    clearInterval(topAutoPlayInterval);
                                }

                                // Pause auto-play on hover
                                const topContainer = document.querySelector('.top-ads-container');
                                if (topContainer) {
                                    topContainer.addEventListener('mouseenter', stopTopAutoPlay);
                                    topContainer.addEventListener('mouseleave', startTopAutoPlay);
                                }

                                // Initialize auto-play for top ads (uncomment to enable)
                                startTopAutoPlay();

                                // Initialize the carousel on page load
                                if (totalTopItems >= 2) {
                                    updateTopCards();
                                }
                            });
                        </script>
                    @endif
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            @lang('messages.No top ads available at the moment')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- feature-style-two -->
    <section class="feature-style-two">
        <div class="auto-container">
            <div class="sec-title centred">
                <h2>@lang('messages.Urgent')</h2>
                <p>@lang('messages.para3')</p>
            </div>

            @if (count($latestAds) > 0)
                <div class="urgent-ads-container" style="position: relative; margin: 40px auto; overflow: hidden;">
                    <div class="urgent-cards-wrapper" style="display: flex; transition: transform 0.5s ease;">

                        @php
                            // For large devices: chunk by 4, for small devices: chunk by 2
                            $chunkedAdsLarge = $latestAds->chunk(4);
                            $chunkedAdsSmall = $latestAds->chunk(2);
                        @endphp

                        <!-- Large device layout (4 ads per slide) -->
                        <div class="large-device-slider" style="display: flex; width: 100%;">
                            @foreach ($chunkedAdsLarge as $groupIndex => $adsGroup)
                                <div class="urgent-cards-group large-group"
                                    style="display: flex; min-width: 100%; gap: 20px; justify-content: center; align-items: stretch;">
                                    @foreach ($adsGroup as $ads)
                                        <div class="urgent-card" style="flex: 1; max-width: 280px; min-width: 250px;">
                                            <a href="/browse_ads_details/{{ $ads->adsId }}"
                                                style="text-decoration: none; color: inherit;">
                                                <div class="feature-block-one">
                                                    <div class="inner-box urgent-inner-box"
                                                        style="border: 4px solid red; border-radius: 4px; overflow: hidden; animation: blinkRed 1.5s infinite; height: 450px; display: flex; flex-direction: column;">

                                                        <div class="image-box"
                                                            style="position: relative; flex-shrink: 0;">
                                                            <figure class="image" style="margin: 0; overflow: hidden;">
                                                                <img src="{{ asset('storage/' . $ads->mainImage) }}"
                                                                    alt="{{ $ads->title }}" class="urgent-card-image"
                                                                    style="width: 100%; height: 220px; object-fit: contain; background-color: white;">
                                                            </figure>

                                                            <div class="feature"
                                                                style="background-color: rgb(171, 18, 18); position: absolute; top: 10px; left: 10px; color: white; padding: 5px 10px; font-size: 12px; font-weight: bold; border-radius: 3px; z-index: 2;">
                                                                Urgent
                                                            </div>
                                                        </div>

                                                        <div class="lower-content urgent-lower-content"
                                                            style="display: flex; flex-direction: column; justify-content: space-between; height: 230px; padding: 15px; flex-grow: 1;">

                                                            <h3 class="urgent-card-title"
                                                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; max-height: 55px; margin: 0 0 15px 0; font-size: 16px; line-height: 1.4;">
                                                                {{ $ads->title }}
                                                            </h3>

                                                            <ul class="clearfix info urgent-card-location"
                                                                style="list-style: none; padding: 0; margin: 0 0 15px 0;">
                                                                <li
                                                                    style="display: flex; align-items: center; font-size: 14px; color: #666;">
                                                                    <i class="fas fa-map-marker-alt"
                                                                        style="margin-right: 8px; color: #e74c3c;"></i>
                                                                    @php
                                                                        $locale = App::getLocale();
                                                                        $locationName = 'name_' . $locale;
                                                                    @endphp
                                                                    <span class="urgent-location-text">
                                                                        {{ $ads->sub_location ? $ads->sub_location->$locationName : 'N/A' }},
                                                                        {{ $ads->main_location ? $ads->main_location->$locationName : 'N/A' }}
                                                                    </span>
                                                                </li>
                                                            </ul>

                                                            <div class="lower-box" style="margin-top: auto;">
                                                                <h5 class="urgent-card-price"
                                                                    style="margin: 0; font-size: 18px; font-weight: bold; color: #e74c3c;">
                                                                    <span
                                                                        style="font-weight: normal; color: #333;">Price:</span>
                                                                    @lang('messages.Rs') {{ number_format($ads->price, 2) }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                    @for ($i = count($adsGroup); $i < 4; $i++)
                                        <div class="urgent-card-placeholder"
                                            style="flex: 1; max-width: 280px; min-width: 250px; visibility: hidden;"></div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>

                        <!-- Small device layout (2 ads per slide) -->
                        <div class="small-device-slider" style="display: none; width: 100%;">
                            @foreach ($chunkedAdsSmall as $groupIndex => $adsGroup)
                                <div class="urgent-cards-group small-group"
                                    style="display: flex; min-width: 100%; gap: 15px; justify-content: center; align-items: stretch;">
                                    @foreach ($adsGroup as $ads)
                                        <div class="urgent-card" style="flex: 1; max-width: 300px; min-width: 280px;">
                                            <a href="/browse_ads_details/{{ $ads->adsId }}"
                                                style="text-decoration: none; color: inherit;">
                                                <div class="feature-block-one">
                                                    <div class="inner-box urgent-inner-box"
                                                        style="border: 4px solid red; border-radius: 4px; overflow: hidden; animation: blinkRed 1.5s infinite; height: 450px; display: flex; flex-direction: column;">

                                                        <div class="image-box"
                                                            style="position: relative; flex-shrink: 0;">
                                                            <figure class="image" style="margin: 0; overflow: hidden;">
                                                                <img src="{{ asset('storage/' . $ads->mainImage) }}"
                                                                    alt="{{ $ads->title }}" class="urgent-card-image"
                                                                    style="width: 100%; height: 220px; object-fit: contain; background-color: white;">
                                                            </figure>

                                                            <div class="feature"
                                                                style="background-color: rgb(171, 18, 18); position: absolute; top: 10px; left: 10px; color: white; padding: 5px 10px; font-size: 12px; font-weight: bold; border-radius: 3px; z-index: 2;">
                                                                Urgent
                                                            </div>
                                                        </div>

                                                        <div class="lower-content urgent-lower-content"
                                                            style="display: flex; flex-direction: column; justify-content: space-between; height: 230px; padding: 15px; flex-grow: 1;">

                                                            <h3 class="urgent-card-title"
                                                                style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; max-height: 55px; margin: 0 0 15px 0; font-size: 16px; line-height: 1.4;">
                                                                {{ $ads->title }}
                                                            </h3>

                                                            <ul class="clearfix info urgent-card-location"
                                                                style="list-style: none; padding: 0; margin: 0 0 15px 0;">
                                                                <li
                                                                    style="display: flex; align-items: center; font-size: 14px; color: #666;">
                                                                    <i class="fas fa-map-marker-alt"
                                                                        style="margin-right: 8px; color: #e74c3c;"></i>
                                                                    @php
                                                                        $locale = App::getLocale();
                                                                        $locationName = 'name_' . $locale;
                                                                    @endphp
                                                                    <span class="urgent-location-text">
                                                                        {{ $ads->sub_location ? $ads->sub_location->$locationName : 'N/A' }},
                                                                        {{ $ads->main_location ? $ads->main_location->$locationName : 'N/A' }}
                                                                    </span>
                                                                </li>
                                                            </ul>

                                                            <div class="lower-box" style="margin-top: auto;">
                                                                <h5 class="urgent-card-price"
                                                                    style="margin: 0; font-size: 18px; font-weight: bold; color: #e74c3c;">
                                                                    <span
                                                                        style="font-weight: normal; color: #333;">Price:</span>
                                                                    @lang('messages.Rs') {{ number_format($ads->price, 2) }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                    @for ($i = count($adsGroup); $i < 2; $i++)
                                        <div class="urgent-card-placeholder"
                                            style="flex: 1; max-width: 300px; min-width: 280px; visibility: hidden;"></div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation arrows - only visible on large devices -->
                    @if (count($chunkedAdsLarge) > 1 || count($chunkedAdsSmall) > 1)
                        <div class="urgent-navigation large-device-navigation"
                            style="position: absolute; top: 50%; transform: translateY(-50%); width: 100%; pointer-events: none;">
                            <button class="urgent-nav-btn urgent-nav-prev" onclick="previousUrgentSlide()"
                                style="position: absolute; left: -50px; background: rgba(231, 76, 60, 0.9); color: white; border: none; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; font-size: 18px; transition: all 0.3s ease; pointer-events: auto; z-index: 10;">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="urgent-nav-btn urgent-nav-next" onclick="nextUrgentSlide()"
                                style="position: absolute; right: -50px; background: rgba(231, 76, 60, 0.9); color: white; border: none; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; font-size: 18px; transition: all 0.3s ease; pointer-events: auto; z-index: 10;">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>

                        <!-- Indicators -->
                        <div class="urgent-indicators large-indicators"
                            style="display: flex; justify-content: center; margin-top: 30px; gap: 10px;">
                            @foreach ($chunkedAdsLarge as $indicatorIndex => $group)
                                <div class="urgent-indicator {{ $indicatorIndex == 0 ? 'active' : '' }}"
                                    onclick="goToUrgentSlide({{ $indicatorIndex }})"
                                    style="width: 12px; height: 12px; border-radius: 50%; background: {{ $indicatorIndex == 0 ? '#e74c3c' : 'rgba(231, 76, 60, 0.3)' }}; cursor: pointer; transition: all 0.3s ease;">
                                </div>
                            @endforeach
                        </div>

                        <div class="urgent-indicators small-indicators"
                            style="display: none; justify-content: center; margin-top: 30px; gap: 10px;">
                            @foreach ($chunkedAdsSmall as $indicatorIndex => $group)
                                <div class="urgent-indicator {{ $indicatorIndex == 0 ? 'active' : '' }}"
                                    onclick="goToUrgentSlide({{ $indicatorIndex }})"
                                    style="width: 12px; height: 12px; border-radius: 50%; background: {{ $indicatorIndex == 0 ? '#e74c3c' : 'rgba(231, 76, 60, 0.3)' }}; cursor: pointer; transition: all 0.3s ease;">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if (count($chunkedAdsLarge) > 1 || count($chunkedAdsSmall) > 1)
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const urgentAdsData = @json($latestAds->values());
                            let currentUrgentIndex = 0;
                            let isSmallDevice = false;
                            let urgentTotalGroups = 0;

                            const largeDeviceSlider = document.querySelector('.large-device-slider');
                            const smallDeviceSlider = document.querySelector('.small-device-slider');
                            const largeNavigation = document.querySelector('.large-device-navigation');
                            const largeIndicators = document.querySelector('.large-indicators');
                            const smallIndicators = document.querySelector('.small-indicators');

                            function checkScreenSize() {
                                const screenWidth = window.innerWidth;
                                const wasSmallDevice = isSmallDevice;

                                // Define breakpoint for small devices (tablets and below)
                                isSmallDevice = screenWidth <= 992;

                                if (wasSmallDevice !== isSmallDevice) {
                                    // Screen size changed, reset slider
                                    currentUrgentIndex = 0;
                                    updateSliderVisibility();
                                    calculateTotalGroups();
                                    updateUrgentSlider();
                                }
                            }

                            function updateSliderVisibility() {
                                if (isSmallDevice) {
                                    largeDeviceSlider.style.display = 'none';
                                    smallDeviceSlider.style.display = 'flex';
                                    if (largeNavigation) largeNavigation.style.display = 'none';
                                    if (largeIndicators) largeIndicators.style.display = 'none';
                                    if (smallIndicators) smallIndicators.style.display = 'flex';
                                } else {
                                    largeDeviceSlider.style.display = 'flex';
                                    smallDeviceSlider.style.display = 'none';
                                    if (largeNavigation) largeNavigation.style.display = 'block';
                                    if (largeIndicators) largeIndicators.style.display = 'flex';
                                    if (smallIndicators) smallIndicators.style.display = 'none';
                                }
                            }



                            function calculateTotalGroups() {
                                const chunkSize = isSmallDevice ? 2 : 4;
                                urgentTotalGroups = Math.ceil(urgentAdsData.length / chunkSize);
                            }

                            function updateUrgentSlider() {
                                const translateX = -currentUrgentIndex * 100;
                                const activeSlider = isSmallDevice ? smallDeviceSlider : largeDeviceSlider;
                                const wrapper = activeSlider.querySelector('.urgent-cards-group') ? activeSlider : activeSlider
                                    .parentElement;

                                if (isSmallDevice) {
                                    smallDeviceSlider.style.transform = `translateX(${translateX}%)`;
                                } else {
                                    largeDeviceSlider.style.transform = `translateX(${translateX}%)`;
                                }

                                updateUrgentIndicators();
                            }

                            function updateUrgentIndicators() {
                                const activeIndicators = isSmallDevice ?
                                    smallIndicators?.querySelectorAll('.urgent-indicator') :
                                    largeIndicators?.querySelectorAll('.urgent-indicator');

                                if (activeIndicators) {
                                    activeIndicators.forEach((indicator, index) => {
                                        const isActive = index === currentUrgentIndex;
                                        indicator.style.background = isActive ? '#e74c3c' : 'rgba(231, 76, 60, 0.3)';
                                        indicator.style.transform = isActive ? 'scale(1.2)' : 'scale(1)';
                                    });
                                }
                            }

                            function nextUrgentSlide() {
                                if (!isSmallDevice) { // Only work on large devices
                                    currentUrgentIndex = (currentUrgentIndex + 1) % urgentTotalGroups;
                                    updateUrgentSlider();
                                }
                            }

                            function previousUrgentSlide() {
                                if (!isSmallDevice) { // Only work on large devices
                                    currentUrgentIndex = (currentUrgentIndex - 1 + urgentTotalGroups) % urgentTotalGroups;
                                    updateUrgentSlider();
                                }
                            }

                            function goToUrgentSlide(index) {
                                currentUrgentIndex = index;
                                updateUrgentSlider();
                            }

                            // Make functions globally available
                            window.nextUrgentSlide = nextUrgentSlide;
                            window.previousUrgentSlide = previousUrgentSlide;
                            window.goToUrgentSlide = goToUrgentSlide;

                            // Add hover effects for navigation buttons (large devices only)
                            const urgentNavButtons = document.querySelectorAll('.urgent-nav-btn');
                            urgentNavButtons.forEach(btn => {
                                btn.addEventListener('mouseenter', function() {
                                    this.style.background = '#e74c3c';
                                    this.style.transform = 'scale(1.1)';
                                });

                                btn.addEventListener('mouseleave', function() {
                                    this.style.background = 'rgba(231, 76, 60, 0.9)';
                                    this.style.transform = 'scale(1)';
                                });
                            });

                            // Add hover effects for urgent cards
                            const urgentCards = document.querySelectorAll('.urgent-card');
                            urgentCards.forEach(card => {
                                const innerBox = card.querySelector('.urgent-inner-box');

                                card.addEventListener('mouseenter', function() {
                                    if (innerBox) {
                                        innerBox.style.transform = 'translateY(-5px)';
                                        innerBox.style.boxShadow = '0 10px 25px rgba(231, 76, 60, 0.3)';
                                    }
                                });

                                card.addEventListener('mouseleave', function() {
                                    if (innerBox) {
                                        innerBox.style.transform = 'translateY(0)';
                                        innerBox.style.boxShadow = 'none';
                                    }
                                });
                            });

                            // Touch/swipe support for small devices
                            let touchStartX = 0;
                            let touchEndX = 0;

                            function handleSwipe() {
                                if (isSmallDevice) {
                                    const swipeThreshold = 50;
                                    const diff = touchStartX - touchEndX;

                                    if (Math.abs(diff) > swipeThreshold) {
                                        if (diff > 0) {
                                            // Swipe left - next slide
                                            currentUrgentIndex = (currentUrgentIndex + 1) % urgentTotalGroups;
                                        } else {
                                            // Swipe right - previous slide
                                            currentUrgentIndex = (currentUrgentIndex - 1 + urgentTotalGroups) % urgentTotalGroups;
                                        }
                                        updateUrgentSlider();
                                    }
                                }
                            }

                            // Auto-slide urgent ads
                            let urgentAutoSlideInterval = setInterval(() => {
                                currentUrgentIndex = (currentUrgentIndex + 1) % urgentTotalGroups;
                                updateUrgentSlider();
                            }, 5000); // change every 5s

                            // Pause auto-slide on hover (desktop)
                            const urgentContainer = document.querySelector('.urgent-ads-container');
                            if (urgentContainer) {
                                urgentContainer.addEventListener('mouseenter', () => clearInterval(urgentAutoSlideInterval));
                                urgentContainer.addEventListener('mouseleave', () => {
                                    urgentAutoSlideInterval = setInterval(() => {
                                        currentUrgentIndex = (currentUrgentIndex + 1) % urgentTotalGroups;
                                        updateUrgentSlider();
                                    }, 5000);
                                });
                            }


                            // Initialize on page load
                            checkScreenSize();
                            calculateTotalGroups();
                            updateSliderVisibility();
                            updateUrgentSlider();

                            // Listen for window resize
                            window.addEventListener('resize', checkScreenSize);
                        });
                    </script>
                @endif
            @else
                <div class="alert alert-info text-center" role="alert" style="margin: 40px auto; max-width: 600px;">
                    @lang('messages.No urgent ads available at the moment')
                </div>
            @endif
        </div>
    </section>


    <!-- ad - banner-section start -->
    {{-- <section class="mb-0 ad-banner-container">
        <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                    @if ($banner->type == 0)
                        @if (isset($banner->url))
                            <a href="{{ $banner->url }}" target="_blank">
                        @endif
                        <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('banners/' . $banner->img) }}" class="mx-auto d-block"
                                alt="Banner Image">
                        </div>
                        @if (isset($banner->url))
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </section> --}}
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
        document.addEventListener('DOMContentLoaded', function() {
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
        document.addEventListener('DOMContentLoaded', function() {
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
