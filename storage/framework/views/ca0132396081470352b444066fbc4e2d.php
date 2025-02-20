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
                    <form class="setting-form" method="POST" action="<?php echo e(route('user.ad_posts')); ?>" enctype="multipart/form-data">
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
                               <?php
                               $cat_id = request()->get('cat_id');
                           ?>
                           
                           <?php if($cat_id == 1 || $cat_id == 4): ?>
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
                           <?php endif; ?>
                           


                            </div>
                            <div class="section-box">
                            <label class="form-label text-dark"><strong>Product Condition</strong></label>
                            <div class="d-flex">
                                <?php $__currentLoopData = ['New', 'Used']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="condition" value="<?php echo e($option); ?>" required>
                                        <label class="form-check-label"  style="margin-right:15px"><?php echo e($option); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    
              <div class="col-lg-12 mb-3">
                 <?php if($cat_id == 1): ?>
                        <?php if (isset($component)) { $__componentOriginalb1a05082315ff853f6fd2bc732a34502 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb1a05082315ff853f6fd2bc732a34502 = $attributes; } ?>
<?php $component = App\View\Components\AdditionaElectroniclInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additiona-electronicl-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionaElectroniclInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['cat_id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cat_id),'sub_cat_id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sub_cat_id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb1a05082315ff853f6fd2bc732a34502)): ?>
<?php $attributes = $__attributesOriginalb1a05082315ff853f6fd2bc732a34502; ?>
<?php unset($__attributesOriginalb1a05082315ff853f6fd2bc732a34502); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb1a05082315ff853f6fd2bc732a34502)): ?>
<?php $component = $__componentOriginalb1a05082315ff853f6fd2bc732a34502; ?>
<?php unset($__componentOriginalb1a05082315ff853f6fd2bc732a34502); ?>
<?php endif; ?>
                    <?php elseif($cat_id == 4): ?>
                        <?php if (isset($component)) { $__componentOriginalbebab527d3d69ec2f3e7c53e46d7f6a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbebab527d3d69ec2f3e7c53e46d7f6a6 = $attributes; } ?>
<?php $component = App\View\Components\AdditionalVehiclesInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-vehicles-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalVehiclesInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbebab527d3d69ec2f3e7c53e46d7f6a6)): ?>
<?php $attributes = $__attributesOriginalbebab527d3d69ec2f3e7c53e46d7f6a6; ?>
<?php unset($__attributesOriginalbebab527d3d69ec2f3e7c53e46d7f6a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbebab527d3d69ec2f3e7c53e46d7f6a6)): ?>
<?php $component = $__componentOriginalbebab527d3d69ec2f3e7c53e46d7f6a6; ?>
<?php unset($__componentOriginalbebab527d3d69ec2f3e7c53e46d7f6a6); ?>
<?php endif; ?>
                    <?php elseif($cat_id == 20): ?>
                        <?php if (isset($component)) { $__componentOriginal0966d50e939274fec53bed6db04a35fe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0966d50e939274fec53bed6db04a35fe = $attributes; } ?>
<?php $component = App\View\Components\AdditionalHomeAndLandInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-home-and-land-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalHomeAndLandInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0966d50e939274fec53bed6db04a35fe)): ?>
<?php $attributes = $__attributesOriginal0966d50e939274fec53bed6db04a35fe; ?>
<?php unset($__attributesOriginal0966d50e939274fec53bed6db04a35fe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0966d50e939274fec53bed6db04a35fe)): ?>
<?php $component = $__componentOriginal0966d50e939274fec53bed6db04a35fe; ?>
<?php unset($__componentOriginal0966d50e939274fec53bed6db04a35fe); ?>
<?php endif; ?>
                    <?php elseif($cat_id == 35): ?>
                        <?php if (isset($component)) { $__componentOriginala582f321ec8ddc8f8c9fe00ec50c96e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala582f321ec8ddc8f8c9fe00ec50c96e4 = $attributes; } ?>
<?php $component = App\View\Components\AdditionalHomeAndGardenInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-home-and-garden-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalHomeAndGardenInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala582f321ec8ddc8f8c9fe00ec50c96e4)): ?>
<?php $attributes = $__attributesOriginala582f321ec8ddc8f8c9fe00ec50c96e4; ?>
<?php unset($__attributesOriginala582f321ec8ddc8f8c9fe00ec50c96e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala582f321ec8ddc8f8c9fe00ec50c96e4)): ?>
<?php $component = $__componentOriginala582f321ec8ddc8f8c9fe00ec50c96e4; ?>
<?php unset($__componentOriginala582f321ec8ddc8f8c9fe00ec50c96e4); ?>
<?php endif; ?>
                    <?php elseif($cat_id == 43): ?>
                        <?php if (isset($component)) { $__componentOriginal929dd540b381a4241484fe02f00171cf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal929dd540b381a4241484fe02f00171cf = $attributes; } ?>
