<?php $__env->startSection('content'); ?>

<style>
    /* General Container Styling */
/* General Container Styling */
.custom-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
}

.custom-card {
    padding: 20px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

/* Step Navigation Styling */
.custom-step-nav {
    display: flex;
    justify-content: center;
    margin: 20px 0;
    padding: 0;
}

.custom-step-nav .custom-nav-link {
    background: none;
    border: none;
    color: gray;
    font-weight: 500;
    padding-bottom: 5px;
    cursor: pointer;
    margin: 0 10px;
}

.custom-step-nav .custom-nav-link.active {
    position: relative;
    color: black;
    font-weight: bold;
}

.custom-step-nav .custom-nav-link.active::after {
    content: "";
    display: block;
    width: 100%;
    height: 3px;
    background-color: red;
    position: absolute;
    bottom: -2px;
    left: 0;
}

.custom-step-nav .custom-nav-link.disabled {
    color: gray;
    pointer-events: none;
}

/* Boost Option Styling */
.custom-boost-options {
    margin-top: 20px;
}

.custom-boost-option {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
}

.custom-boost-option h5 {
    display: flex;
    align-items: center;
    font-size: 1.1rem;
    margin-bottom: 5px;
}

.custom-boost-option img {
    width: 50px;
    height: auto;
    margin-right: 10px;
}

.custom-boost-option select {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
}

.custom-boost-option select:focus {
    outline: none;
    border-color: #007bff;
}

/* Modern Summary Box Styling */
.modern-summary-box {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
}

.modern-summary-box:hover {
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
}

.summary-details {
    margin-bottom: 20px;
}

.summary-text {
    color:black;
    font-weight: 500;
}

.summary-buttons {
    display: flex;
    justify-content: space-between;
    gap: 15px;
}

.summary-buttons button {
    width: 48%;
    margin-top:10px
}

.custom-btn-primary {
    background-color: #007bff;
    color: #fff;
    font-weight: 600;
}

.custom-btn-primary:hover {
    background-color: #0056b3;
}

.custom-btn-secondary {
    background-color: #f8f9fa;
    color: #333;
    font-weight: 600;
    border: 1px solid #ccc;
}

.custom-btn-secondary:hover {
    background-color: #e9ecef;
    border-color: #ddd;
}
.custom-text-success {
    color: #28a745;
    font-weight: 600;
}

/* Button Styles */
.custom-button {
    padding: 12px;
    border-radius: 5px;
    border: none;
    width: 100%;
    font-size: 1.1rem;
    cursor: pointer;
}

.custom-btn-success {
    background-color: #28a745;
    color: #fff;
}

.custom-btn-success:hover {
    background-color: #218838;
}

.custom-btn-primary {
    background-color: #007bff;
    color: #fff;
}

.custom-btn-primary:hover {
    background-color: #0056b3;
}

.custom-btn-secondary {
    background-color: #6c757d;
    color: #fff;
}

.custom-btn-secondary:hover {
    background-color: #5a6268;
}

.remove-plan:hover {
    color: darkred;
    cursor: pointer;
}

.dropdown-wrapper {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Responsive Design */
@media (max-width: 768px) {
    .custom-container {
        padding: 15px;
    }

    .custom-card {
        padding: 15px;
    }

    /* Boost Option Styling */
    .custom-boost-option {
        flex-direction: column;
        align-items: flex-start;
        padding: 10px;
        margin-bottom: 10px;
    }

    .custom-boost-option select {
        margin-top: 10px;
        width: 100%;
    }

    .custom-step-nav {
        flex-direction: column;
        align-items: center;
    }

    .custom-step-nav .custom-nav-link {
        margin: 5px 0;
    }

    /* Make buttons stack in two rows */
    .summary-buttons {
        flex-direction: column;
        gap: 10px;
    }

    .summary-details {
        flex-direction: column;
        gap: 10px;
    }
    .summary-buttons button {
        width: 100%;
    }

    /* Hide remove icon by default */
    .remove-plan {
        display: none;
    }

    /* Adjust for summary box and buttons on mobile */
    .custom-summary-box {
        padding: 20px;
    }

    .custom-boost-options {
        margin-top: 10px;
    }

    .custom-btn-primary {
        width: 100%;
    }

    .form-select option {
        padding: 5px;
        font-size: 16px;
        color: #333;
        background-color: #f8f9fa;
        width: 25%
    }


   

}

</style>

<div class="custom-container mt-4 mb-4">
    <div class="custom-card p-4">

        <!-- Step-wise Navigation -->
        <ul class="custom-step-nav">
            <li class="nav-item">
                <span class="custom-nav-link active">Ad Boost</span>
            </li>
            <li class="nav-item">
                <span class="custom-nav-link disabled" id="summaryStep">Summary</span>
            </li>
            <li class="nav-item">
                <span class="custom-nav-link disabled" id="paymentStep">Payment</span>
            </li>
            <li class="nav-item">
                <span class="custom-nav-link disabled">Done</span>
            </li>
        </ul>

        <!-- Main Plan Section -->
        <div class="custom-boost-options">
            <h4 class="mb-0 text-center">Make your ad stand out!</h4>
            <p class="mb-1 text-center">Get up to 10 times more responses by boosting your ad. Select one plan.</p>

            <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $filteredTypes = $packageTypes->filter(function($type) use ($package) {
                        return $type->package_id == $package->id;
                    });

                    $minPrice = $filteredTypes->min('price');

                    // Mapping package names to image filenames
                    $imageMap = [
                        'Jump up' => '4.png',
                        'Urgent' => '3.png',
                        'Top Ad' => '2.png',
                        'Super' => '1.png'
                    ];

                    // Set the image based on package name, default to 'default.png' if not found
                    $imageFile = $imageMap[$package->name] ?? 'default.png';
                ?>

                <div class="custom-boost-option">
                    <div>
                        <h5>
                            <img src="<?php echo e(asset($imageFile)); ?>" alt="<?php echo e($package->name); ?>"> 
                            <?php echo e($package->name); ?>

                        </h5>
                        <p class="mb-1">Boost your ad with the "<?php echo e($package->name); ?>" package!</p>
                        <strong>From Rs <?php echo e(number_format($minPrice, 2)); ?></strong>
                    </div>
                    <div class="dropdown-wrapper">
                        <select class="form-select" id="packageSelect<?php echo e($package->id); ?>" onchange="selectPlanDropdown(<?php echo e($package->id); ?>, '<?php echo e($package->name); ?>', this)">
                            <option value="">Select Plan</option>
                            <?php $__currentLoopData = $packageTypes->filter(fn($type) => $type->package_id == $package->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($type->price); ?>" data-duration="<?php echo e($type->duration); ?>" 
                                    style="padding: 5px; font-size: 16px; color: #333; background-color: #f8f9fa;">
                                    <?php echo e($type->duration); ?> days | Rs- <?php echo e($type->price); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="remove-plan" id="removeIcon<?php echo e($package->id); ?>" onclick="removePlan(<?php echo e($package->id); ?>)" style="display: none;">❌</span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>



        <!-- Amount Summary -->
        <div class="custom-summary-box">
            <h5>Amount: <span id="totalAmount" class="custom-text-success">Rs 0</span></h5>
            <p id="selectedPlans">No plans selected</p>
        </div>

        <!-- Continue Button -->
        <button id="continueButton" class="custom-button custom-btn-success" disabled onclick="showSummary()">Continue</button>

        <!-- Summary Section -->
        <div id="summarySection" style="display: none;">
            <div class="custom-summary-box modern-summary-box">
                <div class="summary-details" style="display: flex; align-items: center; gap: 20px;">
                    <img src="<?php echo e(asset('images/Ads/' . $ad->mainImage)); ?>" alt="Main Image" 
                         style="width: 150px; height: auto; border-radius: 8px; object-fit: cover;">
        
                    <div>
                        <p style="color: black"><strong>Title:</strong> <span id="summaryAdTitle" class="summary-text"></span></p>
                        <p style="color: black"><strong>Price:</strong> <span id="summaryAdPrice" class="summary-text"></span></p>
                        <p style="color: black"><strong>Description:</strong> <span id="summaryAdDescription" class="summary-text"></span></p>
                    </div>
                </div>
        
                <p style="color: black" id="summarySelectedPlans">No plans selected</p>
                <h5>Total Amount: <span class="custom-text-success" id="summaryTotalAmount">Rs 0</span></h5>
        
                <div class="summary-buttons">
                    <button id="backToAdBoost" class="custom-button custom-btn-secondary" onclick="backToAdBoost()">Back to Ad Boost</button>
                    <button id="proceedToPayment" onclick="showPaymentForm()" class="custom-button custom-btn-primary">Proceed to Payment</button>
                </div>
            </div>
        </div>

                <!-- Payment Form Section -->
        <div id="paymentSection" style="display: none;">
            <div class="custom-summary-box modern-summary-box">
                <h4>Payment Details</h4>
                <form id="paymentForm" action="YOUR_PAYMENT_PROCESSING_URL" method="POST">
                    <!-- User Name Field -->
                    <div class="form-group">
                        <label for="name" class="form-label"> Name On Card</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name On Card" required>
                    </div>

                    <!-- Card Number Field -->
                    <div class="form-group">
                        <label for="cardNumber" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="Enter your card number" required>
                    </div>

                    <!-- Expiry Date -->
                    <div class="form-group">
                        <label for="expiryDate" class="form-label">Expiry Date</label>
                        <input type="month" class="form-control" id="expiryDate" name="expiryDate" required>
                    </div>

                    <!-- CVV Field -->
                    <div class="form-group">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="password" class="form-control" id="cvv" name="cvv" placeholder="Enter CVV" required>
                    </div>

                      <!-- Display Total Amount -->
                    <h5>Total Amount: <span class="custom-text-success" id="paymentTotalAmount">Rs 0</span></h5>

                    <!-- Payment Button -->
                    <div class="form-group ">
                        <button type="submit" class="custom-button custom-btn-primary">Pay</button>
                    </div>
                    <div class="form-group ">
                        <button type="button" class="custom-button custom-btn-secondary" onclick="backToSummary()">Back to Summary</button>
                    </div>
                </form>
            </div>
        </div>

        

    </div>
</div>




<script>
    let ad = <?php echo json_encode($ad, 15, 512) ?>;
    let selectedPlans = [];
    let totalAmount = 0;

    function selectPlanDropdown(packageId, packageName, selectElement) {
    let planName = selectElement.options[selectElement.selectedIndex].text;
    let price = parseFloat(selectElement.value);

    // Clear previous selection
    selectedPlans = [];

    if (price > 0) {
        selectedPlans.push({ package: packageName, name: planName, price: price });
    }

    totalAmount = selectedPlans.length > 0 ? selectedPlans[0].price : 0;

    document.getElementById("totalAmount").innerText = `Rs ${totalAmount}`;
    document.getElementById("selectedPlans").innerHTML = selectedPlans.length
        ? `<strong>${selectedPlans[0].package}:</strong> ${selectedPlans[0].name}`
        : "No plans selected";

    // Show remove icon next to the dropdown if a plan is selected
    let removeIcon = document.getElementById(`removeIcon${packageId}`);
    if (price > 0) {
        removeIcon.style.display = "inline-block";
    } else {
        removeIcon.style.display = "none";
    }

    document.getElementById("continueButton").disabled = selectedPlans.length === 0;

    // Reset all dropdowns except the current one
    document.querySelectorAll("select").forEach(select => {
        if (select !== selectElement) {
            select.selectedIndex = 0;
        }
    });
}

function removePlan(packageId) {
    // Reset the selected plan for the corresponding dropdown
    let selectElement = document.getElementById(`packageSelect${packageId}`);
    selectElement.selectedIndex = 0;

    // Hide the remove icon
    document.getElementById(`removeIcon${packageId}`).style.display = "none";

    // Clear selection and reset UI
    selectedPlans = [];
    totalAmount = 0;
    document.getElementById("totalAmount").innerText = `Rs ${totalAmount}`;
    document.getElementById("selectedPlans").innerHTML = "No plans selected";
    document.getElementById("continueButton").disabled = true;

    // Reload the page after a short delay to allow changes to take effect
    setTimeout(function() {
        location.reload();
    }, 200); // Adjust the timeout as needed
}






    function backToAdBoost() {
        document.getElementById("summarySection").style.display = "none";
        document.querySelector(".custom-boost-options").style.display = "block";
        document.querySelector(".custom-summary-box").style.display = "block";
        document.getElementById("continueButton").style.display = "inline-block";
        document.getElementById("backToAdBoost").style.display = "none";

        document.querySelectorAll(".custom-step-nav .custom-nav-link").forEach(link => {
            link.classList.remove("active");
            link.classList.add("disabled");
        });

        let adBoostStep = document.querySelector(".custom-step-nav .custom-nav-link:first-child");
        adBoostStep.classList.add("active");
        adBoostStep.classList.remove("disabled");
    }

    function showSummary() {

        console.log("Ad Image Path:", ad.mainImage);

        document.getElementById("summaryTotalAmount").innerText = `Rs ${totalAmount}`;
        document.getElementById("summarySelectedPlans").innerHTML = selectedPlans.length 
            ? selectedPlans.map(plan => `<strong>${plan.package}:</strong> ${plan.name} `).join("<br>") 
            : "No plans selected";

        document.getElementById("summaryAdTitle").innerText = ad.title;
        document.getElementById("summaryAdDescription").innerText = ad.description;
        document.getElementById("summaryAdPrice").innerText = "Rs " + ad.price;  // Set the price

        document.querySelector(".custom-boost-options").style.display = "none";
        document.querySelector(".custom-summary-box").style.display = "none";
        document.getElementById("continueButton").style.display = "none";

        document.getElementById("summarySection").style.display = "block";
        document.getElementById("backToAdBoost").style.display = "inline-block";

        document.querySelectorAll(".custom-step-nav .custom-nav-link").forEach(link => {
            link.classList.remove("active");
            link.classList.add("disabled");
        });

        let summaryStep = document.getElementById("summaryStep");
        summaryStep.classList.add("active");
        summaryStep.classList.remove("disabled");

         
    }

    // Show Payment Form (triggered when Proceed to Payment button is clicked)
    function showPaymentForm() {

         // Get the total amount from the summary section
         let totalAmount = document.getElementById("summaryTotalAmount").innerText;

         // Set the total amount in the payment section
          document.getElementById("paymentTotalAmount").innerText = totalAmount;

        // Hide summary and Proceed to Payment button
        document.getElementById("summarySection").style.display = "none";
    

        // Show payment form
        document.getElementById("paymentSection").style.display = "block";
        
        // Update step navigation for payment step
        document.querySelectorAll(".custom-step-nav .custom-nav-link").forEach(link => {
            link.classList.remove("active");
            link.classList.add("disabled");
        });

        let paymentStep = document.getElementById("paymentStep");
        paymentStep.classList.add("active");
        paymentStep.classList.remove("disabled");

        // let paymentStep = document.querySelector(".custom-step-nav .custom-nav-link:nth-child(3)");
        // paymentStep.classList.add("active");
        // paymentStep.classList.remove("disabled");
    }

    function backToSummary() {

       
        // Hide the Payment Section
        document.getElementById("paymentSection").style.display = "none";

        // Show the Summary Section
        document.getElementById("summarySection").style.display = "block";

        // Optionally show the Proceed to Payment button again
        document.getElementById("proceedToPayment").style.display = "inline-block";

        // Update step navigation to reflect the summary step
        document.querySelectorAll(".custom-step-nav .custom-nav-link").forEach(link => {
            link.classList.remove("active");
            link.classList.add("disabled");
        });

       
        let summaryStep = document.getElementById("summaryStep");
        summaryStep.classList.add("active");
        summaryStep.classList.remove("disabled");
    }

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/ads_boost_plans.blade.php ENDPATH**/ ?>