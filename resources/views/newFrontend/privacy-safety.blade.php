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

<div class="container">
  <div class="row">
    <div class="mt-5 col-md-12">
        <div class="sec-title">
        <span>@lang('messages.Privacy & Safety')</span>
        <h2>@lang('messages.Our') @lang('messages.Privacy & Safety')</h2>
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

@endsection
