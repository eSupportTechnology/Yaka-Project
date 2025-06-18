@extends ('newAdminDashboard.master')

@section('content')
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Banner</h4>

                    @if (isset($success) && $success)
                        <div class="alert alert-success" role="alert">
                            {{$success}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                   {{ $error }}</li>
                                @endforeach
                        </div>
                    @endif

                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.banner.create-banner')}}" enctype="multipart/form-data" >

                        @csrf
                        @if(isset($maincategory))
                            <input type="hidden" name="mainid" value="{{$maincategory->id}}">
                        @endif

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Upload Banner Image <span style="color: red">*</span></label>
                           <input type="file" name="image" accept=".gif" class="form-control" id="">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Type </label>
                            <select class="form-control" name="type" id="exampleFormControlSelect2">
                                <option  value="0">Leaderboard (Banner size: 1140x180)</option>
                                <option value="1">Skyscrapers  (Banner size: 285x500)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="banner_url">URL </label>
                            <input class="form-control" type="text" name="banner_url" id="banner_url">
                        </div>

                        <div class="form-group">
                            <label for="package">Package </label>
                            <select class="form-control" name="package" id="">
                                <option  value="">Select Package</option>
                                @foreach ($packages as $package)
                                    <option  value="{{ $package->id }}">{{ $package->name }} - {{ $package->no_of_days }} Days</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
