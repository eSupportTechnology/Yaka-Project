<?php $__env->startSection('content'); ?>

    <!--=====================================
                  SINGLE BANNER PART START
        =======================================-->
    <section class="inner-section single-banner" style="margin-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2><?php echo e($nowSearchSubCategoryUrl==0 ? \Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale()) : \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchSubCategoryUrl), app()->getLocale())); ?></h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('/')); ?>"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Home', app()->getLocale())); ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($nowSearchSubCategoryUrl==0 ?  \Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale()): \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchSubCategoryUrl), app()->getLocale())); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-section" style="margin-bottom: 50px;">
        <div class="container" style="overflow: hidden; padding: 0;">
            <figure id="zss">
                <?php
                    $banners = App\Models\Banners::where('type', 0)->inRandomOrder()->limit(4)->get();
                ?>
                <?php if($banners->count() >= 4): ?>
                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="zss" >
                            <img style="width: 100%;" src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="zss" style="background: url('<?php echo e(asset('banners/' . $banners[0]->img)); ?>') no-repeat; background-size: cover;"></div>
                <?php endif; ?>
            </figure>
        </div>
    </section>

    <!--=====================================
              SINGLE BANNER PART END
    =======================================-->


    <!--=====================================
                AD LIST PART START
    =======================================-->
    <section class="inner-section ad-list-part">
        <div class="container" style="background-color:white; padding:20px">
        <div class="row content-reverse">
            <!-- Left Filter Section -->
            <div class="col-lg-4 col-xl-3">
                <div class="row">
                    <?php if($nowSearchSubCategoryUrl != 0): ?>
                        <?php echo $__env->make('web.components.filters.location', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if($adsurl == 'jobs'): ?>
                            <?php echo $__env->make('web.components.filters.'.$adsurl.'.'.$adsurl, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <?php echo $__env->make('web.components.filters.'.$adsurl.'.'.$nowSearchSubCategoryUrl, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo $__env->make('web.components.filters.category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('web.components.filters.sub-category', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Main Content and Banner Section -->
            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <!-- Main Content Section -->
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="header-filter">
                                    <div class="filter-show">
                                        <span style="text-transform: capitalize">
                                            <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>
                                            <?php if($nowSearchLocation == 0): ?>
                                                <?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('All Locations', app()->getLocale())); ?>

                                            <?php else: ?>
                                                <?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchLocation), app()->getLocale())); ?>

                                            <?php endif; ?>
                                        </span>
                                    </div>
                                    <div class="filter-short">
                                        <span style="text-transform: capitalize">
                                            <i class="fas fa-tags" style="margin-right: 10px;"></i>
                                            <?php echo e($nowSearchSubCategoryUrl == 0 ? \Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale()) : \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchSubCategoryUrl), app()->getLocale())); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if(count($Urgent) > 0): ?>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="slider-arrow" style="width: 100%; padding: 0; margin-bottom: 50px">
                                        <?php $__currentLoopData = $Urgent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="feature-card" style="width: 100%; padding: 0;">
                                                <a href="#" class="feature-img" style="height: 270px;width: 100%;margin: 0 auto;background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>);background-size: cover;background-position: center">
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
                                                    <div class="cross-vertical-badge product-badge">
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

                                                <div class="feature-content" style="padding: 25px; position: absolute; background: none; border-radius: 0px 0px 8px 8px;">
                                                    <ol class="breadcrumb feature-category">
                                                        <li class="breadcrumb-item"><a href="<?php echo e(route('ads',[$ads->category->url])); ?>"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())); ?></a></li>
                                                        <li class="breadcrumb-item active" aria-current="page"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())); ?></li>
                                                    </ol>
                                                    <h3 class="feature-title"><a href="<?php echo e(route('ads.details',['id'=>$ads->id])); ?>"><?php echo e($ads->title); ?></a></h3>
                                                    <div class="feature-meta">
                                                        <span class="feature-price">LKR <?php echo e($ads->price); ?></span>
                                                        <span class="feature-time"><i class="fas fa-clock"></i><?php echo e($ads->created_at->diffForHumans()); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                        <div class="row">
                            <?php $__currentLoopData = $topAdsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div style="width:190px;  margin-bottom:10px" class="product-card
                                        <?php if($ads->ads_package == 5): ?> 
                                        product-jump-up-card " onload="blinkBorder('product-jump-up-card');" 
                                        <?php elseif($ads->ads_package == 3): ?>
                                        product-top-card " onload="blinkBorder('product-top-card');" 
                                        <?php endif; ?>
                                    style="margin-bottom: 10px">
                                        <div style="width: 100%;margin: 0 auto;" class="product-media">
                                            <div class="product-img" style="height: 150px;background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>);background-size: cover;background-position: center">
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
                                        <div class="product-content" >
                                            <ol class="breadcrumb product-category">
                                                <li><i class="fas fa-tags"></i></li>
                                                <li class="breadcrumb-item"><a href="<?php echo e(route('ads',[$ads->category->url])); ?>"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())); ?></a></li>
                                                <li class="breadcrumb-item active" aria-current="page"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())); ?></li>
                                            </ol>

                                            <h5 class="product-title">
                                                <a href="<?php echo e(route('ads.details',['id'=>$ads->id])); ?>" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    <?php echo e($ads->title); ?>

                                                </a>
                                            </h5>


                                            <div class="product-meta">
                                                <span><i class="fas fa-clock"></i><?php echo e($ads->created_at->diffForHumans()); ?></span>
                                            </div>

                                            <?php
                                                $job = \App\Models\Jobs::where('adsId',$ads->adsId)->select('salary_per_month')->first();
                                            ?>
                                            <?php if(isset($job->salary_per_month)): ?>
                                            <div class="product-info">
                                                <h5 class="product-price"> <?php echo e($ads->category->url=='jobs' ? "salary per month ".$job->salary_per_month : "LKR ".$ads->price); ?></h5>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php $__currentLoopData = $adsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <div style="width:190px;  margin-bottom:10px" class="product-card
                                        <?php if($ads->ads_package == 5): ?> 
                                        product-jump-up-card " onload="blinkBorder('product-jump-up-card');" 
                                        <?php elseif($ads->ads_package == 3): ?>
                                        product-top-card " onload="blinkBorder('product-top-card');" 
                                        <?php endif; ?>
                                    style="margin-bottom: 10px">
                                        <div style="width: 100%;margin: 0 auto;" class="product-media">
                                            <div class="product-img" style="height: 150px;background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>);background-size: cover;background-position: center">
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
                                        <div class="product-content" >
                                            <ol class="breadcrumb product-category">
                                                <li><i class="fas fa-tags"></i></li>
                                                <li class="breadcrumb-item"><a href="<?php echo e(route('ads',[$ads->category->url])); ?>"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())); ?></a></li>
                                                <li class="breadcrumb-item active" aria-current="page"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())); ?></li>
                                            </ol>

                                            <h5 class="product-title">
                                                <a href="<?php echo e(route('ads.details',['id'=>$ads->id])); ?>" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    <?php echo e($ads->title); ?>

                                                </a>
                                            </h5>


                                            <div class="product-meta">
                                                <span><i class="fas fa-clock"></i><?php echo e($ads->created_at->diffForHumans()); ?></span>
                                            </div>

                                            <?php
                                                $job = \App\Models\Jobs::where('adsId',$ads->adsId)->select('salary_per_month')->first();
                                            ?>
                                            <?php if(isset($job->salary_per_month)): ?>
                                            <div class="product-info">
                                                <h5 class="product-price"> <?php echo e($ads->category->url=='jobs' ? "salary per month ".$job->salary_per_month : "LKR ".$ads->price); ?></h5>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>


                        <div class="row">
                         
                        </div>

                        <div class="row">
                            <?php echo e($adsData->links('pagination::bootstrap-5')); ?>

                        </div>
                    </div>

                    <!-- Vertical Banner Section -->
                    <div class="col-lg-3">
                        <div class="banner-section" style="position: sticky; top: 10px;">
                            <?php
                                // Fetch banners
                                $banners = App\Models\Banners::where('type', 1)->inRandomOrder()->limit(2)->get();
                            ?>

                            <?php if($banners->count() > 0): ?>
                                <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="banner-ad mb-3">
                                        <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="Banner" style="width: 100%; border-radius: 5px;">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
    <!--=====================================
                AD LIST PART END
    =======================================-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/ads.blade.php ENDPATH**/ ?>