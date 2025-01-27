<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New <?php if(isset($maincategory)): ?> Sub <?php endif; ?> Category</h4>

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

                    <form class="forms-sample" id="admin-form" method="post" action="<?php echo e(route('dashboard.categories.store')); ?>" enctype="multipart/form-data" >

                        <?php echo csrf_field(); ?>
                        <?php if(isset($maincategory)): ?>
                            <input type="hidden" name="mainid" value="<?php echo e($maincategory->id); ?>">
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="exampleInputUsername1">Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="name" value="<?php echo e(old('name')); ?>" placeholder="Name">
                        </div>

                        <?php if(!isset($maincategory)): ?> 
                          <div class="form-group">
                            <label for="count">Free add count </label>
                            <input type="number" required  class="form-control" id="count" name="free_add_count" value="<?php echo e(old('free_add_count') ?? 0); ?>" placeholder="Free add count">
                        </div>
                        <?php endif; ?>

                      

                        <div class="form-group">
                            <label for="formFileDisabled">Image <span style="color: red">*</span></label>
                            <input style="height: 46px;" type="file" required  class="form-control" id="formFileDisabled" name="image"  >
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">status </label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option  value="0">N/A</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>

                        <?php if(isset($maincategory)): ?>
                            <a href="<?php echo e(route('dashboard.sub-categories',[$maincategory->url])); ?>" class="btn btn-light">Cancel</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('dashboard.categories')); ?>" class="btn btn-light">Cancel</a>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\categoryManagement\create.blade.php ENDPATH**/ ?>