<?php $component = App\View\Components\AdditionalPetInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-pet-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalPetInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal929dd540b381a4241484fe02f00171cf)): ?>
<?php $attributes = $__attributesOriginal929dd540b381a4241484fe02f00171cf; ?>
<?php unset($__attributesOriginal929dd540b381a4241484fe02f00171cf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal929dd540b381a4241484fe02f00171cf)): ?>
<?php $component = $__componentOriginal929dd540b381a4241484fe02f00171cf; ?>
<?php unset($__componentOriginal929dd540b381a4241484fe02f00171cf); ?>
<?php endif; ?>
                    <?php elseif($cat_id == 50): ?>
                        <?php if (isset($component)) { $__componentOriginalf3a7e84930c43275afae25449f6acc77 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf3a7e84930c43275afae25449f6acc77 = $attributes; } ?>
<?php $component = App\View\Components\AdditionalServicesInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-services-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalServicesInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf3a7e84930c43275afae25449f6acc77)): ?>
<?php $attributes = $__attributesOriginalf3a7e84930c43275afae25449f6acc77; ?>
<?php unset($__attributesOriginalf3a7e84930c43275afae25449f6acc77); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf3a7e84930c43275afae25449f6acc77)): ?>
<?php $component = $__componentOriginalf3a7e84930c43275afae25449f6acc77; ?>
<?php unset($__componentOriginalf3a7e84930c43275afae25449f6acc77); ?>
<?php endif; ?>    
                    <?php elseif($cat_id == 57): ?>
                        <?php if (isset($component)) { $__componentOriginal54d9fbf215fd1e69aa0567eea759bd25 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54d9fbf215fd1e69aa0567eea759bd25 = $attributes; } ?>
<?php $component = App\View\Components\AdditionalBusinessAndIndustryInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-business-and-industry-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalBusinessAndIndustryInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54d9fbf215fd1e69aa0567eea759bd25)): ?>
<?php $attributes = $__attributesOriginal54d9fbf215fd1e69aa0567eea759bd25; ?>
<?php unset($__attributesOriginal54d9fbf215fd1e69aa0567eea759bd25); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54d9fbf215fd1e69aa0567eea759bd25)): ?>
<?php $component = $__componentOriginal54d9fbf215fd1e69aa0567eea759bd25; ?>
<?php unset($__componentOriginal54d9fbf215fd1e69aa0567eea759bd25); ?>
<?php endif; ?>
                    <?php elseif($cat_id == 65): ?>
                        <?php if (isset($component)) { $__componentOriginal285efd2c99167888d8554656673e2df6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal285efd2c99167888d8554656673e2df6 = $attributes; } ?>
<?php $component = App\View\Components\AdditionalLeisureKidsInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-leisure-kids-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalLeisureKidsInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal285efd2c99167888d8554656673e2df6)): ?>
<?php $attributes = $__attributesOriginal285efd2c99167888d8554656673e2df6; ?>
<?php unset($__attributesOriginal285efd2c99167888d8554656673e2df6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal285efd2c99167888d8554656673e2df6)): ?>
<?php $component = $__componentOriginal285efd2c99167888d8554656673e2df6; ?>
<?php unset($__componentOriginal285efd2c99167888d8554656673e2df6); ?>
<?php endif; ?>       
                    <?php elseif($cat_id == 74): ?>
                        <?php if (isset($component)) { $__componentOriginal472b4ff51dffa7cccb3969725f91524f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal472b4ff51dffa7cccb3969725f91524f = $attributes; } ?>
<?php $component = App\View\Components\AdditionalFancyAndCosmeticsInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-fancy-and-cosmetics-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalFancyAndCosmeticsInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal472b4ff51dffa7cccb3969725f91524f)): ?>
<?php $attributes = $__attributesOriginal472b4ff51dffa7cccb3969725f91524f; ?>
<?php unset($__attributesOriginal472b4ff51dffa7cccb3969725f91524f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal472b4ff51dffa7cccb3969725f91524f)): ?>
<?php $component = $__componentOriginal472b4ff51dffa7cccb3969725f91524f; ?>
<?php unset($__componentOriginal472b4ff51dffa7cccb3969725f91524f); ?>
<?php endif; ?> 
                    <?php elseif($cat_id == 84): ?>
                        <?php if (isset($component)) { $__componentOriginale155920dc7a390c884a615935de8db29 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale155920dc7a390c884a615935de8db29 = $attributes; } ?>
<?php $component = App\View\Components\AdditionalDailyEssentialsInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-daily-essentials-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalDailyEssentialsInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale155920dc7a390c884a615935de8db29)): ?>
<?php $attributes = $__attributesOriginale155920dc7a390c884a615935de8db29; ?>
<?php unset($__attributesOriginale155920dc7a390c884a615935de8db29); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale155920dc7a390c884a615935de8db29)): ?>
<?php $component = $__componentOriginale155920dc7a390c884a615935de8db29; ?>
<?php unset($__componentOriginale155920dc7a390c884a615935de8db29); ?>
<?php endif; ?>     
                    <?php elseif($cat_id == 93): ?>
                        <?php if (isset($component)) { $__componentOriginalae91af77194b99e8bf6595782a388e33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalae91af77194b99e8bf6595782a388e33 = $attributes; } ?>
