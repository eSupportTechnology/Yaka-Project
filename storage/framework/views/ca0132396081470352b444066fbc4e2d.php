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
</style>

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
                                <li><a >my ads</a></li>
                                <li><a href="<?php echo e(route('user.profile')); ?>">Profile</a></li>
                                <li><a href="">message</a></li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
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
                    <form class="setting-form" method="POST" action="<?php echo e(route('user.ad_posts')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="userId" value="">

                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="section-box">
                                <h4>Product Categories</h4>

                                <!-- Main Category -->
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label text-dark"><strong>Main Category</strong></label>
                                        <select id="category" name="id" class="form-control custom-select" onchange="this.form.submit()">
                                            <option value="">Select Category</option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>" <?php if(request()->id == $category->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($category->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Sub Category -->
                                <div class="col-lg-12 mb-3">
                                    <div class="form-group">
                                        <label class="form-label text-dark"><strong>Sub Category</strong></label>
                                        <select id="subcategory" name="subcategory_id" class="form-control custom-select" onchange="this.form.submit()">
                                            <option value="">Select Subcategory</option>
                                            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($subcategory->id); ?>" <?php if(request()->subcategory_id == $subcategory->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($subcategory->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Brand -->
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-dark"><strong>Brand</strong></label>
                                            <select id="brand" name="brand" class="form-control custom-select" onchange="this.form.submit()">
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

                            </div>
                        </div>

                    
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
                    <hr>
                    
                    <!-- Pricing Type -->
                        <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <h4>Pricing Type</h4>
                            <div class="d-flex flex-wrap">
                                <?php $__currentLoopData = ['Fixed', 'Negotiable', 'Daily', 'Weekly', 'Monthly', 'Yearly']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="pricing_type" value="<?php echo e($option); ?>" required>
                                        <label class="form-check-label"><?php echo e($option); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        </div>
                    <hr>
                    
                    <!-- Ad Description -->
                  
                 
                    <hr>
                    
                    <!-- Ad Type -->
                        <div class="col-lg-12 mb-3">
                            <label class="form-label text-dark"><strong>Ad Type</strong></label>
                            <div class="d-flex">
                                <?php $__currentLoopData = ['Booking', 'Sale', 'Rent']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="ad_type" value="<?php echo e($option); ?>" required>
                                        <label class="form-check-label"><?php echo e($option); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <hr>
                    
                    <!-- Product Condition -->
                        <div class="col-lg-12 mb-3">
                            <label class="form-label text-dark"><strong>Product Condition</strong></label>
                            <div class="d-flex">
                                <?php $__currentLoopData = ['New', 'Used']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="condition" value="<?php echo e($option); ?>" required>
                                        <label class="form-check-label"><?php echo e($option); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <hr>
                    
                   
                    
                    
                  
                        <div class="col-lg-6 mb-3">
                        <h4> Location Information </H4>
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>District</strong></label>
                                <select name="district" class="form-control custom-select">
                                    <option value="">Select District</option>
                                    
                                        <option value=""></option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>City</strong></label>
                                <select name="city" class="form-control custom-select">
                                    <option value="">Select City</option>
                                  
                        <option value=""></option>
                   
                </select>
        
        </div>
    </div>
    <hr>
    
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
    // Fetch Brands when Subcategory is selected
    $('#subcategory').change(function() {
        let subcategoryId = $(this).val();
        if (subcategoryId) {
            $.ajax({
                url: "<?php echo e(route('get.brands')); ?>",
                type: "GET",
                data: { subcategory_id: subcategoryId },
                success: function(data) {
                    $('#brand').html('<option value="">Select Brand</option>');
                    $.each(data, function(key, value) {
                        $('#brand').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('#model').html('<option value="">Select Model</option>'); // Reset models
                }
            });
        } else {
            $('#brand').html('<option value="">Select Brand</option>');
            $('#model').html('<option value="">Select Model</option>');
        }
    });

    // Fetch Models when Brand is selected
    $('#brand').change(function() {
        let brandId = $(this).val();
        if (brandId) {
            $.ajax({
                url: "<?php echo e(route('get.models')); ?>",
                type: "GET",
                data: { brand_id: brandId },
                success: function(data) {
                    $('#model').html('<option value="">Select Model</option>');
                    $.each(data, function(key, value) {
                        $('#model').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#model').html('<option value="">Select Model</option>');
        }
    });
});


</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/user/ad_posts.blade.php ENDPATH**/ ?>