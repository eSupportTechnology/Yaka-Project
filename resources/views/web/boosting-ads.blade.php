@extends('web.layout.layout')

@section('content')
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
 /* faq */
 .faq-section {
    max-width: 90%;
    margin: 20px auto;
    padding: 20px 40px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .faq-section h2 {
    font-size: 24px;
    text-align: center;
    color: #333;
    margin-bottom: 20px;
  }

  .faq-item {
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    overflow: hidden;
  }

  .faq-title {
    background-color: #700202;
    color: #fff;
    padding: 15px;
    cursor: pointer;
    font-size: 18px;
    font-weight: bold;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .faq-title:hover {
    background-color: #900303;
  }

  .faq-title .icon {
    font-size: 20px;
    transition: transform 0.3s ease;
  }

  .faq-title.active .icon {
    transform: rotate(180deg);
  }

  .faq-content {
    display: none;
    padding: 15px;
    background-color: #f9f9f9;
    color: #333;
  }

  .faq-question {
    font-weight: bold;
    margin-top: 10px;
  }

  .faq-answer {
    margin-left: 15px;
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
        <h2 class="mt-5 mb-4 text-center">Boosting Ads</h2>
        <p class="mb-4 text-center">{{ GoogleTranslate::trans('Our boosting methods are powered by a fully sophisticated AI-generated algorithm, ensuring quicker results.', app()->getLocale()) }}</p>
        <ul class="text-center boosting-list">
          <li class="mb-2">1. Jump up ads</li>
          <li class="mb-2">2. Top ads</li>
          <li class="mb-2">3. Urgent ads</li>
          <li class="mb-2">4. Super ad</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="faq-container">
    <div class="faq-section">
      <h2>FAQs - Boosting Ads</h2>
  
      <!-- Jump Up Ads FAQ -->
      <div class="faq-item">
        <div class="faq-title">
          1. Jump Up Ads
          <span class="icon">▼</span>
        </div>
        <div class="faq-content">
          <p class="faq-question">What is a Jump Up Ad?</p>
          <p class="faq-answer">A Jump Up Ad allows your advertisement to instantly move to the top of the listing, ensuring more visibility.</p>
  
          <p class="faq-question">How long does a Jump Up Ad remain active?</p>
          <p class="faq-answer">Jump Up Ads remain active for 24 hours before reverting to their normal position.</p>
        </div>
      </div>
  
      <!-- Top Ads FAQ -->
      <div class="faq-item">
        <div class="faq-title">
          2. Top Ads
          <span class="icon">▼</span>
        </div>
        <div class="faq-content">
          <p class="faq-question">What are Top Ads?</p>
          <p class="faq-answer">Top Ads are featured prominently at the top of a category, gaining maximum exposure.</p>
  
          <p class="faq-question">Are Top Ads visible across all devices?</p>
          <p class="faq-answer">Yes, Top Ads are optimized to be visible on both desktop and mobile devices.</p>
        </div>
      </div>
  
      <!-- Urgent Ads FAQ -->
      <div class="faq-item">
        <div class="faq-title">
          3. Urgent Ads
          <span class="icon">▼</span>
        </div>
        <div class="faq-content">
          <p class="faq-question">What makes an ad 'Urgent'?</p>
          <p class="faq-answer">An 'Urgent' label is added to your ad to attract immediate attention from buyers.</p>
  
          <p class="faq-question">Can I combine Urgent Ads with other features?</p>
          <p class="faq-answer">Yes, you can combine Urgent Ads with Top Ads or Jump Up Ads for better performance.</p>
        </div>
      </div>
  
      <!-- Super Ads FAQ -->
      <div class="faq-item">
        <div class="faq-title">
          4. Super Ads
          <span class="icon">▼</span>
        </div>
        <div class="faq-content">
          <p class="faq-question">What are Super Ads?</p>
          <p class="faq-answer">Super Ads combine all premium features, providing ultimate visibility and engagement.</p>
  
          <p class="faq-question">How much does a Super Ad cost?</p>
          <p class="faq-answer">The cost of Super Ads depends on the category and duration. Please contact our support for more details.</p>
        </div>
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const faqTitles = document.querySelectorAll('.faq-title');
  
      faqTitles.forEach(title => {
        title.addEventListener('click', function () {
          const content = this.nextElementSibling;
          const isActive = this.classList.contains('active');
  
          // Close all open FAQ items
          document.querySelectorAll('.faq-title.active').forEach(activeTitle => {
            activeTitle.classList.remove('active');
            activeTitle.nextElementSibling.style.display = 'none';
          });
  
          // Toggle the clicked FAQ item
          if (!isActive) {
            this.classList.add('active');
            content.style.display = 'block';
          }
        });
      });
    });
  </script>
@endsection
