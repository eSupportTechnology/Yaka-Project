<div class="product-card

    <?php if($ads->ads_package == 5): ?> 
    product-jump-up-card " onload="blinkBorder('product-jump-up-card');" 
    <?php elseif($ads->ads_package == 3): ?>
    product-top-card " onload="blinkBorder('product-top-card');" 
    <?php endif; ?>

   style="margin-bottom: 10px">
    <div style="width: 100%;margin: 0 auto;"  class="product-media">
        <div class="product-img" style="height: 220px;background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>);background-size: cover;background-position: center">

        </div>

        <?php if($ads->post_type == 0 && $ads->post_type != null): ?>
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
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="<?php echo e(asset('01.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>top Ad</span>
            </div>

        <?php elseif($ads->ads_package == 4): ?>
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="<?php echo e(asset('03.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>Urgent Ad</span>
            </div>
        <?php elseif($ads->ads_package == 5): ?>
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="<?php echo e(asset('04.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>Jump up Ad</span>
            </div>

        <?php elseif($ads->ads_package == 6): ?>
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="<?php echo e(asset('02.png')); ?>" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>Super Ad</span>
            </div>
        <?php endif; ?>
    </div>
    <div class="product-content">
        <ol class="breadcrumb product-category">
            <li><i class="fas fa-tags"></i></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('ads',[$ads->category->url])); ?>"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())); ?></li>
        </ol>

        <h5 class="product-title">
            <a href="<?php echo e(route('ads.details',['id'=>$ads->id])); ?>"><?php echo e($ads->title); ?></a>

            <div class="product-meta">

            

                <span><i class="fas fa-clock"></i><?php echo e($ads->created_at->diffForHumans()); ?></span>
            </div>
            <?php if(isset(Session::get('user')['id']) && Session::get('user')['id'] == $ads->user->id &&  $ads->status == 1 &&  $ads->ads_package == 0 && isset($bumpUp) && $bumpUp): ?>
                <a style="margin: 5px 0" href="<?php echo e(route('ads.bump-up',[$ads->id])); ?>">
                    <span class="flat-badge rent">Jump up</span>
                </a>
            <?php endif; ?>






            <?php
                $job = \App\Models\Jobs::where('adsId',$ads->adsId)->select('salary_per_month')->first();
            ?>
            <?php if(isset($job->salary_per_month)): ?>
            <div class="product-info">

                <h5 class="product-price"> <?php echo e($ads->category->url=='jobs' ? "salary per month ".$job->salary_per_month : "LKR ".$ads->price); ?></h5>
            </div>
            <?php endif; ?>
        </h5>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/components/cards/adCards.blade.php ENDPATH**/ ?>