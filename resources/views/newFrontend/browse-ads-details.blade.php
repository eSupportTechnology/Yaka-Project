
@extends ('newFrontend.master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- Stylesheets -->


<style>
    .view-count-container {
        position: absolute;
        top: 10px;
        right: 10px;
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .view-count-container i {
        margin-right: 5px;
    }
    .icon-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 16px;
    flex-shrink: 0;
}

.text-wrap {
    word-wrap: break-word; 
    overflow-wrap: break-word;
    word-break: break-word;
    white-space: normal; 
    flex-grow: 1; 
}

.d-flex {
    flex-wrap: wrap; 
}


</style>

        <!-- browse-add-details -->
    
        <div class="auto-container">
            <div class="col-md-12 mb-4 mt-3 d-flex justify-content-center">
                @php
                $banner = $banners->isNotEmpty() ? $banners->random() : null; 
                @endphp

                @if($banner)
                    <div class="banner">
                        <img src="{{ asset('banners/' . $banner->img) }}" style="" alt="Banner Image" class="img-fluid banner-img">
                    </div>
                @endif
            </div>


                <div class="row clearfix">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="add-details-content">
                        <div class="content-one single-box">
                            <div class="text">
                                <!-- Ad Title and Details -->
                                <h3 class="mb-0">{{ $ad->title }}</h3>  
                                <p class="fw-bold">
                                    Posted on {{ \Carbon\Carbon::parse($ad->created_at)->format('d M Y g:i a') }},
                                    {{ $ad->sub_location ? $ad->sub_location->name_en : 'N/A' }},
                                    {{ $ad->main_location ? $ad->main_location->name_en : 'N/A' }},
                                </p>
                            </div>

                            <div class="view-count-container">
                                <i class="fas fa-eye" style="color:rgb(176, 5, 5)"></i> 
                                <span>{{ $ad->view_counr }} Views </span>
                            </div>

                        </div>


                        <div class="content-two single-box">
                            <div class="bxslider">
                                   
                                    <div class="slider-content">
                                        <div class="product-image">
                                        <figure class="image">
                                            <img src="{{ asset('images/Ads/' . $ad->mainImage) }}" alt="Main Image">
                                        </figure>
                                        </div>
                                        @if(!empty($subImages) && is_array($subImages))
                                            <div class="slider-pager">
                                                <ul class="thumb-box clearfix">
                                                    @foreach($subImages as $index => $subImage)
                                                        <li>
                                                            <a data-slide-index="{{ $index }}" href="#">
                                                                <figure>
                                                                    <img src="{{ asset('images/' . $subImage) }}" alt="Thumbnail {{ $index + 1 }}">
                                                                </figure>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="content-one single-box">
                                <div class="text">
                                    <h3 style="color:rgb(176, 5, 5)">Rs {{ $ad->price }}</h3>
                                    <h6>Product Description</h6>
                                    <p>{{ $ad->description }}</p>
                                </div>
                            </div>
                           
                           
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                            <div class="sidebar-search sidebar-widget">
                            <div class="widget-content">
                                <div class="dropdown">
                                    <button class="btn btn-light dropdown-toggle" type="button" id="shareDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-share-alt"></i> Share
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                                        <li>
                                            <a class="dropdown-item" href="" target="_blank">
                                                <i class="fab fa-facebook"></i> Facebook
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="" target="_blank">
                                                <i class="fab fa-whatsapp"></i> WhatsApp
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="user-details mt-3 p-3">
                                    <h5 class="mb-3 text-primary fw-bold">Posted by:</h5>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle bg-danger text-white">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <strong class="w-25">Name:</strong> 
                                        <span class="text-wrap">{{ $ad->user->name ?? 'N/A' }}</span>
                                    </div>
                                    <hr class="my-2">

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle bg-success text-white">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <strong class="w-25">Email:</strong> 
                                        <span class="text-wrap">{{ $ad->user->email ?? 'N/A' }}</span>
                                    </div>

                                    <hr class="my-2">

                                    <div class="d-flex align-items-center">
                                        <div class="icon-circle bg-primary text-white">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <strong class="w-25">Phone:</strong> 
                                        <span class="flex-grow-1 text-wrap">{{ $ad->user->phone_number ?? 'N/A' }}</span>
                                    </div>
                                </div>



                            </div>

                            </div>
                        </div>
                        <div class="col-md-12 mb-4 mt-3 d-flex justify-content-center">
                            @php
                            $otherbanners = $otherbanners->isNotEmpty() ? $otherbanners->random() : null; 
                            @endphp

                            @if($banner)
                                <div class="banner">
                                    <img src="{{ asset('banners/' . $otherbanners->img) }}" style="width:510px" alt="Banner Image" class="img-fluid banner-img">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
  


      <!-- Related Ads -->
<section class="related-ads">
    <div class="auto-container">
        <div class="sec-title">
            <span>Related Ads</span>
        </div>
        <div class="four-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
            @foreach($relatedAds as $relatedAd)
                <a href="{{ route('ads.details', ['ad_id' => $relatedAd->id]) }}" style="display: block; height: 100%; text-decoration: none;">
                    <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%; width: 100%;">
                        <div class="inner-box" style="display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                            <div class="image-box" style="flex-grow: 0;">
                                <figure class="image">
                                    <img src="{{ asset('images/Ads/' . $relatedAd->main_image) }}" 
                                    style="height: 150px; object-fit: cover;" alt="{{ $relatedAd->title }}">
                                </figure>

                                @if($relatedAd->ads_package == 4)
                                    <div class="feature" style="background-color:rgb(172, 3, 3)">
                                        URGENT
                                    </div>
                                @elseif($relatedAd->ads_package == 5)
                                    <div class="icon">
                                        <div class="icon-shape"></div>
                                        <i class=""><img src="{{ asset('02.png') }}" alt=""></i>
                                    </div>
                                @endif
                            </div>

                            <div class="lower-content" style="flex-grow: 1;">
                                <div class="category"><i class="fas fa-tags"></i> <p>{{ $relatedAd->category->name ?? 'N/A' }}</p></div>
                                <h4>{{ $relatedAd->title }}</h4>
                                <ul class="info clearfix">
                                    <li><i class="far fa-clock"></i>{{ $relatedAd->created_at->diffForHumans() }}</li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $relatedAd->main_location ? $relatedAd->main_location->name_en : 'N/A' }}
                                    </li>
                                </ul>
                                <div class="lower-box" style="margin-top: auto;">
                                    <h5>Rs {{ number_format($relatedAd->price, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Ads End -->



@endsection