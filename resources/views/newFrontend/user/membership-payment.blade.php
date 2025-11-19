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

                        @php
                            $hasVoucher =
                                isset($membershipData['promotion_voucher_cost']) &&
                                (float) $membershipData['promotion_voucher_cost'] > 0;
                        @endphp

                        @if ($hasVoucher && (float) $membershipData['promotion_voucher_cost'] >= (float) $price)
                            <label for="voucher_code">Voucher Code</label>
                            <input type="text" class="form-control" id="voucher_code"
                                placeholder="Enter your voucher code">
                            <p id="voucher-status" class="mt-2" style="display:none;"></p>

                            <div id="discount-display" style="display:none;" class="mt-2">
                                <div class="card p-2">
                                    <p class="mb-1"><strong>Original Price:</strong> <span class="text-muted">Rs
                                            {{ number_format($price, 2) }}</span></p>
                                    <p class="mb-1"><strong>Voucher Amount:</strong> <span id="discount-amount">-</span>
                                    </p>
                                    <p class="mb-0"><strong>Final Price:</strong> Rs <span
                                            id="final-price-display">{{ number_format($price, 2) }}</span></p>
                                </div>
                            </div>
                        @else
                            <label for="billing_street">Billing Address Street <span style="color:red;">*</span></label>
                            <input class="form-control" type="text" id="billing_street"
                                placeholder="Enter street address">

                            <label for="billing_city">Billing Address City <span style="color:red;">*</span></label>
                            <input class="form-control" type="text" id="billing_city" placeholder="Enter city">

                            <label for="billing_country">Billing Address Country <span style="color:red;">*</span></label>
                            <input class="form-control" type="text" id="billing_country" value="LKA" readonly>
                        @endif

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

        @if ($hasVoucher)
            document.getElementById('voucher_code').addEventListener('input', function() {
                const enteredCode = this.value.trim();
                const validCode = "{{ $membershipData['voucher_code'] ?? '' }}";
                const discount = parseFloat({{ $membershipData['promotion_voucher_cost'] ?? 0 }});
                const originalPrice = parseFloat({{ $price }});

                const discountDisplay = document.getElementById('discount-display');
                const discountAmountEl = document.getElementById('discount-amount');
                const finalPriceEl = document.getElementById('final-price-display');
                const buttonPrice = document.getElementById('button-price');

                if (enteredCode && enteredCode === validCode) {
                    finalPrice = originalPrice - discount;
                    if (finalPrice < 0) finalPrice = 0;

                    discountDisplay.style.display = 'block';
                    discountAmountEl.textContent = "Rs " + discount.toFixed(2);
                    finalPriceEl.textContent = finalPrice.toFixed(2);
                    buttonPrice.textContent = finalPrice.toFixed(2);
                } else {
                    finalPrice = originalPrice;
                    discountDisplay.style.display = 'none';
                    buttonPrice.textContent = originalPrice.toFixed(2);
                }
            });
        @endif

        document.getElementById('payNowBtn').addEventListener('click', function() {
            @if (!$hasVoucher)
                const billingStreet = document.getElementById('billing_street').value.trim();
                const billingCity = document.getElementById('billing_city').value.trim();
                const billingCountry = document.getElementById('billing_country').value.trim();

                if (!billingStreet || !billingCity || !billingCountry) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Information',
                        text: 'Please fill in all required billing details.'
                    });
                    return;
                }
            @endif

            // show spinner + disable
            document.getElementById('btnSpinner').style.display = 'inline-block';
            document.getElementById('payNowBtn').disabled = true;


            const paymentAmount = parseFloat(finalPrice.toFixed(2));

            // if zero -> call free-complete endpoint (mirror ad behavior)
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
                            window.location.href = "{{ route('membership-package')}}";
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

            // Normal IPG flow — payload shaped the same as ad-payment
            const payment = {
                logoUrl: "{{ config('ipg.logo-url') }}",
                returnUrl: "{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}",
                checkValue: "{{ session('checkValue') }}",
                orderDescription: "Membership Payment for Yaka",
                invoiceId: "{{ session('invoiceId') }}",
                merchantKey: "{{ config('ipg.merchant-key') }}",
                customerFirstName: "{{ auth()->user()->first_name }}",
                customerLastName: "{{ auth()->user()->last_name }}",
                customerMobilePhone: "{{ auth()->user()->phone_number }}",
                customerEmail: "{{ auth()->user()->email }}",
                billingAddressStreet: @if ($hasVoucher)
                    "N/A"
                @else
                    billingStreet
                @endif ,
                billingAddressCity: @if ($hasVoucher)
                    "N/A"
                @else
                    billingCity
                @endif ,
                billingAddressCountry: @if ($hasVoucher)
                    "LKA"
                @else
                    billingCountry
                @endif ,
                amount: paymentAmount.toFixed(2),
                currencyCode: "LKR",
                paymentType: "1",
                notifyUrl: "{{ config('ipg.notify-url') }}"
            };

            // call the same helper that your ad flow uses
            payablePayment(payment);
        });
    </script>
@endsection
