@extends('newFrontend.master')

@section('content')

<style>
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
                        <h1>@lang('messages.Ad posting criteria')</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">@lang('messages.Home')</a></li>
                        <li>@lang('messages.Ad posting criteria')</li>
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
        <style>
    /* General Section Styling */
    .criteria-section, .criteria-section1 {
        text-align: center;
        border-radius: 10px;
        margin: 30px auto;
        animation: fadeIn 1s ease-in-out;
    }


    /* Title & Paragraph Styling */
    .criteria-section h2, .criteria-section1 h2 {
        font-size: 2rem;
        color: rgb(156, 11, 6);
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .criteria-section p, .criteria-section1 p {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 20px;
    }

    /* Posting Criteria List */
    .posting-criteria-list {
        list-style: none;
        padding: 0;
    }

    .posting-criteria-list li {
        background: rgb(156, 11, 6);
        color: white;
        padding: 12px;
        margin: 8px 0;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: 500;
        transition: transform 0.3s, background 0.3s;
    }

    .posting-criteria-list li:hover {
        background: rgb(200, 20, 15);
        transform: scale(1.05);
    }

    /* Step Container */
    .steps {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 30px;
    }

    /* Step Circle */
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: rgb(156, 11, 6);
        color: white;
        font-size: 1.4rem;
        font-weight: bold;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out, background 0.3s;
    }

    .step:hover {
        transform: scale(1.1);
        background-color: rgb(200, 20, 15);
    }

    .step span {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .step p {
        margin-top: 10px;
        font-size: 1rem;
        font-weight: 500;
        color: white;
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Main Title & Posting Criteria -->
<section class="criteria-section1 fade-in center-text" style="max-width: 1000px;">
    <h2>@lang('messages.welcome_title')</h2>
    <p>@lang('messages.welcome_description')</p>
    <ul class="text-center posting-criteria-list">
        <li>@lang('messages.posting_criteria_1')</li>
        <li>@lang('messages.posting_criteria_2')</li>
        <li>@lang('messages.posting_criteria_3')</li>
        <li>@lang('messages.posting_criteria_4')</li>
        <li>@lang('messages.posting_criteria_5')</li>
        <li>@lang('messages.posting_criteria_6')</li>
        <li>@lang('messages.posting_criteria_7')</li>
    </ul>
</section>

<!-- Ad Approval Process -->
<section class="criteria-section fade-in right-align" style="margin:50px 0; background-color: rgb(233, 233, 233); padding:30px 20px;">
    <h2>@lang('messages.approval_process_title')</h2>
    <p>@lang('messages.approval_process_description')</p>
    <div class="steps">
        <div class="step"><span>1</span><p>@lang('messages.approval_step_1')</p></div>
        <div class="step"><span>2</span><p>@lang('messages.approval_step_2')</p></div>
        <div class="step"><span>3</span><p>@lang('messages.approval_step_3')</p></div>
        <div class="step"><span>4</span><p>@lang('messages.approval_step_4')</p></div>
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

