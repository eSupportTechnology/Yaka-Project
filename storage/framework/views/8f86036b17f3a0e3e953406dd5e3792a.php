<?php $__env->startSection('content'); ?>

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">
                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">View <?php if(isset($category) && $category->mainId != 0 ): ?> Sub <?php endif; ?> Type details </h4>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Sub Category </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($data1->name); ?></div>
                </div>

                <div class="form-group">
                    <label style="font-size: 16px;" for="exampleInputUsername1"> Name </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($data->name); ?></div>
                </div>

                <div class="form-group">
                    <label style="font-size:16px " for="exampleInputUsername1">Url </label>
                    <div style="font-size: 15px;margin-left: 20px;"><?php echo e($data->url); ?></div>
                </div>
               
                <?php if(isset($data) && $data1->mainId != 0 ): ?>
                    <a href="<?php echo e(route('dashboard.adsTypes.update',[$data->url])); ?>"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="<?php echo e(route('dashboard.adsTypes')); ?>" class="btn btn-light">Cancel</a>
                <?php else: ?>
                    <a href="<?php echo e(route('dashboard.adsTypes.update',[$data->url])); ?>"  class="btn btn-primary me-2">Update This Details</a>
                    <a href="<?php echo e(route('dashboard.adsTypes.update',[$data->url])); ?>" class="btn btn-light">Cancel</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newAdminDashboard/adsTypesManagement/view.blade.php ENDPATH**/ ?>