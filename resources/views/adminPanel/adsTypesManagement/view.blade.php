@extends('adminPanel.layout.layout')

@section('content')

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">View @if(isset($category) && $category->mainId != 0 ) Sub @endif Type details </h4>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Sub Category </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$data1->name}}</div>
                </div>

                <div class="form-group">
                    <label style="font-size: 16px;" for="exampleInputUsername1"> Name </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$data->name}}</div>
                </div>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Url </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$data->url}}</div>
                </div>
               
                @if(isset($data) && $data1->mainId != 0 )
                    <a href="{{route('dashboard.adsTypes.update',[$data->url])}}"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="{{route('dashboard.adsTypes')}}" class="btn btn-light">Cancel</a>
                @else
                    <a href="{{route('dashboard.adsTypes.update',[$data->url])}}"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="{{route('dashboard.adsTypes.update',[$data->url])}}" class="btn btn-light">Cancel</a>
                @endif

            </div>
        </div>
    </div>
@endsection
