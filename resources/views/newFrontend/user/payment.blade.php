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
        }

        .alert {
            border-radius: 5px;
        }

        #card-details-page {
            display: none;
        }

        .text-success {
            color: #28a745;
            font-weight: bold;
        }

        .text-muted {
            color: #6c757d;
            text-decoration: line-through;
        }

        .discount-info {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
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
    <script src="https://sandboxipgsdk.payable.lk/sdk/v4/payable-checkout.js"></script>

    <div class="container mt-5">
        <div class="payment-container mb-4" id="main-payment-content">
            <h2 class="mb-4 text-center">Complete Your Payment</h2>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Package Details -->
            <div class="card mb-4">

                @if (!empty($membershipData))
                    {{-- Set 1 --}}
                    <p><strong>Price:</strong> Rs {{ number_format($price, 2) }}</p>
                    <p><strong>Valid months:</strong> {{ $membershipData['valid_month'] }}</p>
                    <p><strong>Ads / month:</strong> {{ $membershipData['ads_per_month'] }}</p>
                    <p><strong>Promotion voucher cost:</strong>
                        Rs {{ number_format($membershipData['promotion_voucher_cost'], 2) }}
                    </p>
                @else
                    {{-- Set 2 --}}
                    <div class="card-body">
                        <h4>Package Details</h4>
                        <p><strong>Package Name:</strong> {{ $selectedPackageName }}</p>
                        <p><strong>Package Duration:</strong> {{ $selectedPackageDuration }}
                            {{ $selectedPackageDuration > 1 ? 'days' : 'day' }}
                        </p>

                        <div id="pricing-section">
                            <p><strong>Package Price:</strong>
                                <span id="original-price">LKR {{ number_format($selectedPackagePrice, 2) }}</span>
                            </p>

                            <div id="discount-display" style="display: none;">
                                <div class="discount-info">
                                    <p class="mb-1"><strong>Original Price:</strong>
                                        <span class="text-muted">LKR {{ number_format($selectedPackagePrice, 2) }}</span>
                                    </p>

                                    <p class="mb-1"><strong>Voucher Limit:</strong>
                                        <span class="text-danger" id="discount-amount">-</span>
                                    </p>

                                    <p class="mb-0"><strong>Final Price:</strong>
                                        <span class="text-success" id="final-price-display">
                                            LKR {{ number_format($selectedPackagePrice, 2) }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endif

            </div>


            <!-- Billing / Voucher Section -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Enter Billing Details</h4>

                    @if (empty($membershipData))
                        @if ($activeMembership && $activeMembership->promotion_voucher_cost >= $selectedPackagePrice)
                            <!-- Voucher field -->
                            <label for="voucher_code">Voucher Code</label>
                            <input type="text" class="form-control mb-3" id="voucher_code"
                                placeholder="Enter your voucher code">
                            <p id="voucher-status" class="mt-2" style="display:none;"></p>
                        @else
                            <!-- Normal billing fields -->
                            <input type="hidden" name="return_url" id="return_url"
                                value="{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}">

                            <label for="billing_street">Billing Address Street
                                <span style="color:red; font-size:18px;">*</span>
                            </label>
                            <input class="form-control" type="text" name="billing_street" id="billing_street">

                            <label for="billing_city">Billing Address City
                                <span style="color:red; font-size:18px;">*</span>
                            </label>
                            <input class="form-control" type="text" name="billing_city" id="billing_city">

                            <label for="billing_country">Billing Address Country
                                <span style="color:red; font-size:18px;">*</span>
                            </label>
                            <input class="form-control" type="text" name="billing_country" id="billing_country"
                                value="LKA" readonly>
                        @endif
                    @else
                        <!-- Normal billing fields -->
                        <input type="hidden" name="return_url" id="return_url"
                            value="{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}">

                        <label for="billing_street">Billing Address Street
                            <span style="color:red; font-size:18px;">*</span>
                        </label>
                        <input class="form-control" type="text" name="billing_street" id="billing_street">

                        <label for="billing_city">Billing Address City
                            <span style="color:red; font-size:18px;">*</span>
                        </label>
                        <input class="form-control" type="text" name="billing_city" id="billing_city">

                        <label for="billing_country">Billing Address Country
                            <span style="color:red; font-size:18px;">*</span>
                        </label>
                        <input class="form-control" type="text" name="billing_country" id="billing_country"
                            value="LKA" readonly>
                    @endif

                </div>
            </div>



            <!-- Pay Now Button -->
            <button onclick="returnForm()" type="button" id="payNowBtn"
                class="btn btn-success w-100 d-flex justify-content-center align-items-center">

                <span id="payNowText">
                    Pay Now - LKR
                    <span id="button-price">
                        @if (!empty($membershipData))
                            {{ number_format($price, 2) }}
                        @else
                            {{ number_format($selectedPackagePrice, 2) }}
                        @endif
                    </span>
                </span>

                <div id="btnSpinner" class="ms-2 spinner-border spinner-border-sm text-light" role="status"
                    style="display: none;">
                </div>
            </button>

        </div>

        <!-- Card Details Page (Hidden initially) -->
        <div class="payment-container mb-4" id="card-details-page">
            <h2 class="mb-4 text-center">Enter Card Details</h2>
            <div class="card mb-4">
                <div class="card-body">
                    <h4>Package Price</h4>
                    <p>
                        <strong>Total Amount:</strong>
                        <span class="text-success">
                            LKR
                            @if (!empty($membershipData))
                                {{ number_format($price, 2) }}
                            @else
                                {{ number_format($selectedPackagePrice, 2) }}
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <script>
        let finalPrice = parseFloat({{ !empty($membershipData) ? $price : $selectedPackagePrice }});

        @if (empty($membershipData))
            @if ($activeMembership)
                // Voucher handling
                document.getElementById('voucher_code').addEventListener('input', function() {
                    const enteredCode = this.value.trim();
                    const validCode = "{{ $activeMembership->voucher_code }}";
                    const discount = parseFloat({{ $activeMembership->promotion_voucher_cost }});
                    const originalPrice = parseFloat({{ $selectedPackagePrice }});

                    const discountDisplay = document.getElementById('discount-display');
                    const discountAmountEl = document.getElementById('discount-amount');
                    const finalPriceEl = document.getElementById('final-price-display');
                    const buttonPrice = document.getElementById('button-price');

                    if (enteredCode && enteredCode === validCode) {
                        finalPrice = originalPrice - discount;
                        if (finalPrice < 0) finalPrice = 0;

                        // Show discount section
                        discountDisplay.style.display = 'block';
                        discountAmountEl.textContent = "LKR " + finalPrice.toFixed(2);
                        finalPriceEl.textContent = "LKR " + finalPrice.toFixed(2);

                        // Update button price
                        buttonPrice.textContent = finalPrice.toFixed(2);

                    } else {
                        finalPrice = originalPrice;

                        // Hide discount section
                        discountDisplay.style.display = 'none';

                        // Reset button price
                        buttonPrice.textContent = originalPrice.toFixed(2);
                    }
                });
            @endif
        @endif


        function returnForm() {
            @if (empty($membershipData))
                @if (!$activeMembership)
                    // Only validate billing if no membership
                    const billingStreet = document.getElementById('billing_street').value.trim();
                    const billingCity = document.getElementById('billing_city').value.trim();
                    const billingCountry = document.getElementById('billing_country').value.trim();

                    if (!billingStreet || !billingCity || !billingCountry) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Missing Billing Information',
                            text: 'Please fill in all required billing details.',
                        });
                        return;
                    }
                @endif


                // Show spinner & disable button
                document.getElementById('btnSpinner').style.display = 'inline-block';
                document.getElementById('payNowBtn').disabled = true;

                // Ensure finalPrice is a proper number with 2 decimals
                const paymentAmount = parseFloat(finalPrice.toFixed(2));

                // If final price is zero, skip payment gateway
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
                                    ...{!! json_encode($adData) !!},
                                    user_id: "{{ auth()->id() }}",
                                    voucher_amount: (paymentAmount === 0 ?
                                        {{ $activeMembership->promotion_voucher_cost ?? 0 }} : 0),
                                }
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = "{{ route('user.my_ads') }}";
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || "Something went wrong!"
                                });
                                // Re-enable button if error
                                document.getElementById('btnSpinner').style.display = 'none';
                                document.getElementById('payNowBtn').disabled = false;
                                document.getElementById('payNowText').textContent = "Pay Now - LKR " + paymentAmount
                                    .toFixed(2);
                            }
                        })
                        .catch(() => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: "Request failed. Please try again!"
                            });
                            // Re-enable button if error
                            document.getElementById('btnSpinner').style.display = 'none';
                            document.getElementById('payNowBtn').disabled = false;
                            document.getElementById('payNowText').textContent = "Pay Now - LKR " + paymentAmount
                                .toFixed(2);
                        });

                    return; // Stop further execution
                }
            @endif
            // Else → go through normal payment gateway
            document.getElementById('payNowText').textContent = "Processing...";

            const payment = {
                logoUrl: "{{ config('ipg.logo-url') }}",
                returnUrl: "{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}",
                checkValue: "{{ session('checkValue') }}",
                orderDescription: "Payment for Yaka",
                invoiceId: "{{ session('invoiceId') }}",
                merchantKey: "{{ config('ipg.merchant-key') }}",

                customerFirstName: "{{ auth()->user()->first_name }}",
                customerLastName: "{{ auth()->user()->last_name }}",
                customerMobilePhone: "{{ auth()->user()->phone_number }}",
                customerEmail: "{{ auth()->user()->email }}",

                // Billing details depend on membershipData
                billingAddressStreet: @if (!empty($membershipData))
                    "N/A"
                @else
                    billingStreet
                @endif ,

                billingAddressCity: @if (!empty($membershipData))
                    "N/A"
                @else
                    billingCity
                @endif ,

                billingAddressCountry: @if (!empty($membershipData))
                    "LKA"
                @else
                    billingCountry
                @endif ,

                amount: paymentAmount.toFixed(2), // 2 decimals
                currencyCode: "LKR",
                paymentType: "1",
                notifyUrl: "{{ config('ipg.notify-url') }}"
            };


            payablePayment(payment);
        }
    </script>
@endsection
