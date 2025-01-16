@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12 pt-5 pb-5">
        <h2 class="text-center mt-5 mb-4"> {{ GoogleTranslate::trans('Ads Posting Allowances', app()->getLocale()) }}</h2>
        <p class="text-center mb-4"> {{ GoogleTranslate::trans('Free ad posting is available in every category. Contact us to become a Yaka.lk subscriber and own your stall today.', app()->getLocale()) }}</p>
        
        <ul class="posting-allowances-list">


          @php
            $categories = \App\Models\Category::where('mainId', 0)->where('status', 1)->get();
          @endphp

          @foreach ($categories as $key => $cat)
            <li class="mb-2">{{$key+1}}. - {{ GoogleTranslate::trans($cat->name, app()->getLocale()) }} - {{ $cat->free_add_count}}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection
