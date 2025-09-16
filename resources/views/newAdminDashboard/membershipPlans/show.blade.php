@extends('newAdminDashboard.master')

@section('content')
<div class="content-header">
    <h2 class="content-title">Membership Plan Details</h2>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div id="planDetails">
                    <div class="mb-3">
                        <label for="month_count" class="form-label">Month Count</label>
                        <input type="number" id="month_count" name="month_count" value="{{ $plan->month_count }}" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="ads_per_month" class="form-label">Ads per Month</label>
                        <input type="number" id="ads_per_month" name="ads_per_month" value="{{ $plan->ads_per_month }}" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price (Rs)</label>
                        <input type="number" step="0.01" id="price" name="price" value="{{ $plan->price }}" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="valid_month" class="form-label">Valid Month</label>
                        <input type="number" id="valid_month" name="valid_month" value="{{ $plan->valid_month }}" class="form-control" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="promotion_voucher_cost" class="form-label">Voucher Cost</label>
                        <input type="number" step="0.01" id="promotion_voucher_cost" name="promotion_voucher_cost" value="{{ $plan->promotion_voucher_cost }}" class="form-control" readonly>
                    </div>
                </div>
                <a href="{{ route('membership-plans') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
