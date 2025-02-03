<?php $__env->startSection('content'); ?>


<style>
    /* Set a fixed height for the carousel */
    #adsCarousel .carousel-inner {
        height: 400px;
    }

    .carousel-item-content {
        position: relative;
        height: 100%;
    }

    /* Set a fixed height for the banner */
    .banner-img {
        height: 400px;
        object-fit: cover;
        width: 100%;
    }

    /* Dark overlay for carousel items */
    .carousel-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    /* Ensure text inside carousel is readable */
    .carousel-caption {
        bottom: 10%;
        left: 5%;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
    }

    .carousel-caption p{
        font-size:20px;
        color:white;

    }

    /* Top-left image for the carousel */
    .top-left-image {
        position: absolute;
        top: 10px;
        left: 10px;
        width: 70px;
        height: auto;
    }
</style>


     <!-- Page Title -->
    <section class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg);">
        <div class="auto-container">
            <div class="content-box centred mr-0">
                <div class="title">
                    <h1><?php echo e($category ? $category->name : 'All Categories'); ?></h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="<?php echo e(route('/')); ?>">Home</a></li>
                    <li>Browse Ads </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->



            <div class="auto-container mt-4 mb-4">
                <div class="row clearfix">

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                        <div class="sidebar-search sidebar-widget">
                            <div class="widget-title">
                                <h3>Search</h3>
                            </div>
                            <div class="widget-content">
                                <form action="<?php echo e(route('browse-ads')); ?>" method="GET" class="search-form">
                                    <div class="form-group">
                                        <input type="search" name="search-field" placeholder="Search Keyword..." value="<?php echo e(request()->input('search-field')); ?>" oninput="this.form.submit()">
                                        <button type="submit" style="display:none;"><i class="icon-2"></i></button>
                                    </div>
                                    <div class="form-group">
                                        <i class="icon-3"></i>
                                        <select class="wide" name="location" onchange="this.form.submit()">
                                            <option data-display="Select Location">Select Location</option>
                                            <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($district->id); ?>" <?php echo e(request()->input('location') == $district->id ? 'selected' : ''); ?>><?php echo e($district->name_en); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                            <div class="sidebar-category sidebar-widget">
                                <div class="widget-title">
                                    <h3>Category</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="category-list">
                                        <li>
                                            <label>
                                                <input type="radio" name="category" value="all"
                                                    onchange="window.location='<?php echo e(route('browse-ads')); ?>'"
                                                    <?php echo e(!request()->input('category') ? 'checked' : ''); ?>>
                                                    <span class="text-dark">All Categories</span>
                                        
                                            </label>
                                        </li>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="<?php echo e($category->subcategories->isNotEmpty() ? 'dropdown' : ''); ?>">
                                                <label>
                                                    <input type="radio" name="category" value="<?php echo e($category->id); ?>"
                                                        onchange="window.location='<?php echo e(route('browse-ads', ['category' => $category->id])); ?>'"
                                                        <?php echo e(request()->input('category') == $category->id ? 'checked' : ''); ?>>
                                                    <span><?php echo e($category->name); ?></span>
                                                </label>
                                                
                                                <?php if($category->subcategories->isNotEmpty()): ?>
                                                    <ul>
                                                        <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li>
                                                                <label>
                                                                    <input type="radio" name="subcategory" value="<?php echo e($subcategory->id); ?>"
                                                                        onchange="window.location='<?php echo e(route('browse-ads', ['category' => $category->id, 'subcategory' => $subcategory->id])); ?>'"
                                                                        <?php echo e(request()->input('subcategory') == $subcategory->id ? 'checked' : ''); ?>>
                                                                    <span><?php echo e($subcategory->name); ?></span>
                                                                </label>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <?php
                                    $banner = $banners->isNotEmpty() ? $banners->random() : null; 
                                ?>

                                <?php if($banner): ?>
                                    <div class="banner">
                                        <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="Banner Image" class="img-fluid banner-img">
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                        <div class="category-details-content">
                            <div class="item-shorting clearfix">
                                <div class="text pull-left">
                                    <h6>Buy, Sell, Rent or Find Anything in Sri Lanka</h6>
                                    <p><span>Search Results:</span> Showing <?php echo e($ads->firstItem()); ?>-<?php echo e($ads->lastItem()); ?> of <?php echo e($ads->total()); ?> Listings</p>
                                </div>
                                <div class="right-column pull-right clearfix">
                                </div>
                            </div>
                           


                            <div class="category-block wrapper grid browse-add">
                            <div class="row mb-4">
                            <!-- Carousel Slider for Ads (Column 1) -->
                                <div class="col-md-8">
                                    <div id="adsCarousel" class="carousel slide mb-2" data-bs-ride="carousel" data-bs-interval="2000">
                                        <!-- Indicators -->
                                        <div class="carousel-indicators">
                                            <?php $__currentLoopData = $urgentAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($ad->ads_package == 4): ?> <!-- Filter ads with ads_package = 3 -->
                                                    <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="<?php echo e($key); ?>" class="<?php echo e($key === 0 ? 'active' : ''); ?>" aria-current="<?php echo e($key === 0 ? 'true' : ''); ?>" aria-label="Slide <?php echo e($key + 1); ?>"></button>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <!-- Carousel Items -->
                                        <div class="carousel-inner">
                                            <?php $__currentLoopData = $urgentAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($ad->ads_package == 4): ?> <!-- Filter ads with ads_package = 3 -->
                                                    <div class="carousel-item <?php echo e($key === 0 ? 'active' : ''); ?>">
                                                        <!-- Wrap the entire content with an anchor tag -->
                                                        <a href="<?php echo e(route('ads.details', ['ad_id' => $ad->id])); ?>" style="display: block; height: 100%; text-decoration: none;">
                                                            <div class="carousel-item-content">
                                                                <!-- Image -->
                                                                <img src="<?php echo e(asset('images/Ads/' . $ad->mainImage)); ?>" class="d-block w-100" alt="<?php echo e($ad->title); ?>" style="min-height: 450px;height:auto; object-fit: cover;">
                                                                
                                                                <!-- Dark Overlay -->
                                                                <div class="carousel-overlay"></div>

                                                                <!-- Top-left image -->
                                                                <img src="<?php echo e(asset('3.png')); ?>" alt="Urgent Ad" class="top-left-image">

                                                                <!-- Ad Details Overlay -->
                                                                <div class="carousel-caption d-none d-md-block text-start">
                                                                    <p><?php echo e($ad->title); ?></p>
                                                                    <p>Rs <?php echo e(number_format($ad->price, 2)); ?></p>
                                                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo e($ad->main_location ? $ad->main_location->name_en : 'N/A'); ?></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <!-- Carousel Controls -->
                                        <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>



                                <!-- Banner (Column 2) -->
                                <div class="col-md-4">
                                    <?php
                                    $banner = $banners->isNotEmpty() ? $banners->random() : null; 
                                    ?>

                                    <?php if($banner): ?>
                                        <div class="banner">
                                            <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="Banner Image" class="img-fluid banner-img">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>


                              <!-- Grid Items -->
                            <div class="grid-item feature-style-two four-column pd-0" style="display: flex; flex-wrap: wrap;">
                                <div class="row clearfix" style="width: 100%; display: flex; flex-wrap: wrap; justify-content: space-between;">
                                <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block" style="display: flex; flex-direction: column; flex-grow: 1; margin-bottom: 30px;">
                                    <!-- Wrap the entire card content with the <a> tag -->
                                    <a href="<?php echo e(route('ads.details', ['ad_id' => $ad->id])); ?>" style="display: block; height: 100%; text-decoration: none;">
                                        <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%; width: 100%;">
                                            <div class="inner-box" style="display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                                                <div class="image-box" style="flex-grow: 0;">
                                                    <figure class="image">
                                                        <img src="<?php echo e(asset('images/Ads/' . $ad->mainImage)); ?>" 
                                                        style="height: 150px; object-fit: cover;" alt="<?php echo e($ad->title); ?>">
                                                    </figure>

                                                    <?php if($ad->ads_package == 3): ?>
                                                        <!-- top tag for ads with package = 3 -->
                                                         <div class="icon">
                                                            <div class="icon-shape"></div>
                                                            <i class=""> <img src="<?php echo e(asset('01.png')); ?>" alt="Top Ad"></i>
                                                        </div>
                                                    <?php elseif($ad->ads_package == 6): ?>
                                                        <!-- super ads icon for ads with package = 6 -->
                                                        <div class="icon">
                                                            <div class="icon-shape"></div>
                                                            <i class=""> <img src="<?php echo e(asset('02.png')); ?>" alt="Super Ad"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <div class="lower-content" style="flex-grow: 1;">
                                                    <div class="category"><i class="fas fa-tags"></i><p><?php echo e($ad->category->name); ?></p></div>
                                                    <h4><?php echo e($ad->title); ?></h4>
                                                    <ul class="info clearfix">
                                                        <li><i class="far fa-clock"></i><?php echo e($ad->created_at->diffForHumans()); ?></li>
                                                        <li>
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <?php echo e($ad->main_location ? $ad->main_location->name_en : 'N/A'); ?>

                                                        </li>
                                                    </ul>
                                                    <div class="lower-box" style="margin-top: auto;">
                                                        <h5>Rs <?php echo e(number_format($ad->price, 2)); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                            </div>

                            </div>

                            <!-- Pagination -->
                            <div class="pagination-wrapper centred">
                                <ul class="pagination clearfix">
                                    <?php if($ads->onFirstPage()): ?>
                                        <li class="disabled"><a href="#"><i class="far fa-angle-left"></i>Prev</a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo e($ads->previousPageUrl() . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory')); ?>"><i class="far fa-angle-left"></i>Prev</a></li>
                                    <?php endif; ?>

                                    <?php $__currentLoopData = $ads->getUrlRange(1, $ads->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e(($page == $ads->currentPage()) ? 'current' : ''); ?>">
                                            <a href="<?php echo e($url . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory')); ?>"><?php echo e($page); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if($ads->hasMorePages()): ?>
                                        <li><a href="<?php echo e($ads->nextPageUrl() . '&location=' . request('location') . '&category=' . request('category') . '&subcategory=' . request('subcategory')); ?>">Next<i class="far fa-angle-right"></i></a></li>
                                    <?php else: ?>
                                        <li class="disabled"><a href="#">Next<i class="far fa-angle-right"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                        </div>
                       

                </div>
            </div> 
 

<!-- Script to Initialize Carousel -->
<script>
    var myCarousel = document.querySelector('#adsCarousel');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 2000, // Set interval for auto sliding (5 seconds)
        ride: 'carousel' // Enable auto sliding
    });
</script>

        <?php $__env->stopSection(); ?>
<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/browse-ads.blade.php ENDPATH**/ ?>