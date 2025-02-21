

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New Fields for Categories</h4>

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

                    <form method="post" action="<?php echo e(route('dashboard.formfields.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="main_category">Main Category</label>
                            <select id="main_category" class="form-control" name="main_category" required>
                                <option value="">Select Main Category</option>
                                <?php $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($mainCategory->id); ?>"><?php echo e($mainCategory->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subcategory">Subcategory</label>
                            <select id="subcategory" class="form-control" name="subcategory" required>
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>

                        <div id="fields-container">
                            <div class="row field-group mb-2">
                               
                                <div class="col-md-6">
                                <label for="subcategory">Field Name</label>
                                    <input type="text" name="field_name[]" placeholder="Field Name" class="form-control" required>
                                </div>
                               
                                <div class="col-md-5">
                                <label for="subcategory">Field Type</label>
                                    <select name="field_type[]" class="form-control" required>
                                        <option value="text">Text</option>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <label for="subcategory">Delete</label><br>
                                    <button type="button" class="btn btn-danger remove-field"> <i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add-field" class="btn btn-primary">Add Field</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>




                </div>
            </div>
        </div>
    </div>


    <script>
    document.getElementById('main_category').addEventListener('change', function() {
        let mainCategoryId = this.value;
        let subcategorySelect = document.getElementById('subcategory');
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

        if(mainCategoryId) {
            fetch(`/get-subcategories/${mainCategoryId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        let option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;
                        subcategorySelect.appendChild(option);
                    });
                });
        }
    });

    document.getElementById('add-field').addEventListener('click', function() {
        let container = document.getElementById('fields-container');
        let fieldGroup = document.createElement('div');
        fieldGroup.classList.add('row', 'field-group', 'mb-2');

        fieldGroup.innerHTML = `
            <div class="col-md-6">
                <input type="text" name="field_name[]" placeholder="Field Name" class="form-control" required>
            </div>
            <div class="col-md-5">
                <select name="field_type[]" class="form-control" required>
                    <option value="text">Text</option>
                </select>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-field"> <i class="fas fa-trash"></i></button>
            </div>
        `;

        container.appendChild(fieldGroup);
    });

    document.addEventListener('click', function(event) {
        if(event.target.classList.contains('remove-field')) {
            event.target.closest('.field-group').remove();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newAdminDashboard/formfieldsManagement/create.blade.php ENDPATH**/ ?>