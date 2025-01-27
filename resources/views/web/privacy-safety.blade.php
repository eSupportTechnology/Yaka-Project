@extends('web.layout.layout')

@section('content')
<?php use Stichoza\GoogleTranslate\GoogleTranslate; ?>

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

  @media (max-width: 768px) {
   

    .contact-section {
      padding: 15px 20px;
    }

    .contact-info {
      flex-direction: column;
    }
  }

  </style>
  <div class="container">
    <div class="row">
      <div class="mt-5 col-md-12">
        <h1 class="text-center">{{ GoogleTranslate::trans('Privacy Policy', app()->getLocale()) }}</h1>
        <div class="mb-5 privacy-content">
          
          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('1. Information We Collect', app()->getLocale()) }}</h2>
          <ul>
            <li><strong>{{ GoogleTranslate::trans('Personal Data:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('Name, email address, phone number, and payment information.', app()->getLocale()) }}</li>
            <li><strong>{{ GoogleTranslate::trans('Usage Data:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('IP address, browser type, and interaction history with the Website.', app()->getLocale()) }}</li>
            <li><strong>{{ GoogleTranslate::trans('Cookies:', app()->getLocale()) }}</strong> {{ GoogleTranslate::trans('To enhance user experience and analyze traffic. You can manage cookies through your browser settings.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('2. How We Use Your Data', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('To manage user accounts and provide customer support.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('To process payments and publish listings.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('To improve Website functionality through analytics and user feedback.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('To send updates, notifications, or promotional offers (only with consent).', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('3. Data Sharing and Disclosure', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We do not sell your data to third parties.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Data may be shared with payment processors, law enforcement, or service providers as necessary.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('In case of a merger or acquisition, your data may be transferred to the new entity.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('4. Data Security', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We use encryption and other security measures to protect your personal data.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Despite our efforts, no online service is entirely secure. We encourage users to protect their login information.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('5. User Rights', app()->getLocale()) }}</h2>
          <ul>
            <li><strong>{{ GoogleTranslate::trans('Access and Correction:</strong> You can access and update your personal information through your account.', app()->getLocale()) }}</li>
            <li><strong>{{ GoogleTranslate::trans('Data Deletion:</strong> You may request the deletion of your personal data by contacting support.', app()->getLocale()) }}</li>
            <li><strong>{{ GoogleTranslate::trans('Consent Withdrawal:</strong> You can opt out of marketing emails by clicking the unsubscribe link.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('6. Cookies Policy', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We use cookies to personalize content and ads, analyze traffic, and improve the user experience.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Third-party cookies (e.g., from analytics providers) may also be used.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('7. Third-Party Services', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('The Website may link to external websites. We are not responsible for their privacy practices.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Transactions involving third-party services are governed by the terms of the respective provider.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('8. Data Retention', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We retain personal data for as long as necessary to fulfill the purposes outlined in this policy.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('User data will be deleted upon request, unless it is required for legal or regulatory purposes.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans("9. Children's Privacy", app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('Our Website is not intended for children under the age of 18. We do not knowingly collect data from minors.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="    font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('10. Changes to the Privacy Policy', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We may update this policy periodically. Changes will be communicated through the Website or via email.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Continued use of the Website after changes signifies acceptance of the updated policy.', app()->getLocale()) }}</li>
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
