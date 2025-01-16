@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 pt-5 pb-5">
        <h2 class="text-center mt-5 mb-4">{{ GoogleTranslate::trans('Ads Posting Criteria', app()->getLocale()) }}</h2>
        <ul class="posting-criteria-list text-center">
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
@endsection
