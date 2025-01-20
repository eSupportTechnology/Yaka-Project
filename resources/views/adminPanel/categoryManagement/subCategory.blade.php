@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <h4 style="margin-bottom: 20px" class="card-title">{{$maincategory->name}}' Sub Category List   </h4>
                        {{-- <a href="{{route('dashboard.sub-categories.create',[$maincategory->url])}}" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Create New Sub Category</a>  --}}
                        <a href="{{route('dashboard.categories')}}" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Main Categories</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>url</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>


                                
                            @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->url }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>
                                        @if($subcategory->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            <a href="{{route('dashboard.sub-categories.view',[$subcategory->url])}}"  class="btn btn-primary">
                                                View <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                            </a>
                                            {{-- <a  href="{{route('dashboard.sub-categories.update',[$subcategory->url])}}" class="btn btn-primary">
                                                Update<!-- Assuming you want to use an "Update" icon, change "ti-world" to the appropriate icon class -->
                                            </a>
                                            <a href="{{route('dashboard.sub-categories.delete',[$subcategory->url])}}"  type="button" class="btn btn-primary">
                                                Delete<!-- Assuming you want to use a "Delete" icon, change "ti-email" to the appropriate icon class -->
                                            </a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $subcategories->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
