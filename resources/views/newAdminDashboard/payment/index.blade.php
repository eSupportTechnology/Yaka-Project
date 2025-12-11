@extends ('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Payment List</h2>
    </div>
</div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Check Value</th>
                                <th>Invoice ID</th>
                                <th>Payment for</th>
                                <th>Payment status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="userTableBody">
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->check_value }}</td>
                                    <td>{{ $payment->invoice_id }}</td>
                                    <td>{{ $payment->payment_for }}</td>
                                    <td>{{ $payment->payment_status }}</td>
                                    <td>{{ $payment->status ?? 'N/A' }}</td>
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
