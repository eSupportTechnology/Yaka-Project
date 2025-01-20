<?php $__env->startSection('content'); ?>
<style>
    .suggest-card:hover {
    transform: scale(1.05); /* Slightly enlarge the card */
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Increase shadow on hover */
}
.suggest-card img {
    transition: transform 0.3s ease; /* Smooth zoom effect for image */
}
.suggest-card:hover img {
    transform: scale(1.1); /* Slightly zoom in the image */
}

</style>

    <!--=====================================
            BANNER PART START
=======================================-->
    <?php echo $__env->make('web.Blocks.user-banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--=====================================
            BANNER PART END
=======================================-->
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
                SUGGEST PART START
    =======================================-->
    <section class="suggest-part" style="padding-top: 0 ;margin-top: 100px;">
        <div class="container" style="display: flex;flex-wrap: wrap;justify-content: center; ">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('ads',[$category->url])); ?>" class="suggest-card" 
                    style="width: 165px !important ;margin-bottom: 20px; background-color: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
                        <img src="<?php echo e(asset('images/Category/'.$category->image)); ?>" alt="car">
                        <h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale())); ?></h6>
                        <?php
                            $adsCount = \App\Models\Ads::where('cat_id', $category->id )->where('status',1)->count();
                        ?>
                        <p>(<?php echo e($adsCount); ?> <?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('ads', app()->getLocale())); ?>)</p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <section class="intro-part" style="margin-top: 100px;padding: 55px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                </div>
            </div>
        </div>
    </section>


    
    <!--=====================================
                SUGGEST PART END
    =======================================-->

       <?php if(count($superAds)>4): ?>
    <section class="section feature-part" style="padding-top: 0;margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-lg-7">
                    <div>
                        <div class="feature-card-slider slider-arrow">
                            <?php $__currentLoopData = $superAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('web.components.cards.slideAdsCards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="feature-thumb-slider">
                            <?php $__currentLoopData = $superAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="feature-thumb" style="height: 160px;background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>);background-size: cover;background-position: center">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <p class="mt-4">The Super Ads section on Sri Lanka’s largest classified website yaka.lk offers premium visibility for your listings, ensuring maximum exposure and faster results. Whether you’re buying, selling, or promoting services, Super Ads help your posts stand out with priority placement and enhanced features, connecting you to a wider audience efficiently.</p>
                </div>
                <div class="col-md-5 col-lg-5">
                    <div class="section-side-heading">
                        <h2><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Find your needs in our best ', app()->getLocale())); ?><span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Super Ads', app()->getLocale())); ?></span></h2>










                        <div class="col-md-6 col-lg-12" style="overflow: hidden;padding: 0px;">
                            <figure id="zss">
                                <?php
                                    // Fetch 4 random banners with type 0 (Leaderboard)
                                    $banners = App\Models\Banners::where('type', 1)->inRandomOrder()->limit(4)->get();
                                ?>

                                <?php if($banners->count() >= 4): ?>
                                    <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="zss" >
                                            <img style="width: 100%;" src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <div class="zss" style="height: 789px;background: url('<?php echo e(asset('banners/' . $banners[0]->img)); ?>') no-repeat; background-size: cover;"></div>
                                <?php endif; ?>
                            </figure>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
   <?php endif; ?>
    <!--=====================================
                FEATURE PART START
    =======================================-->
   <?php if(count($topAds)>5): ?>
        <section class="section feature-part" style="padding-top: 0;margin-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5">
                        <div class="section-side-heading">
                            <h2><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Find your needs in our best ', app()->getLocale())); ?><span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Top Ads', app()->getLocale())); ?></span></h2>

                            <div class="col-md-6 col-lg-12" style="overflow: hidden;padding: 0px;">
                                <figure id="zss">
                                    <?php
                                        // Fetch 4 random banners with type 0 (Leaderboard)
                                        $banners = App\Models\Banners::where('type', 1)->inRandomOrder()->limit(4)->get();
                                    ?>

                                    <?php if($banners->count() >= 4): ?>
                                        <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="zss" >
                                                <img style="width: 100%;" src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="">
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="zss" style="height: 789px;background: url('<?php echo e(asset('banners/' . $banners[0]->img)); ?>') no-repeat; background-size: cover;"></div>
                                    <?php endif; ?>
                                </figure>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7">
                        <div>
                            <div class="feature-card-slider slider-arrow">
                                <?php $__currentLoopData = $topAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $__env->make('web.components.cards.slideAdsCards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="feature-thumb-slider">
                                <?php $__currentLoopData = $topAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="feature-thumb" style="height: 160px;background: url(<?php echo e(asset('images/Ads/'.$ads->mainImage)); ?>);background-size: cover;background-position: center">
    
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <p class="mt-4">The Top Ads section on Sri Lanka’s largest classified website yaka.lk guarantees your listings premium placement at the top of search results. With higher visibility and priority ranking, Top Ads ensure your products or services reach more potential buyers quickly and effectively.</p>
                    </div>
                </div>
            </div>
        </section>
   <?php endif; ?>
    <!--=====================================
                FEATURE PART END
    =======================================-->


    <!--=====================================
                RECOMEND PART START
    =======================================-->
    <?php if(count($recommendAds)>4): ?>
    <section class="section recomend-part" style="padding-top: 0;margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2><span><?php echo e(GoogleTranslate::trans('Ads', app()->getLocale())); ?></span></h2>
                        <p style="
                        width: 100%;
                    "><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero
                            voluptatum repudiandae veniam maxime tenetur.', app()->getLocale())); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="recomend-slider slider-arrow">
                        <?php $__currentLoopData = $recommendAds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                <?php echo $__env->make('web.components.cards.adCards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!--=====================================
                RECOMEND PART START
    =======================================-->


    <!--=====================================
                TREND PART START
    =======================================-->
    <?php if(count($popular) >5): ?>
    <section class="section trend-part" style="padding-top: 0;margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Popular Trending ', app()->getLocale())); ?><span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Ads', app()->getLocale())); ?></span></h2>
                        <p style="
                        width: 100%;
                    "><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero
                            voluptatum repudiandae veniam maxime tenetur.', app()->getLocale())); ?></p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">

                    <?php $__currentLoopData = $popular; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-11 col-lg-8 col-xl-6">
                            <?php echo $__env->make('web.components.cards.adCards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-20">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!--=====================================
                TREND PART END
    =======================================-->




    <!--=====================================
                CITY PART START
    =======================================-->
    
    <!--=====================================
                CITY PART END
    =======================================-->


    <!--=====================================
                CATEGORY PART START
    =======================================-->
    <section class="section category-part" style="padding-top: 0;margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    
                </div>
            </div>
            <div class="row">
                <?php $__currentLoopData = $topcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3" style="margin-bottom:15px;">
                        <div class="category-card" style="height: 100%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.05);">
                            

                            <ul class="category-list">
                                <?php $__currentLoopData = $topcategory->subcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $subadcount = \App\Models\Ads::where('sub_cat_id',$subcategory->id )->where('status',1)->count();
                                    ?>
                                    <?php if($key <= 4): ?>
                                        <li><a href="<?php echo e(route('ads',[$subcategory->url])); ?>"><h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($subcategory->name, app()->getLocale())); ?></h6>
                                        <p>(<?php echo e($subadcount); ?>)</p></a></li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-20">




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                CATEGORY PART END
    =======================================-->


    <!--=====================================
                INTRO PART START
    =======================================-->

    <!--=====================================
                INTRO PART END
    =======================================-->


    <!--=====================================
                 PRICE PART START
    =======================================-->
    

    <section class="inner-section" style="margin: 100px 0 50px;">
        <div class="container" style="overflow: hidden; padding: 0;">
            <figure id="zss">
                <?php
                    // Fetch 4 random banners with type 0 (Leaderboard)
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/index.blade.php ENDPATH**/ ?>