<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/userdashboard.css')); ?>" rel="stylesheet">

 <!-- Page Title -->
 <section  class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            <div class="content-box centred mr-0">
                <div class="title">
                    <h1>Dashboard</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="<?php echo e(route('/')); ?>">Home</a></li>
                    <li>Dashboard</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

        <section class="dash-header-part mb-4">
                    <div class="container" >
                        <div class="dash-header-card"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-height:230px; height:auto" >
                            <div class="row">
                                <div class="col-lg-5">
                                <div class="dash-header-left">
                                  <div class="dash-avatar">
                                        <?php if(Auth::check() && Auth::user()->profileImage): ?> 
                                            <a href="#"><img src="<?php echo e(asset('storage/profile_images/' . Auth::user()->profileImage)); ?>" 
                                            alt="user"></a>
                                        <?php else: ?>
                                            <a href="#"><img src="<?php echo e(asset('web/images/user.png')); ?>" alt="user"></a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="dash-intro">
                                        <h4><a href="#"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></a></h4>
                                        <h5><?php echo e(Auth::user()->email); ?></h5>

                                        <ul class="dash-meta">
                                            <li>
                                                <i class="fas fa-phone"></i>
                                                <span><?php echo e(Auth::user()->phone_number); ?></span>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope"></i>
                                                <span><?php echo e(Auth::user()->email); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                <div class="col-lg-7">
                    <div class="dash-header-right">
                        <div class="dash-focus dash-list">
                            <h2>Post</h2>
                            <p>Your Ads</p>
                        </div>
                        <div class="dash-focus dash-book">
                            <h2>Need</h2>
                            <p> To Buy</p>
                        </div>
                        <div class="dash-focus dash-rev">
                            <h2>Boost</h2>
                            <p>Your Ads'</p>
                        </div>
                    </div>
                </div>
            </div>
      
            

                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash-menu-list">
                            <ul>
                                <li><a  class="active" href="<?php echo e(route('user.dashboard')); ?>">dashboard</a></li>
                                <li><a href="<?php echo e(route('user.ad_posts')); ?>">ad post</a></li>
                                <li><a >my ads</a></li>
                                <li><a href="<?php echo e(route('user.profile')); ?>">Profile</a></li>
                                <li><a href="">message</a></li>
                                <li>
                                    <a href="<?php echo e(route('logout')); ?>" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="dashboard-part mt-4 mb-4">
        <div class="container mb-4">

            <?php if(session('success')): ?>  
                <div class="alert alert-success" role="alert" style="margin-top: 20px;padding: 18px;0border-radius: 6px;">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger" role="alert" style="margin-top: 20px;padding: 18px;0border-radius: 6px;">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?>
            
            <div class="row mt-5 " >
              
                <div class="col-lg-4">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
                    <dotlottie-player src="https://lottie.host/07462177-04f3-4b21-93c1-8455179693c0/EUCuUmDPlB.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
                </div>
                <div class="col-lg-8">
                    <h1>Hello, <?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></h1>
                    <h1>Welcome to Yaka.lk</h1>
                    <p style="text-align:justify">   We're thrilled to have you here. As a valued member of our community, you now have access to the largest online marketplace in Sri Lanka, where countless opportunities await you.
                        Explore an extensive range of categories, from real estate and vehicles to electronics and fashion. Our platform connects you with local sellers and unique products, making it easier than ever to find exactly what you need. With user-friendly features, advanced search options, and exclusive offers, shopping has never been more convenient.
                        Thank you for joining yaka.lk —dive in and start discovering the best deals and services </p>
                </div>
            </div>

            

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/user/dashboard.blade.php ENDPATH**/ ?>