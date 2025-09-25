@extends ('newAdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Free Ads Limit</h2>
        </div>
        <div>
            <a href="{{ route('dashboard.limit.create') }}" class="btn btn-primary btn-sm rounded">Create New Package</a>
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
                                    <th>Ads Limit</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adsLimitations as $adsLimitation)
                                    <tr>
                                        <td>{{ $adsLimitation->id }}</td>
                                        <td>{{ $adsLimitation->limit }}</td>
                                        <td>{{ $adsLimitation->name }}</td>
                                        <td>
                                            @if ($adsLimitation->status == 1)
                                                <span class="btn btn-inverse-success btn-fw">Active</span>
                                            @else
                                                <span class="btn btn-inverse-danger btn-fw">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="template-demo d-flex  flex-nowrap">
                                                <a href="{{ route('dashboard.limit.edit', [$adsLimitation->id]) }}"
                                                    class="btn btn-warning btn-sm me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('dashboard.limit.delete', $adsLimitation->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm me-2"
                                                        onclick="return confirm('Are you sure you want to delete this?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

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