<?php $component = App\View\Components\AdditionalEducationInformation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('additional-education-information'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdditionalEducationInformation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalae91af77194b99e8bf6595782a388e33)): ?>
<?php $attributes = $__attributesOriginalae91af77194b99e8bf6595782a388e33; ?>
<?php unset($__attributesOriginalae91af77194b99e8bf6595782a388e33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalae91af77194b99e8bf6595782a388e33)): ?>
<?php $component = $__componentOriginalae91af77194b99e8bf6595782a388e33; ?>
<?php unset($__componentOriginalae91af77194b99e8bf6595782a388e33); ?>
<?php endif; ?>             
                    <?php endif; ?>

              </div>
                   
              <!-- Pricing Type -->
                <div class="col-lg-12 mb-3">
                    <div class="section-box">
                        <h4>Pricing Type</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            <?php $__currentLoopData = ['Fixed', 'Negotiable', 'Daily', 'Weekly', 'Monthly', 'Yearly']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="pricing_type" value="<?php echo e($option); ?>" required>
                                    <label class="form-check-label" style="margin-right:15px"><?php echo e($option); ?></label>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>


                  
                    <!-- Ad Type -->
                        <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>Ad Type</strong></label>
                            <div class="d-flex">
                                <?php $__currentLoopData = ['Booking', 'Sale', 'Rent']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="ad_type" value="<?php echo e($option); ?>" required>
                                        <label class="form-check-label"  style="margin-right:15px"><?php echo e($option); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            </div>
                        </div>

                    <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <h4>Boosting Option</h4>

                            <!-- Free Ad Option -->
                            <div class="d-flex align-items-center mb-2">
                            <div class="form-check me-3">
                                <input class="form-check-input me-2" type="radio" name="boosting_option" id="freeAd" value="free" checked>
                                <label class="form-check-label text-dark" for="freeAd">Free Ad</label>
                            </div>
                            </div>

                            <!-- Top Ads Section -->
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Left: Radio Options -->
                                <div>
                                    <h5 class="mt-3 mb-2">Top Ads</h5>
                                    <div class="d-flex flex-column gap-3">

                                        <!-- 3 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="topAd3" value="3_days">
                                                <label class="form-check-label text-dark" for="topAd3">
                                                    3 DAYS (LKR 500.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 7 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="topAd7" value="7_days">
                                                <label class="form-check-label text-dark" for="topAd7">
                                                    7 DAYS (LKR 1400.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 15 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="topAd15" value="15_days">
                                                <label class="form-check-label text-dark" for="topAd15">
                                                    15 DAYS (LKR 1800.00)
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Right: Description Text -->
                                <div class="text-muted ms-4 mb-3" style="max-width: 50%;">
                                    <p>At every page, there are 4 top slots available for top ads.</p>
                                    <p>If you apply for top ads, your ad will appear on top of those slots, increasing responses.</p>
                                    <p>Top ads are bigger than free ads, with a green blinking border for more visibility.</p>
                                </div>

                            </div>

                             <!-- urgent Ads Section -->
                             <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mt-3 mb-2">Urgent Ads</h5>
                                    <div class="d-flex flex-column gap-3">

                                        <!-- 3 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="urgentAd3" value="3_days">
                                                <label class="form-check-label text-dark" for="urgentAd3">
                                                    3 DAYS (LKR 700.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 7 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="urgentAd7" value="7_days">
                                                <label class="form-check-label text-dark" for="urgentAd7">
                                                    7 DAYS (LKR 800.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 15 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="urgentAd15" value="15_days">
                                                <label class="form-check-label text-dark" for="urgentAd15">
                                                    15 DAYS (LKR 900.00)
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="text-muted ms-4 mt-4 mb-3" style="max-width: 50%;">
                                    <p>We have some special promotion for sell urgently</p>
                                    <p>Urgent ads border blink in bright RED color also urgent badge which is great advantage to get more attention quickly.</p>
                                </div>
                            </div>

                             <!-- Super Ads Section -->
                             <div class="d-flex justify-content-between align-items-start mt-4">
                                <div>
                                    <h5 class="mt-3 mb-2">Super Ads</h5>
                                    <div class="d-flex flex-column gap-3">

                                        <!-- 3 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="superAd3" value="3_days">
                                                <label class="form-check-label text-dark" for="superAd3">
                                                    3 DAYS (LKR 2400.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 7 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="superAd7" value="7_days">
                                                <label class="form-check-label text-dark" for="superAd7">
                                                    7 DAYS (LKR 3000.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 15 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="superAd15" value="15_days">
                                                <label class="form-check-label text-dark" for="superAd15">
                                                    15 DAYS (LKR 3500.00)
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="text-muted ms-4 mt-4" style="max-width: 50%;">
                                    <p>Super adds specially designed to get immediate attention from buyers as soon as log into adds listing page.</p>
                                    <p>Super adds has given premium slot of top of the adds listing with highlighted blue 
                                        blinking border around and rocket symbol, which attract buyers as soon as add promoted to super add.</p>
                                    <p>Super adds also visible as a free add is an extra advantage.</p>
                                </div>
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


<?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/user/ad_posts.blade.php ENDPATH**/ ?>