@extends ('newAdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Membership Plans</h2>
        </div>
        <div>
            <a href="{{ route('membership-plans.create') }}" class="btn btn-primary btn-sm rounded">
                Create Membership Plans
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
                                    <th>Months</th>
                                    <th>Ads per Month</th>
                                    <th>Price</th>
                                    <th>Valid Month</th>
                                    <th>Voucher Cost</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->id }}</td>
                                        <td>{{ $plan->month_count }}</td>
                                        <td>{{ $plan->ads_per_month }}</td>
                                        <td>${{ number_format($plan->price, 2) }}</td>
                                        <td>{{ $plan->valid_month }}</td>
                                        <td>${{ number_format($plan->promotion_voucher_cost, 2) }}</td>
                                        <td>
                                            <div class="template-demo d-flex flex-nowrap">
                                                <a href="{{ route('membership-plans.show', [$plan->id]) }}"
                                                    class="btn btn-view btn-sm me-2">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('membership-plans.edit', $plan->id) }}"
                                                    class="btn btn-warning btn-sm me-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('membership-plans.destroy', $plan->id) }}"
                                                    class="btn btn-danger btn-sm me-2">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
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
