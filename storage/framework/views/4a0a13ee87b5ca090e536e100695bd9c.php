<?php $__env->startSection('content'); ?>
<style>

    .free-ad-section {
        text-align: center;
        padding: 20px 20px;
    }

    .free-ad-section p {
        font-size: 1.2rem;
        color:black;
        margin-bottom: 20px;
        font-weight: 400;
    }

    /* Category List */
    .posting-allowances-list {
        list-style: none;
        padding: 0;
        text-align: center;
        margin-top: 20px;
    }


    .posting-allowances-list li {
        background: rgb(156, 11, 6);
        color: white;
        padding: 12px;
        margin: 8px 0;
        border-radius: 5px;
        display: inline-block;
        font-size: 1.1rem;
        font-weight: 500;
        transition: transform 0.3s, background 0.3s;
        width:80%;
    }

    .posting-allowances-list li:hover {
        background: rgb(200, 20, 15);
        transform: scale(1.05);
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


<!-- Page Title -->
<section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1><?php echo app('translator')->get('messages.Ad posting allowances'); ?></h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="<?php echo e(route( '/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                        <li><?php echo app('translator')->get('messages.Ad posting allowances'); ?></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- ad - banner-section start -->
        <section class="mb-0 ad-banner-container">
            <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($banner->type == 0): ?>
                            <div class="carousel-item ad-carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                               <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" class="mx-auto d-block" alt="Banner Image">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
        <!-- ad - banner-section end -->

<!-- Free Ad Posting Section -->
<div class="container">
    <div class="row">
        <div class="pt-5 pb-5 col-md-12">
            <div class="free-ad-section">
                <p><?php echo app('translator')->get('messages.free_ad_posting'); ?></p>

                <ul class="posting-allowances-list">
                    <?php
                        $categories = \App\Models\Category::where('mainId', 0)->where('status', 1)->get();
                    ?>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($key+1); ?>. <?php echo app('translator')->get('messages.' . $cat->name); ?> - <?php echo app('translator')->get('messages.Free Ads'); ?>: <?php echo e($cat->free_add_count); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- ad - banner-section start -->
<section class="mb-0 ad-banner-container">
    <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($banner->type == 0): ?>
                    <div class="carousel-item ad-carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                       <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" class="mx-auto d-block" alt="Banner Image">
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<!-- ad - banner-section end -->
    <?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\eSupport\Yaka-Project\resources\views/newFrontend/add_posting.blade.php ENDPATH**/ ?>