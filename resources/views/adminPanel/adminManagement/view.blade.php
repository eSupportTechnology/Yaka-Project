@extends('adminPanel.layout.layout')

@section('content')

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">View User details </h4>

                <div class="form-group">
                    <label style="font-size: 16px;" for="exampleInputUsername1">First Name </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$user->first_name}}</div>
                </div>
                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Last Name </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$user->last_name}}</div>
                </div>
                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Url </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$user->url}}</div>
                </div>
                <div class="form-group">
                    <label style="font-size: 16px" for="exampleInputUsername1">Email </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$user->email}}</div>
                </div>
                <div class="form-group">
                    <label style="font-size: 16px" for="exampleInputUsername1">Phone Number </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$user->phone_number}}</div>
                </div>

                    <a href="{{route('dashboard.admins.update',[$user->id])}}"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="{{route('dashboard.admins')}}" class="btn btn-light">Cancel</a>

            </div>
        </div>
    </div>
@endsection
