@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 pt-5 pb-5">
        <h2 class="text-center mt-5 mb-4">Boosting Ads</h2>
        <p class="text-center mb-4">{{ GoogleTranslate::trans('Our boosting methods are powered by a fully sophisticated AI-generated algorithm, ensuring quicker results.', app()->getLocale()) }}</p>
        <ul class="boosting-list text-center">
          <li class="mb-2">1. Jump up ads</li>
          <li class="mb-2">2. Top ads</li>
          <li class="mb-2">3. Urgent ads</li>
          <li class="mb-2">4. Super ad</li>
        </ul>
      </div>
    </div>
  </div>
@endsection
