@extends ('newFrontend.master')

@section('content')
<style>
    .payment-container {
        max-width: 600px;
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

</style>
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
        @if($adData)
        <div class="card mb-4">
            <div class="card-body">
                <h4>Ad Details</h4>
                <p><strong>Title:</strong> {{ $adData['title'] }}</p>
                <p><strong>Price:</strong> LKR {{ number_format($adData['price'], 2) }}</p>
                <p><strong>Description:</strong> {{ $adData['description'] }}</p>
            </div>
        </div>
        @endif

        <!-- Display Package Details -->
        <div class="card mb-4">
            <div class="card-body">
                <h4>Package Details</h4>
                <p><strong>Package Name:</strong> {{ $selectedPackageName }}</p>
                <p><strong>Package Duration:</strong> {{ $selectedPackageDuration }} {{ $selectedPackageDuration > 1 ? 'days' : 'day' }}</p>
                <p><strong>Package Price:</strong> LKR {{ number_format($selectedPackagePrice, 2) }}</p>
            </div>
        </div>

        <!-- Initial Pay Now Button -->
        <button onclick="returnForm()" type="button" id="show-card-page" class="btn btn-success w-100 pay_now">Pay Now</button>
    </div>

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

        <form action="{{ route('payment.complete') }}" method="POST">
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
        </form>
    </div>
</div>
<script>

    function returnForm() {
       const payment = {
            logoUrl: "https://yaka.lk/Logo-re.png",
            returnUrl: "https://yaka.lk/user/my_ads",
            checkValue: "8d55d6f6607b5872168f6b69053680ca",
            orderDescription: "Payment for Yaka",
            invoiceId: "8d55d6f6607b58",
            merchantKey: "2850686EDCB8570C",
            customerFirstName: "Gayashan",
            customerLastName: "Abeywicckrama",
            customerMobilePhone: "0715925451",
            customerEmail: "gayashancs7@gmail.com",
            billingAddressStreet: "Thalgaskoratratuwa",
            billingAddressCity: "Walasmulla",
            billingAddressCountry: "LKA",
            amount: "100.00",
            currencyCode: "LKR",
            paymentType: "1",
            notifyUrl: "https://yaka.lk/api/payment/notify"
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
