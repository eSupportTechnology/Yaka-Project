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
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/terms-conditions.blade.php ENDPATH**/ ?>