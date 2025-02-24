<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/userdashboard.css')); ?>" rel="stylesheet">
<style>

.section-box {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 20px;
    background: #f9f9f9; /* Light grey background */
}
.section-box h4 {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}
.form-check {
    display: flex;
    align-items: center;
}

.form-check-input {
    transform: scale(1.1); 
}

</style>

<?php
    $cat_id = request()->get('cat_id');
    $sub_cat_id = request()->get('sub_cat_id');
   
?>

<!-- Page Title -->
<section  class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            <div class="content-box centred mr-0">
                <div class="title">
                    <h1>Dashboard</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="<?php echo e(route('/')); ?>">Home</a></li>
                    <li>Dashboard</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

        <section class="dash-header-part mb-4">
                    <div class="container" >
                        <div class="dash-header-card"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-height:230px; height:auto" >
                            <div class="row">
                                <div class="col-lg-5">
                                <div class="dash-header-left">
                                    <div class="dash-avatar">
                                        <?php if(Auth::check() && Auth::user()->profileImage): ?> 
                                            <a href="#"><img src="<?php echo e(asset('storage/profile_images/' . Auth::user()->profileImage)); ?>" 
                                            alt="user"></a>
                                        <?php else: ?>
                                            <a href="#"><img src="<?php echo e(asset('web/images/user.png')); ?>" alt="user"></a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="dash-intro">
                                        <h4><a href="#"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></a></h4>
                                        <h5><?php echo e(Auth::user()->email); ?></h5>

                                        <ul class="dash-meta">
                                            <li>
                                                <i class="fas fa-phone"></i>
                                                <span><?php echo e(Auth::user()->phone_number); ?></span>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope"></i>
                                                <span><?php echo e(Auth::user()->email); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                <div class="col-lg-7">
                    <div class="dash-header-right">
                        <div class="dash-focus dash-list">
                            <h2>Post</h2>
                            <p>Your Ads</p>
                        </div>
                        <div class="dash-focus dash-book">
                            <h2>Need</h2>
                            <p> To Buy</p>
                        </div>
                        <div class="dash-focus dash-rev">
                            <h2>Boost</h2>
                            <p>Your Ads'</p>
                        </div>
                    </div>
                </div>
            </div>
      
            

                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash-menu-list">
                            <ul>
                                <li><a href="<?php echo e(route('user.dashboard')); ?>">dashboard</a></li>
                                <li><a class="active" href="<?php echo e(route('user.ad_posts')); ?>">ad post</a></li>
                                <li><a href="<?php echo e(route('user.my_ads')); ?>" >my ads</a></li>
                                <li><a href="<?php echo e(route('user.profile')); ?>">Profile</a></li>
                                <li><a href="#">Message</a></li>
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     
<div class="setting-part">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
            <div class="account-card alert fade show p-4" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

                    <?php if(isset($message)): ?>
                        <div class="alert alert-success" role="alert" style="padding: 12px 12px;margin-bottom: 24px;">
                            <?php echo e($message); ?>

                        </div>
                    <?php endif; ?>
                    <form action="<?php echo e(route('user.ad_posts.store')); ?>?cat_id=<?php echo e($cat_id); ?>&sub_cat_id=<?php echo e($sub_cat_id); ?>&location=<?php echo e($location); ?>&sublocation=<?php echo e($sublocation); ?>"
                     method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="userId" value="">

                    <div class="row">
                        
                    <!-- Product Details -->
                    <div class="col-lg-12 mb-3">
                    <div class="section-box">
                            <h4>Product Details</h4>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Product Title</strong></label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Price</strong></label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Ad Description</strong></label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Upload Main Image</strong></label>
                                <input type="file" name="main_image" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Upload Sub Images</strong></label>
                                <input type="file" name="sub_images[]" class="form-control" multiple>
                            </div>
                        </div>
                        </div>
                        </div>

                     <!-- category Information -->
                     <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <div class="d-flex flex-wrap gap-3">
                               <!-- Brand -->
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label text-dark"><strong>Brand</strong></label>
                                        <select id="brand" name="brand" class="form-control custom-select">
                                            <option value="">Select Brand</option>
                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($brand->id); ?>" <?php if(request()->brand == $brand->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($brand->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Model -->
                                <div class="col-lg-6 mb-3">
                                    <div class="form-group">
                                        <label class="form-label text-dark"><strong>Model</strong></label>
                                        <select id="model" name="model" class="form-control custom-select">
                                            <option value="">Select Model</option>
                                            <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($model->id); ?>" <?php if(request()->model == $model->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($model->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="section-box">
                            <label class="form-label text-dark"><strong>Product Condition</strong></label>
                            <div class="d-flex">
                                <?php $__currentLoopData = ['New', 'Used']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="condition" value="<?php echo e($option); ?>" >
                                        <label class="form-check-label"  style="margin-right:15px"><?php echo e($option); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>Additional Information</strong></label>
                                <!-- Render the form fields -->
                                <?php $__currentLoopData = $formFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group">
                                        <label for="field_<?php echo e($field->id); ?>"><?php echo e($field->field_name); ?></label>
                                        
                                        <!-- Check field type and render appropriate input box -->
                                        <?php if($field->field_type == 'text'): ?>
                                            <input type="text" id="field_<?php echo e($field->id); ?>" name="field_<?php echo e($field->id); ?>" class="form-control" >
                                        <?php elseif($field->field_type == 'number'): ?>
                                            <input type="number" id="field_<?php echo e($field->id); ?>" name="field_<?php echo e($field->id); ?>" class="form-control" >
                                        <?php elseif($field->field_type == 'email'): ?>
                                            <input type="email" id="field_<?php echo e($field->id); ?>" name="field_<?php echo e($field->id); ?>" class="form-control" >
                                        <?php elseif($field->field_type == 'textarea'): ?>
                                            <textarea id="field_<?php echo e($field->id); ?>" name="field_<?php echo e($field->id); ?>" class="form-control" ></textarea>
                                        <?php elseif($field->field_type == 'select'): ?>
                                            <select id="field_<?php echo e($field->id); ?>" name="field_<?php echo e($field->id); ?>" class="form-control" >
                                                <option value="">Select</option>
                                                <!-- Options should be fetched dynamically if needed -->
                                            </select>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                   
              <!-- Pricing Type -->
                <div class="col-lg-12 mb-3">
                    <div class="section-box">
                        <h4>Pricing Type</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            <?php $__currentLoopData = ['Fixed', 'Negotiable', 'Daily', 'Weekly', 'Monthly', 'Yearly']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="pricing_type" value="<?php echo e($option); ?>" >
                                    <label class="form-check-label" style="margin-right:15px"><?php echo e($option); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>


                  
                    <!-- Post Type -->
                        <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>Post Type</strong></label>
                            <div class="d-flex">
                                <?php $__currentLoopData = ['Booking', 'Sale', 'Rent']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="post_type" value="<?php echo e($option); ?>" >
                                        <label class="form-check-label"  style="margin-right:15px"><?php echo e($option); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="section-box">
                                <h4>Boosting Option</h4>
                                
                                <!-- Package Selection -->
                                <div class="mb-3">
                                    <h5 class="mb-2">Select a Package:</h5>
                                    
                                    <!-- Free Ad Option -->
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="boosting_option" id="package_free" value="0" checked>
                                        <label class="form-check-label text-dark" for="package_free">
                                            <h5>Free Ad</h5>
                                        </label>
                                    </div>

                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="radio" name="boosting_option" id="package_<?php echo e($package->id); ?>" value="<?php echo e($package->id); ?>">
                                            <label class="form-check-label text-dark" for="package_<?php echo e($package->id); ?>">
                                                <h5><?php echo e($package->name); ?></h5>
                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <div id="package-types" class="d-none">
                                    <h4>Select Package Type:</h4>
                                    <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="package-types-for-<?php echo e($package->id); ?> d-none">
                                            <?php $__currentLoopData = $package->packageTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packageType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="radio" name="package_type" id="packageType_<?php echo e($packageType->id); ?>" value="<?php echo e($packageType->id); ?>">
                                                    <label class="form-check-label text-dark" for="packageType_<?php echo e($packageType->id); ?>">
                                                        <?php echo e($packageType->duration); ?> (LKR <?php echo e(number_format($packageType->price, 2)); ?>)
                                                    </label>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>


                    <div class="col-lg-12 mt-4">
                        <button type="submit" class="theme-btn-one">
                            <i class="fas fa-check"></i>
                            <span>Publish Your Ad</span>
                        </button>
                    </div>
                </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
 $(document).ready(function() {
    let urlParams = new URLSearchParams(window.location.search);
    let catId = urlParams.get('cat_id');
    let subCatId = urlParams.get('sub_cat_id');
    let selectedBrandId = "<?php echo e(request()->brand); ?>"; // Get pre-selected brand from request
    let selectedModelId = "<?php echo e(request()->model); ?>"; // Get pre-selected model from request

    // Function to Fetch Brands
    function fetchBrands(subCatId) {
        if (subCatId) {
            $.ajax({
                url: "<?php echo e(route('get.brands')); ?>",
                type: "GET",
                data: { subcategory_id: subCatId },
                success: function(data) {
                    $('#brand').html('<option value="">Select Brand</option>');
                    $.each(data, function(key, value) {
                        let selected = selectedBrandId == value.id ? "selected" : "";
                        $('#brand').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                    });

                    // If a brand is pre-selected, fetch models for it
                    if (selectedBrandId) {
                        fetchModels(selectedBrandId);
                    }
                }
            });
        }
    }

    function fetchModels(brandId, subCatId) {
    if (brandId && subCatId) {
        $.ajax({
            url: "<?php echo e(route('get.models')); ?>",
            type: "GET",
            data: { brand_id: brandId, sub_cat_id: subCatId },
            success: function(data) {
                $('#model').html('<option value="">Select Model</option>');
                $.each(data, function(key, value) {
                    let selected = selectedModelId == value.id ? "selected" : "";
                    $('#model').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                });
            },
            error: function(response) {
                console.log('Error:', response);
            }
        });
    }
}




    // Auto-fetch brands if category and subcategory exist in URL
    if (subCatId) {
        fetchBrands(subCatId);
    }

    // Fetch Models when Brand is selected
    $('#brand').change(function() {
        let brandId = $(this).val();
        fetchModels(brandId);
    });

    // If brand is already selected (from request), fetch its models
    if (selectedBrandId) {
        fetchModels(selectedBrandId);
    }
});



</script>

<script>
    // Show package types based on selected package
    document.querySelectorAll('input[name="boosting_option"]').forEach(packageRadio => {
        packageRadio.addEventListener('change', function() {
            // Hide all package types first
            document.querySelectorAll('[class^="package-types-for-"]').forEach(element => {
                element.classList.add('d-none');
            });

            // Show package types for the selected package
            const selectedPackageId = this.value;
            document.querySelector('.package-types-for-' + selectedPackageId).classList.remove('d-none');
            document.getElementById('package-types').classList.remove('d-none');
        });
    });
</script>




<?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/user/ad_posts.blade.php ENDPATH**/ ?>