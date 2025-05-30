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
    .text-success{
        color: #28a745;
        font-weight: bold;
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
    to { transform: rotate(360deg); }
}

</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://sandboxipgsdk.payable.lk/sdk/v4/payable-checkout.js"></script>
<div class="container mt-5">
    <div class="payment-container mb-4" id="main-payment-content">
        <h2 class="mb-4 text-center">Complete Your Payment</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Display Ad Details -->
        {{-- @if($adData)
        <div class="card mb-4">
            <div class="card-body">
                <h4>Ad Details</h4>
                <p><strong>Title:</strong> {{ $adData['title'] }}</p>
                <p><strong>Price:</strong> LKR {{ number_format($adData['price'], 2) }}</p>
                <p><strong>Description:</strong> {{ $adData['description'] }}</p>
            </div>
        </div>
        @endif --}}

        <!-- Display Package Details -->
        <div class="card mb-4">
            <div class="card-body">
                <h4>Package Details</h4>
                <p><strong>Package Name:</strong> {{ $selectedPackageName }}</p>
                <p><strong>Package Duration:</strong> {{ $selectedPackageDuration }} {{ $selectedPackageDuration > 1 ? 'days' : 'day' }}</p>
                <p><strong>Package Price:</strong> LKR {{ number_format($selectedPackagePrice, 2) }}</p>
            </div>
        </div>

        <!-- Get Billing Details Details -->
        <div class="card mb-4">
            <div class="card-body">
                <h4>Enter Billing Details</h4>
                <input type="hidden" name="return_url" id="return_url" value="https://yakalk.esupportsystem.shop/payment/checking?invId={{ $invoiceId }}">
                <label for="billing_street">Billing Address Street<span style="color:red; font-size:18px;">*</span></label>
                <input class="form-control" type="text" name="billing_street" id="billing_street">
                <label for="billing_city">Billing Address City<span style="color:red; font-size:18px;">*</span></label>
                <input class="form-control" type="text" name="billing_city" id="billing_city">
                <label for="billing_country">Billing Address Country<span style="color:red; font-size:18px;">*</span></label>
                <input class="form-control" type="text" name="billing_country" id="billing_country" value="LKA" readonly>
            </div>
        </div>

        <!-- Initial Pay Now Button -->
        {{-- <button onclick="returnForm()" type="button" id="show-card-page" class="btn btn-success w-100 pay_now">Pay Now</button>
    </div> --}}

        <button onclick="returnForm()" type="button" id="payNowBtn" class="btn btn-success w-100 d-flex justify-content-center align-items-center">
          <span id="payNowText">Pay Now</span>
          <div id="btnSpinner" class="ms-2 spinner-border spinner-border-sm text-light" role="status" style="display: none;"></div>
        </button>

    <!-- Payment Form Page (Initially Hidden) -->
    <div class="payment-container mb-4" id="card-details-page">
        <h2 class="mb-4 text-center">Enter Card Details</h2>

        <!-- Display Package Price on Card Details Page -->
        <div class="card mb-4">
            <div class="card-body">
                <h4>Package Price</h4>
                <p><strong>Total Amount:</strong><span class="text-success"> LKR {{ number_format($selectedPackagePrice, 2) }}</span></p>
            </div>
        </div>

        {{--  <form action="{{ route('payment.complete') }}" method="POST">
            @csrf

            <input type="hidden" name="package_type" value="{{ $packageType }}">
            <input type="hidden" name="ad_data" value="{{ json_encode($adData) }}">

            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" class="form-control mb-3" placeholder="1234 5678 9101 1121" required>

            <label for="expiry-date">Expiry Date</label>
            <input type="text" id="expiry-date" class="form-control mb-3" placeholder="MM/YY" required>

            <label for="card-name">Cardholder Name</label>
            <input type="text" id="card-name" class="form-control mb-3" placeholder="John Doe" required>

            <label for="cvc">CVC</label>
            <input type="text" id="cvc" class="form-control mb-3" placeholder="123" required>

            <button type="submit" class="btn btn-success w-100">Confirm Payment</button>
        </form>  --}}
    </div>
</div>
<script>

    function returnForm() {
        const billingStreet = document.getElementById('billing_street').value.trim();
        const billingCity = document.getElementById('billing_city').value.trim();
        const billingCountry = document.getElementById('billing_country').value.trim();

        const returnUrl = document.getElementById('return_url').value.trim();

        if (!billingStreet || !billingCity || !billingCountry) {
            Swal.fire({
                icon: 'error',
                title: 'Missing Billing Information',
                text: 'Please fill in all required billing details.',
            });
            return; // Stop if validation fails
        }

        // Show spinner & disable button
    document.getElementById('btnSpinner').style.display = 'inline-block';
    document.getElementById('payNowBtn').disabled = true;
    document.getElementById('payNowText').textContent = "Processing...";


       const payment = {
            logoUrl: "{{ config('ipg.logo-url') }}",
            returnUrl: returnUrl,
            checkValue: "{{ session('checkValue') }}",
            orderDescription: "Payment for Yaka",
            invoiceId: "{{ session('invoiceId') }}",
            merchantKey: "{{ config('ipg.merchant-key') }}",
            customerFirstName: "{{ auth()->user()->first_name }}",
            customerLastName: "{{ auth()->user()->last_name }}",
            customerMobilePhone: "{{ auth()->user()->phone_number }}",
            customerEmail: "{{ auth()->user()->email }}",
            billingAddressStreet: billingStreet,
            billingAddressCity: billingCity,
            billingAddressCountry: billingCountry,
            amount: "{{ $selectedPackagePrice }}",
            currencyCode: "LKR",
            paymentType: "1",
            notifyUrl: "{{ config('ipg.notify-url') }}"
        };
        payablePayment(payment);
    }
</script>
{{-- <script>
    document.getElementById("show-card-page").addEventListener("click", function () {
        document.getElementById("main-payment-content").style.display = "none"; // Hide all other content
        document.getElementById("card-details-page").style.display = "block"; // Show only the card details form
    });
</script> --}}
@endsection
