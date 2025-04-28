<!-- Add this inside your <head> -->
    

<?php $__env->startSection('content'); ?>


<style>
    .fb-icon i {
    background-color: #3b5998;
}

.insta-icon i {
    background: linear-gradient(45deg, #f9ce34, #ee2a7b, #6228d7);
}

.twitter-icon i {
    background-color: #0082ca;
}

.linkedin-icon i {
    background-color: #0082ca;
}

.whatsppfb-icon i {
    background-color: #25d366;
}

.utube-icon i {
    background-color: #ed302f;
}


.sidebar-icon i {
    width: 46px;
    height: 46px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    color: white;
}
.contat-icon i{
    width: 10px;
    height: 10px;
    justify-content: center;
    align-items: center;
    border-radius: 50%;

}

</style>
<!-- Page Title -->
        <section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1><?php echo app('translator')->get('messages.Contact Us'); ?></h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="<?php echo e(route( '/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                        <li><?php echo app('translator')->get('messages.Contact Us'); ?></li>
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
                                <span><?php echo app('translator')->get('messages.Contact Us'); ?></span>
                                <h2><?php echo app('translator')->get('messages.Our Contacts & Location'); ?></h2>
                            </div>
                            <!--<div class="single-box">
                                <h3>Opening hours</h3>
                                <ul class="clearfix list">
                                    <li>Daily: 9.30 AM–6.00 PM</li>
                                    <li>Sunday & Holidays: Closed</li>
                                </ul>
                            </div>-->
                            <div class="single-box">
                                <h3><?php echo app('translator')->get('messages.Contact info'); ?></h3>
                                <ul class="clearfix list">
                                    <li ><i class="fas fa-map-marker-alt"  style="margin-right: 10px;" ></i>Colombo 10,Sri Lanka </li>
                                    <li ><a href="mailto:Info@yaka.lk" class="contat-icon "  ><i class="fas fa-envelope" style="margin-right: 15px;"></i>Info@yaka.lk</a></li>
                                    <li ><a href="mailto:Yaka.lk@outlook.com" ><i class="fas fa-envelope" style="margin-right: 10px;" ></i>Yaka.lk@outlook.com</a></li>
                                    <li ><a href="mailto:Yakalksrilanka@gmail.com" ><i class="fas fa-envelope" style="margin-right: 10px;" ></i>Yakalksrilanka@gmail.com</a></li>
                                    <li ><a href="tel:070 5 321 321" ><i class="fas fa-microphone" style="margin-right: 10px;" ></i>070 5 321 321</a></li>
                                </ul>
                            </div>
                            <div class="single-box">
                                <h3><?php echo app('translator')->get('messages.Social contact'); ?></h3>
                                <ul class="clearfix sidebar-social-media" style="list-style-type: none; margin: 0; padding: 0; display: flex; justify-content: flex-start;">
                                    <li style="margin-right: 10px;"><a href="https://www.facebook.com/profile.php?id=61565478456618" class="sidebar-icon fb-icon"><i class="fab fa-facebook-f"></i></a></li>
                                    <li style="margin-right: 10px;"><a href="index.html" class="sidebar-icon twitter-icon"><i class="fab fa-twitter"></i></a></li>
                                    <li style="margin-right: 10px;"><a href="https://www.instagram.com/yaka.lk6/" class="sidebar-icon insta-icon"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://youtube.com/@yakalk-g5d?si=rQOXNvOlU_B7fcMo" class="sidebar-icon utube-icon"><i class="fab fa-youtube"></i></a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 form-column">
                        <div class="form-inner">
                            <h2><?php echo app('translator')->get('messages.Get in Touch'); ?></h2>
                            <form method="post" action="<?php echo e(route('contact.send')); ?>" id="contact-form" class="default-form">
                                <?php echo csrf_field(); ?>
                                <div class="clearfix row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label><?php echo app('translator')->get('messages.Name'); ?>*</label>
                                        <input type="text" name="username" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label><?php echo app('translator')->get('messages.Email'); ?> *</label>
                                        <input type="email" name="email" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <label><?php echo app('translator')->get('messages.Phone'); ?></label>
                                        <input type="text" name="phone" required="">
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                                        <label><?php echo app('translator')->get('messages.Subject'); ?></label>
                                        <input type="text" name="subject" required="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label><?php echo app('translator')->get('messages.Message'); ?> ...</label>
                                        <textarea name="message"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                        <button class="theme-btn-one" type="submit" name="submit-form"><?php echo app('translator')->get('messages.Submit'); ?></button>
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
        <!-- Google Map Section Start -->
<section class="google-map-section">
    <div class="contact-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63315.25275813327!2d79.85253170205796!3d6.927078796239132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25960c3fdba49%3A0x86338b0b7e58e8eb!2sColombo%2010%2C%20Colombo!5e0!3m2!1sen!2slk!4v1706523456789!5m2!1sen!2slk"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>
</section>
<!-- Google Map Section End -->



 <?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/contact-us.blade.php ENDPATH**/ ?>