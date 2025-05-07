@extends ('newFrontend.master')

@section('content')
    <style>
        #adsCarousel .carousel-inner {
            height: 400px;
        }

        .carousel-item-content {
            position: relative;
            height: 100%;
        }

        .banner-img {
            height: 400px;
            object-fit: cover;
        }
        /* @media(max-width: 768px) {
            width: 100%;

        } */

        /* Dark overlay for carousel items */
        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Ensure text inside carousel is readable */
        .carousel-caption {
            bottom: 10%;
            left: 5%;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .carousel-caption p {
            font-size: 20px;
            color: white;

        }

        /* Top-left image for the carousel */
        .top-left-image {
            position: absolute;
            top: 5px;
            left: 5px;
            width: 70px;
            height: auto;
        }



        /* Blinking Border Animation */
        @keyframes blinking-border {
            0% {
                border-color: transparent;
            }

            50% {
                border-color: rgba(0, 255, 0, 0.8);
            }

            /* Green */
            100% {
                border-color: transparent;
            }
        }

        @keyframes blinking-border-blue {
            0% {
                border-color: transparent;
            }

            50% {
                border-color: rgba(0, 159, 245, 0.8);
            }

            /* Blue */
            100% {
                border-color: transparent;
            }
        }

        /* Apply Blinking Borders */
        .top-ad {
            animation: blinking-border 1.5s infinite;
            border: 2px solid transparent;
            border-radius: 10px;
        }

        .super-ad {
            animation: blinking-border-blue 1.5s infinite;
            border: 2px solid transparent;
            border-radius: 10px;
        }

        @keyframes blink {
            0% {
                border-color: red;
            }

            50% {
                border-color: transparent;
            }

            100% {
                border-color: red;
            }
        }

        .blink-border {
            border: 2px solid red;
            animation: blink 1s infinite;
        }
        /* Mobile-specific styles */
        @media (max-width: 1200px) {
            .feature-block {
                flex: 0 0 100% !important; /* Full width for mobile */
                max-width: 100% !important;
                margin-bottom: 15px !important;
                height: fit-content !important;
            }

            .feature-block-one .inner-box {
                flex-direction: row !important; /* Horizontal layout */
                gap: 15px;
            }

            .image-box {
                width: 40% !important;
                flex-shrink: 0;
            }

            .image-box img {
                height: 120px !important; /* Reduced image height */
                width: 100% !important;
            }

            .lower-content {
                width: 60% !important;
                padding-right: 10px !important;
            }

            /* Adjust sale button position */
            .sale {
                top: 5px !important;
                right: 5px !important;
            }

            /* Hide less important elements */
            .category, .far.fa-clock {
                display: none !important;
            }

            h4 {
                -webkit-line-clamp: 3 !important; /* Show more text */
                margin-top: 0 !important;
                font-size: 15px !important;
            }
            .icon img {
                height: 20px !important;
            }
            .time-dff {
                margin-left: -25px !important;
            }

            .lower-content {
                padding:unset !important;
            }
            .lower-box {
                padding:unset !important;
            }
            .btn-box a {
                width: max-content;
            }
        }

        @media (max-width: 992px) {
            .sidebar-side-mobile {
                display: none;
            }
        }
        .mobile-filter-toggle {
            display: none;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .red-filter-button {
            background: #e74c3c; /* Red color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            transition: background 0.3s ease;
        }

        .red-filter-button:hover {
            background: #c0392b; /* Darker red on hover */
        }

        .filter-icon {
            width: 20px;
            height: 20px;
            fill: white;
        }

        /* Show only on mobile */
        @media (max-width: 991px) {
            .mobile-filter-toggle {
                display: flex;
            }

            .sidebar-search,
            .sidebar-category {
                display: none;
            }
        }

        /* Hide sidebar on mobile */
        @media (max-width: 992px) {
            .sidebar-search, .sidebar-category {
                display: none;
            }
            .mobile-filter-toggle {
                display: block;
            }
        }

        /* Modal Styles */
        .filter-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 9999;
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 5px;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .close-modal {
            font-size: 28px;
            cursor: pointer;
            color: #666;
        }

        .close-modal:hover {
            color: #000;
        }
        /* Disable Bootstrap carousel sliding animation */
        .carousel.no-animation .carousel-item {
            transition: none !important;
            -webkit-transition: none !important;
        }

    </style>


    <!-- Page Title -->
    <section class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg);">
        <div class="auto-container">
            <div class="mr-0 content-box centred">
                <div class="title">
                    <h1>{{ $category ? __('messages.' . $category->name) : __('messages.All Categories') }}</h1> </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                        <li>@lang('messages.Browse Ads')</li>
                    </ul>
                </div>
            </div>
    </section>
    <!-- ad - banner-section start -->
    <section class="mb-0 ad-banner-container">
        <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach($all_banners as $key => $banner)
                    @if($banner->type == 0)
                        <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                           <img src="{{ asset('banners/' . $banner->img) }}" class="mx-auto d-block" alt="Banner Image">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- ad - banner-section end -->
    <!-- End Page Title -->
<!-- Add this before your sidebar section -->
<!-- Add this in your HTML -->
<div class="mobile-filter-toggle">
    <button id="filterToggle" class="red-filter-button">
        <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/>
        </svg>
        <span>Filters</span>
    </button>
</div>
<!-- Add this at the bottom of your page -->
<div class="filter-modal" id="filterModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Filters</h3>
            <span class="close-modal">&times;</span>
        </div>
        <div class="modal-body">
            <div class="mt-4 mb-4 auto-container">
                <div class="clearfix row">

                    <div class="col-md-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                            <div class="sidebar-search sidebar-widget">
                                <div class="widget-title">
                                    <h3>@lang('messages.Search')</h3>
                                </div>
                                <div class="widget-content">
                                    <form action="{{ route('browse-ads') }}" method="GET" class="search-form">
                                        <div class="form-group">
                                            <input type="search" name="search-field" style="padding-right: 20px"
                                                placeholder="@lang('messages.Search Keyword')..." value="{{ request()->input('search-field') }}"
                                                oninput="this.form.submit()">
                                            <button type="submit" style="display:none;"><i class="icon-2"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <i class="icon-3"></i>
                                            <select class="wide" name="location" onchange="this.form.submit()">
                                                <option data-display="@lang('messages.Select Location')">@lang('messages.Select Location')</option>
                                                @foreach ($districts as $district)
                                                    @php
                                                        $locale = App::getLocale();
                                                        $districtName = 'name_' . $locale;
                                                    @endphp
                                                    <option value="{{ $district->id }}"
                                                        {{ request()->input('location') == $district->id ? 'selected' : '' }}>
                                                        {{ $district->$districtName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- City Dropdown --}}
                                        <div class="form-group">
                                            <select class="wide" name="city" id="city">
                                                <option data-display="@lang('messages.Select City')">@lang('messages.Select City')</option>
                                                @foreach ($citys as $city)
                                                    @php
                                                        $locale = App::getLocale();
                                                        $cityName = 'name_' . $locale;
                                                    @endphp
                                                    <option value="{{ $city->id }}"
                                                        {{ request()->input('location') == $city->id ? 'selected' : '' }}>
                                                        {{ $city->$cityName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="sidebar-category sidebar-widget">
                                <div class="widget-title">
                                    <h3>@lang('messages.Categories')</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list">
                                        <li>
                                            <label>
                                                <input type="radio" name="category" value="all"
                                                    onchange="window.location='{{ route('browse-ads') }}'"
                                                    {{ !request()->input('category') ? 'checked' : '' }}>
                                                <span class="text-dark">@lang('messages.All Categories')</span>

                                            </label>
                                        </li>

                                        @foreach ($categories->take(14) as $category)
                                            <li class="{{ $category->subcategories->isNotEmpty() ? 'dropdown' : '' }}">
                                                <label>
                                                    <input type="radio" name="category" value="{{ $category->id }}"
                                                        onchange="window.location='{{ route('browse-ads', ['category' => $category->id]) }}'"
                                                        {{ request()->input('category') == $category->id ? 'checked' : '' }}>
                                                    <span> @lang('messages.' . $category->name)</span>
                                                </label>

                                                @if ($category->subcategories->isNotEmpty())
                                                    <ul>
                                                        @foreach ($category->subcategories as $subcategory)
                                                            <li>
                                                                <label>
                                                                    <input type="radio" name="subcategory"
                                                                        value="{{ $subcategory->id }}"
                                                                        onchange="window.location='{{ route('browse-ads', ['category' => $category->id, 'subcategory' => $subcategory->id]) }}'"
                                                                        {{ request()->input('subcategory') == $subcategory->id ? 'checked' : '' }}>
                                                                    <span> @lang('messages.' . $subcategory->name)</span>
                                                                </label>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="mt-4 mb-4 auto-container">
        <div class="clearfix row">

            <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side sidebar-side-mobile">
                <div class="default-sidebar category-sidebar">

                    <div class="sidebar-search sidebar-widget">
                        <div class="widget-title">
                            <h3>@lang('messages.Search')</h3>
                        </div>
                        <div class="widget-content">
                            <form action="{{ route('browse-ads') }}" method="GET" class="search-form">
                                <div class="form-group">
                                    <input type="search" name="search-field" style="padding-right: 20px"
                                        placeholder="@lang('messages.Search Keyword')..." value="{{ request()->input('search-field') }}"
                                        oninput="this.form.submit()">
                                    <button type="submit" style="display:none;"><i class="icon-2"></i></button>
                                </div>
                                <div class="form-group">
                                    <i class="icon-3"></i>
                                    <select class="wide" name="location" onchange="this.form.submit()">
                                        <option data-display="@lang('messages.Select Location')">@lang('messages.Select Location')</option>
                                        @foreach ($districts as $district)
                                            @php
                                                $locale = App::getLocale();
                                                $districtName = 'name_' . $locale;
                                            @endphp
                                            <option value="{{ $district->id }}"
                                                {{ request()->input('location') == $district->id ? 'selected' : '' }}>
                                                {{ $district->$districtName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- City Dropdown --}}
                                <div class="form-group">
                                    <select class="wide" name="city" id="city">
                                        <option data-display="@lang('messages.Select City')">@lang('messages.Select City')</option>
                                        @foreach ($citys as $city)
                                            @php
                                                $locale = App::getLocale();
                                                $cityName = 'name_' . $locale;
                                            @endphp
                                            <option value="{{ $city->id }}"
                                                {{ request()->input('location') == $city->id ? 'selected' : '' }}>
                                                {{ $city->$cityName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="sidebar-category sidebar-widget">
                        <div class="widget-title">
                            <h3>@lang('messages.Categories')</h3>
                        </div>
                        <div class="widget-content">
                            <ul class="category-list">
                                <li>
                                    <label>
                                        <input type="radio" name="category" value="all"
                                            onchange="window.location='{{ route('browse-ads') }}'"
                                            {{ !request()->input('category') ? 'checked' : '' }}>
                                        <span class="text-dark">@lang('messages.All Categories')</span>

                                    </label>
                                </li>

                                @foreach ($categories->take(14) as $category)
                                    <li class="{{ $category->subcategories->isNotEmpty() ? 'dropdown' : '' }}">
                                        <label>
                                            <input type="radio" name="category" value="{{ $category->id }}"
                                                onchange="window.location='{{ route('browse-ads', ['category' => $category->id]) }}'"
                                                {{ request()->input('category') == $category->id ? 'checked' : '' }}>
                                            <span> @lang('messages.' . $category->name)</span>
                                        </label>

                                        @if ($category->subcategories->isNotEmpty())
                                            <ul>
                                                @foreach ($category->subcategories as $subcategory)
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="subcategory"
                                                                value="{{ $subcategory->id }}"
                                                                onchange="window.location='{{ route('browse-ads', ['category' => $category->id, 'subcategory' => $subcategory->id]) }}'"
                                                                {{ request()->input('subcategory') == $subcategory->id ? 'checked' : '' }}>
                                                            <span> @lang('messages.' . $subcategory->name)</span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12">
                        @if ($banners)
                        <div id="bannerCarousel" class="carousel slide no-animation" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($banners as $key => $banner)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <div class="banner d-flex justify-content-center">
                                            <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image"
                                                 class="img-fluid banner-img">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                </div>
            </div>

            <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                <div class="category-details-content">
                    <div class="clearfix item-shorting">
                        <div class="text pull-left">
                            <h6>@lang('messages.Buy, Sell, Rent or Find Anything in Sri Lanka')</h6>
                            <p><span>@lang('messages.Search Results'):</span> @lang('messages.Showing')
                                {{ $ads->firstItem() }}-{{ $ads->lastItem() }} @lang('messages.of') {{ $ads->total() }}
                                @lang('messages.Listings')</p>
                        </div>
                        <div class="clearfix right-column pull-right">
                        </div>
                    </div>



                    <div class="grid category-block wrapper browse-add">
                        <div class="mb-4 row">
                            <!-- Carousel Slider for Ads (Column 1) -->
                            <div class="col-md-8">
                                <div id="adsCarousel" class="mb-2 carousel slide" data-bs-ride="carousel"
                                    data-bs-interval="2000">
                                    <!-- Indicators -->
                                    <div class="carousel-indicators">
                                        @foreach ($urgentAds as $key => $ad)
                                            @if ($ad->ads_package == 4)
                                                <!-- Filter ads with ads_package = 4 -->
                                                <button type="button" data-bs-target="#adsCarousel"
                                                    data-bs-slide-to="{{ $key }}"
                                                    class="{{ $key === 0 ? 'active' : '' }}"
                                                    aria-current="{{ $key === 0 ? 'true' : '' }}"
                                                    aria-label="Slide {{ $key + 1 }}"></button>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Carousel Items -->
                                    <div class="carousel-inner">
                                        @foreach ($urgentAds as $key => $ad)
                                            @if ($ad->ads_package == 4)
                                                <!-- Filter ads with ads_package = 4 -->
                                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }} blink-border">
                                                    @if ($ad->post_type)
                                                        <button class="sale"
                                                            style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                                                            {{ $ad->post_type }}
                                                        </button>
                                                    @endif
                                                    <!-- Wrap the entire content with an anchor tag -->
                                                    <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}"
                                                        style="display: block; height: 100%; text-decoration: none;">
                                                        <div class="carousel-item-content">
                                                            <!-- Image -->
                                                            <img src="{{ asset('storage/' . $ad->mainImage) }}"
                                                                class="d-block w-100" alt="{{ $ad->title }}"
                                                                style="min-height: 450px;height:auto; object-fit: contain;">

                                                            <!-- Dark Overlay -->
                                                            <div class="carousel-overlay"></div>

                                                            <!-- Top-left image -->
                                                            <img src="{{ asset('3.png') }}" alt="Urgent Ad"
                                                                class="top-left-image"
                                                                style="z-index:999; height:80px; width:auto">

                                                            <!-- Ad Details Overlay -->
                                                            <div class="carousel-caption d-none d-md-block text-start">
                                                                <p>{{ $ad->title }}</p>
                                                                <p>@lang('messages.Rs') {{ number_format($ad->price, 2) }}
                                                                </p>
                                                                <p><i class="fas fa-map-marker-alt"></i>
                                                                    @php
                                                                        $locale = App::getLocale();
                                                                        $locationName = 'name_' . $locale;
                                                                    @endphp

                                                                    {{ $ad->main_location ? $ad->main_location->$locationName : 'N/A' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <!-- Carousel Controls -->
                                    <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel"
                                        data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel"
                                        data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    </button>
                                </div>
                            </div>


                            <!-- Banner (Column 2) -->
                            <div class="col-md-4">

                                @if ($banners)
                                <div id="bannerCarousel" class="carousel slide no-animation" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($banners as $key => $banner)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <div class="banner d-flex justify-content-center">
                                                    <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image"
                                                         class="img-fluid banner-img">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                    {{-- <div class="banner" style="display: flex;justify-content: center;">
                                        <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image"
                                            class="img-fluid banner-img">
                                    </div> --}}
                                @endif
                            </div>
                        </div>



                        <!-- Grid Items -->
                        <div class="grid-item feature-style-two four-column pd-0" style="display: flex; flex-wrap: wrap;">
                            <div class="clearfix row" style="width: 100%; display: flex; flex-wrap: wrap;">
                                @foreach ($ads as $ad)
                                    @if (is_null($ad->package_expire_at) || \Carbon\Carbon::now()->lessThanOrEqualTo($ad->package_expire_at))
                                        <div class="col-lg-3 col-md-6 col-sm-12 feature-block" style="display: flex; flex-direction: column; flex-grow: 1; margin-bottom: 30px;">
                                            <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%; width: 100%;">
                                                <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}" class="{{ $ad->ads_package == 3 ? 'top-ad' : ($ad->ads_package == 6 ? 'super-ad' : '') }}" style="display: block; height: 100%; text-decoration: none;">
                                                    <div class="inner-box" style="display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                                                        @if ($ad->post_type)
                                                            <button class="sale"
                                                                style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                                                                {{ $ad->post_type }}
                                                            </button>
                                                        @endif
                                                        <div class="image-box" style="flex-grow: 0;">
                                                            <figure class="image">
                                                                <img src="{{ asset('storage/' . $ad->mainImage) }}"
                                                                    style="height: 170px; object-fit: contain;"
                                                                    alt="{{ $ad->title }}">
                                                            </figure>

                                                            @if ($ad->ads_package == 3)
                                                                <!-- Top Ad Badge -->
                                                                <div class="icon">
                                                                    <div class="icon-shape"></div>
                                                                    <i class=""> <img src="{{ asset('01.png') }}"
                                                                            alt="Top Ad"></i>
                                                                </div>
                                                            @elseif($ad->ads_package == 6)
                                                                <!-- Super Ad Badge -->
                                                                <div class="icon">
                                                                    <div class="icon-shape"></div>
                                                                    <i class=""> <img src="{{ asset('02.png') }}"
                                                                            alt="Super Ad"></i>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="lower-content" style="flex-grow: 1;">
                                                            <div class="category"><i class="fas fa-tags"></i>
                                                                <p>@lang('messages.' . $ad->category->name)</p>
                                                            </div>
                                                            <h4
                                                                style="
                                            display: -webkit-box;
                                            -webkit-line-clamp: 2;
                                            -webkit-box-orient: vertical;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            max-height: 55px;
                                            margin-top: 20px;
                                            margin-bottom: 10px;">
                                                                {{ $ad->title }}</h4>
                                                            <ul class="clearfix info">
                                                                <li class="time-dff"><i
                                                                        class="far fa-clock"></i>{{ $ad->created_at->diffForHumans() }}
                                                                </li>
                                                                <li>
                                                                    <i class="fas fa-map-marker-alt"></i>
                                                                    @php
                                                                        $locale = App::getLocale();
                                                                        $locationName = 'name_' . $locale;
                                                                    @endphp

                                                                    {{ $ad->main_location ? $ad->main_location->$locationName : 'N/A' }}
                                                                </li>
                                                            </ul>
                                                            <div class="lower-box" style="margin-top: auto;">
                                                                <h5>@lang('messages.Rs') {{ number_format($ad->price, 2) }}
                                                                </h5>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>


                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper centred">
                        <ul class="clearfix pagination">
                            @if ($ads->onFirstPage())
                                <li class="disabled"><a href="#"><i class="far fa-angle-left"></i>Prev</a></li>
                            @else
                                <li><a
                                        href="{{ $ads->previousPageUrl() . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory') }}"><i
                                            class="far fa-angle-left"></i>Prev</a></li>
                            @endif

                            @foreach ($ads->getUrlRange(1, $ads->lastPage()) as $page => $url)
                                <li class="{{ $page == $ads->currentPage() ? 'current' : '' }}">
                                    <a
                                        href="{{ $url . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory') }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($ads->hasMorePages())
                                <li><a
                                        href="{{ $ads->nextPageUrl() . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory') }}">Next<i
                                            class="far fa-angle-right"></i></a></li>
                            @else
                                <li class="disabled"><a href="#">Next<i class="far fa-angle-right"></i></a></li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>


        </div>
    </div>


    <!-- Script to Initialize Carousel -->
    <script>
        var myCarousel = document.querySelector('#adsCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 2000, // Set interval for auto sliding (5 seconds)
            ride: 'carousel' // Enable auto sliding
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const filterToggle = document.getElementById('filterToggle');
    const filterModal = document.getElementById('filterModal');
    const closeModal = document.querySelector('.close-modal');

    // Open modal
    filterToggle.addEventListener('click', () => {
        filterModal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    });

    // Close modal
    closeModal.addEventListener('click', () => {
        filterModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

    // Close when clicking outside
    window.addEventListener('click', (event) => {
        if (event.target === filterModal) {
            filterModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // Close on escape key
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && filterModal.style.display === 'block') {
            filterModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
});
    </script>
@endsection
