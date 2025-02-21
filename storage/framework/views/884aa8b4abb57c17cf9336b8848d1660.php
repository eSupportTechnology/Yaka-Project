

<?php $__env->startSection('content'); ?>

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Form Fields</h2>
    </div>
    <div>
        <a href="<?php echo e(route('dashboard.formfields.create')); ?>" class="btn btn-primary btn-sm rounded">Create New Fields</a>
    </div>
</div>

<!-- Main Category Dropdown -->
<div class="row mb-3">
    <div class="col-md-4">
        <form method="GET" action="<?php echo e(route('dashboard.form_fields')); ?>">
            <div class="form-group">
                <label for="main_category">Select Main Category</label>
                <select id="main_category" name="main_category_id" class="form-control" onchange="this.form.submit()">
                    <option value="">Select Main Category</option>
                    <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" 
                            <?php echo e(request('main_category_id') == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="formFieldsTable" class="table display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Field Name</th>
                                <th>Field Type</th>
                                <th>Subcategory</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $formFieldsGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategoryId => $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="4" class="font-weight-bold">
                                        Subcategory: <?php echo e($fields->first()->subcategory->name); ?>

                                    </td>
                                </tr>
                                <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($field->field_name); ?></td>
                                        <td><?php echo e($field->field_type); ?></td>
                                        <td><?php echo e($field->subcategory->name); ?></td>
                                        <td> 
                                            <form id="deleteForm<?php echo e($field->id); ?>" action="<?php echo e(route('dashboard.formfields.destroy', $field->id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('deleteForm<?php echo e($field->id); ?>', 'Are you sure you want to delete this field?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        <?php echo e($formFields->links('pagination::bootstrap-5')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script>
    $(document).ready(function() {
        // Initialize DataTable for the combined table
        $('#formFieldsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true
        });
    });
</script>
<script>
    function confirmDelete(formId, message) {
        if (confirm(message)) {
            document.getElementById(formId).submit();
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newAdminDashboard/formfieldsManagement/index.blade.php ENDPATH**/ ?>