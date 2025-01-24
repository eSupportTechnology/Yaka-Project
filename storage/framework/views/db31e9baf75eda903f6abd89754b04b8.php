<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">update your Details</h2>

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

                    <form class="forms-sample" id="admin-form" method="post" action="<?php echo e('dashboard.admins.update-user', $user -> id); ?>" >
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($user -> id); ?>" name="user">
                        <div class="form-group">
                            <label for="exampleInputUsername1">First Name </label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="first_name" value="<?php echo e(old('first_name') ?? $user -> first_name); ?>" placeholder="First Name">
                            <div class="invalid-feedback error-container" id="first_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputLastName">Last Name </label>
                            <input type="text" required class="form-control" name="last_name" id="exampleInputLastName" value="<?php echo e(old('last_name') ?? $user -> last_name); ?>" placeholder="Last Name">
                            <div class="invalid-feedback error-container" id="last_name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email </label>
                            <input type="email" required class="form-control" name="email" id="exampleInputEmail1" value="<?php echo e(old('email') ?? $user -> email); ?>" placeholder="Email">
                            <div class="invalid-feedback error-container" id="email-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mobile Number </label>
                            <input type="text"  class="form-control" name="phone_number" id="exampleInputEmail1" value="<?php echo e(old('phone_number') ?? $user -> phone_number); ?>" placeholder="phone_number">
                            <div class="invalid-feedback error-container" id="email-error"></div>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                        <a href="<?php echo e(route('dashboard.admins')); ?>" class="btn btn-light">Cancel</a>

                        <!-- Error container -->
                        <div id="error-container"></div>
                    </form>
                </div>
            </div>
        </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newAdminDashboard/adminManagement/update.blade.php ENDPATH**/ ?>