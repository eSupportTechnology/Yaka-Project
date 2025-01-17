@extends('web.layout.layout')

@section('content')
<?php use Stichoza\GoogleTranslate\GoogleTranslate; ?>
  <div class="container">
    <div class="row">
      <div class="pt-5 pb-5 col-md-12">
        <h2 class="mt-5 mb-4 text-center">Boosting Ads</h2>
        <p class="mb-4 text-center">{{ GoogleTranslate::trans('Our boosting methods are powered by a fully sophisticated AI-generated algorithm, ensuring quicker results.', app()->getLocale()) }}</p>
        <ul class="text-center boosting-list">
          <li class="mb-2">1. Jump up ads</li>
          <li class="mb-2">2. Top ads</li>
          <li class="mb-2">3. Urgent ads</li>
          <li class="mb-2">4. Super ad</li>
        </ul>
      </div>
    </div>
  </div>
@endsection
