<nav class="mobile-nav">
    <div class="container">
        <div class="mobile-group">
            <a href="/" class="mobile-widget">
                <i class="fas fa-home"></i>
                <span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('home', app()->getLocale())); ?></span>
            </a>

            <?php if(isset(Session::get('user')['id'])): ?>
                <a href="<?php echo e(route('user.dashboard')); ?>" class="mobile-widget">
                    <i class="fas fa-user"></i>
                    <span><?php echo e(Session::get('user')['first_name']); ?></span>
                </a>
                <a href="<?php echo e(route('user.dashboard.ad-post.main')); ?>" class="mobile-widget plus-btn">
                    <i class="fas fa-plus"></i>
                    <span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Ad Post', app()->getLocale())); ?></span>
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="mobile-widget">
                    <i class="fas fa-user"></i>
                    <span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('SignIn / SingUp', app()->getLocale())); ?> </span>
                </a>
                <a href="<?php echo e(route('about-us')); ?>" class="mobile-widget">
                    <i class="fas fa-envelope"></i>
                    <span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('About Us', app()->getLocale())); ?></span>
                </a>
            <?php endif; ?>
           
            
            
            <a href="<?php echo e(route('contact-us')); ?>" class="mobile-widget">
                <i class="fas fa-envelope"></i>
                <span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Contact', app()->getLocale())); ?></span>
            </a>
            
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/mobile-nav.blade.php ENDPATH**/ ?>