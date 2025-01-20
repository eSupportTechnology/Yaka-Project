@extends('adminPanel.layout.layout')

@section('content')

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">View @if(isset($data) && $data->brandsId != 0 ) Model @else Brand @endif details </h4>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Sub Category </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$data->category->name}}</div>
                </div>

                <div class="form-group">
                    <label style="font-size: 16px;" for="exampleInputUsername1"> Name </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$data->name}}</div>
                </div>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Url </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$data->url}}</div>
                </div>

                @if(isset($data) && $data->brandsId != 0 )
                    <a href="{{route('dashboard.categories.update',[$data->url])}}"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="{{route('dashboard.configuration.models',[$brand->url])}}" class="btn btn-light">Cancel</a>
                @else
                    <a href="{{route('dashboard.categories.update',[$data->url])}}"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="{{route('dashboard.configuration.brands-and-models')}}" class="btn btn-light">Cancel</a>
                @endif

            </div>
        </div>
    </div>
@endsection
