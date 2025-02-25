@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Package List</h2>
    </div>
    <div>
        <a href="{{route('dashboard.package.create')}}" class="btn btn-primary btn-sm rounded">Create New Package</a>
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
                                <th>url</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Sub Package</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($packTypes as $packType)
                                <tr>
                                    <td>{{ $packType->id }}</td>
                                    <td>{{ $packType->url }}</td>
                                    <td>{{ $packType->name }}</td>
                                    <td>
                                        @if($packType->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            
                                            <!-- <a href="{{route('dashboard.package.view',[$packType->url])}}" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                            </a>-->
                                            <a href="{{route('dashboard.package.update',[$packType->url])}}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{route('dashboard.package.delete',[$packType->url])}}" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                                            
                                            <a href="{{route('dashboard.sub-packages',[$packType->url])}}" class="btn btn-success btn-sm me-2">
                                            <i class="fas fa-file"></i>
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
