@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Banner Package List</h2>
    </div>
    <div>
        <a href="{{route('dashboard.banner-package.create')}}" class="btn btn-primary btn-sm rounded">Create New Banner Package</a>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>No of Days</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($packTypes as $packType)
                                <tr>
                                    <td>{{ $packType->id }}</td>
                                    <td>{{ $packType->name }}</td>
                                    <td>
                                        @if($packType->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $packType->no_of_days }}</td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">

                                            <a href="{{route('dashboard.banner-package.update',[$packType->id])}}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{route('dashboard.banner-package.delete',[$packType->id])}}" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $packTypes->links('pagination::bootstrap-5') }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
