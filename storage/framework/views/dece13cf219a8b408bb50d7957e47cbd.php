<?php $__env->startSection('content'); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash-menu-list">
                            <ul>
                                <li><a  class="active" href="<?php echo e(route('user.dashboard')); ?>">dashboard</a></li>
                                <li><a href="<?php echo e(route('user.dashboard.ad-post.main')); ?>">ad post</a></li>
                                <li><a href="<?php echo e(route('user.dashboard.my-ads',['all'])); ?>">my ads</a></li>
                                <li><a href="<?php echo e(route('user.dashboard.setting',[Session::get('user')['url']])); ?>">Profile</a></li>
                                <li><a href="/chatify">message</a></li>
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
                    <h1><?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('Hello,', app()->getLocale())); ?> <?php echo e(Session::get('user')['first_name']); ?></h1>
                    <h1><?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('welcome to Yaka.lk', app()->getLocale())); ?></h1>
                    <p>  <?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans(" We're thrilled to have you here. As a valued member of our community, you now have access to the largest online marketplace in Sri Lanka, where countless opportunities await you.
                        Explore an extensive range of categories, from real estate and vehicles to electronics and fashion. Our platform connects you with local sellers and unique products, making it easier than ever to find exactly what you need. With user-friendly features, advanced search options, and exclusive offers, shopping has never been more convenient.
                        Thank you for joining yaka.lk —dive in and start discovering the best deals and services ", app()->getLocale())); ?></p>
                </div>
            </div>

            

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/user/dashboard.blade.php ENDPATH**/ ?>