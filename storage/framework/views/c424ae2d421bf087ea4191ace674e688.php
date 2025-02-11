<?php $__env->startSection('content'); ?>

<style>

.step-nav .nav-link {
    background: none !important;
    border: none;
    color: black; 
    font-weight: 500;
    padding-bottom: 5px;
}


.step-nav .nav-link.active {
    position: relative;
    color: black; 
    font-weight: bold;
}

.step-nav .nav-link.active::after {
    content: "";
    display: block;
    width: 100%;
    height: 3px;
    background-color: red;
    position: absolute;
    bottom: -2px;
    left: 0;
}

.step-nav .nav-link.disabled {
    color: gray;
    pointer-events: none;
}
</style>

<div class="container mt-4 mb-4" style="max-width :900px;width:100%">
    <div class="card p-4" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2) !important; padding:20px 150px !important">   

       <!-- Step-wise Navigation -->
        <ul class="nav justify-content-center mb-4 mt-4 step-nav">
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

        <!-- Ad Details 
        <div class="text-center p-3 mb-1">
            <img src="<?php echo e(asset('images/Ads/' . $ad->mainImage)); ?>" class="card-img-top mx-auto" style="width: 40%;" alt="Ad Image">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($ad->title); ?></h5>
                <p class="card-text">Price: Rs <?php echo e(number_format($ad->price, 2)); ?></p>
                <p class="card-text text-muted">Location: <?php echo e($ad->location); ?></p>
            </div>
        </div>-->

       
        <div class="boost-options mt-2">
            <h4 class="mb-0 text-center">Make your ad stand out!</h4>
            <p class="mb-1 text-center">Get up to 10 times more responses by boosting your ad. Select one or more options.</p>

            <!-- Bump Up Plan -->
            <div class="boost-option card p-3 mb-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            <img src="<?php echo e(asset('4.png')); ?>" alt="Jump Up" style="width: 50px; height: auto"> 
                            Jump Up
                        </h5>
                        <p class="mb-1">Get a fresh start every day and get up to 10 times more responses!</p>
                        <strong>From Rs 700</strong>
                    </div>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#bumpUpModal">+</button>
                </div>
            </div>

           <!-- Urgent Plan Card -->
            <div class="boost-option card p-3 mb-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            <img src="<?php echo e(asset('3.png')); ?>" alt="Urgent" style="width: 50px; height: auto"> 
                            Urgent
                        </h5>
                        <p class="mb-1">Stand out from the rest by showing a bright red marker on the ad!</p>
                        <strong>From Rs 1,900</strong>
                    </div>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#urgentModal">+</button>
                </div>
            </div>

            <!-- Top ad Plan -->
            <div class="boost-option card p-3 mb-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            <img src="<?php echo e(asset('1.png')); ?>" alt="Top ad" style="width: 50px; height: auto"> 
                            Top ad
                        </h5>
                        <p class="mb-1">Boost sales by showing your ad in this premium slot.</p>
                        <strong>From Rs 2,400</strong>
                    </div>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#topadModal">+</button>
                </div>
            </div>

            <!-- Super ad Plan -->
            <div class="boost-option card p-3 mb-3 border">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5>
                            <img src="<?php echo e(asset('2.png')); ?>" alt="Top ad" style="width: 50px; height: auto"> 
                            Super ad
                        </h5>
                        <p class="mb-1">Boost sales by showing your ad in this premium slot.</p>
                        <strong>From Rs 2,400</strong>
                    </div>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#SuperModal">+</button>
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
                <h5 class="modal-title">
                    <span class="badge bg-danger text-white">URGENT</span> Urgent
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Stand out from the rest by showing a bright red marker on the ad! <a href="#">Learn more</a></p>
                
                <!-- Plan Selection -->
                <div class="list-group">
                    <label class="list-group-item d-flex justify-content-between align-items-center">
                        <input type="radio" name="urgentPlan" value="1900" onclick="selectPlan('Urgent 3 Days', 1900)">
                        <span>3 days</span>
                        <strong class="text-success">Rs 1,900</strong>
                    </label>
                    <label class="list-group-item d-flex justify-content-between align-items-center">
                        <input type="radio" name="urgentPlan" value="2300" onclick="selectPlan('Urgent 7 Days', 2300)">
                        <span>7 days</span>
                        <strong class="text-success">Rs 2,300</strong>
                    </label>
                    <label class="list-group-item d-flex justify-content-between align-items-center">
                        <input type="radio" name="urgentPlan" value="2800" onclick="selectPlan('Urgent 15 Days', 2800)">
                        <span>15 days</span>
                        <strong class="text-success">Rs 2,800</strong>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="continueButton2" disabled data-bs-dismiss="modal">Continue</button>
            </div>
        </div>
    </div>
</div>





<!-- Top Modal -->
<div class="modal fade" id="topadModal" tabindex="-1" aria-labelledby="topadModallLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Top Ad Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Boost sales by showing your ad in a premium slot!</p>
                <strong>Rs 2,400</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="selectPlan('Top Ad', 2400)">Add</button>
            </div>
        </div>
    </div>
</div>

<!-- Super Modal  -->
<div class="modal fade" id="SuperModal" tabindex="-1" aria-labelledby="SuperModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Top Ad Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Boost sales by showing your ad in a premium slot!</p>
                <strong>Rs 2,400</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="selectPlan('Super Ad', 2400)">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedPlans = [];
    let totalAmount = 0;

    function selectPlan(name, price) {
        // Replace any previous urgent selection
        selectedPlans = selectedPlans.filter(plan => !plan.name.startsWith("Urgent"));
        selectedPlans.push({ name, price });
        
        totalAmount = selectedPlans.reduce((sum, plan) => sum + plan.price, 0);
        updateSummary();

        // Enable continue button
        document.getElementById("continueButton2").disabled = false;
    }

    function updateSummary() {
        document.getElementById("totalAmount").innerText = "Rs " + totalAmount;
        document.getElementById("selectedPlans").innerText = selectedPlans.map(plan => plan.name).join(", ");
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/ads_boost_plans.blade.php ENDPATH**/ ?>