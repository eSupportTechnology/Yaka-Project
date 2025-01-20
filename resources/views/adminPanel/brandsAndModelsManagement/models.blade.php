@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <h4 style="margin-bottom: 20px" class="card-title">{{$brand->name}}' Sub models List   <a href="{{route('dashboard.configuration.models.create',[$brand->url])}}" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Create New Model</a> <a href="{{route('dashboard.configuration.brands-and-models')}}" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Brands</a></h4>
                      
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
                            @foreach($models as $model)
                                <tr>
                                    <td>{{ $model->id }}</td>
                                    <td>{{ $model->url }}</td>
                                    <td>{{ $model->name }}</td>
                                    <td>
                                        @if($model->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            <a href="{{route('dashboard.configuration.models.view',[$model->url])}}"  class="btn btn-primary">
                                                View <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                            </a>
                                            <a  href="{{route('dashboard.configuration.models.update',[$model->url])}}" class="btn btn-primary">
                                                Update<!-- Assuming you want to use an "Update" icon, change "ti-world" to the appropriate icon class -->
                                            </a>
                                            {{-- <a href="{{route('dashboard.sub-categories.delete',[$model->url])}}"  type="button" class="btn btn-primary">
                                                Delete<!-- Assuming you want to use a "Delete" icon, change "ti-email" to the appropriate icon class -->
                                            </a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $models->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
