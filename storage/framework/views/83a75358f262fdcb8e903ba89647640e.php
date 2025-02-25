<?php $__env->startSection('content'); ?>
  
<style>

.banner-section {
    background: linear-gradient(to bottom, rgb(102, 17, 17), rgb(171, 18, 18), rgb(253, 6, 6));
    padding: 30px;
    text-align: center;
    color: white;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.content-box {
    max-width: 80%;
    margin: auto;
}



/* Responsive adjustments */
@media (max-width: 768px) {
    .text h1 {
        font-size: 25px; 
    }

    .text p {
        font-size: 10px; 
    }

    .banner-section {
        height: auto;
        padding: 50px 20px;
    }
}

@media (max-width: 480px) {
    .text h1 {
        font-size: 15px;
    }

    .text p {
        font-size: 8px;
    }

    .banner-section {
        height: auto;
        padding: 40px 15px;
    }
}

       
.banner-container {
    width: 100%;
    background-color:#ffff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 0;
	margin-top: 30px;
    margin-bottom: 50px;
    
}

.banner {
    width: 80%;
    max-width: 1000px;
    height: 150px;
    background: url('banner-image.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: black;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    font-size: 24px;
    padding: 20px;
}

.banner-text {
    flex: 1;
    text-align: left;
}

.banner-logo {
    font-size: 40px;
    font-weight: bold;
}

.banner-hashtags {
    flex: 1;
    text-align: right;
    font-size: 18px;
}

.carousel-inner {
    height: 100%; /* Makes sure the carousel inner has a consistent height */
}

.carousel-item {
    height: 100%; /* Ensures each carousel item matches the container's height */
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}

@media (max-width: 768px) {
    .banner {
                flex-direction: column;
                height: auto;
                padding: 20px;
                text-align: center;
            }

    .banner-text, .banner-hashtags {
                text-align: center;
                font-size: 16px;
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

.cont{
    max-width: 1200px;
    margin: 20px auto;
    
}

.heading {
    font-size: 30px;
    color: #333;
    margin-bottom: 15px;
    text-align: left;
    margin-left:124px;
}

.heading span {
    color: red;
    font-weight: bold;
    font-size: 32px;  /* Font size increased */
    display: inline-block;
    padding: 5px 10px; 
    font-style: italic;
}

.top-banner { 
    display: flex;
    align-items: flex-start; /* Align content to the top */
    justify-content: flex-start; /* Align everything to the left */
    padding: 20px;
    position: relative; /* Ensure proper placement */
}

.top-banner .left { 
    flex: 1; /* Adjust size */
    margin-left: 150px; /* Adjust spacing without negative margins */
}

.top-banner .left img { 
    max-width: 400px; 
    max-height: 600px; 
    border-radius: 10px;
}
.super-banner .right img { 
    max-width: 50px; 
    max-height: 300px; 
    border-radius: 10px;
}

.top-banner .right { 
    flex: 2; 
    margin-left: -50px; /* Replacing the negative margin */
    text-align: left;
    position: relative;
    top: 0;
    margin-top:210px; /* Adjust height properly */
}

.top-banner p { 
    color: #555;
    font-size: 16px;
    line-height: 1.5;
}

.top-banner .ad-box { 
    background-color: #fff;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px; /* Instead of negative margins */
}

.top-banner .ad-box h3 { 
    color: #222;
    font-size: 18px;
}

.top-banner .ad-box p { 
    font-size: 14px;
    color: #444;
}

.top-banner .ad-box .price { 
    color: blue;
    font-weight: bold;
    font-size: 20px;
}

.carousel-item .ad-box {
    background: white;
    padding-top: 10px; /* Reduced padding */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: left;
    max-width: 99%;
    margin: auto;
}

.carousel-control-prev, 
.carousel-control-next {
    filter: invert(100%);
}

#topAdsCarousel {
    margin-bottom: 30px; /* Space between the carousel and the cards */
}

/* Style for each ad card */
.ad-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: right;
    margin-bottom: 10px;
}

.ad-card h3 {
    font-size: 1.2rem;
    font-weight: bold;
}

.ad-card p {
    margin: 5px 0;
}

.price {
    font-size: 1.1rem;
    color: #d9534f;
    font-weight: bold;
}

.card-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

/* Card image styling if needed */
.ad-card img {
    max-width: 50%;
    border-radius: 8px;
}

.slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.card-container {
    display: flex;
    width: 200%;
    transition: transform 0.5s ease-in-out;
}

.ad-card {
    width: 20%;
    padding: 15px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    flex-shrink: 0;
}
.badge {
            position: absolute;
            top: 10px;
            left:10px;
            background: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            clip-path: polygon(100% 0%, 100% 100%, 50% 80%, 0 100%, 0 0);
        }


</style>

        <!-- banner-section -->
        <section class="banner-section">
            <div class="auto-container" >
                <div class="content-box">
                    <div class="text">
                        <h1 style="font-size:45px">You can #Buy, #Rent, #Booking anything from here.</h1>
                        <p>Buy and sell everything from used cars to mobile phones and computers,<br> or search for property, jobs and more in Sri Lanka.
                        </p>
                    </div>
                    
                </div> 
            </div>
        </section>
        <!-- banner-section end -->

        <!-- ad - banner-section start -->
        <section class="ad-banner-container mb-0"> 
            <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($banner->type == 0): ?>
                            <div class="carousel-item ad-carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                               <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" class="d-block mx-auto" alt="Banner Image">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- ad - banner-section end -->

        <!-- category-section -->
        <section class="category-section centred sec-pad" style="padding-top:30px;">
            <div class="auto-container">
                <div class="sec-title">
                    <span>Categories</span>
                    <h2>Explore by Category</h2>
                </div>
                
                <div class="clearfix inner-content" style="display: flex; flex-wrap: wrap; justify-content: center;">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category-block-one wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <a href="<?php echo e(route('browse-ads', ['category' => $category->id])); ?>" style="text-decoration: none;">
                        <div class="inner-box">
                            <div class="shape">
                                <div class="shape-1" style="background-image: url('<?php echo e(asset('newFrontend/Clasifico/assets/images/shape/shape-1.png')); ?>');"></div>
                                <div class="shape-2" style="background-image: url('<?php echo e(asset('newFrontend/Clasifico/assets/images/shape/shape-2.png')); ?>');"></div>
                            </div>

                            <div class="icon-box">
                                <img src="<?php echo e(asset('images/Category/' . $category->image)); ?>" 
                                    alt="<?php echo e($category->name); ?>" 
                                    style="width: 70px; height: 70px; object-fit: contain;">
                            </div>

                            <h5 style="min-height: 50px; display: -webkit-box; 
                                    -webkit-line-clamp: 2; -webkit-box-orient: vertical; 
                                    overflow: hidden; text-overflow: ellipsis; ">
                                <?php echo e($category->name); ?>

                            </h5>

                            <span><?php echo e($category->ads_count); ?></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
</section>
<!-- category-section end -->

<!-- top add-section start -->
<div class="cont">
    <h2 class="heading"><b>Find your needs in our <br> 
        best <span>Top Ads</span></b></h2>

    <div class="top-banner"> <!-- Updated class reference here -->
        <div class="left">
        <?php if($topbanners->isNotEmpty()): ?>
            <?php $__currentLoopData = $topbanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($banner->type == 1): ?>  
                    <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                        <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" class="d-block w-100" alt="Banner Image">
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No banners available</p>
        <?php endif; ?>

        </div>

        <div class="right">
            <div id="topAdsCarousel" class="carousel slide" data-bs-ride="carousel" style="margin-top:-320px;margin-left:-200px;">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $topAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                        <div class="ad-box" style="margin-right:150px; width: 560px; height: 300px; background: url('<?php echo e(asset('storage/' . $ad->mainImage)); ?>') no-repeat center center/cover; position: relative; color: white; padding: 15px; display: flex; flex-direction: column; justify-content: flex-end;">
                        <!-- Shadow Overlay -->
                            <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0)); border-radius: 5px;"></div>
                            <div class="badge">
                                <img src="<?php echo e(asset('01.png')); ?>" alt="Top Ad" style="width: 20px; height: 20px;">
                            </div>

                        <?php if($ad->post_type): ?>
                        <button class="sale" style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                        <?php echo e($ad->post_type); ?>

                        </button>
                        <?php endif; ?>
                       
                                <p style="color:white;"><?php echo e($ad->category->name ?? 'Uncategorized'); ?> &raquo; <?php echo e($ad->subcategory->name ?? ''); ?></p>
                                <h3 style="color:white;font-weight:bold;"><?php echo e($ad->title); ?></h3>
                                
                                <p class="price" style="color:rgb(130, 128, 226);">LKR <?php echo e(number_format($ad->price, 2)); ?></p>
                                <p style="color:white;"><i class="fas fa-clock"></i>
                                <?php echo e($ad->created_at->diffForHumans()); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="small-carousel-wrapper" style="overflow: hidden; width: 580px; margin-top: -50px;">
                <div class="card-container d-flex" style="display: flex; transition: transform 0.5s ease-in-out;">
                    <?php $__currentLoopData = $topAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="ad-card" data-index="<?php echo e($index); ?>" style="background: url('<?php echo e(asset('storage/' . $ad->mainImage)); ?>') no-repeat center center/cover; height: 100px; width: 100px; margin: -2px; border: 3px solid transparent; transition: border 0.3s;">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            <p style="margin-top:18px;font-size:16px; text-align:justify; width: 560px;">The Top Ads section on Sri Lanka's largest classified website yaka.lk guarantees your listings premium placement at the top of search results.
                with higher visibility and priority ranking.Top ads ensure your products or services reach more potential buyers quickly and effectively.
            </p>
        </div> <!-- Closing right div -->

    </div>
    
    <!-- Closing top-banner div -->

    
