<?php $__env->startSection('content'); ?>
<?php use Stichoza\GoogleTranslate\GoogleTranslate; ?>
<style>
  .about-yaka-section {
    background-color: #f9f9f9;
    padding: 20px 0;
  }
  
  .about-yaka-section h2 {
    font-size: 2.3rem;
    font-weight: bold;
    color: #333;
  }
  
  .about-yaka-section p {
    font-size: 1rem;
    color: #666;
  }
  
  .about-yaka-section h4 {
    font-size: 1.25rem;
    font-weight: bold;
    color: #444;
  }
  
  .about-yaka-section a {
    color: #700202;
    text-decoration: underline;
  }
  
  .about-yaka-section a:hover {
    text-decoration: none;
  }
  
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
    .about-yaka-section h2 {
      font-size: 1.8rem;
    }

    .about-yaka-section p {
      font-size: 0.9rem;
    }

    .contact-section {
      padding: 15px 20px;
    }

    .contact-info {
      flex-direction: column;
    }
  }
</style>

<div class="py-5 about-yaka-section">
  <div class="container">
    <div class="mb-4 text-center row">
      <div class="col">
        <h2 class="mt-3">About Yaka.lk</h2>
        <img src="<?php echo e(asset('web/images/about/5.png')); ?>" alt="About Illustration" class="img-fluid" style="max-width: 400px; height:auto">
        <p class="text-muted">Yaka.lk is a platform on which you can buy and sell almost everything! Use the location selector to find the deals close to you.</p>
      </div>
    </div>
    <div class="row">
      <div class="mb-4 col-md-6 d-flex align-items-start">
        <img src="<?php echo e(asset('web/images/about/about-sell2.png')); ?>" alt="Sell Icon" class="me-3 img-fluid" style="width: 85px; height: 85px;">
        <div>
          <h4>Have items to sell?</h4>
          <p>Sign up for a free account to start selling your items! It takes less than 2 minutes to post an ad. Visit <a href="#">How to sell fast</a> for some tips on creating great ads that generate a lot of buyer interest.</p>
        </div>
      </div>
      <div class="mb-4 col-md-6 d-flex align-items-start">
        <img src="<?php echo e(asset('web/images/about/about-buy.png')); ?>" alt="Buy Icon" class="me-3 img-fluid" style="width: 95px; height: 95px;">
        <div>
          <h4>Looking to buy something?</h4>
          <p>Yaka.lk has the widest selection of items all over Sri Lanka and across more than different categories. Find the best deal on Yaka.lk!</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="pt-5 pb-5 col-md-12">
      <h1 class="mb-5 text-center"><?php echo e(GoogleTranslate::trans('Our Story', app()->getLocale())); ?></h1>
      <ul>
        <li class="mb-2 text-center"><?php echo e(GoogleTranslate::trans('Yaka.lk is the largest growing market place in Sri Lanka. This is a 100 % Sri Lankan website which designed specially to suit Sri Lankans. If you want to buy or sell anything, you have arrived to the right destination.', app()->getLocale())); ?></li>
        <li class="mb-2 text-center"><?php echo e(GoogleTranslate::trans('Yaka.lk has the broad selection of items so you can navigate through many categories such as Electronics, Vehicles, Property, jobs, Industrial, etc., also you can use search filters in order to make it quick in findings.', app()->getLocale())); ?></li>
        <li class="mb-2 text-center"><?php echo e(GoogleTranslate::trans('You can create free account in yaka.lk and post your advertisement within no time and as soon as you publish, we will review it and allow to view in website. Also, you can choose add promotion packages for better results.', app()->getLocale())); ?></li>
      </ul>
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

<?php echo $__env->make('web.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/about.blade.php ENDPATH**/ ?>