@extends('newFrontend.master')

@section('content')

<style>
  .contact-section {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px 40px;
    margin: 20px auto;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 100%;
    width: 90%;
  }

  .contact-section h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
  }

  .contact-section p {
    font-size: 14px;
    color: #666;
    margin: 5px 0;
  }

  .contact-info {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    align-items: center;
    margin-top: 20px;
    font-size: 16px;
    color: #333;
  }

  .contact-info div {
    flex: 1;
    max-width: 300px;
    text-align: center;
    margin: 10px;
  }

  .contact-info .icon {
    font-size: 24px;
    color: #700202;
    margin-bottom: 10px;
  }

  .contact-info a {
    color: #700202;
    text-decoration: none;
  }

  .contact-info a:hover {
    text-decoration: underline;
  }

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
                <h1>Privacy & safety</h1>
            </div>
            <ul class="clearfix bread-crumb">
                <li><a href="{{route( '/')}}">Home</a></li>
                <li>Privacy & safety</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<div class="container">
  <div class="row">
    <div class="mt-5 col-md-12">
        <div class="sec-title">
            <span>Privacy & Safety</span>
            <h2>Our Privacy & Safety</h2>
        </div>
      <div class="mb-5 privacy-content">
        <h2 style="font-size: 27px;margin-top: 40px">1. Information We Collect</h2>
        <ul  class="custom-dots">
          <li><strong>Personal Data:</strong> Name, email address, phone number, and payment information.</li>
          <li><strong>Usage Data:</strong> IP address, browser type, and interaction history with the Website.</li>
          <li><strong>Cookies:</strong> To enhance user experience and analyze traffic. You can manage cookies through your browser settings.</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">2. How We Use Your Data</h2>
        <ul class="custom-dots">
          <li>To manage user accounts and provide customer support.</li>
          <li>To process payments and publish listings.</li>
          <li>To improve Website functionality through analytics and user feedback.</li>
          <li>To send updates, notifications, or promotional offers (only with consent).</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">3. Data Sharing and Disclosure</h2>
        <ul  class="custom-dots">
          <li>We do not sell your data to third parties.</li>
          <li>Data may be shared with payment processors, law enforcement, or service providers as necessary.</li>
          <li>In case of a merger or acquisition, your data may be transferred to the new entity.</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">4. Data Security</h2>
        <ul  class="custom-dots">
          <li>We use encryption and other security measures to protect your personal data.</li>
          <li>Despite our efforts, no online service is entirely secure. We encourage users to protect their login information.</li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">5. User Rights</h2>
        <ul  class="custom-dots">
          <li><strong>Access and Correction:</strong> You can access and update your personal information through your account.</li>
          <li><strong>Data Deletion:</strong> You may request the deletion of your personal data by contacting support.</li>
          <li><strong>Consent Withdrawal:</strong> You can opt out of marketing emails by clicking the unsubscribe link.</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<div class="contact-section">
  <h2>Questions? Get in touch!</h2>
  <p>If you have any problems,</p>
  <p>May be related to the following services</p>
  <div class="contact-info">
    <div>
      <div class="icon">📞</div>
      <strong>Call us</strong>
      <p><a href="tel:0705321321">070 5 321 321</a></p>
    </div>
    <div>
      <div class="icon">📍</div>
      <strong>Our Location</strong>
      <p>Colombo 10, Sri Lanka</p>
    </div>
    <div>
      <div class="icon">📧</div>
      <strong>Email us</strong>
      <p><a href="mailto:Yakalksrilanka@gmail.com">Yakalksrilanka@gmail.com</a></p>
    </div>
  </div>
</div>
@endsection
