@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 pt-5 pb-5">
        <h1 class="text-center mb-5" >{{ GoogleTranslate::trans('About Us', app()->getLocale()) }}</h1>
        <ul>
          <li class="text-center mb-2 ">{{ GoogleTranslate::trans('Yaka.lk is the largest growing market place in Sri Lanka. This is a 100 % Sri
            Lankan website which designed specially to suit Sri Lankans. If you want
            to buy or sell anything, you have arrived to the right destination.', app()->getLocale()) }}</li>
            <li  class="text-center mb-2 ">{{ GoogleTranslate::trans('Yaka.lk has the broad selection of items so you can navigate through
              many categories such as Electronics, Vehicles, Property, jobs, Industrial,
              etc., also you can use search filters in order to make it quick in findings.', app()->getLocale()) }}</li>
              <li class="text-center mb-2 ">{{ GoogleTranslate::trans('You can create free account in yaka.lk and post your advertisement within
                no time and as soon as you publish, we will review it and allow to view in
                website. Also, you can choose add promotion packages for better results.', app()->getLocale()) }}</li>
        </ul>
      </div>
    </div>
  </div>
@endsection

