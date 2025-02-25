@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Brands</h2>
    </div>
    <div>
        <a href="{{route('dashboard.configuration.brands-and-models.create')}}" class="btn btn-primary btn-sm rounded">Create New Brands</a>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <form action="{{route('dashboard.configuration.brands-and-models')}}" style="width: 30%; display: flex; align-items: center;">
                            <input name="name" value="{{ $_GET['name'] ?? "" }}" type="search" id="searchInput" class="form-control" placeholder="Brand Name Search" title="Search here" style="flex-grow: 1; margin-right: 10px;">
                            <button type="submit" style="width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">
                                Search
                            </button>
                            <a href="{{route('dashboard.configuration.brands-and-models')}}" style="text-decoration: none;margin-left: 10px;width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">Clear</a>
                        </form>
                    </div>
                    @if (isset($success) && $success)
                        <div class="alert alert-success" role="alert">
                            {{$success}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>url</th>
                                <th>Name</th>
                                <th>Sub Category</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Models</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->url }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>{{ $brand->category->name ?? "" }}</td>
                                    <td>
                                        @if($brand->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                           
                                        {{--  <a href="{{route('dashboard.configuration.brands-and-models.view',[$brand->url])}}" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                            </a>--}}
                                            <a href="{{route('dashboard.configuration.brands-and-models.update',[$brand->url])}}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                             <a href="{{route('dashboard.configuration.brands-and-models.delete',[$brand->url])}}" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                                           
                                            <a href="{{route('dashboard.configuration.models',[$brand->url])}}" class="btn btn-success btn-sm me-2">
                                                <i class="fas fa-file"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $brands->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
