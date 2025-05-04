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

</style>
<div class="container mt-5">
    <div class="payment-container mb-4" id="main-payment-content">
        <!-- Display Package Details -->
        <div class="card mb-4">
            <div class="card-body">
                <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                    <h3>❌ Something Went Wrong</h3>
                    <p>There was an error processing your payment. Please contact the administrator.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
