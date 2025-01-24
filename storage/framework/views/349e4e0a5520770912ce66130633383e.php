<section class="dash-header-part">
    <div class="container">
        <div class="dash-header-card">
            <div class="row">
                <div class="col-lg-5">
                    <div class="dash-header-left">
                        <div class="dash-avatar">
                            <?php if(isset(Session::get('user')['profileImage']) && Session::get('user')['profileImage']!=''): ?>
                                <a href="#"><img src="<?php echo e(asset('images/user/'.Session::get('user')['profileImage'])); ?>" alt="user"></a>

                            <?php else: ?>
                                <a href="#"><img src="<?php echo e(asset('web/images/user.png')); ?>" alt="user"></a>
                            <?php endif; ?>
                        </div>
                        <div class="dash-intro">
                            <h4><a href="#"><?php echo e(Session::get('user')['first_name']." ".Session::get('user')['last_name']); ?></a></h4>
                            <h5><?php echo e(Session::get('user')['url']); ?></h5>
                            
                            <ul class="dash-meta">
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <span><?php echo e(Session::get('user')['phone_number']); ?></span>
                                </li>
                                <?php if(Session::get('user')['email']!=null): ?>
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <span><?php echo e(Session::get('user')['email']); ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="dash-header-right">
                        <div class="dash-focus dash-list">
                            <h2><?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('Post', app()->getLocale())); ?></h2>
                            <p><?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('Your Ads', app()->getLocale())); ?></p>
                        </div>
                        <div class="dash-focus dash-book">
                            <h2><?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('Need', app()->getLocale())); ?></h2>
                            <p> <?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('To Buy ', app()->getLocale())); ?></p>
                        </div>
                        <div class="dash-focus dash-rev">
                            <h2><?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('Boost', app()->getLocale())); ?></h2>
                            <p><?php echo e(Stichoza\GoogleTranslate\GoogleTranslate::trans('Your Ads', app()->getLocale())); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            
<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/Blocks/dashboard-nav.blade.php ENDPATH**/ ?>