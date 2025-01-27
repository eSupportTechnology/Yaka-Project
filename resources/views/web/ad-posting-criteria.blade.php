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
      <div class="pt-5 pb-5 col-md-12">
        <h2 class="mt-5 mb-4 text-center">{{ GoogleTranslate::trans('Ads Posting Criteria', app()->getLocale()) }}</h2>
        <ul class="text-center posting-criteria-list">
          <li class="mb-2">{{ GoogleTranslate::trans('1. Use correct quality pictures regarding the item.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('2. Strictly only legal items.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('3. Photos should match the item or service.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('4. Do not post alcohol, tobacco, or related drugs.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('5. Use correct contact numbers.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('6. Do not post prohibited items.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('7. Do not post several items in a single ad.', app()->getLocale()) }}</li>
        </ul>
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
