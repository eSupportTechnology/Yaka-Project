<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Banner</h4>

                    <?php if(isset($success) && $success): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e($success); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <form class="forms-sample" id="admin-form" method="post" action="<?php echo e(route('dashboard.banner.create-banner')); ?>" enctype="multipart/form-data" >

                        <?php echo csrf_field(); ?>
                        <?php if(isset($maincategory)): ?>
                            <input type="hidden" name="mainid" value="<?php echo e($maincategory->id); ?>">
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Upload Banner Image <span style="color: red">*</span></label>
                           <input type="file" name="image" accept=".gif" class="form-control" id="">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Type </label>
                            <select class="form-control" name="type" id="exampleFormControlSelect2">
                                <option  value="0">Leaderboard (Banner size: 1140x180)</option>
                                <option value="1">Skyscrapers  (Banner size: 285x500)</option>
                            </select>
                        </div>
                        
                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\bannerManagement\create.blade.php ENDPATH**/ ?>