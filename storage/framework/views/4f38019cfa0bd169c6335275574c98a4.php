<div class="feature-card" style="width: 100%; margin: 0; padding: 0;">
    <a href="#" class="feature-img" 
       style="height: 270px; width: 100%; margin: 0 auto; background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>); background-size: cover; background-position: center;">
        <!-- Background image applied directly -->
    </a>

    <?php if($ads->post_type == 0): ?>
        <div class="product-type" style="position: absolute; top: 10px; left: 10px;">
            <span class="flat-badge booking" style="background-color: #28a745; color: #fff; padding: 5px 10px; border-radius: 5px;">booking</span>
        </div>
    <?php elseif($ads->post_type == 1): ?>
        <div class="product-type" style="position: absolute; top: 10px; left: 10px;">
            <span class="flat-badge sale" style="background-color: #dc3545; color: #fff; padding: 5px 10px; border-radius: 5px;">sale</span>
        </div>
    <?php elseif($ads->post_type == 2): ?>
        <div class="product-type" style="position: absolute; top: 10px; left: 10px;">
            <span class="flat-badge rent" style="background-color: #ffc107; color: #fff; padding: 5px 10px; border-radius: 5px;">rent</span>
        </div>
    <?php endif; ?>

    <!-- Ad package badges -->
    <?php if($ads->ads_package == 3): ?>
        <div class="cross-vertical-badge product-badge" 
             style="position: absolute; top: 10px; right: 10px; text-align: center; width: 60px;">
            <i style="font-size: 30px; display: block; width: 56px;">
                <img src="<?php echo e(asset('01.png')); ?>" alt="" style="width: 39px; margin-top: 4px;">
            </i>
            <span style="font-size: 12px; color: #fff;">Top Ad</span>
        </div>
    <?php elseif($ads->ads_package == 4): ?>
        <div class="cross-vertical-badge product-badge" 
             style="position: absolute; top: 10px; right: 10px; text-align: center; width: 60px;">
            <i style="font-size: 30px; display: block; width: 56px;">
                <img src="<?php echo e(asset('03.png')); ?>" alt="" style="width: 39px; margin-top: 4px;">
            </i>
            <span style="font-size: 12px; color: #fff;">Urgent Ad</span>
        </div>
    <?php elseif($ads->ads_package == 5): ?>
        <div class="cross-vertical-badge product-badge" 
             style="position: absolute; top: 10px; right: 10px; text-align: center; width: 60px;">
            <i style="font-size: 30px; display: block; width: 56px;">
                <img src="<?php echo e(asset('04.png')); ?>" alt="" style="width: 39px; margin-top: 4px;">
            </i>
            <span style="font-size: 12px; color: #fff;">Jump up Ad</span>
        </div>
    <?php elseif($ads->ads_package == 6): ?>
        <div class="cross-vertical-badge product-badge" 
             style="position: absolute; top: 10px; right: 10px; text-align: center; width: 60px;">
            <i style="font-size: 30px; display: block; width: 56px;">
                <img src="<?php echo e(asset('02.png')); ?>" alt="" style="width: 39px; margin-top: 4px;">
            </i>
            <span style="font-size: 12px; color: #fff;">Super Ad</span>
        </div>
    <?php endif; ?>

    <!-- Feature content -->
    <div class="feature-content" 
         style="padding: 25px; background: rgba(255, 255, 255, 0.8); border-radius: 0px 0px 8px 8px; width: 100%; position: relative;">
        <ol class="breadcrumb feature-category" style="padding: 0; margin: 0; list-style: none; display: flex; gap: 5px;">
            <li class="breadcrumb-item" style="font-size: 14px; color: #007bff;">
                <a href="<?php echo e(route('ads', [$ads->category->url])); ?>" 
                   style="text-decoration: none; color: inherit;">
                    <?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())); ?>

                </a>
            </li>
            <li class="breadcrumb-item active" style="font-size: 14px; color: #6c757d;" aria-current="page">
                <?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())); ?>

            </li>
        </ol>
        <h3 class="feature-title" 
            style="margin: 10px 0; font-size: 18px; font-weight: bold; line-height: 1.2;">
            <a href="<?php echo e(route('ads.details', ['id' => $ads->id])); ?>" 
               style="text-decoration: none; color: #333;">
                <?php echo e($ads->title); ?>

            </a>
        </h3>
        <div class="feature-meta" style="display: flex; justify-content: space-between; font-size: 14px;">
            <span class="feature-price" style="color: #28a745; font-weight: bold;">LKR <?php echo e($ads->price); ?></span>
            <span class="feature-time" style="color: #6c757d;">
                <i class="fas fa-clock" style="margin-right: 5px;"></i><?php echo e($ads->created_at->diffForHumans()); ?>

            </span>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/components/cards/slideAdsCards.blade.php ENDPATH**/ ?>