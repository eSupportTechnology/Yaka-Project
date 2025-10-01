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
                <div class="card-body">
                    <h4>{{ isset($paymentType) && $paymentType === 'membership' ? 'Membership' : 'Package' }} Details</h4>
                    <p><strong>Package Name:</strong> {{ $selectedPackageName }}</p>
                    <p><strong>Duration:</strong> {{ $selectedPackageDuration }}</p>

                    @if(isset($paymentType) && $paymentType === 'membership' && isset($membershipData))
                        <p><strong>Ads Per Month:</strong> {{ $membershipData['ads_per_month'] ?? 'N/A' }}</p>
                        <p><strong>Voucher Credit:</strong> LKR {{ number_format($membershipData['promotion_voucher_cost'] ?? 0, 2) }}</p>
                    @endif

                    <div id="pricing-section">
                        <p><strong>Package Price:</strong> <span id="original-price">LKR
                                {{ number_format($selectedPackagePrice, 2) }}</span></p>
                        <div id="discount-display" style="display: none;">
                            <div class="discount-info">
                                <p class="mb-1"><strong>Original Price:</strong> <span class="text-muted">LKR
                                        {{ number_format($selectedPackagePrice, 2) }}</span></p>
                                <p class="mb-1"><strong>Voucher Discount:</strong> <span class="text-danger"
                                                                                         id="discount-amount">-</span></p>
                                <p class="mb-0"><strong>Final Price:</strong> <span class="text-success"
                                                                                    id="final-price-display">LKR {{ number_format($selectedPackagePrice, 2) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    @if (isset($paymentType) && $paymentType === 'ad' && isset($activeMembership) && $activeMembership->promotion_voucher_cost > 0)
                        <h4>Payment Options</h4>
                        <p class="text-muted mb-3">Available voucher balance: LKR {{ number_format($activeMembership->promotion_voucher_cost, 2) }}</p>

                        <div class="mb-3">
                            <label for="voucher_code">Voucher Code (Optional)</label>
                            <input type="text" class="form-control" id="voucher_code"
                                   placeholder="Enter voucher code to get discount">
                            <small class="text-muted">Leave empty to pay full amount via gateway</small>
                        </div>

                        <div id="billing-fields" style="display: none;">
                            <hr class="my-3">
                            <h5>Billing Details</h5>
                            <input type="hidden" name="return_url" id="return_url"
                                   value="{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}">
                            <label for="billing_street">Billing Address Street<span
                                    style="color:red; font-size:18px;">*</span></label>
                            <input class="form-control mb-3" type="text" name="billing_street" id="billing_street">
                            <label for="billing_city">Billing Address City<span
                                    style="color:red; font-size:18px;">*</span></label>
                            <input class="form-control mb-3" type="text" name="billing_city" id="billing_city">
                            <label for="billing_country">Billing Address Country<span
                                    style="color:red; font-size:18px;">*</span></label>
                            <input class="form-control" type="text" name="billing_country" id="billing_country"
                                   value="LKA" readonly>
                        </div>
                    @else
                        <h4>Enter Billing Details</h4>
                        <input type="hidden" name="return_url" id="return_url"
                               value="{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}">
                        <label for="billing_street">Billing Address Street<span
                                style="color:red; font-size:18px;">*</span></label>
                        <input class="form-control mb-3" type="text" name="billing_street" id="billing_street">
                        <label for="billing_city">Billing Address City<span
                                style="color:red; font-size:18px;">*</span></label>
                        <input class="form-control mb-3" type="text" name="billing_city" id="billing_city">
                        <label for="billing_country">Billing Address Country<span
                                style="color:red; font-size:18px;">*</span></label>
                        <input class="form-control" type="text" name="billing_country" id="billing_country"
                               value="LKA" readonly>
                    @endif
                </div>
            </div>

            <button onclick="returnForm()" type="button" id="payNowBtn"
                    class="btn btn-success w-100 d-flex justify-content-center align-items-center">
                <span id="payNowText">Pay Now - LKR <span
                        id="button-price">{{ number_format($selectedPackagePrice, 2) }}</span></span>
                <div id="btnSpinner" class="ms-2 spinner-border spinner-border-sm text-light" role="status"
                     style="display: none;"></div>
            </button>
        </div>
    </div>

    <script>
        let finalPrice = parseFloat({{ $selectedPackagePrice }});
        const paymentType = "{{ $paymentType ?? 'ad' }}";
        let voucherApplied = false;

        @if (isset($paymentType) && $paymentType === 'ad' && isset($activeMembership))
        const voucherInput = document.getElementById('voucher_code');
        const billingFields = document.getElementById('billing-fields');

        voucherInput.addEventListener('input', function() {
            const enteredCode = this.value.trim();
            const validCode = "{{ $activeMembership->voucher_code }}";
            const availableVoucher = parseFloat({{ $activeMembership->promotion_voucher_cost }});
            const originalPrice = parseFloat({{ $selectedPackagePrice }});

            const discountDisplay = document.getElementById('discount-display');
            const discountAmountEl = document.getElementById('discount-amount');
            const finalPriceEl = document.getElementById('final-price-display');
            const buttonPrice = document.getElementById('button-price');

            if (enteredCode && enteredCode === validCode) {
                const discountAmount = Math.min(availableVoucher, originalPrice);
                finalPrice = Math.max(0, originalPrice - discountAmount);
                voucherApplied = true;

                discountDisplay.style.display = 'block';
                discountAmountEl.textContent = "LKR " + discountAmount.toFixed(2);
                finalPriceEl.textContent = "LKR " + finalPrice.toFixed(2);
                buttonPrice.textContent = finalPrice.toFixed(2);

                if (finalPrice > 0) {
                    billingFields.style.display = 'block';
                } else {
                    billingFields.style.display = 'none';
                }
            } else {
                finalPrice = originalPrice;
                voucherApplied = false;
                discountDisplay.style.display = 'none';
                buttonPrice.textContent = originalPrice.toFixed(2);

                billingFields.style.display = 'block';
            }
        });

        billingFields.style.display = 'block';
        @endif

        function returnForm() {
            const needsBilling = @if(isset($paymentType) && $paymentType === 'membership')
                true
                @elseif(isset($activeMembership))
            (finalPrice > 0) // Only need billing if there's remaining amount
            @else
                true
            @endif;

            if (needsBilling && finalPrice > 0) {
                const billingStreet = document.getElementById('billing_street');
                const billingCity = document.getElementById('billing_city');
                const billingCountry = document.getElementById('billing_country');

                if (billingStreet && billingCity && billingCountry) {
                    const street = billingStreet.value.trim();
                    const city = billingCity.value.trim();
                    const country = billingCountry.value.trim();

                    if (!street || !city || !country) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Missing Billing Information',
                            text: 'Please fill in all required billing details.',
                        });
                        return;
                    }
                }
            }

            document.getElementById('btnSpinner').style.display = 'inline-block';
            document.getElementById('payNowBtn').disabled = true;

            const paymentAmount = parseFloat(finalPrice.toFixed(2));
            const originalPrice = parseFloat({{ $selectedPackagePrice }});

            if (paymentAmount === 0 && voucherApplied) {
                document.getElementById('payNowText').textContent = "Completing...";

                const voucherUsed = originalPrice - paymentAmount;

                const requestData = {
                    invoiceId: "{{ $invoiceId }}",
                };

                if (paymentType === 'ad') {
                    requestData.adData = {
                        @if(isset($adData))
                        ...{!! json_encode($adData) !!},
                        @endif
                        user_id: "{{ auth()->id() }}",
                        voucher_amount: voucherUsed,
                        selected_package_price: originalPrice,
                        @if(isset($activeMembership))
                        membership_package_id: "{{ $activeMembership->id }}"
                        @endif
                    };

                    console.log('Free completion request data:', requestData);
                } else {
                    requestData.adData = {};
                }

                fetch("{{ route('payment.free.complete') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(requestData)
                })
                    .then(res => res.json())
                    .then(data => {
                        console.log('Free completion response:', data);
                        if (data.success) {
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else if (paymentType === 'membership') {
                                window.location.href = "{{ route('membership-package') }}";
                            } else {
                                window.location.href = "{{ route('user.my_ads') }}";
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message || "Something went wrong!"
                            });
                            resetButton(paymentAmount);
                        }
                    })
                    .catch((error) => {
                        console.error('Free completion error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "Request failed. Please try again!"
                        });
                        resetButton(paymentAmount);
                    });

                return;
            }

            document.getElementById('payNowText').textContent = "Processing...";

            const billingStreet = needsBilling && document.getElementById('billing_street') ?
                document.getElementById('billing_street').value : "N/A";
            const billingCity = needsBilling && document.getElementById('billing_city') ?
                document.getElementById('billing_city').value : "N/A";
            const billingCountry = needsBilling && document.getElementById('billing_country') ?
                document.getElementById('billing_country').value : "LKA";

            const payment = {
                logoUrl: "{{ config('ipg.logo-url') }}",
                returnUrl: "{{ env('APP_URL') }}/payment/checking?invId={{ $invoiceId }}",
                checkValue: "{{ $checkValue ?? session('checkValue') }}",
                orderDescription: paymentType === 'membership' ? "Membership Package Payment" : "Ad Package Payment",
                invoiceId: "{{ $invoiceId ?? session('invoiceId') }}",
                merchantKey: "{{ config('ipg.merchant-key') }}",
                customerFirstName: "{{ auth()->user()->first_name }}",
                customerLastName: "{{ auth()->user()->last_name }}",
                customerMobilePhone: "{{ auth()->user()->phone_number }}",
                customerEmail: "{{ auth()->user()->email }}",
                billingAddressStreet: billingStreet,
                billingAddressCity: billingCity,
                billingAddressCountry: billingCountry,
                amount: paymentAmount.toFixed(2),
                currencyCode: "LKR",
                paymentType: "1",
                notifyUrl: "{{ config('ipg.notify-url') }}"
            };

            console.log('Payment gateway data:', payment);
            payablePayment(payment);
        }

        function resetButton(amount) {
            document.getElementById('btnSpinner').style.display = 'none';
            document.getElementById('payNowBtn').disabled = false;
            document.getElementById('payNowText').textContent = "Pay Now - LKR " + amount.toFixed(2);
        }
    </script>
@endsection
