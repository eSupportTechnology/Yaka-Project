<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Admin</h4>

                    <?php if(isset($usersuccess) && $usersuccess): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e($usersuccess); ?>

                        </div>
                    <?php endif; ?>
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <form class="forms-sample" id="admin-form" method="post" action="<?php echo e(route('dashboard.admins.store')); ?>" >
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="exampleInputUsername1">First Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="First Name">
                            <div class="invalid-feedback error-container" id="first_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLastName">Last Name <span style="color: red">*</span></label>
                            <input type="text" required class="form-control" name="last_name" id="exampleInputLastName" value="<?php echo e(old('last_name')); ?>" placeholder="Last Name">
                            <div class="invalid-feedback error-container" id="last_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number <span style="color: red">*</span></label>
                            <input type="text" required class="form-control" name="number" id="exampleInputEmail1" value="<?php echo e(old('number')); ?>" placeholder="Phone Number ">
                            <div class="invalid-feedback error-container" id="email-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Roles <span style="color: red">*</span></label>
                            <select class="form-control" name="role" id="exampleFormControlSelect2">
                                <option value="<?php echo e(ADMIN); ?>">Admin</option>
                                <option value="<?php echo e(USER); ?>">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password <span style="color: red">*</span></label>
                            <input type="password" required class="form-control" name="password" id="exampleInputPassword1" value="<?php echo e(old('password')); ?>" placeholder="Password">
                            <div class="invalid-feedback error-container" id="password-error"></div>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                        <a href="<?php echo e(route('dashboard.admins')); ?>" class="btn btn-light">Cancel</a>

                        <!-- Error container -->
                        <div id="error-container"></div>
                    </form>
                </div>
            </div>
        </div>

        
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminPanel.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/adminPanel/adminManagement/create.blade.php ENDPATH**/ ?>