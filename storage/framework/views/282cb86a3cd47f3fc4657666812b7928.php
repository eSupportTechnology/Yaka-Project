<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title"><?php echo e($package->name); ?>' Sub Package List</h2>
    </div>
    <div>
        <a href="<?php echo e(route('dashboard.sub-pacages.create',[$package->url])); ?>" class="btn btn-primary btn-sm rounded">New Sub Package</a>
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
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($subcategory->id); ?></td>
                                    <td><?php echo e($subcategory->url); ?></td>
                                    <td><?php echo e($subcategory->name); ?></td>
                                    <td>Rs <?php echo e($subcategory->price); ?></td>
                                    <td>
                                        <?php if($subcategory->status == 1): ?>
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        <?php else: ?>
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                           
                                            <!--<a href="<?php echo e(route('dashboard.sub-package.view',[$subcategory->url])); ?>" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                            </a>-->
                                            <a href="<?php echo e(route('dashboard.sub-package.update',[$subcategory->url])); ?>" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo e(route('dashboard.sub-package.delete',[$subcategory->url])); ?>" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\packageManagement\subpackages.blade.php ENDPATH**/ ?>