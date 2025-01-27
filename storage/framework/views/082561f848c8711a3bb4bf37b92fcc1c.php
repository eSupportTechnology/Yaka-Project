<?php $__env->startSection('content'); ?>

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">View <?php if(isset($packTypes) && $packTypes->package_id != 0 ): ?> Sub <?php endif; ?> Package details </h4>

                <div class="form-group">
                    <label style="font-size: 16px;" for="exampleInputUsername1"> Name </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($packTypes->name); ?></div>
                </div>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Url </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($packTypes->url); ?></div>
                </div>
               

                <?php if(isset($packTypes) ): ?>
                    <a href="<?php echo e(route('dashboard.package.update',[$packTypes->url])); ?>"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="<?php echo e(route('dashboard.packages')); ?>" class="btn btn-light">Cancel</a>
                <?php else: ?>
                    <a href=""  class="btn btn-primary me-2">Update This Details</a>
                    <a href="" class="btn btn-light">Cancel</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\packageManagement\viewpackage.blade.php ENDPATH**/ ?>