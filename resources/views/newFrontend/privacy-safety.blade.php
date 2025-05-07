@extends('newFrontend.master')

@section('content')

<style>


  ul.custom-dots {
      list-style: none;
      padding-left: 20px;
  }
  ul.custom-dots li {
      display: flex; /* Keeps dot and text in a row */
      align-items: center; /* Aligns text vertically */
      gap: 10px; /* Space between dot and text */
      word-wrap: break-word; /* Prevents overflow issues */
  }
  ul.custom-dots li::before {
      content: "•";
      color: black;
      font-weight: bold;
      font-size: 18px;
  }
  @media (max-width: 768px) {
    .contact-section {
      padding: 15px 20px;
    }

    .contact-info {
      flex-direction: column;
    }
    ul.custom-dots li {
          font-size: 14px; /* Adjusts text size for smaller screens */
          gap: 8px; /* Reduces space between dot and text */
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

ul.custom-dots {
    list-style: none;
    padding-left: 0;
    margin-left: 0;
}

ul.custom-dots li {
    position: relative;
    padding-left: 25px;
    margin-bottom: 10px;
    font-size: 16px;
    line-height: 1.6;
    word-wrap: break-word;
}

ul.custom-dots li::before {
    content: "•";
    position: absolute;
    left: 0;
    top: 2px;
    font-size: 20px;
    color: black;
    font-weight: bold;
    line-height: 1;
}

@media (max-width: 768px) {
    ul.custom-dots li {
      font-size: 14px;
      padding-left: 20px;
    }

    ul.custom-dots li::before {
      font-size: 16px;
      top: 3px;
    }
  }

  ul.custom-dots {
    list-style: none;
    padding-left: 0;
    margin-left: 0;
}

ul.custom-dots li {
    position: relative;
    padding-left: 25px; /* Creates space for the custom bullet */
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 1.6;
}

ul.custom-dots li::before {
    content: "•";
    position: absolute;
    left: 0;
    top: 3px; /* Tweak as needed for vertical alignment */
    font-size: 18px;
    color: black;
    font-weight: bold;
}
@media (max-width: 768px) {
    ul.custom-dots li {
      font-size: 14px;
      padding-left: 20px;
    }

    ul.custom-dots li::before {
      font-size: 16px;
      top: 4px;
    }
  }
  ul.custom-dots {
    list-style: none;
    padding-left: 0;
    margin-left: 0;
}

ul.custom-dots li {
    display: grid;
    grid-template-columns: auto 1fr; /* Bullet + content */
    align-items: start;
    column-gap: 10px;
    margin-bottom: 12px;
    font-size: 16px;
    line-height: 1.6;
}

ul.custom-dots li::before {
    content: "•";
    color: black;
    font-weight: bold;
    font-size: 18px;
    padding-top: 2px; /* vertical alignment tweak */
}
@media (max-width: 768px) {
    ul.custom-dots li {
        font-size: 14px;
        column-gap: 8px;
    }

    ul.custom-dots li::before {
        font-size: 16px;
        padding-top: 4px;
    }
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
                        <h1>@lang('messages.Privacy & Safety')</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">@lang('messages.Home')</a></li>
                        <li>@lang('messages.Privacy & Safety')</li>
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

<div class="container">
  <div class="row">
    <div class="mt-5 col-md-12">
        <div class="sec-title">
        <span>@lang('messages.Privacy & Safety')</span>
        <h2>@lang('Our') @lang('messages.Privacy & Safety')</h2>
        </div>
      <div class="mb-5 privacy-content">
        <h2 style="font-size: 27px;margin-top: 40px">1. @lang('messages.Information We Collect')</h2>
        <ul  class="custom-dots">
        <li><strong>@lang('messages.Personal Data'):</strong> @lang('messages.Name, email address, phone number, and payment information')</li>
          <li><strong>@lang('messages.Usage Data'):</strong> @lang('messages.IP address, browser type, and interaction history with the Website')</li>
          <li><strong>@lang('messages.Cookies'):</strong> @lang('messages.To enhance user experience and analyze traffic. You can manage cookies through your browser settings')</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">2. @lang('messages.How We Use Your Data')</h2>
        <ul class="custom-dots">
          <li>@lang('messages.To manage user accounts and provide customer support')</li>
          <li>@lang('messages.To process payments and publish listings')</li>
          <li>@lang('messages.To improve Website functionality through analytics and user feedback')</li>
          <li>@lang('messages.To send updates, notifications, or promotional offers (only with consent)')</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">3. @lang('messages.Data Sharing and Disclosure')</h2>
        <ul  class="custom-dots">
          <li>@lang('messages.We do not sell your data to third parties')</li>
          <li>@lang('messages.Data may be shared with payment processors, law enforcement, or service providers as necessary')</li>
          <li>@lang('messages.In case of a merger or acquisition, your data may be transferred to the new entity')</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">4. @lang('messages.Data Security')</h2>
        <ul  class="custom-dots">
          <li>@lang('messages.We use encryption and other security measures to protect your personal data')</li>
          <li>@lang('messages.Despite our efforts, no online service is entirely secure. We encourage users to protect their login information')</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">5. @lang('messages.User Rights')</h2>
        <ul  class="custom-dots">
          <li><strong>@lang('messages.Access and Correction'):</strong>@lang('messages.You can access and update your personal information through your account')</li>
          <li><strong>@lang('messages.Data Deletion'):</strong>@lang('messages.You may request the deletion of your personal data by contacting support') </li>
          <li><strong>@lang('messages.Consent Withdrawal'):</strong>@lang('messages.You can opt out of marketing emails by clicking the unsubscribe link')
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
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
