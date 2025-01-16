@extends('web.layout.layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="pt-5 pb-5 col-md-12">
        <h1 class="mb-5 text-center">{{ $data['title'] }}</h1>
        <ul>
          @foreach ($data['content'] as $item)
            <li class="mb-2 text-center">{{ $item }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endsection


