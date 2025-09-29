@extends ('newAdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Purchased Memberships of {{ $user->first_name }} {{ $user->last_name }}</h2>
        </div>
        <div>
            <a href="{{ route('membership-plans.purchase') }}" class="btn btn-primary btn-sm rounded">
                Back to Purchased Membership
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="plans-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Package Date</th>
                                    <th>Used Ads per Month</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->id }}</td>
                                        <td>{{ $plan->year }}-{{ $plan->month }}</td>
                                        <td>{{ $plan->ads_used }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">
                                            No Membership Usage Found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