</div> <!-- Closing cont div -->
<!-- top add-section end -->

<!--Super Ads Section>-->
<div class="cont">
   
    <div class="super-banner" style="display: flex; flex-direction: row-reverse;"> <!-- Reverse layout -->
        <div class="right" style="flex: 1;margin-top:180px;margin-left:-324px;"> <!-- Heading and Banner on the Right -->
            <?php $__currentLoopData = $superbanners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($banner->type == 1): ?>  <!-- Only display banners with type 1 -->
                    <div class="carousel-item <?php echo e($key == 1 ? 'active' : ''); ?>">
                        <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" class="d-block w-100" alt="Banner Image">
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <h2 class="heading" style="margin-top:90px;margin-left:0px;"><b>Find your needs in our <br> 
        best <span>Super Ads</span></b></h2>

        <div class="left" style="flex: 1;"> <!-- Ads on the Left -->
            <div id="superAdsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $superAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $adss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                            <div class="ad-box" style="margin-left:124px;margin-top:100px;width: 560px; height: 300px; background: url('<?php echo e(asset('storage/' . $adss->mainImage)); ?>') no-repeat center center/cover; position: relative; color: white; padding: 15px; display: flex; flex-direction: column; justify-content: flex-end;">
                                <!-- Shadow Overlay -->
                                <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0)); border-radius: 5px;"></div>
                                <div class="badge">
                                <img src="<?php echo e(asset('02.png')); ?>" alt="Top Ad" style="width: 20px; height: 20px;">
                                </div>

                                <button class="sale" style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
                                    Sale
                                </button>
                                <p style="color:white;"><?php echo e($adss->category->name ?? 'Uncategorized'); ?> &raquo; <?php echo e($adss->subcategory->name ?? ''); ?></p>
                                <h3 style="color:white;font-weight:bold;font-size:1.1rem;"><?php echo e($adss->title); ?></h3>
                                <p class="price" style="color:rgb(130, 128, 226);font-size:1.2rem;">LKR <?php echo e(number_format($adss->price, 2)); ?></p>
                                <p style="color:white;"><i class="fas fa-clock"></i> <?php echo e($adss->created_at->diffForHumans()); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="small-carousel-wrapper" style="overflow: hidden; width: 580px; margin-top: -21px;margin-left:124px;">
                <div class="card-container d-flex" style="display: flex; transition: transform 0.5s ease-in-out;">
                    <?php $__currentLoopData = $superAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $adss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="ad-card" data-index="<?php echo e($index); ?>" style="background: url('<?php echo e(asset('storage/' . $adss->mainImage)); ?>') no-repeat center center/cover; height: 100px; width: 100px; margin: -2px; border: 3px solid transparent; transition: border 0.3s;">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <p style="margin-top:18px;font-size:16px; text-align:justify; width: 550px;">The Super Ads section on Sri Lanka's largest classified website yaka.lk guarantees your listings premium placement at the top of search results.
                    With higher visibility and priority ranking, super ads ensure your products or services reach more potential buyers quickly and effectively.
                </p>
            </div>
        </div>
    </div>

    </div>



        <!-- feature-style-two -->
        <section class="feature-style-two">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span>Urgents</span>
                    <h2>Urgent Ads</h2>
                    <p>We have some special promotion for sell urgently<br>
