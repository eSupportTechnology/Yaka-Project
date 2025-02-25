
@extends ('newFrontend.master')

@section('content')


<style>
    /* Set a fixed height for the carousel */
    #adsCarousel .carousel-inner {
        height: 400px;
    }

    .carousel-item-content {
        position: relative;
        height: 100%;
    }

    /* Set a fixed height for the banner */
    .banner-img {
        height: 400px;
        object-fit: cover;
        width: 100%;
    }

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

    .carousel-caption p{
        font-size:20px;
        color:white;

    }

    /* Top-left image for the carousel */
    .top-left-image {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 70px;
        height: auto;
    }

    

    /* Blinking Border Animation */
    @keyframes blinking-border {
        0% { border-color: transparent; }
        50% { border-color: rgba(0, 255, 0, 0.8); } /* Green */
        100% { border-color: transparent; }
    }

    @keyframes blinking-border-blue {
        0% { border-color: transparent; }
        50% { border-color: rgba(0, 159, 245, 0.8); } /* Blue */
        100% { border-color: transparent; }
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
</style>


     <!-- Page Title -->
    <section class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg);">
        <div class="auto-container">
            <div class="content-box centred mr-0">
                <div class="title">
                    <h1>{{ $category ? $category->name : 'All Categories' }}</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('/') }}">Home</a></li>
                    <li>Browse Ads </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->



            <div class="auto-container mt-4 mb-4">
                <div class="row clearfix">

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                        <div class="sidebar-search sidebar-widget">
                            <div class="widget-title">
                                <h3>Search</h3>
                            </div>
                            <div class="widget-content">
                                <form action="{{ route('browse-ads') }}" method="GET" class="search-form">
                                    <div class="form-group">
                                        <input type="search" name="search-field" placeholder="Search Keyword..." value="{{ request()->input('search-field') }}" oninput="this.form.submit()">
                                        <button type="submit" style="display:none;"><i class="icon-2"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <i class="icon-3"></i>
                                        <select class="wide" name="location" onchange="this.form.submit()">
                                            <option data-display="Select Location">Select Location</option>
                                            @foreach($districts as $district)
                                                <option value="{{ $district->id }}" {{ request()->input('location') == $district->id ? 'selected' : '' }}>{{ $district->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                            <div class="sidebar-category sidebar-widget">
                                <div class="widget-title">
                                    <h3>Category</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list">
                                        <li>
                                            <label>
                                                <input type="radio" name="category" value="all"
                                                    onchange="window.location='{{ route('browse-ads') }}'"
                                                    {{ !request()->input('category') ? 'checked' : '' }}>
                                                    <span class="text-dark">All Categories</span>
                                        
                                            </label>
                                        </li>

                                        @foreach($categories as $category)
                                            <li class="{{ $category->subcategories->isNotEmpty() ? 'dropdown' : '' }}">
                                                <label>
                                                    <input type="radio" name="category" value="{{ $category->id }}"
                                                        onchange="window.location='{{ route('browse-ads', ['category' => $category->id]) }}'"
                                                        {{ request()->input('category') == $category->id ? 'checked' : '' }}>
                                                    <span>{{ $category->name }}</span>
                                                </label>
                                                
                                                @if($category->subcategories->isNotEmpty())
                                                    <ul>
                                                        @foreach($category->subcategories as $subcategory)
                                                            <li>
                                                                <label>
                                                                    <input type="radio" name="subcategory" value="{{ $subcategory->id }}"
                                                                        onchange="window.location='{{ route('browse-ads', ['category' => $category->id, 'subcategory' => $subcategory->id]) }}'"
                                                                        {{ request()->input('subcategory') == $subcategory->id ? 'checked' : '' }}>
                                                                    <span>{{ $subcategory->name }}</span>
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
                                @php
                                    $banner = $banners->isNotEmpty() ? $banners->random() : null; 
                                @endphp

                                @if ($banner)
                                    <div class="banner">
                                        <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image" class="img-fluid banner-img">
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                        <div class="category-details-content">
                            <div class="item-shorting clearfix">
                                <div class="text pull-left">
                                    <h6>Buy, Sell, Rent or Find Anything in Sri Lanka</h6>
                                    <p><span>Search Results:</span> Showing {{ $ads->firstItem() }}-{{ $ads->lastItem() }} of {{ $ads->total() }} Listings</p>
                                </div>
                                <div class="right-column pull-right clearfix">
                                </div>
                            </div>
                           


                            <div class="category-block wrapper grid browse-add">
                            <div class="row mb-4">
                            <!-- Carousel Slider for Ads (Column 1) -->
                                <div class="col-md-8">
                                    <div id="adsCarousel" class="carousel slide mb-2" data-bs-ride="carousel" data-bs-interval="2000">
                                        <!-- Indicators -->
                                        <div class="carousel-indicators">
                                            @foreach($urgentAds as $key => $ad)
                                                @if($ad->ads_package == 4) <!-- Filter ads with ads_package = 4 -->
                                                    <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : '' }}" aria-label="Slide {{ $key + 1 }}"></button>
                                                @endif
                                            @endforeach
                                        </div>

                                        <!-- Carousel Items -->
                                        <div class="carousel-inner">
                                            @foreach($urgentAds as $key => $ad)
                                                @if($ad->ads_package == 4) <!-- Filter ads with ads_package = 4 -->
                                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }} blink-border">
                                                    @if($ad->post_type)
                                                    <button class="sale" style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                                                    {{ $ad->post_type }}
                                                    </button>
                                                    @endif
                                                        <!-- Wrap the entire content with an anchor tag -->
                                                        <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}" style="display: block; height: 100%; text-decoration: none;">
                                                            <div class="carousel-item-content">
                                                                <!-- Image -->
                                                                <img src="{{ asset('storage/' . $ad->mainImage) }}" class="d-block w-100" alt="{{ $ad->title }}" style="min-height: 450px;height:auto; object-fit: cover;">
                                                                
                                                                <!-- Dark Overlay -->
                                                                <div class="carousel-overlay"></div>

                                                                <!-- Top-left image -->
                                                                <img src="{{ asset('3.png') }}" alt="Urgent Ad" class="top-left-image" style="z-index:10000; height:80px; width:auto">

                                                                <!-- Ad Details Overlay -->
                                                                <div class="carousel-caption d-none d-md-block text-start">
                                                                    <p>{{ $ad->title }}</p>
                                                                    <p>Rs {{ number_format($ad->price, 2) }}</p>
                                                                    <p><i class="fas fa-map-marker-alt"></i> {{ $ad->main_location ? $ad->main_location->name_en : 'N/A' }}</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <!-- Carousel Controls -->
                                        <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>


                                <!-- Banner (Column 2) -->
                                <div class="col-md-4">
                                    @php
                                    $banner = $banners->isNotEmpty() ? $banners->random() : null; 
                                    @endphp

                                    @if($banner)
                                        <div class="banner">
                                            <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image" class="img-fluid banner-img">
                                        </div>
                                    @endif
                                </div>
                            </div>

 

