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
                <h1>@lang('messages.Terms & Conditions')</h1>
            </div>
            <ul class="clearfix bread-crumb">
                <li><a href="{{route( '/')}}">@lang('messages.Home')</a></li>
                <li>@lang('messages.Terms & Conditions')</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->
  <div class="container">
    <div class="row">
      <div class="mt-5 col-md-12">
        <div class="sec-title">
            <span>@lang('messages.Terms & Conditions')</span>
            <h2>@lang('messages.Our Terms & Conditions')</h2>
        </div>
        <div class="mb-5 terms-content">
          <h2 style="font-size: 27px;margin-top: 40px">1. @lang('messages.Acceptance of Terms')</h2>
          <ul  class="custom-dots">
            <li>@lang('messages.Acceptance line1')</li>
            <li>@lang('messages.Acceptance line2')</li>
        </ul>

          <h2 style="font-size: 27px;margin-top: 40px">2. @lang('messages.User Registration and Eligibility')</h2>
          <ul  class="custom-dots">
            <li>@lang('messages.Eligibility line1')</li>
            <li>@lang('messages.Eligibility line2')</li>
            <li>@lang('messages.Eligibility line3')</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">3. @lang('messages.Listing and Posting Rules')</h2>
          <ul  class="custom-dots">
            <li>@lang('messages.Posting Rules line1')</li>
            <li>@lang('messages.Posting Rules line2')</li>
            <li>@lang('messages.Posting Rules line3')</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">4. @lang('messages.Fees and Payment')</h2>
          <ul class="custom-dots">
              <li>@lang('messages.Fees line1')</li>
              <li>@lang('messages.Fees line2')</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">5. @lang('messages.User Responsibilities and Conduct')</h2>
          <ul class="custom-dots">
              <li>@lang('messages.User line1')</li>
              <li>@lang('messages.User line2')</li>
              <li>@lang('messages.User line3')</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">6. @lang('messages.Prohibited Content')</h2>
          <ul class="custom-dots">
              <li>@lang('messages.Prohibited line1')</li>
              <li>@lang('messages.Prohibited line2')</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">7. @lang('messages.Intellectual Property')</h2>
          <ul class="custom-dots">
              <li>@lang('messages.Intellectual line1')</li>
              <li>@lang('messages.Intellectual line2')</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">8. @lang('messages.Disclaimers and Limitation of Liability')</h2>
          <ul class="custom-dots">
              <li>@lang('messages.Disclaimers line1')</li>
              <li>@lang('messages.Disclaimers line2')</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">9. @lang('messages.Third-Party Links and Services')</h2>
          <ul class="custom-dots">
              <li>@lang('messages.ThirdParty line1')</li>
              <li>@lang('messages.ThirdParty line2')</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">10. @lang('messages.Account Termination')</h2>
          <ul class="custom-dots">
              <li>@lang('messages.Termination line1')</li>
              <li>@lang('messages.Termination line2')</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
 
@endsection
