@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mt-5 col-md-12">
        <h1 class="text-center">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Contact Us', $locale) }}</h1>
        <div class="mb-5 text-center contact-content">
          <p>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('If you have any questions or concerns regarding these policies, please feel free to contact us at:', $locale) }}</p>
          
          <ul class="list-unstyled">
            <li><strong>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Email:', $locale) }}:</strong></li>
            <li>Info@yaka.lk</li>
            <li>Yaka.lk@outlook.com</li>
            <li>Yakalksrilanka@gmail.com</li>
          </ul>

          <ul class="list-unstyled">
            <li><strong>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Phone:', $locale) }}:</strong> 070 5 321 321</li>
          </ul>
        </div>

        <!-- Contact Form -->
        <form action="{{ route('contact.submit') }}" method="post" style="background: #ffffff;padding: 22px;margin-bottom: 46px;">
          @csrf
          <div class="form-group">
            <label for="name">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Name', $locale) }}:</label>
            <input type="text" id="name" name="name" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="email">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Email', $locale) }}:</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="message">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Message', $locale) }}:</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
          </div>

          <button type="submit" class="mt-3 btn btn-primary">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Send', $locale) }}</button>
        </form>
        <!-- End of Contact Form -->

      </div>
    </div>
  </div>
@endsection