Urgent badge which is great advantage to get more attention quickly. <br /></p>
                </div>
                <div class="tabs-box">
                    
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">

                            <div class="clearfix row justify-content-center">
                            <?php $__currentLoopData = $latestAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-3 col-md-5 col-sm-12 feature-block justify-content-center">
                                    <div class="feature-block-one wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box" >
                                                <figure class="image"><img src="<?php echo e(asset('storage/' . $ads->mainImage)); ?>" alt="" style="width: 370px; height: 220px; object-fit: cover;"></figure>
                                               
                                                <div class="feature" style="background-color: rgb(171, 18, 18);">Urgent</div>
                                            
                                            </div>
                                            <div class="lower-content">
                                            
                                              
                                                <h3 style="margin-top:20px;"><a href="<?php echo e(route('ads.details', ['adsId' => $ad->adsId])); ?>"><?php echo e($ads ->title); ?></a></h3>
                                           
                                                <ul class="clearfix info">
                                                    
                                                    <li><i class="fas fa-map-marker-alt"></i><?php echo e($ad->sub_location ? $ad->sub_location->name_en : 'N/A'); ?>,
                                                    <?php echo e($ad->main_location ? $ad->main_location->name_en : 'N/A'); ?></li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Price:</span><?php echo e($ads -> price); ?></h5>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature-style-two end -->

      <!-- advertisement - banner-section start 
    <section class="banner-container">
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($banner->type == 0): ?> 
                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                            <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" 
                                alt="Banner Image">
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
 advertisement - banner-section end -->

           <!-- ad - banner-section start -->
           <section class="ad-banner-container mb-0"> 
            <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($banner->type == 0): ?>
                            <div class="carousel-item ad-carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                               <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" class="d-block mx-auto" alt="Banner Image">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- advertisement - banner-section end -->

        <script>
