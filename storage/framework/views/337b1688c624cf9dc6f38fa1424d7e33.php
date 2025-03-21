<style>
    .ad-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: right;
    margin-bottom: 10px;
}

.ad-card h3 {
    font-size: 1.2rem;
    font-weight: bold;
}

.ad-card p {
    margin: 5px 0;
}

.price {
    font-size: 1.1rem;
    color: #d9534f;
    font-weight: bold;
}

.card-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

/* Card image styling if needed */
.ad-card img {
    max-width: 50%;
    border-radius: 8px;
}

.slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.card-container {
    display: flex;
    width: 200%;
    transition: transform 0.5s ease-in-out;
}

.ad-card {
    width: 20%;
    padding: 15px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    flex-shrink: 0;
}
.badge {
            position: absolute;
            top: 10px;
            left:10px;
            background: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            clip-path: polygon(100% 0%, 100% 100%, 50% 80%, 0 100%, 0 0);
        }
</style>
<?php $__env->startSection('content'); ?>
    <div class="auto-container">
        <div class="sec-title centred mt-4">
            <span><?php echo app('translator')->get('messages.search_results'); ?></span>
            <h2><?php echo app('translator')->get('messages.search_results'); ?> "<?php echo e(request('query')); ?>"</h2>
          
        </div>

        <div class="tabs-box">
            <div class="tabs-content">
                <div class="tab active-tab" id="tab-1">
                    <div class="clearfix row justify-content-center">
                        <?php if($ads->isEmpty()): ?>
                        <p><?php echo app('translator')->get('messages.no_ads_found'); ?></p>
                        <?php else: ?>
                            <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-3 col-md-5 col-sm-12 feature-block justify-content-center">
                                    <div class="feature-block-one wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image">
                                                    <img src="<?php echo e(asset('storage/' . $ad->mainImage)); ?>" alt="" style="width: 370px; height: 220px; object-fit: cover;">
                                                </figure>

                                               
                                            </div>

                                            <div class="lower-content" style="display: flex; flex-direction: column; justify-content: space-between;height: 210px;">
                                                <h3 style="
                                                    display: -webkit-box; 
                                                    -webkit-line-clamp: 2; 
                                                    -webkit-box-orient: vertical; 
                                                    overflow: hidden; 
                                                    text-overflow: ellipsis; 
                                                    max-height: 55px; 
                                                    margin-top: 20px; 
                                                    margin-bottom: 10px;">
                                                    <a href="<?php echo e(route('ads.details', ['adsId' => $ad->adsId])); ?>"><?php echo e($ad->title); ?></a>
                                                </h3>
                                                
                                                <ul class="clearfix info">
                                                    <li><i class="fas fa-map-marker-alt"></i>
                                                    <span><?php echo e($ad->sub_location ? $ad->sub_location->name_en : 'N/A'); ?>,
                                                    <?php echo e($ad->main_location ? $ad->main_location->name_en : 'N/A'); ?>

                                                    </span>
                                                    </li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span><p><?php echo app('translator')->get('messages.Price'); ?></p>:</span><?php echo app('translator')->get('messages.LKR'); ?><?php echo e($ad->price ?? 'N/A'); ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/search-results.blade.php ENDPATH**/ ?>