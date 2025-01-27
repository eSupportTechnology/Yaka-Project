<?php $__env->startSection('content'); ?>
<?php use Stichoza\GoogleTranslate\GoogleTranslate; ?>
<style>
 .contact-section {
   background-color: #fff;
   border-radius: 10px;
   padding: 20px 40px;
   margin: 20px auto;
   text-align: center;
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   max-width: 100%;
   width: 90%;
 }

 .contact-section h2 {
   font-size: 24px;
   color: #333;
   margin-bottom: 10px;
 }

 .contact-section p {
   font-size: 14px;
   color: #666;
   margin: 5px 0;
 }

 .contact-info {
   display: flex;
   flex-wrap: wrap;
   justify-content: space-around;
   align-items: center;
   margin-top: 20px;
   font-size: 16px;
   color: #333;
 }

 .contact-info div {
   flex: 1;
   max-width: 300px;
   text-align: center;
   margin: 10px;
 }

 .contact-info .icon {
   font-size: 24px;
   color: #700202;
   margin-bottom: 10px;
 }

 .contact-info a {
   color: #700202;
   text-decoration: none;
 }

 .contact-info a:hover {
   text-decoration: underline;
 }

 @media (max-width: 768px) {
  

   .contact-section {
     padding: 15px 20px;
   }

   .contact-info {
     flex-direction: column;
   }
 }

</style>
<div class="container">
  <div class="row">
    <div class="pt-5 pb-5 col-md-12">
      <!-- Tips Section -->
      <h2 class="mb-4 text-center"><?php echo e(GoogleTranslate::trans('Tips for Better Ads', app()->getLocale())); ?></h2>
      <ul class="text-center tips-list">
        <li class="mb-2"><?php echo e(GoogleTranslate::trans('1. Upload clear photos from different angles.', app()->getLocale())); ?></li>
        <li class="mb-2"><?php echo e(GoogleTranslate::trans('2. Upload real photos.', app()->getLocale())); ?></li>
        <li class="mb-2"><?php echo e(GoogleTranslate::trans('3. Add actual and clear details to impress customers.', app()->getLocale())); ?></li>
        <li class="mb-2"><?php echo e(GoogleTranslate::trans('4. Add working contact numbers.', app()->getLocale())); ?></li>
        <li class="mb-2"><?php echo e(GoogleTranslate::trans('5. Choose a competitive price.', app()->getLocale())); ?></li>
        <li class="mb-2"><?php echo e(GoogleTranslate::trans('6. Select the negotiable option for a better response.', app()->getLocale())); ?></li>
      </ul>
    </div>
  </div>

  <!-- Features Section -->
  <div class="pt-5 pb-5 row bg-light">
    <div class="text-center col-md-12">
      <h3 class="mb-4"><?php echo e(GoogleTranslate::trans('Why Choose Us?', app()->getLocale())); ?></h3>
      <div class="row">
        <div class="col-md-4">
          <div class="feature-box">
            <img src="<?php echo e(asset('web/images/about/high_quality.png')); ?>" alt="High Quality" class="mb-3 img-fluid" style="width:100px;height:100px">
            <h5><?php echo e(GoogleTranslate::trans('High-Quality Listings', app()->getLocale())); ?></h5>
            <p><?php echo e(GoogleTranslate::trans('We ensure only high-quality ads appear on our platform.', app()->getLocale())); ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box">
            <img src="<?php echo e(asset('web/images/about/customer_support.png')); ?>" alt="Customer Support" class="mb-3 img-fluid"style="width:100px;height:100px">
            <h5><?php echo e(GoogleTranslate::trans('24/7 Support', app()->getLocale())); ?></h5>
            <p><?php echo e(GoogleTranslate::trans('Our team is always here to help you with your needs.', app()->getLocale())); ?></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="feature-box">
            <img src="<?php echo e(asset('web/images/about/secure.png')); ?>" alt="Secure" class="mb-3 img-fluid"style="width:100px;height:100px">
            <h5><?php echo e(GoogleTranslate::trans('Secure Transactions', app()->getLocale())); ?></h5>
            <p><?php echo e(GoogleTranslate::trans('We prioritize your security during every interaction.', app()->getLocale())); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>

 <!-- Call-to-Action Section -->
  <div class="pt-5 pb-5 text-center text-white row "style="background-color: #8B0000;">
    <div class="col-md-12">
      <h3 class="mb-4"><?php echo e(GoogleTranslate::trans('Ready to Post Your Ad?', app()->getLocale())); ?></h3>
      <p><?php echo e(GoogleTranslate::trans('Join thousands of satisfied customers today. It’s quick, easy, and free!', app()->getLocale())); ?></p>
      <a href="<?php echo e(url('/post-ad')); ?>" class="btn btn-light"><?php echo e(GoogleTranslate::trans('Post Your Ad Now', app()->getLocale())); ?></a>
    </div>
  </div>
</div>
<div class="contact-section">
  <h2>Questions? Get in touch!</h2>
  <p>If you have any problems,</p>
  <p>May be related to the following services</p>
  <div class="contact-info">
    <div>
      <div class="icon">📞</div>
      <strong>Call us</strong>
      <p><a href="tel:0705321321">070 5 321 321</a></p>
    </div>
    <div>
      <div class="icon">📍</div>
      <strong>Our Location</strong>
      <p>Colombo 10, Sri Lanka</p>
    </div>
    <div>
      <div class="icon">📧</div>
      <strong>Email us</strong>
      <p><a href="mailto:Yakalksrilanka@gmail.com">Yakalksrilanka@gmail.com</a></p>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('web.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/tips.blade.php ENDPATH**/ ?>