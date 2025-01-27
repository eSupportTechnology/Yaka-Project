<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Banner</h4>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e($error); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Update form -->
                    <form class="forms-sample" id="admin-form" method="post" action="<?php echo e(route('dashboard.banner.update', $banner->id)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>

                        <!-- Existing banner image preview -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Current Banner Image</label>
                            <?php if($banner->type == 0): ?>
                            <div>
                                <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="Banner Image" width="100%">
                            </div>
                            <?php else: ?>
                            <div>
                                <img src="<?php echo e(asset('banners/' . $banner->img)); ?>" alt="Banner Image" width="200">
                            </div>
                            <?php endif; ?>
                            
                        </div>

                        <!-- Option to upload a new image -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Upload New Banner Image (optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <!-- Type selection -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Type</label>
                            <select class="form-control" name="type" id="exampleFormControlSelect2">
                                <option value="0" <?php echo e($banner->type == 0 ? 'selected' : ''); ?>>Leaderboard (Banner size: 1140x180)</option>
                                <option value="1" <?php echo e($banner->type == 1 ? 'selected' : ''); ?>>Skyscrapers (Banner size: 285x500)</option>
                            </select>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Update</button>
                        <a href="<?php echo e(route('dashboard.banner')); ?>" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\bannerManagement\update.blade.php ENDPATH**/ ?>