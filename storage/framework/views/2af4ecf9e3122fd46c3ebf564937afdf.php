<?php $__env->startSection('content'); ?>

<style>
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* Basic Reset */
        .tips-section{
            background-color: rgba(255, 255, 255, 0.98);
            padding: 50px 0px;
        }

        .tips-box {
            background: linear-gradient(135deg,rgb(248, 223, 223),rgb(255, 255, 255),rgb(226, 232, 240));
            padding: 20px;

            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            width:80%;
        }

        .tips-box:hover {
            transform: scale(1.05);
            background: rgb(255, 255, 255);
        }

        .tips-box h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
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
                        <h1><?php echo app('translator')->get('messages.Tips for Better Ads'); ?></h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="<?php echo e(route( '/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                        <li><?php echo app('translator')->get('messages.Tips'); ?></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->

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
<!-- tips-section -->
<section class="tips-section">
    <div class="container d-flex flex-column align-items-center">
        <div class="tips-box">
            <h3>1. <?php echo app('translator')->get('messages.Upload clear photos from different angles'); ?></h3>
        </div>

        <div class="tips-box">
            <h3>2. <?php echo app('translator')->get('messages.Upload real photos'); ?></h3>
        </div>

        <div class="tips-box">
            <h3>3. <?php echo app('translator')->get('messages.Add actual and clear details to impress customers'); ?></h3>
        </div>

        <div class="tips-box">
            <h3>4. <?php echo app('translator')->get('messages.Add working contact numbers'); ?></h3>
        </div>

        <div class="tips-box">
            <h3>5. <?php echo app('translator')->get('messages.Choose a competitive price'); ?></h3>
        </div>

        <div class="tips-box">
            <h3>6. <?php echo app('translator')->get('messages.Select the negotiable option for a better response'); ?></h3>
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\eSupport\Yaka-Project\resources\views/newFrontend/tips.blade.php ENDPATH**/ ?>