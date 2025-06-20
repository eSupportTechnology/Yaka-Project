@extends ('newAdminDashboard.master')

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
                    <label style="font-size: 16px" for="exampleInputUsername1">Phone Number </label>
                    <div style="font-size: 15px;margin-left: 20px;">{{$user->phone_number}}</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <th>Category</th>
                                <th>Count</th>
                            </thead>
                            <tbody>
                                @foreach ($adsDetails as $adsDetail)
                                    <tr>
                                        <td>{{ $adsDetail->name }}</td>
                                        <td>{{ $adsDetail->total }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>Total</td>
                                    <td>{{ $totalAds }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                    <a href="{{route('dashboard.staffs.update',[$user->id])}}"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="{{route('dashboard.staffs')}}" class="btn btn-light">Cancel</a>

            </div>
        </div>
    </div>
@endsection
