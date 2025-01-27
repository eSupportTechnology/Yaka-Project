


<?php $__env->startSection('content'); ?>


        <!-- Page Title -->
        <section class="page-title style-two banner-part " style="background-image: url(assets/images/background/page-title.jpg);">
            <div class="auto-container ">
                <div class="content-box centred mr-0">
                    <div class="title">
                        <h1>Browse Ads Grid</h1>
                    </div>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Browse Ads Grid</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


        <!-- category-details -->
        <section class="category-details bg-color-2">
            <div class="auto-container">
                <div class="row clearfix">

                    <div class="col-lg-3 col-md-12 col-sm-12 sidebar-side">
                        <div class="default-sidebar category-sidebar">
                            <div class="sidebar-search sidebar-widget">
                                <div class="widget-title">
                                    <h3>Search</h3>
                                </div>
                                <div class="widget-content">
                                    <form action="category-details.html" method="post" class="search-form">
                                        <div class="form-group">
                                            <input type="search" name="search-field" placeholder="Search Keyword..." required="">
                                            <button type="submit"><i class="icon-2"></i></button>
                                        </div>
                                        <div class="form-group">
                                            <i class="icon-3"></i>
                                            <select class="wide">
                                               <option data-display="Select Location">Select Location</option>
                                               <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                               <option value="1"><?php echo e($city->name_en); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            <div class="sidebar-category sidebar-widget">
                                <div class="widget-title">
                                    <h3>Category</h3>
                                </div>
                                <div class="widget-content">
                                <ul class="category-list">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e($category->subcategories->isNotEmpty() ? 'dropdown' : ''); ?>">
                                            <a href="#"><?php echo e($category->name); ?></a>
                                            <?php if($category->subcategories->isNotEmpty()): ?>
                                                <ul>
                                                    <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li><a href="#"><?php echo e($subcategory->name); ?></a></li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12 content-side">
                        <div class="category-details-content">
                            <div class="item-shorting clearfix">
                                <div class="text pull-left">
                                    <h6>Buy, Sell, Rent or Find Anything in Sri Lanka</h6>
                                    <p><span>Search Results:</span> Showing <?php echo e($ads->firstItem()); ?>-<?php echo e($ads->lastItem()); ?> of <?php echo e($ads->total()); ?> Listings</p>
                                </div>
                                <div class="right-column pull-right clearfix">
                                </div>
                            </div>

                            
                            <div class="category-block wrapper grid browse-add">
                            <div class="grid-item feature-style-two four-column pd-0" style="display: flex; flex-wrap: wrap;">
                                <div class="row clearfix">
                                    <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block" style="display: flex; flex-direction: column; flex-grow: 1; margin-bottom: 30px;">
                                        <div class="feature-block-one" style="display: flex; flex-direction: column; height: 100%;">
                                            <div class="inner-box" style="display: flex; flex-direction: column; height: 100%;">
                                                <div class="image-box">
                                                    <figure class="image">
                                                        <img src="<?php echo e(asset('storage/' . $ad->main_image)); ?>" alt="">
                                                    </figure>
                                                    <div class="shape"></div>
                                                    <div class="feature">Featured</div>
                                                    <div class="icon">
                                                        <div class="icon-shape"></div>
                                                        <i class="icon-16"></i>
                                                    </div>
                                                </div>
                                                <div class="lower-content" style="flex-grow: 1;">
                                                    <div class="category"><i class="fas fa-tags"></i><p><?php echo e($ad->category->name); ?></p></div>
                                                    <h4><a href="browse-ads-details.html"><?php echo e($ad->title); ?></a></h4>
                                                    <ul class="info clearfix">
                                                        <li><i class="far fa-clock"></i><?php echo e($ad->created_at->diffForHumans()); ?></li>
                                                        <li>
                                                            <i class="fas fa-map-marker-alt"></i>
                                                            <?php echo e($ad->main_location ? $ad->main_location->name_en : 'N/A'); ?>

                                                        </li>
                                                    </ul>
                                                    <div class="lower-box" style="margin-top: auto;">
                                                        <h5>Rs <?php echo e(number_format($ad->price, 2)); ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            </div>
                            <!-- Pagination -->
                            <div class="pagination-wrapper centred">
                                <ul class="pagination clearfix">
                                    
                                    <?php if($ads->onFirstPage()): ?>
                                        <li class="disabled"><a href="#"><i class="far fa-angle-left"></i>Prev</a></li>
                                    <?php else: ?>
                                        <li><a href="<?php echo e($ads->previousPageUrl()); ?>"><i class="far fa-angle-left"></i>Prev</a></li>
                                    <?php endif; ?>

                                    
                                    <?php $__currentLoopData = $ads->getUrlRange(1, $ads->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="<?php echo e(($page == $ads->currentPage()) ? 'current' : ''); ?>">
                                            <a href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <?php if($ads->hasMorePages()): ?>
                                        <li><a href="<?php echo e($ads->nextPageUrl()); ?>">Next<i class="far fa-angle-right"></i></a></li>
                                    <?php else: ?>
                                        <li class="disabled"><a href="#">Next<i class="far fa-angle-right"></i></a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                        </div>
                       

                </div>
            </div> 
        </section>
        <!-- category-details end -->


        <?php $__env->stopSection(); ?>
<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/browse-ads.blade.php ENDPATH**/ ?>