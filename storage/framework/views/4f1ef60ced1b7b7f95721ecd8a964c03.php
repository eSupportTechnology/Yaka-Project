<?php $__env->startSection('content'); ?>





<style>
    .view-count-container {
        position: absolute;
        top: 10px;
        right: 10px;
        color: black;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 18px;
        display: flex;
        align-items: center;
    }

    .view-count-container i {
        margin-right: 5px;
    }
    .icon-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 16px;
    flex-shrink: 0;
}

.text-wrap {
    word-wrap: break-word; 
    overflow-wrap: break-word;
    word-break: break-word;
    white-space: normal; 
    flex-grow: 1; 
}

.d-flex {
    flex-wrap: wrap; 
}


</style>

        <!-- browse-add-details -->
    
        <div class="auto-container">
            <div class="mt-3 mb-4 col-md-12 d-flex justify-content-center">
                <?php
                $banner = $banners->isNotEmpty() ? $banners->random() : null; 
                ?>

                <?php if($banner): ?>
                    <div class="banner">
                        <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" style="" alt="Banner Image" class="img-fluid banner-img">
                    </div>
                <?php endif; ?>
            </div>


                <div class="clearfix row">
                    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                        <div class="add-details-content">
                        <div class="content-one single-box">
                            <div class="text">
                                <!-- Ad Title and Details -->
                                <h3 class="mb-0"><?php echo e($ad->title); ?></h3>  
                                <p class="fw-bold">
                                    Posted on <?php echo e(\Carbon\Carbon::parse($ad->created_at)->format('d M Y g:i a')); ?>,
                                    <?php echo e($ad->sub_location ? $ad->sub_location->name_en : 'N/A'); ?>,
                                    <?php echo e($ad->main_location ? $ad->main_location->name_en : 'N/A'); ?>,
                                </p>
                            </div>

                            <div class="view-count-container">
                                <i class="fas fa-eye" style="color:rgb(176, 5, 5)"></i> 
                                <span><?php echo e($ad->view_counr); ?> Views </span>
                            </div>

                        </div>


                        <div class="content-two single-box">
                            <div class="bxslider">
                                   
                                    <div class="slider-content">
                                        <div class="product-image">
                                        <figure class="image">
                                            <img src="<?php echo e(asset('images/Ads/' . $ad->mainImage)); ?>" alt="Main Image">
                                        </figure>
                                        </div>
                                        <?php if(!empty($subImages) && is_array($subImages)): ?>
                                            <div class="slider-pager">
                                                <ul class="clearfix thumb-box">
                                                    <?php $__currentLoopData = $subImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subImage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li>
                                                            <a data-slide-index="<?php echo e($index); ?>" href="#">
                                                                <figure>
                                                                    <img src="<?php echo e(asset('images/' . $subImage)); ?>" alt="Thumbnail <?php echo e($index + 1); ?>">
                                                                </figure>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="content-one single-box">
                                <div class="text">
                                    <h3 style="color:rgb(176, 5, 5)">Rs <?php echo e($ad->price); ?></h3>
                                    <h6>Product Description</h6>
                                    <p><?php echo e($ad->description); ?></p>
                                </div>
                            </div>
                           
                           
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                            <div class="sidebar-search sidebar-widget">
                            <div class="widget-content">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Share Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="shareDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-share-alt"></i> Share
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="shareDropdown">
                                            <li>
                                                <a class="dropdown-item" 
                                                href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(route('ads.details', ['adsId' => $ad->adsId]))); ?>" 
                                                target="_blank">
                                                    <i class="fab fa-facebook"></i> Facebook
                                                </a>
                                            </li>
                                            <li>
                                            <a class="dropdown-item" 
                                                href="https://api.whatsapp.com/send?text=<?php echo e(urlencode($ad->title)); ?>%0A%0A<?php echo e(urlencode($ad->description)); ?>%0A%0A🔗 <?php echo e(urlencode(route('ads.details', ['adsId' => $ad->adsId]))); ?>" 
                                                target="_blank">
                                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Boost Ad Button -->
                                    <a href="<?php echo e(route('ads.boost', ['ad_id' => $ad->adsId])); ?>" class="btn btn-warning align-items-center">
                                        <i class="fas fa-rocket"></i> Boost this ad
                                    </a>
                                </div>

                                <div class="p-3 mt-3 user-details">
                                    <h5 class="mb-3 text-primary fw-bold">Posted by:</h5>

                                    <div class="mb-3 d-flex align-items-center">
                                        <div class="text-white icon-circle bg-danger">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <strong class="w-25">Name:</strong> 
                                        <span class="text-wrap"><?php echo e($ad->user->name ?? 'N/A'); ?></span>
                                    </div>
                                    <hr class="my-2">

                                    <div class="mb-3 d-flex align-items-center">
                                        <div class="text-white icon-circle bg-success">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <strong class="w-25">Email:</strong> 
                                        <span class="text-wrap"><?php echo e($ad->user->email ?? 'N/A'); ?></span>
                                    </div>

                                    <hr class="my-2">

                                    <div class="d-flex align-items-center">
                                        <div class="text-white icon-circle bg-primary">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <strong class="w-25">Phone:</strong> 
                                        <span class="flex-grow-1 text-wrap"><?php echo e($ad->user->phone_number ?? 'N/A'); ?></span>
                                    </div>
                                </div>



                            </div>

                            </div>
                        </div>
                        <div class="mt-3 mb-4 col-md-12 d-flex justify-content-center">
                            <?php
                            $otherbanners = $otherbanners->isNotEmpty() ? $otherbanners->random() : null; 
                            ?>

                            <?php if($banner): ?>
                                <div class="banner">
                                    <img src="<?php echo e(asset('banners/' . $otherbanners->img)); ?>" style="width:510px" alt="Banner Image" class="img-fluid banner-img">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
  


      <!-- Related Ads -->
