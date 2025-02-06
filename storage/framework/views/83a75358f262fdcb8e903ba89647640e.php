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

.cont{
    max-width: 1200px;
    margin: 20px auto;
    
}

.heading {
    font-size: 30px;
    color: #333;
    margin-bottom: 15px;
    text-align: left;
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
    align-items: center; /* Align content to the top */
    justify-content: flex-start; /* Align everything to the left */
    padding: 20px; /* Increased padding */
}

.top-banner .left { 
    flex: 1; /* Adjust size */
    padding: 20px;
}

.top-banner .left img { 
    max-width: 100%; 
    max-height: 400px; 
    border-radius: 10px;
}

.top-banner .right { 
    flex: 2; 
    padding: 20px;
    text-align: left;
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
    margin-top: 50px;

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
    margin-top: -90px;
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
    align-items: right;
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
        <section class="category-section centred sec-pad mt-0">
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
            <div id="topAdsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $topAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                            <div class="ad-box">
                                <h3><?php echo e($ad->title); ?></h3>
                                <p><?php echo e($ad->category->name ?? 'Uncategorized'); ?> &raquo; <?php echo e($ad->subcategory->name ?? ''); ?></p>
                                <p class="price">LKR <?php echo e(number_format($ad->price, 2)); ?></p>
                                <p><?php echo e($ad->created_at->diffForHumans()); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="card-container">
                <?php $__currentLoopData = $topAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="ad-card">
                        <h3><?php echo e($ad->title); ?></h3>
                        <p><?php echo e($ad->category->name ?? 'Uncategorized'); ?> &raquo; <?php echo e($ad->subcategory->name ?? ''); ?></p>
                        <p class="price">LKR <?php echo e(number_format($ad->price, 2)); ?></p>
                        <p><?php echo e($ad->created_at->diffForHumans()); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <p>The Top Ads section on Sri Lanka's largest classified website yaka.lk guarantees your listings premium placement at the top of search results.</p>
        </div> <!-- Closing right div -->

    </div> <!-- Closing top-banner div -->
</div> <!-- Closing cont div -->
<!-- top add-section end -->


        <!-- feature-style-two -->
        <section class="feature-style-two">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span>Features</span>
                    <h2>Featured Ads</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt labore <br />dolore magna aliqua enim.</p>
                </div>
                <div class="tabs-box">
                    <div class="tab-btn-box centred">
                        <ul class="clearfix tab-btns tab-buttons">
                            <li class="tab-btn active-btn" data-tab="#tab-1">Recent Listing</li>
                            <li class="tab-btn" data-tab="#tab-2">Popular Listing</li>
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="clearfix row">
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-1.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-1.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>1 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInDown animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-2.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-2.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(25)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>2 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$2,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInDown animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-3.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-3.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(40)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>3 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,500.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-4.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-4.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(28)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>4 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-5.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-5.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(15)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>5 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$1,800.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-6.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-6.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>6 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,200.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="clearfix row">
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-1.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-1.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>1 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-2.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-2.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(25)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>2 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$2,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-3.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-3.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(40)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>3 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,500.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-4.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-4.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(28)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>4 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-5.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-5.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(15)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>5 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$1,800.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-6.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-6.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="clearfix rating">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="clearfix info">
                                                    <li><i class="far fa-clock"></i>6 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,200.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        let slider = document.querySelector(".card-container");
        let cards = document.querySelectorAll(".ad-card");
        let prevBtn = document.querySelector(".prev");
        let nextBtn = document.querySelector(".next");
        let index = 0;

        function slide() {
            index = (index + 1) % cards.length;
            let moveAmount = -index * 50; // Moves each card by 50% (2 cards per row)
            slider.style.transform = `translateX(${moveAmount}%)`;
        }

        let autoSlide = setInterval(slide, 3000); // Auto slide every 3 sec

        nextBtn.addEventListener("click", function() {
            clearInterval(autoSlide); // Stop auto-slide
            slide();
            autoSlide = setInterval(slide, 3000); // Restart auto-slide
        });

        prevBtn.addEventListener("click", function() {
            clearInterval(autoSlide);
            index = (index - 1 + cards.length) % cards.length;
            let moveAmount = -index * 50;
            slider.style.transform = `translateX(${moveAmount}%)`;
            autoSlide = setInterval(slide, 3000);
        });
    });
</script>
         
<?php $__env->stopSection(); ?>

       



 
<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/index.blade.php ENDPATH**/ ?>