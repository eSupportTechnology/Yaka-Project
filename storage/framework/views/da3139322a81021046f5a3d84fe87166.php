<?php $__env->startSection('content'); ?>
<!-- Page Title -->
        <section class="page-title style-two" style="background-image: url(assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Contact Us</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="index.html">Home</a></li>
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
                            <div class="single-box">
                                <h3>Opening hours</h3>
                                <ul class="clearfix list"> 
                                    <li>Daily: 9.30 AM–6.00 PM</li>
                                    <li>Sunday & Holidays: Closed</li>
                                </ul>
                            </div>
                            <div class="single-box">
                                <h3>Contact info</h3>
                                <ul class="clearfix list"> 
                                    <li>77408 Satterfield Motorway Suite <br />469 New Antonetta, BC K3L6P6</li>
                                    <li><a href="mailto:example@info.com">example@info.com</a></li>
                                    <li><a href="tel:6174959400326">(617) 495-9400-326</a></li>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55945.16225505631!2d-73.90847969206546!3d40.66490264739892!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1601263396347!5m2!1sen!2sbd"></iframe>
            </div>
        </section>
        <!-- google-map-section end -->
 <?php $__env->stopSection(); ?>     

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/contact-us.blade.php ENDPATH**/ ?>