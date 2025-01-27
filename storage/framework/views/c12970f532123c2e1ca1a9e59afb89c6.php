<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title"><?php echo e($brand->name); ?>' Sub models List  </h2>
    </div>
    <div>
        <a href="<?php echo e(route('dashboard.configuration.models.create',[$brand->url])); ?>" class="btn btn-primary btn-sm rounded">Create New Model</a>
        
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
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($model->id); ?></td>
                                    <td><?php echo e($model->url); ?></td>
                                    <td><?php echo e($model->name); ?></td>
                                    <td>
                                        <?php if($model->status == 1): ?>
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        <?php else: ?>
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            
                                        
                                            <a href="<?php echo e(route('dashboard.configuration.models.update',[$model->url])); ?>" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                           <a href="<?php echo e(route('dashboard.sub-categories.delete',[$model->url])); ?>" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a> 
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo e($models->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\brandsAndModelsManagement\models.blade.php ENDPATH**/ ?>