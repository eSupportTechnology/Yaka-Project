@extends('newFrontend.master')

@section('content')

<style>


.boosting-section:hover {
    transform: scale(1.02);
}

.boosting-section h2 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.boosting-list {
    list-style: none;
    padding: 0;
}

.boosting-list li {
    font-size: 1.2rem;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.2);
    transition: background 0.3s ease-in-out;
}

.boosting-list li:hover {
    background-color: rgba(255, 255, 255, 0.4);
}

/* Ads Description */
.ad-type {
    margin: 40px 0;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    background: linear-gradient(135deg, rgb(255, 235, 235), white, rgb(226, 232, 240));
    transition: transform 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
}

.ad-type:hover {
    transform: scale(1.05);
    background: rgb(255, 255, 255);
}

.ad-type h3 {
    font-size: 1.5rem;
    color: rgb(156, 11, 6);
    margin-bottom: 10px;
}

/* Steps Section */
.steps {
    text-align: center;
    padding: 50px 20px;
    background-color: #f8f9fa;
}

.steps h2 {
    font-size: 2rem;
    color: rgb(156, 11, 6);
    margin-bottom: 20px;
}

.step-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.step {
    background: white;
    padding: 20px;
    width: 350px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out, background 0.3s ease-in-out;
    position: relative;
}

.step:hover {
    transform: translateY(-5px);
    background: rgb(255, 240, 240);
}

.step i {
    font-size: 2rem;
    color: rgb(156, 11, 6);
    margin-bottom: 10px;
    display: block;
}

.step h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.step p {
    font-size: 1rem;
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
    width: 60%;  /* Reduced width */
    max-width: 600px;  /* Smaller banner width */
    height: 80px;  /* Reduced height */
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

.ad-carousel-item img {
    width: 800px !important;
    height: 120px !important;
    object-fit: cover;
    margin: 0 auto;
}

.top-banner .left .carousel-item img {
    max-width: 80%; /* Adjust the width percentage as needed */
    max-height: 50%; /* Ensure the aspect ratio is maintained */
    margin: 20px; /* Center the image horizontally */
    margin-left:-40px;
    margin-top:-25px;
}
.super-banner .right .carousel-item img {
    max-width: 57%; /* Adjust the width percentage as needed */
    max-height: 140%; /* Ensure the aspect ratio is maintained */
    margin-left: 20px; /* Center the image horizontally */

}
.ad-carousel-item img {
        /* width: 800px !important;
        height: 120px !important; */
        object-fit: contain;
        margin: 0 auto;
    }
@media (min-width: 766px) {
        .ad-carousel-item img {
            width: 800px !important;
            height: 120px !important;
            object-fit: contain;
            margin: 0 auto;
        }
    }
</style>

 <!-- Page Title -->
 <section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>@lang('messages.Boosting ads')</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">@lang('messages.Home')</a></li>
                        <li>@lang('messages.Boosting ads')</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->
        <!-- ad - banner-section start -->
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
        <!-- ad - banner-section end -->


<!-- Boosting Ads Section -->
<div class="container" style=" max-width: 900px;">

    <!-- Ads Details -->
    <div class="ad-type">
        <h3>@lang('messages.Jump Up Ads')</h3>
        <p>@lang('messages.JumpUp description')</p>
    </div>

    <div class="ad-type">
        <h3>@lang('messages.Top Ads')</h3>
        <p>@lang('messages.TopAds description')</p>
    </div>

    <div class="ad-type">
        <h3>@lang('messages.Super Ads')</h3>
        <p>@lang('messages.SuperAds description')</p>
    </div>

    <div class="ad-type">
        <h3>@lang('messages.Urgent Ads')</h3>
        <p>@lang('messages.UrgentAds description')</p>
    </div>
</div>

<!-- Steps Section -->
<section class="steps">
    <h2>@lang('messages.How to Boost Your Ad?')</h2>
    <div class="step-container">
        <div class="step">
            <i class="fas fa-upload"></i>
            <h3>@lang('messages.Upload Your Ad')</h3>
            <p>@lang('messages.Upload description')</p>
        </div>
        <div class="step">
            <i class="fas fa-bullhorn"></i>
            <h3>@lang('messages.Choose a Boost Plan')</h3>
            <p>@lang('messages.ChoosePlan description')</p>
        </div>
        <div class="step">
            <i class="fas fa-chart-line"></i>
            <h3>@lang('messages.Get More Views')</h3>
            <p>@lang('messages.GetViews description')</p>
        </div>
    </div>
</section>

<!-- ad - banner-section start -->
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
<!-- ad - banner-section end -->

@endsection

