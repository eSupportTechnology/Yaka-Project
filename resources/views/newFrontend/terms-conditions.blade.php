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
                <h1>Terms & Conditions</h1>
            </div>
            <ul class="clearfix bread-crumb">
                <li><a href="{{route( '/')}}">Home</a></li>
                <li>Terms & Conditions</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->
  <div class="container">
    <div class="row">
      <div class="mt-5 col-md-12">
        <div class="sec-title">
            <span>Terms & Conditions</span>
            <h2>Our Terms & Conditions</h2>
        </div>
        <div class="mb-5 terms-content">
          <h2 style="font-size: 27px;margin-top: 40px">1. Acceptance of Terms</h2>
          <ul  class="custom-dots">
            <li>By accessing or using [Yaka.lk] (“the Website”), you agree to be bound by these Terms and Conditions. </li>
            <li>  If you do not agree to these terms, you may not use the Website.</li>
        </ul>

          <h2 style="font-size: 27px;margin-top: 40px">2. User Registration and Eligibility</h2>
          <ul  class="custom-dots">
            <li>Users must be at least 18 years old to create an account.</li>
            <li>You agree to provide accurate and up-to-date information during registration.</li>
            <li>We reserve the right to terminate accounts that violate these terms.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">3. Listing and Posting Rules</h2>
          <ul  class="custom-dots">
            <li>You are responsible for ensuring that the information provided in your listing is accurate and complete.</li>
            <li>Illegal items, stolen goods, counterfeit products, and prohibited services are strictly forbidden.</li>
            <li>We reserve the right to remove or suspend listings that violate these terms without notice.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">4. Fees and Payment</h2>
          <ul  class="custom-dots">
            <li>Some listings may require a fee to post. All fees are non-refundable.</li>
            <li>Payments are processed securely through third-party payment gateways. We are not responsible for any transaction issues related to payment providers.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">5. User Responsibilities and Conduct</h2>
          <ul  class="custom-dots">
            <li>You agree not to engage in fraudulent or deceptive activities, including false advertising or spamming.</li>
            <li>Users are responsible for verifying the authenticity of goods and services before proceeding with a transaction.</li>
            <li>We are not responsible for any disputes between buyers and sellers.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">6. Prohibited Content</h2>
          <ul  class="custom-dots">
            <li>You must not post content that is unlawful, defamatory, obscene, or infringes on third-party rights.</li>
            <li>We reserve the right to remove content at our discretion.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">7. Intellectual Property</h2>
          <ul  class="custom-dots">
            <li>All content on the Website, including logos, design, and text, is our intellectual property.</li>
            <li>You may not reproduce, distribute, or use the Website’s content without our permission.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">8. Disclaimers and Limitation of Liability</h2>
          <ul  class="custom-dots">
            <li>We provide the Website “as is” and make no guarantees about the availability, reliability, or accuracy of listings.</li>
            <li>We are not liable for any direct, indirect, or consequential damages arising from your use of the Website.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">9. Third-Party Links and Services</h2>
          <ul  class="custom-dots">
            <li>The Website may contain links to third-party websites. We are not responsible for their content or practices.</li>
            <li>Your dealings with third-party services are solely between you and the respective provider.</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">10. Account Termination</h2>
          <ul  class="custom-dots">
            <li>We reserve the right to terminate accounts without notice if users violate these terms or engage in suspicious activity.</li>
            <li>Users may delete their accounts at any time by contacting support.</li>
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
