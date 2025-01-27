<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <h4 style="margin-bottom: 20px" class="card-title">Ads List</h4>
                        <form action="<?php echo e(route('dashboard.ads')); ?>" style="width: 30%; display: flex; align-items: center;">
                            <input name="code" value="<?php echo e($_GET['code'] ?? ""); ?>" type="search" id="searchInput" class="form-control" placeholder="Ad Code Search" title="Search here" style="flex-grow: 1; margin-right: 10px;">
                            <button type="submit" style="width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">
                                Search
                            </button>
                            <a href="<?php echo e(route('dashboard.ads')); ?>" style="text-decoration: none;margin-left: 10px;width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">Clear</a>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Ads Code</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>District</th>
                                <th>City</th>
                                <th>Ads Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $adsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($ads->id); ?></td>
                                    <td><?php echo e($ads->adsId); ?></td>
                                    <td><?php echo e($ads->title); ?></td>
                                    <td><?php echo e($ads->category->name); ?></td>
                                    <td><?php echo e($ads->subcategory->name); ?></td>
                                    <td><?php echo e($ads->main_location ? $ads->main_location->name_en : 'N/A'); ?></td>
                                    <td><?php echo e($ads->sub_location ? $ads->sub_location->name_en : 'N/A'); ?></td>

                                    <td>
                                        <?php if($ads->status == 1): ?>
                                            <span  class="btn btn-inverse-success btn-fw">Approved</span>
                                        <?php else: ?>
                                            <span  class="btn btn-inverse-danger btn-fw">Disapproved</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            
                                            <a href="<?php echo e(route('ads.details',[$ads->id])); ?>" class="btn btn-view btn-sm me-2">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if($ads->status == 1): ?>
                                                <a href="<?php echo e(route('dashboard.ads.status',['disapprove',$ads->id])); ?>" class="btn btn-primary">
                                                    Disapprove <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo e(route('dashboard.ads.status',['approve',$ads->id])); ?>" class="btn btn-primary">
                                                    Approve <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                                </a>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php echo e($adsData->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\adsManagement\index.blade.php ENDPATH**/ ?>