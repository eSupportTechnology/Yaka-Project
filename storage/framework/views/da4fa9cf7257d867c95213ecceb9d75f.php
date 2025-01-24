<?php $__env->startSection('content'); ?>


    <!--=====================================
                    AD DETAILS PART START
        =======================================-->
    <section class="inner-section ad-details-part">
        <div class="container">
            <section class="inner-section" style="margin-bottom: 50px;">
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

            <div class="row content-reverse">
                <div class="col-lg-4">

                    <button type="button" class="common-card number" data-toggle="modal" data-target="#number">
                        <h3><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($data->user->phone_number, app()->getLocale())); ?><h3>
                        <i class="fas fa-phone"></i>
                    </button>

                    <!-- AUTHOR CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('author info', app()->getLocale())); ?></h5>
                        </div>
                        <div class="ad-details-author">

                            <?php if($data->user->profileImage != null): ?>
                            <a href="#" class="author-img active">
                                <img src="<?php echo e(asset('images/user/'.$data->user->profileImage)); ?>" alt="avatar">
                            </a>
                            <?php endif; ?>
                           
                            <div class="author-meta">
                                <h4><a href="#"><?php echo e($data->user->first_name.' '.$data->user->last_name); ?></a></h4>
                                <?php
                                    use Carbon\Carbon;
                                    $joined = Carbon::parse($data->user->created_at)->format('F d, Y');
                                ?>
                                <h5><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('joined', app()->getLocale())); ?>: <?php echo e($joined); ?></h5>
                            </div>
                            <div class="author-widget">
                                <a href="/chatify/<?php echo e($data->user->id); ?>" title="Message" class="fas fa-envelope"></a>
                            </div>
                            <ul class="author-list">
                                <?php
                                    $total_ads = \App\Models\Ads::where('user_id',$data->user->id)->where('status','<',10)->count();
                                ?>
                                <li><h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('total ads ', app()->getLocale())); ?></h6><p><?php echo e($total_ads); ?></p></li>
                            </ul>
                        </div>
                    </div>
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
                                <div class="zss" style="height: 500px;background: url('<?php echo e(asset('banners/' . $banners[0]->img)); ?>') no-repeat; background-size: cover;"></div>
                            <?php endif; ?>
                        </figure>

                    </div>
                    <?php
                        // where('sub_cat_id' , $data->sub_cat_id)
                        $topads = \App\Models\Ads::where('status' ,0)->with('ads_vehicles','user', 'main_location', 'sub_location', 'category', 'subcategory')->paginate(4);
                    ?>
                    <?php if( count($topads) >4 ): ?>
                        <!-- FEATURE CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title"> <?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('featured ads', app()->getLocale())); ?></h5>
                            </div>
                            <div class="ad-details-feature slider-arrow">
                                <?php $__currentLoopData = $topads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                        <?php echo $__env->make('web.components.cards.adCards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-8">
                    <!-- AD DETAILS CARD -->
                    <div class="common-card">
                        <ol class="breadcrumb ad-details-breadcrumb">
                            <?php if($data->post_type == 0 && $data->post_type != null): ?>
                                    <span class="flat-badge booking">booking</span>
                            <?php elseif($data->post_type == 1): ?>
                                    <span class="flat-badge sale">sale</span>
                            <?php elseif($data->post_type == 2): ?>
                                    <span class="flat-badge rent">rent</span>
                            <?php endif; ?>
                            <li class="breadcrumb-item"><?php echo e($data->category->name); ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo e($data->subcategory->name); ?></li>
                        </ol>
                        
                        <h3 class="ad-details-title" style="margin-bottom: 0"><?php echo e($data->title); ?></h3>
                        <div class="ad-details-meta">




                        </div>
                        <?php if(empty($data->subImage)): ?>
                            <div class="ad-details-slider-group">
                                <img src="<?php echo e(asset('images/Ads/'.$data->mainImage)); ?>"  style="width: 100%;">
                            </div>
                        <?php else: ?>
                            <div class="ad-details-slider-group">
                                <div class="ad-details-slider slider-arrow">
                                    <?php
                                        // Explode the string by comma and trim each filename
                                        $imageArray = explode(", ", $data->subImage);

                                        // Remove square brackets and any whitespace from each filename
                                        $imageArray = array_map(function($filename) {
                                            return trim($filename, "[] ");
                                        }, $imageArray);

                                    ?>
                                    <?php $__currentLoopData = $imageArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div><img style="width: auto;margin: 0 auto" src="<?php echo e(asset('images/Ads/'.$image)); ?>" alt="details"></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>
                                <?php if($data->ads_package == 3): ?>
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>top Ad</span>
                                    </div>
                                <?php elseif($data->ads_package == 4): ?>
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>Urgent Ad</span>
                                    </div>
                                <?php elseif($data->ads_package == 5): ?>
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>Bump Up Ad</span>
                                    </div>

                                <?php elseif($data->ads_package == 6): ?>
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>Spotlight Ad</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="ad-thumb-slider">
                            <?php $__currentLoopData = $imageArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><img src="<?php echo e(asset('images/Ads/'.$image)); ?>" alt="details"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                  
                    
                    <!-- SPECIFICATION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Specification', app()->getLocale())); ?></h5>
                        </div>
                        <ul class="ad-details-specific">
                            <li>
                                <h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Price', app()->getLocale())); ?>:</h6>
                                <p>LKR <?php echo e($data->price); ?></p>
                            </li>
                            <li>
                                <h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('District', app()->getLocale())); ?>:</h6>
                                
                            </li>
                            <li>
                                <h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('city', app()->getLocale())); ?>:</h6>
                                
                            </li>
                            <li>
                                <h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Category', app()->getLocale())); ?>:</h6>
                                 <p><?php echo e($data->category->name); ?></p>
                            </li>

                            <li>
                                <h6><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Sub Category', app()->getLocale())); ?>:</h6>
                                <p><?php echo e($data->subcategory->name); ?></p>
                            </li>



                            <?php echo $__env->make('web.components.adsDetailsSpecification.'.$data->category->url, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </ul>
                    </div>

                    <!-- DESCRIPTION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Description', app()->getLocale())); ?></h5>
                        </div>
                        <p class="ad-details-desc"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($data->description, app()->getLocale())); ?></p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                AD DETAILS PART END
    =======================================-->


    <!--=====================================
                RELATED PART START
    =======================================-->
    <?php
        $relatedads = \App\Models\Ads::where('status' ,1)->where('sub_cat_id' , $data->sub_cat_id)->with('user', 'main_location', 'sub_location', 'category', 'subcategory')->paginate(5);
    ?>
    <?php if(count($relatedads)>0): ?>
        <section class="inner-section related-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Related', app()->getLocale())); ?>  <span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Ads', app()->getLocale())); ?></span></h2>
                        <p><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero voluptatum repudiandae veniam maxime tenetur.', app()->getLocale())); ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="related-slider slider-arrow">
                        <?php $__currentLoopData = $relatedads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web.components.cards.adCards', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                        <a href="ad-column3.html" class="btn btn-inline">
                            <i class="fas fa-eye"></i>
                            <span><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('view all related', app()->getLocale())); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <!--=====================================
                RELATED PART START
    =======================================-->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/ads-details.blade.php ENDPATH**/ ?>