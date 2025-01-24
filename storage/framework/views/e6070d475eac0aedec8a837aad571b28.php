<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12">
        <div class="dash-menu-list">
            <ul>
                <li><a  href="<?php echo e(route('user.dashboard')); ?>">dashboard</a></li>
                <li><a  class="active" href="<?php echo e(route('user.dashboard.ad-post.main')); ?>">ad post</a></li>
                <li><a href="<?php echo e(route('user.dashboard.my-ads',['all'])); ?>">my ads</a></li>
                <li><a href="<?php echo e(route('user.dashboard.setting',[Session::get('user')['url']])); ?>">Profile</a></li>
                <li><a href="/chatify">message</a></li>
                <li><a href="<?php echo e(route('logout')); ?>">logout</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
</section>
    <section id="up" class="adpost-part" style="margin: 50px 50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-card alert fade show">
                        <div class="account-title">
                            <h3>Main Categories</h3>
                        </div>
                        <ul class="account-card-text">
                            <?php $__currentLoopData = $maincategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $maincategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li   style="cursor: pointer;">
                                <a href="<?php echo e(route('user.dashboard.ad-post.sub',[$maincategory->url])); ?>"><p <?php if(isset($okmaincategory) && $okmaincategory->url == $maincategory->url): ?> <?php endif; ?> ><?php echo e($maincategory->name); ?></p></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

            <?php if(isset($subcategories)): ?>
                <div class="col-lg-6" style="    height: 701px;
    overflow: hidden;
    overflow-y: scroll;">
                    <div class="account-card alert fade show">
                        <div class="account-title">
                            <h3>Sub Categories</h3>
                        </div>
                        <ul class="account-card-text">
                            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li style="cursor: pointer">
                                    <a href="<?php echo e(route('user.dashboard.ad-post.main.sub',[$okmaincategory->url,$subcategory->url])); ?>"><p><?php echo e($subcategory->name); ?></p></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.user.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/user/main-categories.blade.php ENDPATH**/ ?>