@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Type List</h2>
    </div>
    <div>
        <a href="{{route('dashboard.adsTypes.create')}}" class="btn btn-primary btn-sm rounded">Create New Type</a>
    </div>
</div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        
                        <form action="{{route('dashboard.adsTypes')}}" style="width: 30%; display: flex; align-items: center;">
                            <input name="name" value="{{ $_GET['name'] ?? "" }}" type="search" id="searchInput" class="form-control" placeholder="Type Name Search" title="Search here" style="flex-grow: 1; margin-right: 10px;">
                            <button type="submit" style="width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">
                                Search
                            </button>
                            <a href="{{route('dashboard.adsTypes')}}" style="text-decoration: none;margin-left: 10px;width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">Clear</a>
                        </form>
                    </div>
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

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($packageTypes as $packType)
                                <tr>
                                    <td>{{ $packType->id }}</td>
                                    <td>{{ $packType->url }}</td>
                                    <td>{{ $packType->name }}</td>
                                    <td>{{ $packType->category ? $packType->category->name : 'N/A' }}</td>
                                    <td>
                                        @if($packType->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            

                                        {{-- <a href="{{route('dashboard.adsTypes.view',[$packType->url])}}" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                            </a>--}}
                                            <a href="{{route('dashboard.adsTypes.update',[$packType->url])}}" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{route('dashboard.adsTypes.delete',[$packType->url])}}" class="btn btn-danger btn-sm me-2">
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
