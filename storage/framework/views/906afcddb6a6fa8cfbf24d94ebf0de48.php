<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Package List</h2>
    </div>
    <div>
        <a href="<?php echo e(route('dashboard.package.create')); ?>" class="btn btn-primary btn-sm rounded">Create New Package</a>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                  
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>url</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Sub Package</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $packTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($packType->id); ?></td>
                                    <td><?php echo e($packType->url); ?></td>
                                    <td><?php echo e($packType->name); ?></td>
                                    <td>
                                        <?php if($packType->status == 1): ?>
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        <?php else: ?>
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            
                                            <!-- <a href="<?php echo e(route('dashboard.package.view',[$packType->url])); ?>" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                            </a>-->
                                            <a href="<?php echo e(route('dashboard.package.update',[$packType->url])); ?>" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo e(route('dashboard.package.delete',[$packType->url])); ?>" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                                            
                                            <a href="<?php echo e(route('dashboard.sub-packages',[$packType->url])); ?>" class="btn btn-success btn-sm me-2">
                                            <i class="fas fa-file"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo e($packTypes->links('pagination::bootstrap-5')); ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\packageManagement\index.blade.php ENDPATH**/ ?>