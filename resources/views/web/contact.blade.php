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

  .map-container {
    margin-top: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        <h1 class="text-center">{{ GoogleTranslate::trans('Contact Us', app()->getLocale()) }}</h1>
        <div class="mb-5 text-center contact-content">
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

          <button type="submit" class="mt-3 btn btn-primary">{{ GoogleTranslate::trans('Send', app()->getLocale()) }}</button>
        </form>
        <!-- End of Contact Form -->

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
  <!-- Add Google Maps Embed -->
  <div class="mt-5 google-container">
    <h2 class="text-center">{{ GoogleTranslate::trans('Our Location on the Map', app()->getLocale()) }}</h2>
    <div class="map-container">
        <!-- Replace YOUR_GOOGLE_MAPS_API_KEY with your actual API key -->
        <iframe 
            src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=Colombo+10,+Sri+Lanka" 
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </div>
  </div>
  

@endsection
