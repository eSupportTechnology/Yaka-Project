@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-5">
        <h1 class="text-center">{{ GoogleTranslate::trans('Terms & Conditions', app()->getLocale()) }}</h1>
        <div class="terms-content mb-5">
          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('1. Acceptance of Terms', app()->getLocale()) }}</h2>
          <p>{{ GoogleTranslate::trans('By accessing or using [Yaka.lk] (“the Website”), you agree to be bound by these Terms and Conditions. If you do not agree to these terms, you may not use the Website.', app()->getLocale()) }}</p>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('2. User Registration and Eligibility', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('Users must be at least 18 years old to create an account.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('You agree to provide accurate and up-to-date information during registration.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('We reserve the right to terminate accounts that violate these terms.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('3. Listing and Posting Rules', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('You are responsible for ensuring that the information provided in your listing is accurate and complete.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Illegal items, stolen goods, counterfeit products, and prohibited services are strictly forbidden.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('We reserve the right to remove or suspend listings that violate these terms without notice.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('4. Fees and Payment', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('Some listings may require a fee to post. All fees are non-refundable.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Payments are processed securely through third-party payment gateways. We are not responsible for any transaction issues related to payment providers.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('5. User Responsibilities and Conduct', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('You agree not to engage in fraudulent or deceptive activities, including false advertising or spamming.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Users are responsible for verifying the authenticity of goods and services before proceeding with a transaction.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('We are not responsible for any disputes between buyers and sellers.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('6. Prohibited Content', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('You must not post content that is unlawful, defamatory, obscene, or infringes on third-party rights.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('We reserve the right to remove content at our discretion.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('7. Intellectual Property', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('All content on the Website, including logos, design, and text, is our intellectual property.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('You may not reproduce, distribute, or use the Website’s content without our permission.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('8. Disclaimers and Limitation of Liability', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We provide the Website “as is” and make no guarantees about the availability, reliability, or accuracy of listings.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('We are not liable for any direct, indirect, or consequential damages arising from your use of the Website.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('9. Third-Party Links and Services', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('The Website may contain links to third-party websites. We are not responsible for their content or practices.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Your dealings with third-party services are solely between you and the respective provider.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('10. Account Termination', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We reserve the right to terminate accounts without notice if users violate these terms or engage in suspicious activity.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Users may delete their accounts at any time by contacting support.', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('11. Governing Law and Disputes', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('These terms are governed by the laws of [Your Jurisdiction].', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Any disputes will be resolved through arbitration or courts located in [Your Jurisdiction].', app()->getLocale()) }}</li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">{{ GoogleTranslate::trans('12. Changes to Terms and Conditions', app()->getLocale()) }}</h2>
          <ul>
            <li>{{ GoogleTranslate::trans('We reserve the right to update these terms at any time. Changes will be communicated through the Website or email.', app()->getLocale()) }}</li>
            <li>{{ GoogleTranslate::trans('Continued use of the Website after changes constitutes acceptance of the revised terms.', app()->getLocale()) }}</li>
          </ul>
          
        </div>
      </div>
    </div>
  </div>
@endsection
