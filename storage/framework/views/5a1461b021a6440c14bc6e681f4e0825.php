<?php $__env->startSection('content'); ?>

        <!-- Page Title -->
        <section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1><?php echo app('translator')->get('messages.About'); ?></h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="<?php echo e(route( '/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                        <li><?php echo app('translator')->get('messages.About'); ?></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- about-section -->
        <section class="about-section">
            <div class="auto-container">
                <div class="clearfix row">
                    <div class="col-lg-6 col-md-6 col-sm-12 content-column">
                        <div class="content_block_3">
                            <div class="content-box">
                                <div class="sec-title">
                                    <span><?php echo app('translator')->get('messages.About'); ?></span>
                                    <h2><?php echo app('translator')->get('messages.About Our Company'); ?></h2>
                                </div>
                                <div class="text">
                                    <p>
                                    <?php echo app('translator')->get('messages.para5'); ?>
                                    </p>
                                    <h3><?php echo app('translator')->get('messages.What We Do'); ?></h3>
                                    <p><?php echo app('translator')->get('messages.para6'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 image-column">
                        <div class="image_block_1">
                            <div class="image-box">
                                <div class="image-pattern">
                                    <div class="pattern-1" style="background-image: url(newFrontend/Clasifico/assets/images/shape/shape-16.png);"></div>
                                    <div class="pattern-2" style="background-image: url(newFrontend/Clasifico/assets/images/shape/shape-16.png);"></div>
                                </div>
                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/about-1.png" alt=""></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about-section end -->


        <!-- process-section -->
        <section class="process-section centred sec-pad">
            <div class="pattern-layer" style="background-image: url(newFrontend/Clasifico/assets/images/shape/shape-17.png);"></div>
            <div class="auto-container">
                <div class="sec-title centred">
                    <span><?php echo app('translator')->get('messages.Process'); ?></span>
                    <h2><?php echo app('translator')->get('messages.How it Works'); ?></h2>
                    <p><?php echo app('translator')->get('messages.para7'); ?>
                       </p>
                </div>
                <div class="inner-content">
                    <div class="clearfix row">
                        <div class="col-lg-4 col-md-6 col-sm-12 process-block">
                            <div class="process-block-one">
                                <div class="inner-box">
                                    <span class="count wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">01</span>
                                    <div class="text wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="icon-box"><i class="fas fa-user"></i></div>
                                        <h3><?php echo app('translator')->get('messages.Create Account'); ?></h3>
                                        <p><?php echo app('translator')->get('messages.accpara'); ?></p>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 process-block">
                            <div class="process-block-one">
                                <div class="inner-box">
                                    <span class="count wow fadeInDown animated" data-wow-delay="300ms" data-wow-duration="1500ms">02</span>
                                    <div class="text wow fadeInUp animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="icon-box"><i class="fas fa-glass-martini"></i></div>
                                        <h3><?php echo app('translator')->get('messages.Post Your Ads'); ?></h3>
                                        <p><?php echo app('translator')->get('messages.postpara'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 process-block">
                            <div class="process-block-one">
                                <div class="inner-box">
                                    <span class="count wow fadeInDown animated" data-wow-delay="600ms" data-wow-duration="1500ms">03</span>
                                    <div class="text wow fadeInUp animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div class="icon-box"><i class="fas fa-dollar-sign"></i></div>
                                        <h3><?php echo app('translator')->get('messages.Sell Your Item'); ?></h3>
                                        <p><?php echo app('translator')->get('messages.sellpara'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- process-section end -->


    
<!--about new process section-->
        <div class="py-5 about-yaka-section">
            <div class="container">
              <div class="mb-4 text-center row">
                <div class="col">
                  <img src="<?php echo e(asset('newFrontend/Clasifico/assets/images/resource/yaka-process.png')); ?>" alt="About Illustration" class="img-fluid" style="max-width: 400px; height:auto">
                  <p class="text-muted"><?php echo app('translator')->get('messages.para8'); ?></p>
                  </div>
              </div>
              <div class="row">
                <div class="mb-4 col-md-6 d-flex align-items-start">
                  <img src="<?php echo e(asset('newFrontend/Clasifico/assets/images/resource/about-sell2.png')); ?>" alt="Sell Icon" class="me-3 img-fluid" style="width: 85px; height: 85px;">
                  <div>
                    <h4><?php echo app('translator')->get('messages.Have items to sell?'); ?></h4>
                    <p><?php echo app('translator')->get('messages.para9'); ?></p>
                  </div>
                </div>
                <div class="mb-4 col-md-6 d-flex align-items-start">
                  <img src="<?php echo e(asset('newFrontend/Clasifico/assets/images/resource/about-buy.png')); ?>" alt="Buy Icon" class="me-3 img-fluid" style="width: 95px; height: 95px;">
                  <div>
                    <h4><?php echo app('translator')->get('messages.Looking to buy something?'); ?></h4>
                    <p><?php echo app('translator')->get('messages.para10'); ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!--end about new process section-->



 <?php $__env->stopSection(); ?>       

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/about-us.blade.php ENDPATH**/ ?>