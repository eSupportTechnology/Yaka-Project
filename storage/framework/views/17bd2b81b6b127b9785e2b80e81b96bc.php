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
                <h1><?php echo app('translator')->get('messages.Privacy & Safety'); ?></h1>
            </div>
            <ul class="clearfix bread-crumb">
                <li><a href="<?php echo e(route( '/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                <li><?php echo app('translator')->get('messages.Privacy & Safety'); ?></li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<div class="container">
  <div class="row">
    <div class="mt-5 col-md-12">
        <div class="sec-title">
        <span><?php echo app('translator')->get('messages.Privacy & Safety'); ?></span>
        <h2><?php echo app('translator')->get('messages.Our'); ?> <?php echo app('translator')->get('messages.Privacy & Safety'); ?></h2>
        </div>
      <div class="mb-5 privacy-content">
        <h2 style="font-size: 27px;margin-top: 40px">1. <?php echo app('translator')->get('messages.Information We Collect'); ?></h2>
        <ul  class="custom-dots">
        <li><strong><?php echo app('translator')->get('messages.Personal Data'); ?>:</strong> <?php echo app('translator')->get('messages.Name, email address, phone number, and payment information'); ?></li>
          <li><strong><?php echo app('translator')->get('messages.Usage Data'); ?>:</strong> <?php echo app('translator')->get('messages.IP address, browser type, and interaction history with the Website'); ?></li>
          <li><strong><?php echo app('translator')->get('messages.Cookies'); ?>:</strong> <?php echo app('translator')->get('messages.To enhance user experience and analyze traffic. You can manage cookies through your browser settings'); ?></li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">2. <?php echo app('translator')->get('messages.How We Use Your Data'); ?></h2>
        <ul class="custom-dots">
          <li><?php echo app('translator')->get('messages.To manage user accounts and provide customer support'); ?></li>
          <li><?php echo app('translator')->get('messages.To process payments and publish listings'); ?></li>
          <li><?php echo app('translator')->get('messages.To improve Website functionality through analytics and user feedback'); ?></li>
          <li><?php echo app('translator')->get('messages.To send updates, notifications, or promotional offers (only with consent)'); ?></li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">3. <?php echo app('translator')->get('messages.Data Sharing and Disclosure'); ?></h2>
        <ul  class="custom-dots">
          <li><?php echo app('translator')->get('messages.We do not sell your data to third parties'); ?></li>
          <li><?php echo app('translator')->get('messages.Data may be shared with payment processors, law enforcement, or service providers as necessary'); ?></li>
          <li><?php echo app('translator')->get('messages.In case of a merger or acquisition, your data may be transferred to the new entity'); ?></li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">4. <?php echo app('translator')->get('messages.Data Security'); ?></h2>
        <ul  class="custom-dots">
          <li><?php echo app('translator')->get('messages.We use encryption and other security measures to protect your personal data'); ?></li>
          <li><?php echo app('translator')->get('messages.Despite our efforts, no online service is entirely secure. We encourage users to protect their login information'); ?></li>
        </ul>

        <h2 style="font-size: 27px;margin-top: 40px">5. <?php echo app('translator')->get('messages.User Rights'); ?></h2>
        <ul  class="custom-dots">
          <li><strong><?php echo app('translator')->get('messages.Access and Correction'); ?>:</strong><?php echo app('translator')->get('messages.You can access and update your personal information through your account'); ?></li>
          <li><strong><?php echo app('translator')->get('messages.Data Deletion'); ?>:</strong><?php echo app('translator')->get('messages.You may request the deletion of your personal data by contacting support'); ?> </li>
          <li><strong><?php echo app('translator')->get('messages.Consent Withdrawal'); ?>:</strong><?php echo app('translator')->get('messages.You can opt out of marketing emails by clicking the unsubscribe link'); ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/privacy-safety.blade.php ENDPATH**/ ?>