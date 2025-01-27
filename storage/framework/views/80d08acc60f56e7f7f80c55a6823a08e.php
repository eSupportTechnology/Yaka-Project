


<?php $__env->startSection('content'); ?>
        


        <!-- Page Title -->
        <section class="page-title style-two" style="background-image: url(assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="content-box centred mr-0">
                    <div class="title">
                        <h1>Log in</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Log in</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- login-section -->
        <section class="login-section bg-color-2">
            <div class="auto-container">
                <div class="inner-container">
                    <div class="inner-box">
                        <h2>Log in</h2>
                        <form action="<?php echo e(route('custom.login')); ?>" method="POST" class="login-form">
                             <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" required="">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" required="">
                            </div>
                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn-one">Login Now</button>
                            </div>
                        </form>


                        <div class="other-content centred">
                            <div class="text"><span>or</span></div>
                            <div class="othre-text">
                                <p>Don’t have an account? <a href="<?php echo e(route('register')); ?>">Register Now</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- login-section end -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/login.blade.php ENDPATH**/ ?>