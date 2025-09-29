@extends ('newAdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Purchased Membership </h2>
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
                                    <th>User</th>
                                    <th>Start Date</th>
                                    <th>Expiry Date</th>
                                    <th>Ads per Month</th>
                                    <th>Voucher Code</th>
                                    <th>Price</th>
                                    <th>Promotion Voucher Cost</th>
                                    <th>Valid Month</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($plans as $plan)
                                    <tr>
                                        <td>{{ $plan->id }}</td>
                                        <td>{{ $plan->user->first_name }} {{ $plan->user->last_name }}</td>
                                        <td>{{ $plan->start_date }}</td>
                                        <td>{{ $plan->expiry_date }}</td>
                                        <td>{{ $plan->ads_per_month }}</td>
                                        <td>{{ $plan->voucher_code }}</td>
                                        <td>Rs.{{ number_format($plan->price, 2) }}</td>
                                        <td>Rs.{{ number_format($plan->promotion_voucher_cost, 2) }}</td>
                                        <td>{{ $plan->valid_month }}</td>
                                        <td>
                                            <div class="template-demo d-flex flex-nowrap">
                                                <a href="{{ route('membership-plans.purchase_view', [$plan->user_id]) }}"
                                                    class="btn btn-view btn-sm me-2">
                                                    <i class="fas fa-eye"></i>
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
