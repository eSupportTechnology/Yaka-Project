<div class="col-md-6 col-lg-12">
    <div class="product-widget">
        <h6 class="product-widget-title"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans('categories', app()->getLocale())); ?></h6>
        <ul class="product-widget-list">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="product-widget-item">
                    <a href="<?php echo e(route('ads',[$category->url])); ?>">
                        <span class="product-widget-text"><?php echo e(\Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale())); ?></span>
                        <?php
                            $adsCount = \App\Models\Ads::where('cat_id', $category->id )->where('status', 1 )->count();
                        ?>
                        <span class="product-widget-number">(<?php echo e($adsCount); ?>)</span>
                    </a>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/web/components/filters/category.blade.php ENDPATH**/ ?>