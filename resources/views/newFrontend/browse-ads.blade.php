
@extends ('newFrontend.master')

@section('content')


        <!-- Page Title -->
        <section class="page-title style-two banner-part " style="background-image: url(assets/images/background/page-title.jpg);">
            <div class="auto-container ">
                <div class="content-box centred mr-0">
                    <div class="title">
                        <h1>Browse Ads Grid</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Browse Ads Grid</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- category-details -->
        <section class="category-details bg-color-2">
            <div class="auto-container">
                <div class="row clearfix">

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                            <div class="sidebar-search sidebar-widget">
                                <div class="widget-title">
                                    <h3>Search</h3>
                                </div>
                                <div class="widget-content">
                                    <form action="category-details.html" method="post" class="search-form">
                                        <div class="form-group">
                                            <input type="search" name="search-field" placeholder="Search Keyword..." required="">
                                            <button type="submit"><i class="icon-2"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <i class="icon-3"></i>
                                            <select class="wide">
                                               <option data-display="Select Location">Select Location</option>
                                               @foreach($cities as $city)
                                               <option value="1">{{ $city->name_en }}</option>
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
                                    @foreach($categories as $category)
                                        <li class="{{ $category->subcategories->isNotEmpty() ? 'dropdown' : '' }}">
                                            <a href="#">{{ $category->name }}</a>
                                            @if($category->subcategories->isNotEmpty())
                                                <ul>
                                                    @foreach($category->subcategories as $subcategory)
                                                        <li><a href="#">{{ $subcategory->name }}</a></li>
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
                            <div class="grid-item feature-style-two four-column pd-0" style="display: flex; flex-wrap: wrap;">
                                <div class="row clearfix">
                                    @foreach($ads as $ad)
                                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block" style="display: flex; flex-direction: column; flex-grow: 1; margin-bottom: 30px;">
                                        <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%;">
                                            <div class="inner-box" style="display: flex; flex-direction: column; height: 100%;">
                                                <div class="image-box">
                                                    <figure class="image">
                                                        <img src="{{ asset('storage/' . $ad->main_image) }}" alt="">
                                                    </figure>
                                                    <div class="shape"></div>
                                                    <div class="feature">Featured</div>
                                                    <div class="icon">
                                                        <div class="icon-shape"></div>
                                                        <i class="icon-16"></i>
                                                    </div>
                                                </div>
                                                <div class="lower-content" style="flex-grow: 1;">
                                                    <div class="category"><i class="fas fa-tags"></i><p>{{ $ad->category->name }}</p></div>
                                                    <h4><a href="browse-ads-details.html">{{ $ad->title }}</a></h4>
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
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            </div>
                            <!-- Pagination -->
                            <div class="pagination-wrapper centred">
                                <ul class="pagination clearfix">
                                    {{-- Previous Page Link --}}
                                    @if ($ads->onFirstPage())
                                        <li class="disabled"><a href="#"><i class="far fa-angle-left"></i>Prev</a></li>
                                    @else
                                        <li><a href="{{ $ads->previousPageUrl() }}"><i class="far fa-angle-left"></i>Prev</a></li>
                                    @endif

                                    {{-- Page Number Links --}}
                                    @foreach ($ads->getUrlRange(1, $ads->lastPage()) as $page => $url)
                                        <li class="{{ ($page == $ads->currentPage()) ? 'current' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Next Page Link --}}
                                    @if ($ads->hasMorePages())
                                        <li><a href="{{ $ads->nextPageUrl() }}">Next<i class="far fa-angle-right"></i></a></li>
                                    @else
                                        <li class="disabled"><a href="#">Next<i class="far fa-angle-right"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        </div>
                       

                </div>
            </div> 
        </section>
        <!-- category-details end -->


        @endsection