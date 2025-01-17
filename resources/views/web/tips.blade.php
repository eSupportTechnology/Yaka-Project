@extends('web.layout.layout')

@section('content')
<?php use Stichoza\GoogleTranslate\GoogleTranslate; ?>
  <div class="container">
    <div class="row">
      <div class="pt-5 pb-5 col-md-12">
        <h2 class="mb-4 text-center">{{ GoogleTranslate::trans('Tips for Better Ads', app()->getLocale()) }}</h2>
        <ul class="text-center tips-list">
          <li class="mb-2">{{ GoogleTranslate::trans('1. Upload clear photos from different angles.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('2. Upload real photos.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('3. Add actual and clear details to impress customers.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('4. Add working contact numbers.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('5. Choose a competitive price.', app()->getLocale()) }}</li>
          <li class="mb-2">{{ GoogleTranslate::trans('6. Select the negotiable option for a better response.', app()->getLocale()) }}</li>
        </ul>
      </div>
    </div>
  </div>
@endsection