<!-- Grid Items -->
<div class="grid-item feature-style-two four-column pd-0" style="display: flex; flex-wrap: wrap;">
    <div class="row clearfix" style="width: 100%; display: flex; flex-wrap: wrap; justify-content: space-between;">
        @foreach($ads as $ad)
            <div class="col-lg-4 col-md-6 col-sm-12 feature-block" 
                style="display: flex; flex-direction: column; flex-grow: 1; margin-bottom: 30px;">
                    <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%; width: 100%;">
                    <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}" 
                    class="{{ $ad->ads_package == 3 ? 'top-ad' : ($ad->ads_package == 6 ? 'super-ad' : '') }}"
                    style="display: block; height: 100%; text-decoration: none;">
                    
                        <div class="inner-box" style="display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                        @if($ad->post_type)
                        <button class="sale" style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                        {{ $ad->post_type }}
                        </button>
                        @endif
                            <div class="image-box" style="flex-grow: 0;">
                                <figure class="image">
                                    <img src="{{ asset('storage/' . $ad->mainImage) }}" 
                                        style="height: 170px; object-fit: cover;" alt="{{ $ad->title }}">
                                </figure>

                                @if($ad->ads_package == 3)
                                    <!-- Top Ad Badge -->
                                    <div class="icon">
                                        <div class="icon-shape"></div>
                                        <i class=""> <img src="{{ asset('01.png') }}" alt="Top Ad"></i>
                                    </div>
                                @elseif($ad->ads_package == 6)
                                    <!-- Super Ad Badge -->
                                    <div class="icon">
                                        <div class="icon-shape"></div>
                                        <i class=""> <img src="{{ asset('02.png') }}" alt="Super Ad"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="lower-content" style="flex-grow: 1;">
                                <div class="category"><i class="fas fa-tags"></i><p>{{ $ad->category->name }}</p></div>
                                <h4>{{ $ad->title }}</h4>
                                <ul class="info clearfix">
                                    <li><i class="far fa-clock"></i>{{ $ad->created_at->diffForHumans() }}</li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $ad->main_location ? $ad->main_location->name_en : 'N/A' }}
                                    </li>
                                </ul>
                                <div class="lower-box" style="margin-top: auto;">
                                    <h5>Rs {{ number_format($ad->price, 2) }}</h5>
                                </div>
                            </div>

                        </div>
                        </a>
                    </div>
               

            </div>
        @endforeach
    </div>
</div>


                            </div>

                            <!-- Pagination -->
                            <div class="pagination-wrapper centred">
                                <ul class="pagination clearfix">
                                    @if ($ads->onFirstPage())
                                        <li class="disabled"><a href="#"><i class="far fa-angle-left"></i>Prev</a></li>
                                    @else
                                        <li><a href="{{ $ads->previousPageUrl() . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory') }}"><i class="far fa-angle-left"></i>Prev</a></li>
                                    @endif

                                    @foreach ($ads->getUrlRange(1, $ads->lastPage()) as $page => $url)
                                        <li class="{{ ($page == $ads->currentPage()) ? 'current' : '' }}">
                                            <a href="{{ $url . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory') }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($ads->hasMorePages())
                                        <li><a href="{{ $ads->nextPageUrl() . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory') }}">Next<i class="far fa-angle-right"></i></a></li>
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

@endsection