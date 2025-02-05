


<?php $__env->startSection('content'); ?>


<div class="container mt-4">
    <h2>Boost Your Ad</h2>
    <div class="card">
        <img src="<?php echo e(asset($ad->mainImage)); ?>" class="card-img-top" alt="Ad Image">
        <div class="card-body">
            <h5 class="card-title"><?php echo e($ad->title); ?></h5>
            <p class="card-text">Price: Rs <?php echo e(number_format($ad->price, 2)); ?></p>
            <p class="card-text text-muted">Location: <?php echo e($ad->location); ?></p>

            <form action="" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-warning"><i class="fas fa-rocket"></i> Boost Now</button>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/ads_boost_plans.blade.php ENDPATH**/ ?>