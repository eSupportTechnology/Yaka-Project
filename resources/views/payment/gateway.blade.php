@extends('newFrontend.master')

@section('content')
    <style>
        .payment-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 20px;
        }

        .payment-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
            padding: 40px;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .payment-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .payment-logo {
            width: 150px;
            margin-bottom: 20px;
        }

        .payment-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .payment-subtitle {
            color: #6c757d;
            font-size: 1rem;
        }

        .order-details {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .order-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 1rem;
        }

        .order-label {
            color: #6c757d;
            font-weight: 500;
        }

        .order-value {
            color: #2c3e50;
            font-weight: 600;
        }

        .order-total {
            border-top: 2px solid #dee2e6;
            padding-top: 15px;
            margin-top: 15px;
        }

        .order-total .order-value {
            color: #B00505;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .payment-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #B00505 0%, #690303 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(176, 5, 5, 0.3);
        }

        .payment-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(176, 5, 5, 0.4);
        }

        .payment-btn:active {
            transform: translateY(0);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .payment-btn.loading .spinner {
            display: inline-block;
        }

        .payment-btn.loading .btn-text {
            display: none;
        }
    </style>

    <div class="payment-container">
        <div class="payment-card">
            <div class="payment-header">
                <img src="{{ env('IPG_LOGO_URL') }}" alt="Yaka.lk" class="payment-logo">
                <h2 class="payment-title">Complete Your Purchase</h2>
                <p class="payment-subtitle">Secure Payment Gateway</p>
            </div>

            <div class="order-details">
                <div class="order-row">
                    <span class="order-label">Order ID:</span>
                    <span class="order-value">{{ $paymentData['order_id'] }}</span>
                </div>
                <div class="order-row">
                    <span class="order-label">Membership Plan:</span>
                    <span class="order-value">{{ $paymentData['items'] }}</span>
                </div>
                <div class="order-row">
                    <span class="order-label">Business Name:</span>
                    <span class="order-value">{{ $paymentData['custom_1'] }}</span>
                </div>
                <div class="order-row">
                    <span class="order-label">Email:</span>
                    <span class="order-value">{{ $paymentData['custom_2'] }}</span>
                </div>
                <div class="order-row">
                    <span class="order-label">Phone:</span>
                    <span class="order-value">{{ $paymentData['custom_3'] }}</span>
                </div>
                <div class="order-row order-total">
                    <span class="order-label">Total Amount:</span>
                    <span class="order-value">LKR {{ number_format($paymentData['amount'], 2) }}</span>
                </div>
            </div>

            <form id="payment-form" action="https://ipg.payable.lk/payment/gateway" method="POST">
                @foreach($paymentData as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <button type="submit" class="payment-btn" id="payment-submit-btn">
                    <span class="btn-text">Proceed to Payment</span>
                    <span class="spinner"></span>
                </button>
            </form>

            <div class="secure-badge">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2L3 7V12C3 16.55 6.84 20.74 12 22C17.16 20.74 21 16.55 21 12V7L12 2Z"
                          stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 12L11 14L15 10" stroke="#28a745" stroke-width="2"
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span>Secured by SSL Encryption</span>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function() {
            const btn = document.getElementById('payment-submit-btn');
            btn.classList.add('loading');
            btn.disabled = true;
        });
    </script>
@endsection
