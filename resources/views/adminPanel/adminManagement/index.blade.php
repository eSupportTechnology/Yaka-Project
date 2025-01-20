@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <h4 style="margin-bottom: 20px" class="card-title">Admin List   <a href="{{route('dashboard.admins.create')}}" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Create Admin</a> </h4>                      
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Url</th>
                                <th>Email</th>
                                {{-- <th>Status</th> --}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="userTableBody">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->url }}</td>
                                    <td>{{ $user->email }}</td>
                                    {{-- <td>
                                        @if($user->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td> --}}
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            <a href="{{route('dashboard.admins.view',[$user->id])}}" class="btn btn-primary">
                                                View <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                            </a>
                                            <a href="{{route('dashboard.admins.update',[$user->id])}}" class="btn btn-primary">
                                                Update<!-- Assuming you want to use an "Update" icon, change "ti-world" to the appropriate icon class -->
                                            </a>
                                            <a href="{{route('dashboard.admins.delete',[$user->id])}}" class="btn btn-primary">
                                                Delete<!-- Assuming you want to use a "Delete" icon, change "ti-email" to the appropriate icon class -->
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


























{{--@extends('adminPanel.layout.layout')--}}

{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-12 grid-margin stretch-card">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div style="display: flex;justify-content: space-between">--}}
{{--                        <h4 style="margin-bottom: 20px" class="card-title">Admin List   <a href="{{route('dashboard.admins.create')}}" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Cteate Admin</a> </h4>--}}
{{--                        <form style="width: 30%;display: flex;align-items: center" class="search-form" action="#">--}}
{{--                            <i style="margin-right: 5px" class="icon-search"></i>--}}
{{--                            <input type="search" class="form-control" placeholder="Search Here" title="Search here">--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>Id</th>--}}
{{--                                <th>Frist Name</th>--}}
{{--                                <th>Last Name</th>--}}
{{--                                <th>Url</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th>Status</th>--}}
{{--                                <th>Action</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($users as $user)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $user->id }}</td>--}}
{{--                                    <td>{{ $user->first_name }}</td>--}}
{{--                                    <td>{{ $user->last_name }}</td>--}}
{{--                                    <td>{{ $user->url }}</td>--}}
{{--                                    <td>{{ $user->email }}</td>--}}
{{--                                    <td>--}}
{{--                                        @if($user->status == 1)--}}
{{--                                            <span  class="btn btn-inverse-success btn-fw">Active</span>--}}
{{--                                        @else--}}
{{--                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        <div class="template-demo d-flex justify-content-between flex-nowrap">--}}
{{--                                            <button style="color: white;padding: 8px 20px;background: #625c5c;border: none;" type="button" class="btn btn-primary btn-rounded btn-icon">--}}
{{--                                                View <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->--}}
{{--                                            </button>--}}
{{--                                            <button style="color: white;padding: 8px;background: #625c5c;border: none;" type="button" class="btn btn-dark btn-rounded btn-icon">--}}
{{--                                                Update<!-- Assuming you want to use an "Update" icon, change "ti-world" to the appropriate icon class -->--}}
{{--                                            </button>--}}
{{--                                            <button style="color: white;padding: 8px;background: #625c5c;border: none;" type="button" class="btn btn-danger btn-rounded btn-icon">--}}
{{--                                                Delete<!-- Assuming you want to use a "Delete" icon, change "ti-email" to the appropriate icon class -->--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        {{ $users->links('pagination::bootstrap-5') }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
