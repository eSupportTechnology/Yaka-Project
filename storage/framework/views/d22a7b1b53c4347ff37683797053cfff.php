<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Admin List</h2>
    </div>
    <div>
        <a href="<?php echo e(route('dashboard.admins.create')); ?>" class="btn btn-primary btn-sm rounded">Create Admin</a>
    </div>
</div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
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
                                    <div class="template-demo d-flex flex-nowrap">
                                        <a href="<?php echo e(route('dashboard.admins.view',[$user->id])); ?>" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?php echo e(route('dashboard.admins.update',[$user->id])); ?>" class="btn btn-warning btn-sm me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo e(route('dashboard.admins.delete',[$user->id])); ?>" class="btn btn-danger btn-sm me-2">
                                         <i class="fas fa-trash"></i>
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





























































































<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\adminManagement\index.blade.php ENDPATH**/ ?>