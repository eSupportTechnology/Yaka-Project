
@extends ('newFrontend.master')

@section('content')





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

.thumb-item {
    cursor: pointer;
}

.thumb-item:hover img {
    opacity: 0.7; /* Optional: Add opacity effect on hover for better UX */
}
.watermark {
    position: relative;
    display: inline-block;
}

.watermark::after {
    content: "";
    background: url('{{ asset('images/watermark.png') }}') no-repeat center;
    background-size: contain;
    width: 100px;
    height: 100px;
    position: absolute;
    bottom: 10px;
    right: 10px;
    opacity: 0.3;
    pointer-events: none;
    z-index: 10;
}



</style>

        <!-- browse-add-details -->

        <div class="auto-container">
            <div class="mt-3 mb-4 col-md-12 d-flex justify-content-center">
                <section class="mb-0 ad-banner-container">
                    <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                        <div class="carousel-inner">
                            @foreach($banners as $key => $banner)
                                @if($banner->type == 0)
                                    <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                                       <img src="{{ asset('banners/' . $banner->img) }}" class="mx-auto d-block" alt="Banner Image">
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>


                <div class="clearfix row">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="add-details-content">
                        <div class="content-one single-box">
                            <div class="text">
                                <!-- Ad Title and Details -->
                                <h3 class="mb-0">{{ $ad->title }}</h3>
                                <p class="fw-bold">
                                @lang('messages.Posted on'): {{ \Carbon\Carbon::parse($ad->created_at)->translatedFormat('d M Y g:i a') }}


                                    @php
                                            $locale = App::getLocale();
                                            $locationName = 'name_' . $locale;
                                        @endphp

                                    {{ $ad->sub_location ? $ad->sub_location->$locationName : 'N/A' }},
                                    {{ $ad->main_location ? $ad->main_location->$locationName : 'N/A' }}
                                </p>
                            </div>

                            <div class="view-count-container">
                                <i class="fas fa-eye" style="color:rgb(176, 5, 5)"></i>
                                <span>
                                    {{ $ad->view_count }}
                                    @lang('messages.view')
                                </span>

                            </div>

                        </div>

                        <div class="content-two single-box">
                            <div class="bxslider">
                                <div class="slider-content">
                                    <div class="product-image watermark">
                                        <figure class="image">
                                            <img id="mainImage" src="{{ asset('storage/'.$mainImage) }}" alt="Main Image" style="height: 100%; width: 100%; object-fit: cover;">
                                        </figure>
                                    </div>

                                    @if(!empty($subImages) && is_array($subImages))
                                        <div class="slider-pager">
                                            <ul class="clearfix thumb-box">
                                                @foreach($subImages as $index => $subImage)
                                                    <li class="thumb-item">
                                                        <a data-slide-index="{{ $index }}" href="#" class="thumbnail">
                                                            <figure>
                                                                <img src="{{ asset('storage/'.$subImage) }}" alt="Thumbnail {{ $index + 1 }}" style="height: 150px; width: auto; object-fit: contain;">
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
                                    <h3 style="color:rgb(176, 5, 5)">
                                        @lang('messages.Rs') {{ $ad->price }}
                                        <span style="font-size: 13px; font-style: italic;" class="text-muted">
                                            @lang('messages.' . $ad->price_type)
                                        </span>
                                    </h3>

                                    <h6>@lang('messages.Product Description')</h6>
                                    <p class="mb-1">{{ $ad->description }}</p>

                                    @if($brand)
                                        <p class="mb-0"><strong> @lang('messages.Brand'):</strong> {{ $brand->name }}</p>
                                    @endif

                                    @if($model)
                                        <p class="mb-0"><strong> @lang('messages.Model'):</strong> {{ $model->name }}</p>
                                    @endif


                                    @if($ad->condition)
                                        <p class="mb-0"><strong> @lang('messages.Condition'):</strong> {{ $ad->condition }}</p>
                                    @endif

                                    @foreach($ad->adDetail as $detail)
                                        @if($detail->value)
                                            <p class="mb-0"><strong>{{ $detail->additional_info }}:</strong> {{ $detail->value }}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                            <div class="sidebar-search sidebar-widget">
                            <div class="widget-content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Share Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="shareDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-share-alt"></i> Share
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                                            <li>
                                                <a class="dropdown-item"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('ads.details', ['adsId' => $ad->adsId])) }}"
                                                target="_blank">
                                                    <i class="fab fa-facebook"></i> Facebook
                                                </a>
                                            </li>
                                            <li>
                                            <a class="dropdown-item"
                                                href="https://api.whatsapp.com/send?text={{ urlencode($ad->title) }}%0A%0A{{ urlencode($ad->description) }}%0A%0A🔗 {{ urlencode(route('ads.details', ['adsId' => $ad->adsId])) }}"
                                                target="_blank">
                                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Boost Ad Button -->
                                    <a href="{{ route('ads.boost', ['adsId' => $ad->adsId]) }}" class="btn btn-warning align-items-center">
                                        <i class="fas fa-rocket"></i> @lang('messages.Boost this ad')
                                    </a>
                                </div>

                                <div class="p-3 mt-3 user-details">
                                    <h5 class="mb-3 text-primary fw-bold">@lang('messages.Posted by'):</h5>

                                    <div class="mb-3 d-flex align-items-center">
                                        <div class="text-white icon-circle bg-danger" >
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <strong class="w-20" style="padding-right: 5px">@lang('messages.Name'):</strong>
                                        <span class="text-wrap">{{ $ad->user->first_name }} {{ $ad->user->last_name ?? 'N/A' }}</span>
                                    </div>
                                    <hr class="my-2">

                                    <div class="mb-3 d-flex align-items-center">
                                        <div class="text-white icon-circle bg-success">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <strong class="w-20" style="padding-right: 5px">@lang('messages.Email'):</strong>
                                        <span class="text-wrap">{{ $ad->user->email ?? 'N/A' }}</span>
                                    </div>

                                    <hr class="my-2">

                                    <div class="d-flex align-items-center">
                                        <div class="text-white icon-circle bg-primary">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <strong class="w-45" style="padding-right: 5px">@lang('messages.Phone'):</strong>
                                        <span class="flex-grow-1 text-wrap">{{ $ad->user->phone_number ?? 'N/A' }}</span>
                                    </div>
                                </div>



                            </div>

                            </div>
                        </div>
                        <div class="mt-3 mb-4 col-md-12 d-flex justify-content-center">
                            <div id="other-banner" class="carousel slide " data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($otherbanners as $index => $banner)
                                        <div class="carousel-item @if ($index == 0) active @endif">
                                            <img width="20%" src="{{ asset('banners/' . $banner->img) }}"
                                                class="mx-auto d-block w-100" alt="Slide 1">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
                <a href="{{ route('ads.details', ['adsId' => $relatedAd->adsId]) }}" style="display: block; height: 100%; text-decoration: none;">
                    <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%; width: 100%;">
                        <div class="inner-box" style="display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                            <div class="image-box" style="flex-grow: 0;">
                                <figure class="image">
                                    <img src="{{ asset('storage/'.$relatedAd->mainImage) }}"
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

                            <div class="lower-content" style="flex-grow: 1; flex-direction: column; justify-content: space-between;height: 260px;">
                                <div class="mt-3 category"><i class="fas fa-tags"></i> <p>@lang('messages.' . $relatedAd->category->name ?? 'N/A')</p></div>
                                <h4 style=" display: -webkit-box;
                                                    -webkit-line-clamp: 2;
                                                    -webkit-box-orient: vertical;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    max-height: 55px;
                                                    margin-top: 20px;
                                                    margin-bottom: 10px;">{{ $relatedAd->title }}</h4>
                                <ul class="clearfix info">
                                    <li><i class="far fa-clock"></i>{{ $relatedAd->created_at->diffForHumans() }}</li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        @php
                                            $locale = App::getLocale();
                                            $locationName = 'name_' . $locale;
                                        @endphp

                                        {{ $relatedAd->main_location ? $relatedAd->main_location->$locationName : 'N/A' }}
                                    </li>
                                </ul>
                                <div class="lower-box" style="margin-top: auto;">
                                    <h5>@lang('messages.Rs') {{ number_format($relatedAd->price, 2) }}</h5>
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


<script>


// Get the original main image src (for reset on mouseout)
const originalMainImageSrc = document.getElementById('mainImage').src;

// Add event listeners for mouseover (to change image) and mouseout (to reset the image)
document.querySelectorAll('.thumbnail').forEach(function (thumbnail) {
    thumbnail.addEventListener('mouseover', function () {
        const subImageSrc = this.querySelector('img').src;
        document.getElementById('mainImage').src = subImageSrc;
    });

    // Reset the main image when mouse leaves the thumbnail
    thumbnail.addEventListener('mouseout', function () {
        document.getElementById('mainImage').src = originalMainImageSrc;
    });
});
</script>


@endsection
