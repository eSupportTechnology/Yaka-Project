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
                        <h1>@lang('messages.About')</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">@lang('messages.Home')</a></li>
                        <li>@lang('messages.About')</li>
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

        <!-- about-section -->
        <section class="about-section">
            <div class="auto-container">
                <div class="clearfix row">
                    <div class="col-lg-6 col-md-6 col-sm-12 content-column">
                        <div class="content_block_3">
                            <div class="content-box">
                                <div class="sec-title">
                                    <span>@lang('messages.About')</span>
                                    <h2>@lang('messages.About Our Company')</h2>
                                </div>
                                <div class="text">
                                    <p>
                                    @lang('messages.para5')
                                    </p>
                                <div class="sec-title">
                                    <h2>@lang('messages.What We Do')</h2>
                                </div>

                                    <p>@lang('messages.para6')</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                        <div class="image_block_1">
                            <div class="image-box">
                                <div class="image-pattern">
                                    <div class="pattern-1" style="background-image: url(newFrontend/Clasifico/assets/images/shape/shape-16.png);"></div>
                                    <div class="pattern-2" style="background-image: url(newFrontend/Clasifico/assets/images/shape/shape-16.png);"></div>
                                </div>
                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/about-1.png" alt=""></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-section end -->


        <!-- process-section -->
        <section class="process-section centred sec-pad">
            <div class="pattern-layer" style="background-image: url(newFrontend/Clasifico/assets/images/shape/shape-17.png);"></div>
            <div class="auto-container">
                <div class="sec-title centred">
                    <span>@lang('messages.Process')</span>
                    <h2>@lang('messages.How it Works')</h2>
                    <p>@lang('messages.para7')
                       </p>
                </div>
                <div class="inner-content">
                    <div class="clearfix row">
                        <div class="col-lg-4 col-md-6 col-sm-12 process-block">
                            <div class="process-block-one">
                                <div class="inner-box">
                                    <span class="count wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">01</span>
                                    <div class="text wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="icon-box"><i class="fas fa-user"></i></div>
                                        <h3>@lang('messages.Create Account')</h3>
                                        <p>@lang('messages.accpara')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 process-block">
                            <div class="process-block-one">
                                <div class="inner-box">
                                    <span class="count wow fadeInDown animated" data-wow-delay="300ms" data-wow-duration="1500ms">02</span>
                                    <div class="text wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="icon-box"><i class="fas fa-glass-martini"></i></div>
                                        <h3>@lang('messages.Post Your Ads')</h3>
                                        <p>@lang('messages.postpara')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 process-block">
                            <div class="process-block-one">
                                <div class="inner-box">
                                    <span class="count wow fadeInDown animated" data-wow-delay="600ms" data-wow-duration="1500ms">03</span>
                                    <div class="text wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                        <h3>@lang('messages.Sell Your Item')</h3>
                                        <p>@lang('messages.sellpara')</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- process-section end -->



<!--about new process section-->
        <div class="py-5 about-yaka-section">
            <div class="container">
              <div class="mb-4 text-center row">
                <div class="col">
                  <img src="{{ asset('newFrontend/Clasifico/assets/images/resource/yaka-process.png')}}" alt="About Illustration" class="img-fluid" style="max-width: 500px; height:auto">
                  <p class="text-muted">@lang('messages.para8')</p>
                  </div>
              </div>
              <div class="row">
                <div class="mb-4 col-md-6 d-flex align-items-start">
                  <img src="{{ asset('newFrontend/Clasifico/assets/images/resource/about-sell2.png')}}" alt="Sell Icon" class="me-3 img-fluid" style="width: 85px; height: 85px;">
                  <div>
                    <h4>@lang('messages.Have items to sell?')</h4>
                    <p>@lang('messages.para9')</p>
                  </div>
                </div>
                <div class="mb-4 col-md-6 d-flex align-items-start">
                  <img src="{{ asset('newFrontend/Clasifico/assets/images/resource/about-buy.png')}}" alt="Buy Icon" class="me-10 img-fluid" style="width: 95px; height: 95px;">
                  <div>
                    <h4>@lang('messages.Looking to buy something?')</h4>
                    <p>@lang('messages.para10')</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!--end about new process section-->

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