document.addEventListener("DOMContentLoaded", function () {
    function initializeCarousel(wrapperSelector, containerSelector, cardSelector, carouselSelector, smallCarouselSelector) {
        var adCards = document.querySelectorAll(wrapperSelector + " " + cardSelector);
        var cardContainer = document.querySelector(wrapperSelector + " " + containerSelector);
        var carouselItems = document.querySelectorAll(wrapperSelector + " " + carouselSelector + " .carousel-item");
        var smallCarousel = document.querySelector(wrapperSelector + " " + smallCarouselSelector);
        var wrapperWidth = cardContainer?.offsetWidth || 0;
        var cardWidth = 110; // Adjust based on actual card width + margin
        var currentIndex = 0;

        function updateActiveAd(index) {
            // Remove previous red borders from small ads
            adCards.forEach(card => card.style.border = "3px solid transparent");

            let activeCard = document.querySelector(wrapperSelector + ` ${cardSelector}[data-index="${index}"]`);
            if (activeCard) {
                activeCard.style.border = "3px solid red"; // Highlight active ad

                // Scroll the small ads container to bring active ad into view
                let offset = Math.max(0, (index * cardWidth) - (wrapperWidth / 2) + (cardWidth / 2));
                if (cardContainer) cardContainer.style.transform = `translateX(-${offset}px)`;
            }

            // Update the large ad to match
            carouselItems.forEach((item, i) => {
                item.classList.remove("active");
                if (i === index) item.classList.add("active");
            });

            currentIndex = index; // Store current index for autoplay
        }

        // Clicking on a large ad should highlight the small ad
        carouselItems.forEach((item, index) => {
            item.addEventListener("click", function () {
                updateActiveAd(index);
            });
        });

        // Clicking on a small ad should update the large ad
        adCards.forEach((card, index) => {
            card.addEventListener("click", function () {
                updateActiveAd(index);
            });
        });

        // Automatic sliding for the small ad box
        function slideSmallAds() {
            currentIndex = (currentIndex + 1) % adCards.length;
            updateActiveAd(currentIndex);
            setTimeout(slideSmallAds, 3000); // Adjust delay as needed
        }

        setTimeout(slideSmallAds, 3000); // Start the auto-slide

        // Set initial active ad
        updateActiveAd(0);
    }

    // Initialize for both Top Ads and Super Ads
    initializeCarousel(".top-banner", ".card-container", ".ad-card", "#topAdsCarousel", ".small-carousel-wrapper");
    initializeCarousel(".super-banner", ".card-container", ".ad-card", "#superAdsCarousel", ".small-carousel-wrapper");







    // Function to start a slideshow for a given banner section
    function startSlideshow(bannerItems) {
        if (bannerItems.length > 0) {
            let currentIndex = 0;

            function showNextBanner() {
                bannerItems[currentIndex].classList.remove('active'); // Hide current banner
                currentIndex = (currentIndex + 1) % bannerItems.length; // Move to next (wrap around to first)
                bannerItems[currentIndex].classList.add('active'); // Show next banner
            }

            setInterval(showNextBanner, 5000); // Change slide every 5 seconds
        }
    }

    // Start slideshows for both .top-banner and .super-banner
    let topBannerItems = document.querySelectorAll('.top-banner .carousel-item');
    let superBannerItems = document.querySelectorAll('.super-banner .carousel-item');

    startSlideshow(topBannerItems);
    startSlideshow(superBannerItems);
});

</script>

         
<?php $__env->stopSection(); ?>

       



 
<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/index.blade.php ENDPATH**/ ?>