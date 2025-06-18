@extends ('newAdminDashboard.master')

@section('content')

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">

                <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.banner-package.delete-package', $category->id)}}" >
                    @csrf
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <div style=" border-bottom: 1px solid #e3e3e3;" class="form-group">
                        <p style="font-size: 13px;margin-left: 20px;">Are you sure you want to delete?</p>
                    </div>

                    <button style="background: red;border: none;"  class="btn btn-primary me-2">Delete</button>
                    <a href="{{ route('dashboard.banner-packages') }}" class="btn btn-light">Cancel</a>
                </form>

            </div>
        </div>
    </div>
@endsection
