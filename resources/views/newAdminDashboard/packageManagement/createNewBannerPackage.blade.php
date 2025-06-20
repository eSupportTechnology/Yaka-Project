@extends ('newAdminDashboard.master')

@section('content')
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New Banner Package</h4>

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

                <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.banner-package.store')}}" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <label for="exampleInputUsername1">Name <span style="color: red">*</span></label>
                        <input type="text" required class="form-control" id="exampleInputUsername1" name="name" value="{{ old('name')  }}" placeholder="Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlSelect2">status </label>
                        <select class="form-control" name="status" id="exampleFormControlSelect2">
                            <option value="0">N/A</option>
                            <option value="1">Active</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect2">No of Days </label>
                        <input class="form-control" type="text" name="no_of_days" id="no_of_days">
                    </div>

                    <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>

                    <a href="{{ route('dashboard.banner-packages') }}" class="btn btn-light">Cancel</a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
