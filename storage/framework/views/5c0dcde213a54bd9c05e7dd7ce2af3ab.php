<?php $__env->startSection('content'); ?>

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">


                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">delete User </h4>
                <form class="forms-sample" id="admin-form" method="post" action="<?php echo e(route('dashboard.admins.delete-user', $user -> id)); ?>" >
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user" value="<?php echo e($user->id); ?>">
                    <div style=" border-bottom: 1px solid #e3e3e3;" class="form-group">
                        <p style="font-size: 13px;margin-left: 20px;">Are you sure you want to delete?</p>
                    </div>

                    <button style="background: red;border: none;"  class="btn btn-primary me-2">Delete</button>
                    <a href="<?php echo e(route('dashboard.admins')); ?>" class="btn btn-light">Cancel</a>
                </form>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\adminManagement\delete.blade.php ENDPATH**/ ?>