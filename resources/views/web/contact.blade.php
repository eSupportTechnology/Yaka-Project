@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-5">
        <h1 class="text-center">{{ GoogleTranslate::trans('Contact Us', app()->getLocale()) }}</h1>
        <div class="contact-content text-center mb-5">
          <p>{{ GoogleTranslate::trans('If you have any questions or concerns regarding these policies, please feel free to contact us at:', app()->getLocale()) }}</p>
          
          <ul class="list-unstyled">
            <li><strong>{{ GoogleTranslate::trans('Email:', app()->getLocale()) }}:</strong></li>
            <li>Info@yaka.lk</li>
            <li>Yaka.lk@outlook.com</li>
            <li>Yakalksrilanka@gmail.com</li>
          </ul>

          <ul class="list-unstyled">
            <li><strong>{{ GoogleTranslate::trans('Phone:', app()->getLocale()) }}:</strong> 070 5 321 321</li>
          </ul>
        </div>

        <!-- Contact Form -->
        <form action="{{ route('contact.submit') }}" method="post" style="background: #ffffff;padding: 22px;margin-bottom: 46px;">
          @csrf
          <div class="form-group">
            <label for="name">{{ GoogleTranslate::trans('Name', app()->getLocale()) }}:</label>
            <input type="text" id="name" name="name" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="email">{{ GoogleTranslate::trans('Email', app()->getLocale()) }}:</label>
            <input type="email" id="email" name="email" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="message">{{ GoogleTranslate::trans('Message', app()->getLocale()) }}:</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
          </div>

          <button type="submit" class="btn btn-primary mt-3">{{ GoogleTranslate::trans('Send', app()->getLocale()) }}</button>
        </form>
        <!-- End of Contact Form -->

      </div>
    </div>
  </div>
@endsection
