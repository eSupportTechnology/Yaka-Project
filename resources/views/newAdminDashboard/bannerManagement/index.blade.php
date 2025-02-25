@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Banner List</h2>
    </div>
    <div>
        <a href="{{route('dashboard.banner.create')}}" class="btn btn-primary btn-sm rounded">Create New Banner</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                 <!-- Display success message -->
                 @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $banner)
                                <tr>
                                    <td>{{ $banner->id }}</td>
                                    <td><img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image" width="100"></td>
                                    <td>
                                        @if($banner->type == 0)
                                            Leaderboard (1140x180)
                                        @else
                                            Skyscraper (285x500)
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex flex-nowrap">
                                            <a href="{{ route('dashboard.banner.update', [$banner->id]) }}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('dashboard.banner.delete', [$banner->id]) }}" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    {{ $banners->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
