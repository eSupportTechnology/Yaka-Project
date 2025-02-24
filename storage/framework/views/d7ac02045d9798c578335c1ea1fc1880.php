<?php $__env->startSection('content'); ?>
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Brands</h2>
    </div>
    <div>
        <a href="<?php echo e(route('dashboard.configuration.brands-and-models.create')); ?>" class="btn btn-primary btn-sm rounded">Create New Brands</a>
    </div>
</div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <form action="<?php echo e(route('dashboard.configuration.brands-and-models')); ?>" style="width: 30%; display: flex; align-items: center;">
                            <input name="name" value="<?php echo e($_GET['name'] ?? ""); ?>" type="search" id="searchInput" class="form-control" placeholder="Brand Name Search" title="Search here" style="flex-grow: 1; margin-right: 10px;">
                            <button type="submit" style="width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">
                                Search
                            </button>
                            <a href="<?php echo e(route('dashboard.configuration.brands-and-models')); ?>" style="text-decoration: none;margin-left: 10px;width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">Clear</a>
                        </form>
                    </div>
                    <?php if(isset($success) && $success): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e($success); ?>

                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>url</th>
                                <th>Name</th>
                                <th>Sub Category</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Models</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($brand->id); ?></td>
                                    <td><?php echo e($brand->url); ?></td>
                                    <td><?php echo e($brand->name); ?></td>
                                    <td><?php echo e($brand->category->name ?? ""); ?></td>
                                    <td>
                                        <?php if($brand->status == 1): ?>
                                            <span  class="btn btn-inverse-success btn-fw">Active</span>
                                        <?php else: ?>
                                            <span  class="btn btn-inverse-danger btn-fw">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                           
                                        
                                            <a href="<?php echo e(route('dashboard.configuration.brands-and-models.update',[$brand->url])); ?>" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                             <a href="<?php echo e(route('dashboard.configuration.brands-and-models.delete',[$brand->url])); ?>" class="btn btn-danger btn-sm me-2">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex justify-content-between flex-nowrap">
                                           
                                            <a href="<?php echo e(route('dashboard.configuration.models',[$brand->url])); ?>" class="btn btn-success btn-sm me-2">
                                                <i class="fas fa-file"></i>
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

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newAdminDashboard/brandsAndModelsManagement/index.blade.php ENDPATH**/ ?>