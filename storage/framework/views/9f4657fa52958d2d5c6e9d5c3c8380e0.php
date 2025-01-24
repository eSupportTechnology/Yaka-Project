<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <h4 style="margin-bottom: 20px" class="card-title">Admin List   <a href="<?php echo e(route('dashboard.admins.create')); ?>" style="margin-left: 10px" class="btn btn-inverse-primary btn-fw">Create Admin</a> </h4>                      
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Url</th>
                                <th>Email</th>
                                
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="userTableBody">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($user->id); ?></td>
                                    <td><?php echo e($user->first_name); ?></td>
                                    <td><?php echo e($user->last_name); ?></td>
                                    <td><?php echo e($user->url); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            <a href="<?php echo e(route('dashboard.admins.view',[$user->id])); ?>" class="btn btn-primary">
                                                View <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                            </a>
                                            <a href="<?php echo e(route('dashboard.admins.update',[$user->id])); ?>" class="btn btn-primary">
                                                Update<!-- Assuming you want to use an "Update" icon, change "ti-world" to the appropriate icon class -->
                                            </a>
                                            <a href="<?php echo e(route('dashboard.admins.delete',[$user->id])); ?>" class="btn btn-primary">
                                                Delete<!-- Assuming you want to use a "Delete" icon, change "ti-email" to the appropriate icon class -->
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo e($users->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>





























































































<?php echo $__env->make('adminPanel.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/adminPanel/adminManagement/index.blade.php ENDPATH**/ ?>