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
            display: none;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://sandboxipgsdk.payable.lk/sdk/v4/payable-checkout.js"></script>

    <section class="dashboard-part mt-4 mb-4">
        <div class="container">
            <div class="payment-container">
                <h3 class="mb-4 text-center">Membership Payment</h3>


                <div class="card mb-4">
                    <div class="card-body">
                        <p><strong>Price:</strong> Rs {{ number_format($price, 2) }}</p>
                        <p><strong>Valid months:</strong> {{ $membershipData['valid_month'] ?? '-' }}</p>
                        <p><strong>Ads / month:</strong> {{ $membershipData['ads_per_month'] ?? '-' }}</p>
                        <p><strong>Promotion voucher cost:</strong> Rs
                            {{ number_format($membershipData['promotion_voucher_cost'] ?? 0, 2) }}</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        {{-- Use same return_url pattern as ad flow --}}
                        <input type="hidden" name="return_url" id="return_url"
                            value="{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}">

                            <label for="billing_street">Billing Address Street <span style="color:red;">*</span></label>
                            <input class="form-control" type="text" id="billing_street"
                                placeholder="Enter street address">

                            <label for="billing_city">Billing Address City <span style="color:red;">*</span></label>
                            <input class="form-control" type="text" id="billing_city" placeholder="Enter city">

                            <label for="billing_country">Billing Address Country <span style="color:red;">*</span></label>
                            <input class="form-control" type="text" id="billing_country" value="LKA" readonly>

                    </div>
                </div>

                <button id="payNowBtn" type="button"
                    class="btn btn-success w-100 d-flex justify-content-center align-items-center">
                    <span id="payNowText">Pay Now - Rs <span id="button-price">{{ number_format($price, 2) }}</span></span>
                    <div id="btnSpinner" class="ms-2 spinner-border spinner-border-sm text-light" role="status"></div>
                </button>
            </div>
        </div>
    </section>

    <script>

        // keep finalPrice consistent with ad flow
        let finalPrice = parseFloat({{ $price }});

        document.getElementById('payNowBtn').addEventListener('click', function() {

            const billingStreet = document.getElementById('billing_street').value.trim();
            const billingCity = document.getElementById('billing_city').value.trim();
            const billingCountry = document.getElementById('billing_country').value.trim();

            console.log(billingStreet, billingCity, billingCountry, finalPrice);


            if (!billingStreet || !billingCity || !billingCountry) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Information',
                    text: 'Please fill in all required billing details.'
                });
                return;
            }

            document.getElementById('btnSpinner').style.display = 'inline-block';
            document.getElementById('payNowBtn').disabled = true;

            const paymentAmount = parseFloat(finalPrice.toFixed(2));

            if (paymentAmount === 0) {
                document.getElementById('payNowText').textContent = "Completing...";
                fetch("{{ route('payment.free.complete') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            invoiceId: "{{ $invoiceId }}",
                            adData: {
                                ...{!! json_encode($membershipData) !!},
                                user_id: "{{ auth()->id() }}",
                                voucher_amount: (paymentAmount === 0 ?
                                    {{ $membershipData['promotion_voucher_cost'] ?? 0 }} : 0),
                            }
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = "{{ route('membership-package') }}";
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || "Something went wrong!"
                            });
                            document.getElementById('btnSpinner').style.display = 'none';
                            document.getElementById('payNowBtn').disabled = false;
                            document.getElementById('payNowText').textContent = "Pay Now - Rs " + paymentAmount
                                .toFixed(2);
                        }
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Request failed. Please try again!"
                        });
                        document.getElementById('btnSpinner').style.display = 'none';
                        document.getElementById('payNowBtn').disabled = false;
                        document.getElementById('payNowText').textContent = "Pay Now - Rs " + paymentAmount
                            .toFixed(2);
                    });
                return;
            }

            document.getElementById('payNowText').textContent = 'Processing...';

            const payment = {
                logoUrl: "{{ config('ipg.logo-url') }}",
                returnUrl: "{{ config('ipg.base_url') }}/payment/checking?invId={{ $invoiceId }}",
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
                billingAddressCountry: "LKA",
                amount: paymentAmount.toFixed(2),
                currencyCode: "LKR",
                paymentType: "1",
                notifyUrl: "{{ config('ipg.notify-url-membership') }}"
            };

            console.log(payment);


            console.log('=== Payment Data Being Sent ===');
            console.log('Invoice ID:', payment.invoiceId);
            console.log('Check Value:', payment.checkValue);
            console.log('Merchant Key:', payment.merchantKey);
            console.log('Amount:', payment.amount);
            console.log('Full Payment Object:', payment);
            console.log('================================');

            payablePayment(payment);
        });
    </script>
@endsection
