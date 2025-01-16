<!DOCTYPE html>
<html lang="en">
<head>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>YAKA.LK Payment Loading .....</title>
    <script src="https://sandboxipgsdk.payable.lk/sdk/v4/payable-checkout.js"></script>
</head>
<body onload="returnForm()" style="display: flex; justify-content: center; height: 100vh; align-items: center;">
    @php
        $merchantKey = '2850686EDCB8570C';
        $invoiceId = $invoiceId;
        $amount = $amount;
        $currencyCode = 'LKR';
        $merchantToken = '39A5BAE508D3435EB484DFBE83D2A780';
        $innerHash = strtoupper(hash('sha512', $merchantToken));
        $concatenatedString = $merchantKey . '|' . $invoiceId . '|' . $amount . '|' . $currencyCode . '|' . $innerHash;
        $checkValue = strtoupper(hash('sha512', $concatenatedString));
        
       
    @endphp

    <script>
       function returnForm() {           
        let today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format
         let domain = "https://yaka.lk/";
        if ({{$post}} == '1') {
            let returnUrl = "https://yaka.lk/";
        }else{
            let returnUrl = "https://yaka.lk/user/dashboard/my-ads/active";
        }

        const payment = {
            logoUrl: domain + "yaka-payment.png", // Replace with a valid https URL
            returnUrl: domain, // Replace with a valid https URL
            refererUrl: domain, // Replace with a valid https URL
            checkValue: "{{ $checkValue }}", // Pass the PHP variable to JavaScript
            orderDescription: "Payment",
            invoiceId: "{{$invoiceId}}",
            merchantKey: "2850686EDCB8570C", // Ensure this key is valid
            customerFirstName: "{{$customerFirstName}}",
            customerLastName: "{{$customerLastName}}",
            customerMobilePhone: "{{$customerMobilePhone}}",
            customerEmail: "{{$customerEmail}}",
            billingAddressStreet: "Main street",
            billingAddressCity: "{{$billingAddressCity}}",
            billingAddressCountry: "LKA",
            amount: "{{$amount}}",
            currencyCode: "LKR",
            paymentType: "1",
            startDate: today, // Use today's date
            endDate: "2024-12-20",
            recurringAmount: "2.00",
            interval: "MONTHLY",
            isRetry: "1",
            retryAttempts: "1",
            doFirstPayment: "1",
            notifyUrl: "https://yaka.lk/payment/notify" // Replace with a valid https URL
        };

        console.log('Payment Object:', payment);

    try {
        payablePayment(payment, function(response) {
            console.log('Response:', response);

            // Send response to the server using fetch
            fetch('{{ route('user.notify') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
                },
                body: JSON.stringify({
                    response: response,
                    invoiceId: payment.invoiceId,
                    amount: payment.amount,
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('Server Response:', data);
                alert('Payment was successful and the server has been notified.');
            })
            .catch(err => {
                console.error('Server Error:', err);
                alert('Failed to notify the server.');
            });

        }, function(error) {
            console.error('Error:', error);
            alert('Payment failed. Error: ' + error.error + ' Status: ' + error.status);
        });
    } catch (e) {
        console.error('Exception:', e);
        alert('An unexpected error occurred: ' + e.message);
    }
}
    </script>

    <!-- Lottie animation for loading screen -->
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <dotlottie-player src="https://lottie.host/93d4d9df-bc1c-46e5-b1e0-f990d07cf818/3EMGQt5TQl.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
</body>
</html>
