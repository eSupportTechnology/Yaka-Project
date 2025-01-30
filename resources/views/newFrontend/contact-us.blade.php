@extends('newFrontend.master')

@section('content')
<style>
   .contact-section-all {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px 40px;
    margin: 20px auto;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 100%;
    width: 90%;
  }

  .contact-section-all h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
  }

  .contact-section-all p {
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
    
    .contact-section-all {
      padding: 15px 20px;
    }

    .contact-info {
      flex-direction: column;
    }

}
</style>
<!-- Page Title -->
        <section class="page-title style-two" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Contact Us</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- contact-section -->
        <section class="contact-section bg-color-2">
            <div class="auto-container">
                <div class="clearfix row">
                    <div class="col-lg-4 col-md-12 col-sm-12 info-column">
                        <div class="contact-info-inner">
                            <div class="sec-title">
                                <span>Contact Us</span>
                                <h2>Our Contacts & Location</h2>
                            </div>
                            <!--<div class="single-box">
                                <h3>Opening hours</h3>
                                <ul class="clearfix list"> 
                                    <li>Daily: 9.30 AM–6.00 PM</li>
                                    <li>Sunday & Holidays: Closed</li>
                                </ul>
                            </div>-->
                            <div class="single-box">
                                <h3>Contact info</h3>
                                <ul class="clearfix list"> 
                                    <li>Colombo 10,Sri Lanka </li>
                                    <li><a href="mailto:Info@yaka.lk">Info@yaka.lk</a></li>
                                    <li><a href="mailto:Yaka.lk@outlook.com">Yaka.lk@outlook.com</a></li>
                                    <li><a href="mailto:Yakalksrilanka@gmail.com">Yakalksrilanka@gmail.com</a></li>
                                    <li><a href="tel:070 5 321 321">070 5 321 321</a></li>
                                </ul>
                            </div>
                            <div class="single-box">
                                <h3>Social contact</h3>
                                <ul class="clearfix social-links">
                                    <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="index.html"><i class="fab fa-vimeo-v"></i></a></li>
                                    <li><a href="index.html"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 form-column">
                        <div class="form-inner">
                            <h2>Get in Touch</h2>
                            <form method="post" action="sendemail.php" id="contact-form" class="default-form"> 
                                <div class="clearfix row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>Your Name *</label>
                                        <input type="text" name="username" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label>Your Email *</label>
                                        <input type="email" name="email" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <label>Your Phone</label>
                                        <input type="text" name="phone" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" required="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label>Your Message ...</label>
                                        <textarea name="message"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button class="theme-btn-one" type="submit" name="submit-form">Submit Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact-section end -->


        <!-- google-map-section -->
        <section class="google-map-section">
            <div class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63315.25275813327!2d79.85253170205796!3d6.927078796239132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25960c3fdba49%3A0x86338b0b7e58e8eb!2sColombo%2010%2C%20Colombo!5e0!3m2!1sen!2slk!4v1706523456789!5m2!1sen!2slk" 
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
        
        <!-- google-map-section end -->

        <!--about contact section-->

<div class="contact-section-all">
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
<!--end about contact section-->
 @endsection     
