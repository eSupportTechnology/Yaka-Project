

<?php $__env->startSection('content'); ?>
<div class="container">
    <h3>Search Results for "<?php echo e($query); ?>"</h3>

    <?php if($ads->count() > 0): ?>
        <div class="row">
            <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="<?php echo e(asset('images/ads/' . $ad->mainImage)); ?>" class="card-img-top" alt="<?php echo e($ad->title); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($ad->title); ?></h5>
                            <p class="card-text"><?php echo e(Str::limit($ad->description, 100)); ?></p>
                            <a href="<?php echo e(route('ads.show', $ad->adsId)); ?>" class="btn btn-primary">View Details</a>

                            <!-- Safely access relationships using optional() -->
                            <p>Category: <?php echo e(optional($ad->category)->name ?? 'No category'); ?></p>
                            <p>Subcategory: <?php echo e(optional($ad->subcategory)->name ?? 'No subcategory'); ?></p>
                            <p>Location: <?php echo e(optional($ad->main_location)->name ?? 'No location'); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php echo e($ads->links()); ?>

    <?php else: ?>
        <p>No ads found.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Esupport_Projects\Yaka-Project-main\resources\views/NewFrontend/search-results.blade.php ENDPATH**/ ?>