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
        <h2 class="mt-5 mb-4 text-center"><?php echo e(GoogleTranslate::trans('Banner Ads', app()->getLocale())); ?></h2>
        <p class="mb-4 text-center"><?php echo e(GoogleTranslate::trans('Banner ads are a great way to attract and engage with your target audience.', app()->getLocale())); ?></p>
        
        <ul class="text-center banner-ads-list">
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 1:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('It is cost effective! Using banners is one of the cheapest methods of advertising available. Banners are often a better option financially compared to TV or radio station advertisements.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 2:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('They target your main audience. Whether you hang up your banner at a sponsored event or outside your business location, you will have a much higher chance of gaining potential customers.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 3:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('It’s a sustainable method for increasing customers. By placing your banner in a high-profile spot, it will influence customers, giving you a wider client base.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 4:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('Banners are extremely memorable. A strategically designed banner will make future customers more likely to remember your business and the information they see.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 5:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('Your banners can be used multiple times. If you decide to move to a new building or attend an important event, your banner is reusable.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 6:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('It is an effective method of advertising. Banner advertising has always worked, as signage is directly available to the masses.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 7:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('Durable and able to withstand harsh weather conditions. High-quality materials mean our banners can be used for very long periods.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 8:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('Ideal for promoting special offers and upcoming sales. A bold banner is the perfect way to spread the word about your business.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 9:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('A well-designed banner will be memorable. Including your logo and important information such as slogans or contact details increases the chances of having a memorable design, leading to more customers.', app()->getLocale())); ?></li>
          <li class="mb-2"><strong><?php echo e(GoogleTranslate::trans('Number 10:', app()->getLocale())); ?></strong> <?php echo e(GoogleTranslate::trans('Banners are straightforward to create. Made from vinyl, the process of producing banners is much faster than other advertising methods.', app()->getLocale())); ?></li>
        </ul>

        <h3 class="mt-5 text-center">Leaderboard Banners</h3>
        <img style="width: 100%" src="https://leadsdubai.com/wp-content/uploads/target-banner-advertising.jpg" alt="Leaderboard Banner" class="mb-4 img-fluid">
        <p class="mb-4 text-center"><?php echo e(GoogleTranslate::trans("Leaderboard banners can run at a premium because of their coveted spot at the top of the webpage. However, it's important to note that they can also appear below the fold, just above the footer. The good news is that studies have found click-through rates are even higher in this position, as users have already scrolled down and engaged with the content. In some cases, your banner can occupy both top and bottom slots for maximum impact.", app()->getLocale())); ?></p>

        <h3 class="mt-5 text-center">Skyscraper Banners</h3>
        <img style="width: 100%" src="https://www.mediaimpact.de/data/uploads/2023/07/skyscraper-622x350.jpg" alt="Leaderboard Banner" class="mb-4 img-fluid">
        <p class="mb-4 text-center"><?php echo e(GoogleTranslate::trans("Since skyscraper banner ads are long and thin, achieving the right balance in your banner design is essential. You'll want to include your company logo, your value proposition, and a strong call to action—all of which require adequate space. This is where strong banner ad design skills come in, along with insights into what resonates with your target audience.", app()->getLocale())); ?></p>

        <p class="mt-4 text-center"><?php echo e(GoogleTranslate::trans('Purchase your banners for your business today!', app()->getLocale())); ?></p>
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

<?php echo $__env->make('web.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/banner-ads.blade.php ENDPATH**/ ?>