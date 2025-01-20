@extends('adminPanel.layout.layout')

@section('content')

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">View @if(isset($packTypes) && $packTypes->package_id != 0 ) Sub @endif Package details </h4>

                <div class="form-group">
                    <label style="font-size: 16px;" for="exampleInputUsername1"> Name </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$packTypes->name}}</div>
                </div>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Url </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$packTypes->url}}</div>
                </div>
               

                @if(isset($packTypes) )
                    <a href="{{route('dashboard.package.update',[$packTypes->url])}}"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="{{route('dashboard.packages')}}" class="btn btn-light">Cancel</a>
                @else
                    <a href=""  class="btn btn-primary me-2">Update This Details</a>
                    <a href="" class="btn btn-light">Cancel</a>
                @endif

            </div>
        </div>
    </div>
@endsection
