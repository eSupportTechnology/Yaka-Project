@extends ('newFrontend.master')

@section('content')

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
    border: 1px solid #e0e0e0;
    transition: all 0.3s ease;
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

.ad-banner-container {
    width: 100%;
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 5px 0;
    margin-top: 0px;
    margin-bottom: 30px;
}

.ad-banner {
    width: 60%;  /* Reduced width */
    max-width: 600px;  /* Smaller banner width */
    height: 80px;  /* Reduced height */
    background: url('banner-image.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    font-size: 10px;
    padding: 5px;
}

.ad-carousel-item img {
    width: 800px !important;
    height: 120px !important;
    object-fit: cover;
    margin: 0 auto;
}

.top-banner .left .carousel-item img {
    max-width: 80%; /* Adjust the width percentage as needed */
    max-height: 50%; /* Ensure the aspect ratio is maintained */
    margin: 20px; /* Center the image horizontally */
    margin-left:-40px;
    margin-top:-25px;
}
.super-banner .right .carousel-item img {
    max-width: 57%; /* Adjust the width percentage as needed */
    max-height: 140%; /* Ensure the aspect ratio is maintained */
    margin-left: 20px; /* Center the image horizontally */

}

</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://sandboxipgsdk.payable.lk/sdk/v4/payable-checkout.js"></script>

<div class="mt-4 mb-4 custom-container">
    <div class="p-4 custom-card">

        <!-- Step-wise Navigation -->
        <ul class="custom-step-nav">
            <li class="nav-item">
                <span class="custom-nav-link active">@lang('messages.Ad Boost')</span>
            </li>
            <li class="nav-item">
                <span class="custom-nav-link disabled" id="summaryStep">@lang('messages.Summary')</span>
            </li>
            {{-- <li class="nav-item">
                <span class="custom-nav-link disabled" id="paymentStep">@lang('messages.Payment')</span>
            </li>
            <li class="nav-item">
                <span class="custom-nav-link disabled">@lang('messages.done')</span>
            </li> --}}
        </ul>

        <!-- Main Plan Section -->
        <div class="custom-boost-options">
            <h4 class="mb-0 text-center">@lang('messages.Make your ad stand out')</h4>
            <p class="mb-1 text-center">@lang('messages.boosting_ad_message')</p>

            @foreach($packages as $package)
                <?php
                    $filteredTypes = $packageTypes->filter(function($type) use ($package) {
                        return $type->package_id == $package->id;
                    });

                    $minPrice = $filteredTypes->min('price');

                    // Mapping package names to image filenames
                    $imageMap = [
                        'Jump up' => '4.png',
                        'Urgent' => '3.png',
                        'Top Ad' => '1.png',
                        'Super' => '2.png'
                    ];

                    // Set the image based on package name, default to 'default.png' if not found
                    $imageFile = $imageMap[$package->name] ?? 'default.png';
                ?>

                <div class="custom-boost-option">
                    <div>
                        <h5>
                            <img src="{{ asset($imageFile) }}" alt="{{ $package->name }}">
                            @lang('messages.' . $package->name)
                        </h5>
                        <p class="mb-1">@lang('messages.Boost your ad with the') "{{ $package->name }}" @lang('messages.package')!</p>
                        <strong>@lang('messages.from') @lang('messages.Rs') {{ number_format($minPrice, 2) }} @lang('messages.from1') </strong>
                    </div>
                    <div class="dropdown-wrapper">
                        <select class="form-select" id="packageSelect{{ $package->id }}" onchange="selectPlanDropdown({{ $package->id }}, '{{ $package->name }}', this)">
                            <option value="">@lang('messages.Select Plan')</option>
                            @foreach($packageTypes->filter(fn($type) => $type->package_id == $package->id) as $type)
                                <option value="{{ $type->price }}" data-id="{{$type->id}}" data-duration="{{ $type->duration }}"
                                    style="padding: 5px; font-size: 16px; color: #333; background-color: #f8f9fa;">
                                    {{ $type->duration }} @lang('messages.Days') | @lang('messages.Rs')- {{ $type->price }}
                                </option>
                            @endforeach
                        </select>
                        <span class="remove-plan" id="removeIcon{{ $package->id }}" onclick="removePlan({{ $package->id }})" style="display: none;">❌</span>
                    </div>
                </div>
            @endforeach
        </div>



        <!-- Amount Summary -->
        <div class="custom-summary-box">
            <h5>@lang('messages.Amount'): <span id="totalAmount" class="custom-text-success">@lang('messages.Rs') 0</span></h5>
            <p id="selectedPlans">@lang('messages.No plans selected')</p>
        </div>

        <!-- Continue Button -->
        <button id="continueButton" class="custom-button custom-btn-success" disabled onclick="showSummary()">@lang('messages.Continue')</button>

        <!-- Summary Section -->
        <div id="summarySection" style="display: none;">
            <div class="custom-summary-box modern-summary-box">
                <div class="summary-details" style="display: flex; align-items: center; gap: 20px;">
                    <img src=" {{ url('storage/' . $mainImage) }}" alt="Main Image"
                         style="width: 150px; height: auto; border-radius: 8px; object-fit: cover;">

                    <div>
                        <p style="color: black"><strong>@lang('messages.Title'):</strong> <span id="summaryAdTitle" class="summary-text"></span></p>
                        <p style="color: black"><strong>@lang('messages.Price'):</strong> <span id="summaryAdPrice" class="summary-text"></span></p>
                        <p style="color: black"><strong>@lang('messages.Description'):</strong> <span id="summaryAdDescription" class="summary-text"></span></p>
                        <p style="color: black"><strong>@lang('messages.current_package'):</strong> <span id="summaryAdCurrentPackage" class="summary-text"></span></p>
                        <p style="color: black"><strong>@lang('messages.current_package_duration'):</strong> <span id="summaryAdCurrentPackageType" class="summary-text"></span>days</p>
                        <p style="color: black"><strong>@lang('messages.current_package_expired'):</strong> <span id="summaryAdCurrentPackageExpired" class="summary-text"></span></p>
                    </div>
                </div>

                <p style="color: black" id="summarySelectedPlans">No plans selected</p>
                <h5>@lang('messages.Total'): <span class="custom-text-success" id="summaryTotalAmount">Rs 0</span></h5>

    




                <div class="summary-buttons">
                    <button id="backToAdBoost" class="custom-button custom-btn-secondary" onclick="backToAdBoost()">@lang('messages.Back')</button>
                    <button id="proceedToPayment" onclick="saveBoostingInfo()" class="custom-button custom-btn-primary">@lang('messages.Proceed to Payment')</button>
                </div>
            </div>
        </div>

        



    </div>
</div>


<script>
    const invoiceId = @json($invoiceId);
</script>


<script>
    let ad = @json($ad);
    let packages = @json($packages);
    let packagesType = @json($packageTypes);
    let selectedPlans = [];
    let totalAmount = 0;
    let selectedPackageId = null;
    let selectedPackageTypeId = null; // Global variable for packagetypeId
    let selectedDuration = null; // To store the selected duration
    let selectedPackageName = null; // To store the selected package name

    console.log(totalAmount);


    function selectPlanDropdown(packageId, packageName, selectElement) {
        selectedPackageId = packageId; // Store globally
        selectedPackageName = packageName; // Store package name
        
        let planName = selectElement.options[selectElement.selectedIndex].text;
        let price = parseFloat(selectElement.value);
        selectedPackageTypeId = parseInt(selectElement.options[selectElement.selectedIndex].getAttribute("data-id"), 10);
        selectedDuration = parseInt(selectElement.options[selectElement.selectedIndex].getAttribute("data-duration"), 10);


        // Clear previous selection
        selectedPlans = [];

        if (price > 0) {
            selectedPlans.push({ package: packageName, name: planName, price: price, duration: selectedDuration });
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
        selectedPackageId = null;
        selectedPackageTypeId = null;
        selectedDuration = null;
        selectedPackageName = null;
        
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
        document.getElementById("summaryAdPrice").innerText = "Rs " + ad.price;
        
        // Find the package that matches ad.ads_package
        const packageName = packages.find(pkg => pkg.id === ad.ads_package)?.name || "Unknown Package";

        // Update the element with the package name
        document.getElementById("summaryAdCurrentPackage").innerText = packageName;

        // Find the matching package type using both ad.ads_package and ad.package_type
        const packageType = packagesType.find(pt => pt.package_id === ad.ads_package && pt.id === ad.package_type);

        // Get duration or set a default value if not found
        const duration = packageType ? packageType.duration : "Unknown Duration";

        // Update the element with the duration
        document.getElementById("summaryAdCurrentPackageType").innerText = duration;
        document.getElementById("summaryAdCurrentPackageExpired").innerText = ad.package_expire_at;

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

    // Function to save boosting info to the boostingaddinfo table
    function saveBoostingInfo() {
        if (!selectedPackageId || !selectedPackageTypeId) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a package before proceeding!'
            });
            return;
        }

        // Extract price from selectedPlans
        let price = selectedPlans.length > 0 ? selectedPlans[0].price : 0;
        
        // Get the current package info
        const currentPackageName = document.getElementById("summaryAdCurrentPackage").innerText;
        const currentPackageDuration = document.getElementById("summaryAdCurrentPackageType").innerText;
        const currentPackageExpiry = document.getElementById("summaryAdCurrentPackageExpired").innerText;

// Convert durations to integer
    const currentPackageDuration1 = parseInt(currentPackageDuration) || 0;
    const newPackageDuration1 = parseInt(selectedDuration) || 0;

    // Data to save
    const boostingData = {
        ad_id: ad.adsId,
        ad_title: ad.title,
        ad_description: ad.description,
        ad_price: ad.price,
        current_package_id: ad.ads_package,
        current_package_name: currentPackageName,
        current_package_type_id: ad.package_type,
        current_package_duration: currentPackageDuration1,
        current_package_expiry: currentPackageExpiry,
        new_package_id: selectedPackageId,
        new_package_name: selectedPackageName,
        new_package_type_id: selectedPackageTypeId,
        new_package_duration: newPackageDuration1,
        amount: price,
        payment_status: 'pending',
        invoice_id: invoiceId
    };
        console.log("Boosting Data:", boostingData);


        // Save to the boostingaddinfo table
        fetch("{{ route('boosting.saveInfo') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json", // <-- Add this line
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify(boostingData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                console.log("Boosting info saved successfully!", data);
                 // Redirect to billing page
                 window.location.href = data.redirect;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to save boosting information.'
                });
            }
        })
        .catch(error => {
            console.error("Error saving boosting info:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to save boosting information. Please try again.'
            });
        });
    }

    // Show Payment Form (triggered after saving boosting info)
    function showPaymentForm() {
        // Get the total amount from the summary section
        let totalAmount = document.getElementById("summaryTotalAmount").innerText;
        
        // Set the total amount in the payment section
        document.getElementById("paymentTotalAmount").innerText = totalAmount;

        // Hide summary section
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

@endsection