

<?php $__env->startSection('content'); ?>
<style>
    dashboard-banner {
  padding: 100px 0px 200px;
}

.dash-header-part {
  margin-top: -100px;
  position: relative;
  z-index: 1;
}

.dash-header-card {
  padding: 30px 30px 0px 30px;
  background: var(--white);
  border-radius: 8px;
}

.dash-header-left {
  display: flex;
  align-items: center;
  justify-content: center;
  justify-content: flex-start;
}

.dash-header-right {
  display: flex;
  align-items: center;
  justify-content: center;
}

.dash-avatar {
  margin-right: 30px;
}

.dash-avatar a {
  border-radius: 50%;
  border: 3px solid var(--primary);
}

.dash-avatar a img {
  width: 140px;
  border-radius: 50%;
  border: 3px solid var(--white);
}

.dash-intro h4 a {
  color: var(--heading);
  text-transform: capitalize;
}

.dash-intro h5 {
  font-size: 14px;
  line-height: 22px;
  color: var(--gray);
  text-transform: capitalize;
  margin-bottom: 8px;
}

.dash-meta li {
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  margin-bottom: 3px;
  color:black;
}

.dash-meta li:last-child {
  margin-bottom: 0px;
}

.dash-meta li i {
  font-size: 14px;
  margin-top: 5px;
  margin-right: 10px;
  color: rgb(156, 20, 20);
}

.dash-meta li span {
  font-size: 14px;
  line-height: 22px;
}

.dash-focus {
  width: 100%;
  padding: 25px 0px;
  text-align: center;
  margin-right: 20px;
  border-radius: 8px;
  background: url(../../images/bg/04.png);
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  position: relative;
  z-index: 1;
}

.dash-focus::before {
  position: absolute;
  content: "";
  top: 0px;
  left: 0px;
  width: 100%;
  height: 100%;
  border-radius: 8px;
  background: var(--primary);
  opacity: 0.8;
  z-index: -1;
}

.dash-focus:last-child {
  margin-right: 0px;
}

.dash-focus h2 {
  color: var(--white);
  font-family: sans-serif;
}

.dash-focus p {
  color: var(--white);
  text-transform: capitalize;
}

.dash-list::before {
  background: #df1313;
}

.dash-book::before {
  background: #00af1e;
}

.dash-rev::before {
  background: #d0a300;
}

.dash-menu-list {
  margin-top: 30px;
}

.dash-menu-list ul {
  display: flex;
  align-items: center;
  justify-content: center;
  justify-content: space-between;
}

.dash-menu-list ul li {
  width: 100%;
}

.dash-menu-list ul li a {
  width: 100%;
  font-size: 14px;
  font-weight: 500;
  text-align: center;
  text-transform: uppercase;
  padding: 12px 0px;
  color: var(--heading);
  background: var(--white);
  border-bottom: 2px solid var(--white);
}

.dash-menu-list ul li .active {
  color: var(--primary);
  text-shadow: var(--primary-tshadow);
  border-bottom: 2px solid var(--primary);
}

@media (max-width: 991px) {
  .dash-menu-list {
    overflow-x: scroll;
  }
  .dash-menu-list ul {
    width: 900px;
  }
}

@media (max-width: 575px) {

  .dash-header-card {
    padding: 20px 20px 0px 20px;
  }
  .dash-header-left {
    flex-direction: column;
    align-items: flex-start;
  }
  .dash-avatar {
    margin-right: 0px;
    margin-bottom: 5px;
  }
  .dash-intro h5 {
    margin-bottom: 12px;
  }
  .dash-meta {
    margin-bottom: 25px;
  }
  .dash-header-right {
    flex-direction: column;
  }
  .dash-focus {
    margin-bottom: 20px;
    margin-right: 0px;
  }
  .dash-focus:last-child {
    margin-bottom: 0px;
  }

}

@media (min-width: 576px) and (max-width: 767px) {
  .dash-header-right {
    margin-top: 30px;
  }
  .dash-focus h2 {
    font-size: 32px;
  }
}

@media (min-width: 768px) and (max-width: 991px) {

  .dash-header-right {
    margin-top: 30px;
  }
}

@media (min-width: 992px) and (max-width: 1199px) {
  .dash-avatar {
    margin-right: 25px;
  }
  .dash-avatar a img {
    width: 120px;
  }
}

</style>

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

        <section class="dash-header-part">
                    <div class="container">
                        <div class="dash-header-card"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" >
                            <div class="row">
                                <div class="col-lg-5">
                                <div class="dash-header-left">
                                    <div class="dash-avatar">
                                        <a href="#">
                                            <img src="<?php echo e(asset('yaka-payment.png')); ?>" alt="user">
                                        </a>
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
                                <li><a href="">ad post</a></li>
                                <li><a href="">my ads</a></li>
                                <li><a href="">Profile</a></li>
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
    <section class="dashboard-part">
        <div class="container">

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
            
            <div class="row mt-5" >
              
                <div class="col-lg-4">
                    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 
                    <dotlottie-player src="https://lottie.host/07462177-04f3-4b21-93c1-8455179693c0/EUCuUmDPlB.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
                </div>
                <div class="col-lg-8">
                    <h1></h1>
                    <h1>welcome to Yaka.lk</h1>
                    <p>   We're thrilled to have you here. As a valued member of our community, you now have access to the largest online marketplace in Sri Lanka, where countless opportunities await you.
                        Explore an extensive range of categories, from real estate and vehicles to electronics and fashion. Our platform connects you with local sellers and unique products, making it easier than ever to find exactly what you need. With user-friendly features, advanced search options, and exclusive offers, shopping has never been more convenient.
                        Thank you for joining yaka.lk —dive in and start discovering the best deals and services </p>
                </div>
            </div>

            

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/user/dashboard.blade.php ENDPATH**/ ?>