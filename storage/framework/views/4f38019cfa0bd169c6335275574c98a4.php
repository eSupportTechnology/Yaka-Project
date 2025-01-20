<div class="feature-card">
    
    <a href="#" class="feature-img" style="height: 270px;width: 380px;margin: 0 auto;background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>);background-size: cover;background-position: center">
        <!--<img  src="<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>" alt="feature">-->
    </a>

    <?php if($ads->post_type == 0): ?>
        <div class="product-type">
            <span class="flat-badge booking">booking</span>
        </div>

    <?php elseif($ads->post_type == 1): ?>
        <div class="product-type">
            <span class="flat-badge sale">sale</span>
        </div>

    <?php elseif($ads->post_type == 2): ?>
        <div class="product-type">
            <span class="flat-badge rent">rent</span>
        </div>
    <?php endif; ?>

    <?php if($ads->ads_package == 3): ?>
        <div class="cross-vertical-badge product-badge" style="">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="<?php echo e(asset('01.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>top Ad</span>
        </div>

    <?php elseif($ads->ads_package == 4): ?>
        <div class="cross-vertical-badge product-badge">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="<?php echo e(asset('03.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>Urgent Ad</span>
        </div>

    <?php elseif($ads->ads_package == 5): ?>
        <div class="cross-vertical-badge product-badge">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="<?php echo e(asset('04.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>Jump up Ad</span>
        </div>

    <?php elseif($ads->ads_package == 6): ?>
        <div class="cross-vertical-badge product-badge">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="<?php echo e(asset('02.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>Super Ad</span>
        </div>
    <?php endif; ?>

    <div class="feature-content" style="padding: 25px; position: absolute;background: none;border-radius: 0px 0px 8px 8px;" >
        <ol class="breadcrumb feature-category">
            <li class="breadcrumb-item"><a href="<?php echo e(route('ads',[$ads->category->url])); ?>"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())); ?></a>
            </li>
            <li class="breadcrumb-item active"
                aria-current="page"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())); ?></li>
        </ol>
        <h3 class="feature-title"><a href="<?php echo e(route('ads.details',['id'=>$ads->id])); ?>"><?php echo e($ads->title); ?></a>
        </h3>
        <div class="feature-meta">
            <span class="feature-price">LKR <?php echo e($ads->price); ?></span>
            <span class="feature-time"><i  class="fas fa-clock"></i><?php echo e($ads->created_at->diffForHumans()); ?></span>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/components/cards/slideAdsCards.blade.php ENDPATH**/ ?>