@extends ('newAdminDashboard.master')

@section('content')
    <div class="row">
            <div class="col-lg-6 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">

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
                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.banner-package.update-package',[$pack->id])}}" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $pack->id}}">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="name" value="{{ old('name') ??  $pack->name }}" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">status <span style="color: red">*</span></label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option  @if( $pack->status == 0) selected @endif value="0">N/A</option>
                                <option  @if( $pack->status == 1) selected @endif value="1">Active</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputUsername1">No of Days <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="" name="no_of_days" value="{{ old('no_of_days') ??  $pack->no_of_days }}" placeholder="No of Days">
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>

                        <a href="{{ route('dashboard.banner-packages') }}" class="btn btn-light">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
