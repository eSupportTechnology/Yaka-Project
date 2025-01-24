@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Category List</h2>
    </div>
    <div>
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary btn-sm rounded">Create  New Category</a>
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
                                <th>Free Ads Count</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Sub category</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->url }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->free_add_count }}</td>
                                    <td>
                                        <img src="{{ asset('images/Category/' . $category->image) }}" alt="Category Image" style="width: 50px; height: auto;">
                                    </td>

                                    <td>
                                        @if($category->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                
                                            <!--<a href="{{route('dashboard.categories.view',[$category->url])}}" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                            </a>-->
                                            <a href="{{route('dashboard.categories.update',[$category->url])}}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{route('dashboard.categories.delete',[$category->url])}}" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>

                                        </div>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                                 
                                            <a href="{{route('dashboard.sub-categories',[$category->url])}}" class="btn btn-success btn-sm me-2">
                                            <i class="fas fa-file"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $categories->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
