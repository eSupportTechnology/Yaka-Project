<?php $__env->startSection('content'); ?>

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">View <?php if(isset($data) && $data->brandsId != 0 ): ?> Model <?php else: ?> Brand <?php endif; ?> details </h4>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Sub Category </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($data->category->name); ?></div>
                </div>

                <div class="form-group">
                    <label style="font-size: 16px;" for="exampleInputUsername1"> Name </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($data->name); ?></div>
                </div>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Url </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($data->url); ?></div>
                </div>

                <?php if(isset($data) && $data->brandsId != 0 ): ?>
                    <a href="<?php echo e(route('dashboard.categories.update',[$data->url])); ?>"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="<?php echo e(route('dashboard.configuration.models',[$brand->url])); ?>" class="btn btn-light">Cancel</a>
                <?php else: ?>
                    <a href="<?php echo e(route('dashboard.categories.update',[$data->url])); ?>"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="<?php echo e(route('dashboard.configuration.brands-and-models')); ?>" class="btn btn-light">Cancel</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\brandsAndModelsManagement\view.blade.php ENDPATH**/ ?>