@extends ('newFrontend.master')

@section('content')
<section class="page-title style-two banner-part"
        style="background-image: url('{{ asset('assets/images/background/page-title.jpg') }}'); height:350px">
    <div class="auto-container">
        <div class="mr-0 content-box centred">
            <div class="title">
                <h1>@lang('messages.membership') @lang('messages.payment')</h1>
            </div>
            <ul class="clearfix bread-crumb">
                <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                <li>@lang('messages.membership payment')</li>
            </ul>
        </div>
    </div>
</section>

<section class="dashboard-part mt-4 mb-4">
    <div class="container">
        <div class="card shadow-sm p-4">
            <h3 class="mb-3">@lang('messages.membership payment')</h3>

            <p><strong>@lang('messages.price'):</strong> Rs {{ number_format($price, 2) }}</p>
            <p><strong>@lang('messages.valid month'):</strong> {{ $membershipData['valid_month'] }}</p>
            <p><strong>@lang('messages.ads per month'):</strong> {{ $membershipData['ads_per_month'] }}</p>
            <p><strong>@lang('messages.promotion voucher cost'):</strong> Rs {{ number_format($membershipData['promotion_voucher_cost'], 2) }}</p>

            <button id="payNowBtn" class="theme-btn-one">
                @lang('messages.pay now')
            </button>
        </div>
    </div>
</section>

<script src="https://cdn.payable.lk/payable-v2.0.0.min.js"></script>
<script>
    document.getElementById('payNowBtn').addEventListener('click', function () {
        PayableCheckout.open({
            amount: {{ $price }},
            currency: "LKR",
            invoice_id: "{{ $invoiceId }}",
            check_value: "{{ $checkValue }}",
            customer: {
                name: "{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}",
                email: "{{ Auth::user()->email }}",
                phone: "{{ Auth::user()->phone_number }}"
            },
            redirect_url: "{{ route('payment.checking', ['invId' => $invoiceId]) }}"
        });
    });
</script>
@endsection
