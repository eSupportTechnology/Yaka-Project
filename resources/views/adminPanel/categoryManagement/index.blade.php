@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <h4 style="margin-bottom: 20px" class="card-title">Category List    </h4>
                        {{-- <a href="{{route('dashboard.categories.create')}}" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Create New Category</a> --}}
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>url</th>
                                <th>Name</th>
                                <th>Free Ads Count</th>
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
                                        @if($category->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            <a href="{{route('dashboard.categories.view',[$category->url])}}"  class="btn btn-primary">
                                                View <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                            </a>
                                            <a  href="{{route('dashboard.categories.update',[$category->url])}}" class="btn btn-primary">
                                                Update<!-- Assuming you want to use an "Update" icon, change "ti-world" to the appropriate icon class -->
                                            </a>
                                            {{-- <a href="{{route('dashboard.categories.delete',[$category->url])}}"  type="button" class="btn btn-primary">
                                                Delete<!-- Assuming you want to use a "Delete" icon, change "ti-email" to the appropriate icon class -->
                                            </a> --}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                                            <a href="{{route('dashboard.sub-categories',[$category->url])}}"  type="button" class="btn btn-primary">
                                                Manage<!-- Assuming you want to use a "Delete" icon, change "ti-email" to the appropriate icon class -->
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
