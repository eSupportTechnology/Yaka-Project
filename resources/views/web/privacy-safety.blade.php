@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mt-5 col-md-12">
        <h1 class="text-center">{{ $translations['Privacy Policy'] }}</h1>
        <div class="mb-5 privacy-content">

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['Information We Collect'] }}</h2>
          <ul>
            <li><strong>{{ $translations['Personal Data'] }}:</strong> {{ __('Name, email address, phone number, and payment information.') }}</li>
            <li><strong>{{ $translations['Usage Data'] }}:</strong> {{ __('IP address, browser type, and interaction history with the Website.') }}</li>
            <li><strong>{{ $translations['Cookies'] }}:</strong> {{ __('To enhance user experience and analyze traffic. You can manage cookies through your browser settings.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['How We Use Your Data'] }}</h2>
          <ul>
            <li>{{ __('To manage user accounts and provide customer support.') }}</li>
            <li>{{ __('To process payments and publish listings.') }}</li>
            <li>{{ __('To improve Website functionality through analytics and user feedback.') }}</li>
            <li>{{ __('To send updates, notifications, or promotional offers (only with consent).') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['Data Sharing and Disclosure'] }}</h2>
          <ul>
            <li>{{ __('We do not sell your data to third parties.') }}</li>
            <li>{{ __('Data may be shared with payment processors, law enforcement, or service providers as necessary.') }}</li>
            <li>{{ __('In case of a merger or acquisition, your data may be transferred to the new entity.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['Data Security'] }}</h2>
          <ul>
            <li>{{ __('We use encryption and other security measures to protect your personal data.') }}</li>
            <li>{{ __('Despite our efforts, no online service is entirely secure. We encourage users to protect their login information.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['User Rights'] }}</h2>
          <ul>
            <li><strong>{{ __('Access and Correction:') }}</strong> {{ __('You can access and update your personal information through your account.') }}</li>
            <li><strong>{{ __('Data Deletion:') }}</strong> {{ __('You may request the deletion of your personal data by contacting support.') }}</li>
            <li><strong>{{ __('Consent Withdrawal:') }}</strong> {{ __('You can opt out of marketing emails by clicking the unsubscribe link.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['Cookies Policy'] }}</h2>
          <ul>
            <li>{{ __('We use cookies to personalize content and ads, analyze traffic, and improve the user experience.') }}</li>
            <li>{{ __('Third-party cookies (e.g., from analytics providers) may also be used.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['Third-Party Services'] }}</h2>
          <ul>
            <li>{{ __('The Website may link to external websites. We are not responsible for their privacy practices.') }}</li>
            <li>{{ __('Transactions involving third-party services are governed by the terms of the respective provider.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['Data Retention'] }}</h2>
          <ul>
            <li>{{ __('We retain personal data for as long as necessary to fulfill the purposes outlined in this policy.') }}</li>
            <li>{{ __('User data will be deleted upon request, unless it is required for legal or regulatory purposes.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations["Children's Privacy"] }}</h2>
          <ul>
            <li>{{ __('Our Website is not intended for children under the age of 18. We do not knowingly collect data from minors.') }}</li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">{{ $translations['Changes to the Privacy Policy'] }}</h2>
          <ul>
            <li>{{ __('We may update this policy periodically. Changes will be communicated through the Website or via email.') }}</li>
            <li>{{ __('Continued use of the Website after changes signifies acceptance of the updated policy.') }}</li>
          </ul>

        </div>
      </div>
    </div>
  </div>
@endsection
