<?php $__env->startSection('content'); ?>
<style>

  ul.custom-dots {
      list-style: none;
      padding-left: 20px;
  }
  ul.custom-dots li {
      display: flex; /* Keeps dot and text in a row */
      align-items: center; /* Aligns text vertically */
      gap: 10px; /* Space between dot and text */
      word-wrap: break-word; /* Prevents overflow issues */
  }
  ul.custom-dots li::before {
      content: "•";
      color: black;
      font-weight: bold;
      font-size: 18px;
  }
  @media (max-width: 768px) {
    .contact-section {
      padding: 15px 20px;
    }

    .contact-info {
      flex-direction: column;
    }
    ul.custom-dots li {
          font-size: 14px; /* Adjusts text size for smaller screens */
          gap: 8px; /* Reduces space between dot and text */
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



    ul.custom-dots {
        list-style: none;
        padding-left: 0; /* Reset default padding */
        margin-left: 0;
    }

    ul.custom-dots li {
        display: flex;
        align-items: flex-start; /* Aligns dot with top of multiline text */
        gap: 10px;
        font-size: 16px;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    ul.custom-dots li::before {
        content: "•";
        color: black;
        font-weight: bold;
        font-size: 20px;
        line-height: 1; /* Align dot vertically */
    }

    @media (max-width: 768px) {
      ul.custom-dots li {
          font-size: 14px;
          gap: 8px;
      }
    }

    /* Ad Banner Styling */
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
        width: 60%;
        max-width: 600px;
        height: 80px;
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
        width: 100% !important;
        height: auto !important;
        object-fit: cover;
        margin: 0 auto;
    }

    /* Banner Image Tweaks */
    .top-banner .left .carousel-item img {
        max-width: 80%;
        max-height: 50%;
        margin: 20px auto 0 -40px;
    }

    .super-banner .right .carousel-item img {
        max-width: 57%;
        max-height: 140%;
        margin-left: 20px;
    }

    /* Titles and Sections */
    .page-title.style-two .content-box .title h1,
    .terms-content h2 {
        font-size: 32px;
    }

    /* Tablet Devices */
    @media (max-width: 991.98px) {
        .page-title.style-two {
            background-position: center;
            background-size: cover;
        }

        .page-title .content-box .title h1 {
            font-size: 28px;
        }

        .terms-content h2 {
            font-size: 22px;
        }

        .ad-carousel-item img {
            width: 100%;
            height: auto;
        }
    }

    /* Mobile Devices */
    @media (max-width: 767.98px) {
        .page-title.style-two .content-box {
            text-align: center;
            padding: 30px 10px;
        }

        .page-title .content-box .title h1 {
            font-size: 22px;
        }

        .terms-content h2 {
            font-size: 20px;
        }

        .bread-crumb {
            display: flex;
            flex-wrap: wrap;
            font-size: 14px;
            justify-content: center;
        }

        .ad-carousel-item img {
            max-width: 100%;
            height: auto;
        }
    }




</style>
  <!-- Page Title -->
  <section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="mr-0 content-box centred">
            <div class="title">
                <h1><?php echo app('translator')->get('messages.Terms & Conditions'); ?></h1>
            </div>
            <ul class="clearfix bread-crumb">
                <li><a href="<?php echo e(route( '/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                <li><?php echo app('translator')->get('messages.Terms & Conditions'); ?></li>
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
  <div class="container">
    <div class="row">
      <div class="mt-5 col-md-12">
        <div class="sec-title">
            <span><?php echo app('translator')->get('messages.Terms & Conditions'); ?></span>
            <h2><?php echo app('translator')->get('messages.Our Terms & Conditions'); ?></h2>
        </div>
        <div class="mb-5 terms-content">
          <h2 style="font-size: 27px;margin-top: 40px">1. <?php echo app('translator')->get('messages.Acceptance of Terms'); ?></h2>
          <ul  class="custom-dots">
            <li><?php echo app('translator')->get('messages.Acceptance line1'); ?></li>
            <li><?php echo app('translator')->get('messages.Acceptance line2'); ?></li>
        </ul>

          <h2 style="font-size: 27px;margin-top: 40px">2. <?php echo app('translator')->get('messages.User Registration and Eligibility'); ?></h2>
          <ul  class="custom-dots">
            <li><?php echo app('translator')->get('messages.Eligibility line1'); ?></li>
            <li><?php echo app('translator')->get('messages.Eligibility line2'); ?></li>
            <li><?php echo app('translator')->get('messages.Eligibility line3'); ?></li>
          </ul>

          <h2 style="font-size: 27px;margin-top: 40px">3. <?php echo app('translator')->get('messages.Listing and Posting Rules'); ?></h2>
          <ul  class="custom-dots">
            <li><?php echo app('translator')->get('messages.Posting Rules line1'); ?></li>
            <li><?php echo app('translator')->get('messages.Posting Rules line2'); ?></li>
            <li><?php echo app('translator')->get('messages.Posting Rules line3'); ?></li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">4. <?php echo app('translator')->get('messages.Fees and Payment'); ?></h2>
          <ul class="custom-dots">
              <li><?php echo app('translator')->get('messages.Fees line1'); ?></li>
              <li><?php echo app('translator')->get('messages.Fees line2'); ?></li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">5. <?php echo app('translator')->get('messages.User Responsibilities and Conduct'); ?></h2>
          <ul class="custom-dots">
              <li><?php echo app('translator')->get('messages.User line1'); ?></li>
              <li><?php echo app('translator')->get('messages.User line2'); ?></li>
              <li><?php echo app('translator')->get('messages.User line3'); ?></li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">6. <?php echo app('translator')->get('messages.Prohibited Content'); ?></h2>
          <ul class="custom-dots">
              <li><?php echo app('translator')->get('messages.Prohibited line1'); ?></li>
              <li><?php echo app('translator')->get('messages.Prohibited line2'); ?></li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">7. <?php echo app('translator')->get('messages.Intellectual Property'); ?></h2>
          <ul class="custom-dots">
              <li><?php echo app('translator')->get('messages.Intellectual line1'); ?></li>
              <li><?php echo app('translator')->get('messages.Intellectual line2'); ?></li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">8. <?php echo app('translator')->get('messages.Disclaimers and Limitation of Liability'); ?></h2>
          <ul class="custom-dots">
              <li><?php echo app('translator')->get('messages.Disclaimers line1'); ?></li>
              <li><?php echo app('translator')->get('messages.Disclaimers line2'); ?></li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">9. <?php echo app('translator')->get('messages.Third-Party Links and Services'); ?></h2>
          <ul class="custom-dots">
              <li><?php echo app('translator')->get('messages.ThirdParty line1'); ?></li>
              <li><?php echo app('translator')->get('messages.ThirdParty line2'); ?></li>
          </ul>

          <h2 style="font-size: 27px; margin-top: 40px">10. <?php echo app('translator')->get('messages.Account Termination'); ?></h2>
          <ul class="custom-dots">
              <li><?php echo app('translator')->get('messages.Termination line1'); ?></li>
              <li><?php echo app('translator')->get('messages.Termination line2'); ?></li>
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

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\eSupport\Yaka-Project\resources\views/newFrontend/terms-conditions.blade.php ENDPATH**/ ?>