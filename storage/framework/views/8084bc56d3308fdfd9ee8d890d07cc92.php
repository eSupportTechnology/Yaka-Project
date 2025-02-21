<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New <?php if(isset($brand)): ?> Model <?php else: ?> Brands <?php endif; ?></h4>

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

                    <form class="forms-sample" id="admin-form" method="post" action="<?php echo e(route('dashboard.configuration.brands-and-models.store')); ?>" enctype="multipart/form-data" >

                        <?php echo csrf_field(); ?>
                            <input type="hidden" name="brandid" value="<?php echo e($brand->id ?? 0); ?>">

                        <?php if(isset($subcategories)): ?>
                            <div class="form-group">
                                <label for="exampleFormControlSelect2">Sub Category <span style="color: red">*</span></label>
                                <select class="form-control" name="sub_cat_id" id="exampleFormControlSelect2">
                                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="exampleInputUsername1">Name <span style="color: red">*Do not use any symbol for the name</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="name" value="<?php echo e(old('name')); ?>" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">status </label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option  value="0">N/A</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>

                        <?php if(isset($brand)): ?>
                            <a href="<?php echo e(route('dashboard.configuration.models',[$brand->url])); ?>" class="btn btn-light">Cancel</a>
                        <?php else: ?>
                            <a href="<?php echo e(route('dashboard.configuration.brands-and-models')); ?>" class="btn btn-light">Cancel</a>
                        <?php endif; ?>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newAdminDashboard/brandsAndModelsManagement/create.blade.php ENDPATH**/ ?>