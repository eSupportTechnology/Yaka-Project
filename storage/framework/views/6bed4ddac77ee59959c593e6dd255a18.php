<?php $__env->startSection('content'); ?>
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

<div class="container mt-5">
    <div class="payment-container mb-4" id="main-payment-content">
        <h2 class="mb-4 text-center">Complete Your Payment</h2>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <!-- Display Ad Details -->
        <?php if($adData): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h4>Ad Details</h4>
                <p><strong>Title:</strong> <?php echo e($adData['title']); ?></p>
                <p><strong>Price:</strong> LKR <?php echo e(number_format($adData['price'], 2)); ?></p>
                <p><strong>Description:</strong> <?php echo e($adData['description']); ?></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Display Package Details -->
        <div class="card mb-4">
            <div class="card-body">
                <h4>Package Details</h4>
                <p><strong>Package Name:</strong> <?php echo e($selectedPackageName); ?></p>
                <p><strong>Package Duration:</strong> <?php echo e($selectedPackageDuration); ?> <?php echo e($selectedPackageDuration > 1 ? 'days' : 'day'); ?></p>
                <p><strong>Package Price:</strong> LKR <?php echo e(number_format($selectedPackagePrice, 2)); ?></p>
            </div>
        </div>

        <!-- Initial Pay Now Button -->
        <button type="button" id="show-card-page" class="btn btn-success w-100">Pay Now</button>
    </div>

    <!-- Payment Form Page (Initially Hidden) -->
    <div class="payment-container mb-4" id="card-details-page">
        <h2 class="mb-4 text-center">Enter Card Details</h2>

        <!-- Display Package Price on Card Details Page -->
        <div class="card mb-4">
            <div class="card-body">
                <h4>Package Price</h4>
                <p><strong>Total Amount:</strong><span class="text-success"> LKR <?php echo e(number_format($selectedPackagePrice, 2)); ?></span></p>
            </div>
        </div>

        <form action="<?php echo e(route('payment.complete')); ?>" method="POST">
            <?php echo csrf_field(); ?>
           
            <input type="hidden" name="package_type" value="<?php echo e($packageType); ?>">
            <input type="hidden" name="ad_data" value="<?php echo e(json_encode($adData)); ?>">

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
    document.getElementById("show-card-page").addEventListener("click", function () {
        document.getElementById("main-payment-content").style.display = "none"; // Hide all other content
        document.getElementById("card-details-page").style.display = "block"; // Show only the card details form
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/user/payment.blade.php ENDPATH**/ ?>