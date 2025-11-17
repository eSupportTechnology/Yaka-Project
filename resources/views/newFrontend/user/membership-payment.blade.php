@extends ('newFrontend.master')

@section('content')
    <style>
        .payment-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        #btnSpinner {
            width: 18px;
            height: 18px;
            border: 2px solid #ffffff;
            border-top: 2px solid #28a745;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            <div class="payment-container">
                <h3 class="mb-4 text-center">@lang('messages.membership payment')</h3>

                {{-- Membership Information --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>@lang('messages.price'):</strong> Rs {{ number_format($price, 2) }}</p>
                        <p><strong>@lang('messages.valid month'):</strong> {{ $membershipData['valid_month'] }}</p>
                        <p><strong>@lang('messages.ads per month'):</strong> {{ $membershipData['ads_per_month'] }}</p>
                        <p><strong>@lang('messages.promotion voucher cost'):</strong> Rs {{ number_format($membershipData['promotion_voucher_cost'], 2) }}</p>
                    </div>
                </div>

                {{-- Billing Form --}}
                <div class="card mb-4">
                    <div class="card-body">

                        <input type="hidden" name="return_url" id="return_url"
                               value="{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}">

                        <label for="billing_street">@lang('messages.billing address street')<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" id="billing_street" placeholder="Enter street address">

                        <label for="billing_city">@lang('messages.billing address city')<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" id="billing_city" placeholder="Enter city">

                        <label for="billing_country">@lang('messages.billing address country')<span style="color:red;">*</span></label>
                        <input class="form-control" type="text" id="billing_country" value="LKA" readonly>
                    </div>
                </div>

                {{-- Button --}}
                <button id="payNowBtn" type="button"
                        class="btn btn-success w-100 d-flex justify-content-center align-items-center">
                    <span id="payNowText">
                        @lang('messages.pay now') - Rs {{ number_format($price, 2) }}
                    </span>
                    <div id="btnSpinner" class="ms-2 spinner-border spinner-border-sm text-light"
                         style="display: none;"></div>
                </button>
            </div>
        </div>
    </section>

    {{-- Payable.lk JS --}}
    <script src="https://sandboxipgsdk.payable.lk/sdk/v4/payable-checkout.js"></script>

    <script>
        document.getElementById('payNowBtn').addEventListener('click', function () {

            const billingStreet = document.getElementById('billing_street').value.trim();
            const billingCity = document.getElementById('billing_city').value.trim();
            const billingCountry = document.getElementById('billing_country').value.trim();

            if (!billingStreet || !billingCity || !billingCountry) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Information',
                    text: 'Please fill in all required billing details.',
                });
                return;
            }

            // Button Loading UI
            document.getElementById('btnSpinner').style.display = 'inline-block';
            document.getElementById('payNowBtn').disabled = true;
            document.getElementById('payNowText').textContent = 'Processing...';

            const paymentAmount = parseFloat({{ $price }}).toFixed(2);

            const payment = {
                logoUrl: "{{ config('ipg.logo-url') }}",
                returnUrl: "{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}",
                checkValue: "{{ $checkValue }}",
                orderDescription: "Membership Payment for Yaka",
                invoiceId: "{{ $invoiceId }}",
                merchantKey: "{{ config('ipg.merchant-key') }}",
                customerFirstName: "{{ auth()->user()->first_name }}",
                customerLastName: "{{ auth()->user()->last_name }}",
                customerMobilePhone: "{{ auth()->user()->phone_number }}",
                customerEmail: "{{ auth()->user()->email }}",
                billingAddressStreet: billingStreet,
                billingAddressCity: billingCity,
                billingAddressCountry: billingCountry,
                amount: paymentAmount,
                currencyCode: "LKR",
                paymentType: "1",
                notifyUrl: "{{ config('ipg.notify-url') }}"
            };

            payablePayment(payment);
        });
    </script>

@endsection
