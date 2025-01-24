@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">{{$package->name}}' Sub Package List</h2>
    </div>
    <div>
        <a href="{{route('dashboard.sub-pacages.create',[$package->url])}}" class="btn btn-primary btn-sm rounded">New Sub Package</a>
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
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sub as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->url }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>Rs {{ $subcategory->price }}</td>
                                    <td>
                                        @if($subcategory->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                           
                                            <!--<a href="{{route('dashboard.sub-package.view',[$subcategory->url])}}" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                            </a>-->
                                            <a href="{{route('dashboard.sub-package.update',[$subcategory->url])}}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{route('dashboard.sub-package.delete',[$subcategory->url])}}" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
