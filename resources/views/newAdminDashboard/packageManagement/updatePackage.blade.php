@extends ('newAdminDashboard.master')

@section('content')
    <div class="row">
            <div class="col-lg-6 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update @if(isset($mainpack) && $pack->package_id != 1 ) Sub @endif Package</h4>

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
                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.package.update-package',[$pack->url])}}" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="id" value="{{ $pack->id}}">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="name" value="{{ old('name') ??  $pack->name }}" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">status </label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option  @if( $pack->status == 0) selected @endif value="0">N/A</option>
                                <option  @if( $pack->status == 1) selected @endif value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>

                        @if(isset($mainpack) &&  $pack->package_id != 0 )
                            <a href="{{route('dashboard.sub-packages',[$mainpack->url])}}" class="btn btn-light">Cancel</a>
                        @else
                            <a href="{{ route('dashboard.packages') }}" class="btn btn-light">Cancel</a>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
