@extends ('newFrontend.master')

@section('content')

<div class="container mt-4 mb-4" style="width:50%">
    <div class="card p-4" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2) !important;">   
        <h2 class="text-center">Boost Your Ad</h2>

        <!-- Step-wise Navigation -->
        <ul class="nav nav-pills justify-content-center mb-4 mt-4">
            <li class="nav-item">
                <span class="nav-link active">Ad Boost</span>
            </li>
            <li class="nav-item">
                <span class="nav-link disabled">Summary</span>
            </li>
            <li class="nav-item">
                <span class="nav-link disabled">Payment</span>
            </li>
            <li class="nav-item">
                <span class="nav-link disabled">Done</span>
            </li>
        </ul>

        <!-- Ad Details -->
        <div class="text-center p-3 mb-4">
            <img src="{{ asset('images/Ads/' . $ad->mainImage) }}" class="card-img-top mx-auto" style="width: 40%;" alt="Ad Image">
            <div class="card-body">
                <h5 class="card-title">{{ $ad->title }}</h5>
                <p class="card-text">Price: Rs {{ number_format($ad->price, 2) }}</p>
                <p class="card-text text-muted">Location: {{ $ad->location }}</p>
            </div>
        </div>

        <!-- Boost Options -->
        <h4 class="mb-3">Make your ad stand out!</h4>
        <p>Get up to 10 times more responses by boosting your ad. Select one or more options.</p>

        <div class="boost-options">
            <!-- Bump Up Plan -->
            <div class="boost-option card p-3 mb-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5><i class="fas fa-arrow-up text-warning"></i> Bump Up</h5>
                        <p class="mb-1">Get a fresh start every day and get up to 10 times more responses!</p>
                        <strong>Rs 2,000</strong> <span class="badge bg-dark">7 days</span>
                    </div>
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#bumpUpModal">-</button>
                </div>
            </div>

            <!-- Urgent Plan -->
            <div class="boost-option card p-3 mb-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5><span class="badge bg-danger text-white">URGENT</span> Urgent</h5>
                        <p class="mb-1">Stand out from the rest by showing a bright red marker on the ad!</p>
                        <strong>From Rs 700</strong>
                    </div>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#urgentModal">+</button>
                </div>
            </div>

            <!-- Spotlight Plan -->
            <div class="boost-option card p-3 mb-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5><i class="fas fa-star text-primary"></i> Spotlight</h5>
                        <p class="mb-1">Boost sales by showing your ad in this premium slot.</p>
                        <strong>From Rs 2,400</strong>
                    </div>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#spotlightModal">+</button>
                </div>
            </div>
        </div>

        <!-- Amount Summary -->
        <div class="summary-box p-3 mt-3 bg-light border">
            <h5>Amount: <span id="totalAmount" class="text-success">Rs 0</span></h5>
            <p id="selectedPlans">No plans selected</p>
        </div>

        <!-- Continue Button -->
        <button id="continueButton" class="btn btn-success mt-3 w-100" disabled>Continue</button>
    </div>
</div>


<!-- Bump Up Modal -->
<div class="modal fade" id="bumpUpModal" tabindex="-1" aria-labelledby="bumpUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bump Up Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Get a fresh start every day for 7 days and get up to 10 times more responses!</p>
                <strong>Rs 2,000</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="selectPlan('Bump Up', 2000)">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Urgent Modal -->
<div class="modal fade" id="urgentModal" tabindex="-1" aria-labelledby="urgentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Urgent Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Stand out from the rest with a red marker on your ad!</p>
                <strong>Rs 700</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="selectPlan('Urgent', 700)">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Spotlight Modal -->
<div class="modal fade" id="spotlightModal" tabindex="-1" aria-labelledby="spotlightModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Spotlight Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Boost sales by showing your ad in a premium slot!</p>
                <strong>Rs 2,400</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="selectPlan('Spotlight', 2400)">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedPlans = [];
    let totalAmount = 0;

    function selectPlan(name, price) {
        if (!selectedPlans.some(plan => plan.name === name)) {
            selectedPlans.push({ name, price });
            totalAmount += price;
            updateSummary();
        }
    }

    function updateSummary() {
        document.getElementById("totalAmount").innerText = "Rs " + totalAmount;
        document.getElementById("selectedPlans").innerText = selectedPlans.map(plan => plan.name).join(", ");
        document.getElementById("continueButton").disabled = selectedPlans.length === 0;
    }
</script>

@endsection