<section class="related-ads">
    <div class="auto-container">
        <div class="sec-title">
            <span>Related Ads</span>
        </div>
        <div class="four-item-carousel owl-carousel owl-theme owl-nav-none dots-style-one">
            <?php $__currentLoopData = $relatedAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedAd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('ads.details', ['adsId' => $relatedAd->adsId])); ?>" style="display: block; height: 100%; text-decoration: none;">
                    <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%; width: 100%;">
                        <div class="inner-box" style="display: flex; flex-direction: column; height: 100%; justify-content: space-between;">
                            <div class="image-box" style="flex-grow: 0;">
                                <figure class="image">
                                    <img src="<?php echo e(asset('images/Ads/' . $relatedAd->main_image)); ?>" 
                                    style="height: 150px; object-fit: cover;" alt="<?php echo e($relatedAd->title); ?>">
                                </figure>

                                <?php if($relatedAd->ads_package == 4): ?>
                                    <div class="feature" style="background-color:rgb(172, 3, 3)">
                                        URGENT
                                    </div>
                                <?php elseif($relatedAd->ads_package == 5): ?>
                                    <div class="icon">
                                        <div class="icon-shape"></div>
                                        <i class=""><img src="<?php echo e(asset('02.png')); ?>" alt=""></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="lower-content" style="flex-grow: 1;">
                                <div class="category"><i class="fas fa-tags"></i> <p><?php echo e($relatedAd->category->name ?? 'N/A'); ?></p></div>
                                <h4><?php echo e($relatedAd->title); ?></h4>
                                <ul class="clearfix info">
                                    <li><i class="far fa-clock"></i><?php echo e($relatedAd->created_at->diffForHumans()); ?></li>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <?php echo e($relatedAd->main_location ? $relatedAd->main_location->name_en : 'N/A'); ?>

                                    </li>
                                </ul>
                                <div class="lower-box" style="margin-top: auto;">
                                    <h5>Rs <?php echo e(number_format($relatedAd->price, 2)); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- Related Ads End -->



<?php $__env->stopSection(); ?>
<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/browse-ads-details.blade.php ENDPATH**/ ?>