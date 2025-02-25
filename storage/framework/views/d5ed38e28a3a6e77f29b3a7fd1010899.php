<div>
    <p>Selected Brand ID: <?php echo e($selectedBrand ?? 'None Selected'); ?></p>

    <!-- Brand Dropdown -->
    <div class="col-lg-6 mb-3">
        <div class="form-group">
            <label class="form-label text-dark"><strong>Brand</strong></label>
            <select wire:model="selectedBrand" class="form-control custom-select">
                <option value="">Select Brand</option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
    </div>

    <!-- Model Dropdown -->
    <div class="col-lg-6 mb-3">
        <div class="form-group">
            <label class="form-label text-dark"><strong>Model</strong></label>
            <select wire:model="selectedModel" class="form-control custom-select">
                <option value="">Select Model</option>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($model->id); ?>"><?php echo e($model->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </select>
        </div>
    </div>
</div>

<script>
    document.addEventListener("livewire:load", function() {
        Livewire.on('refreshComponent', () => {
            location.reload();
        });
    });
</script>
<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/livewire/brand-model-selector.blade.php ENDPATH**/ ?>