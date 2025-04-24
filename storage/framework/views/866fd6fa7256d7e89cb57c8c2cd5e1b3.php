<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/userdashboard.css')); ?>" rel="stylesheet">
<style>


    .active-category {
        background-color:rgb(175, 76, 76) !important;
        color: white !important;
    }

    .active-subcategory {
        background-color: rgb(175, 76, 76) !important;
        color: white !important;
    }



.main-categories {
    margin: 20px 0;
}

.category-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #f7f7f7;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.category-item:hover {
    background-color: #e0e0e0;
}

.category-name {
    font-size: 18px;
    flex-grow: 1;
}

.right-arrow {
    font-size: 18px;
    transition: transform 0.3s ease;
}

.subcategory-list {
    padding-left: 20px;
    margin-top: 10px;
    display: none;
}

.subcategory-item {
    display: flex;
    align-items: center;
    cursor: pointer;
    margin-bottom: 15px;
    padding: 15px;
    background-color: #f7f7f7;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.subcategory-item:hover {
    background-color: #e0e0e0;
}


</style>

<section  class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            <div class="mr-0 content-box centred">
                <div class="title">
                    <h1><?php echo app('translator')->get('messages.Dashboard'); ?></h1>
                </div>
                <ul class="clearfix bread-crumb">
                    <li><a href="<?php echo e(route('/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                    <li><?php echo app('translator')->get('messages.Dashboard'); ?></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

        <section class="mb-4 dash-header-part">
                    <div class="container" >
                        <div class="dash-header-card"  style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-height:230px; height:auto" >
                            <div class="row">
                                <div class="col-lg-5">
                                <div class="dash-header-left">
                                  <div class="dash-avatar">
                                        <?php if(Auth::check() && Auth::user()->profileImage): ?>
                                            <a href="#"><img src="<?php echo e(asset('storage/profile_images/' . Auth::user()->profileImage)); ?>"
                                            alt="user"></a>
                                        <?php else: ?>
                                            <a href="#"><img src="<?php echo e(asset('web/images/user.png')); ?>" alt="user"></a>
                                        <?php endif; ?>
                                    </div>

                                    <div class="dash-intro">
                                        <h4><a href="#"><?php echo e(Auth::user()->first_name); ?> <?php echo e(Auth::user()->last_name); ?></a></h4>
                                        <h5><?php echo e(Auth::user()->email); ?></h5>

                                        <ul class="dash-meta">
                                            <li>
                                                <i class="fas fa-phone"></i>
                                                <span><?php echo e(Auth::user()->phone_number); ?></span>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope"></i>
                                                <span><?php echo e(Auth::user()->email); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                <div class="col-lg-7">
                    <div class="dash-header-right">
                        <div class="dash-focus dash-list">
                            <h2>Post</h2>
                            <p>Your Ads</p>
                        </div>
                        <div class="dash-focus dash-book">
                            <h2>Need</h2>
                            <p> To Buy</p>
                        </div>
                        <div class="dash-focus dash-rev">
                            <h2>Boost</h2>
                            <p>Your Ads'</p>
                        </div>
                    </div>
                </div>
            </div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash-menu-list">
                            <ul>
                                <li><a href="<?php echo e(route('user.dashboard')); ?>"><?php echo app('translator')->get('messages.Dashboard'); ?></a></li>
                                <li><a  class="active" href="<?php echo e(route('user.ad_posts.categories')); ?>"><?php echo app('translator')->get('messages.ad post'); ?></a></li>
                                <li><a href="<?php echo e(route('user.my_ads')); ?>" ><?php echo app('translator')->get('messages.my ads'); ?></a></li>
                                <li><a href="<?php echo e(route('user.profile')); ?>"><?php echo app('translator')->get('messages.Profile'); ?></a></li>
                                <li><a href=""><?php echo app('translator')->get('messages.message'); ?></a></li>
                                <li>
                                    <a href="<?php echo e(route('user.logout')); ?>"><?php echo app('translator')->get('messages.Logout'); ?></a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="setting-part">
    <div class="container">
        <div class="row">
            <div class="mb-3 col-lg-6">
                <div class="p-4 account-card alert fade show" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                    <h4> <?php echo app('translator')->get('messages.Main Categories'); ?></h4>

                    <!-- Main Category List -->
                    <div class="main-categories">
                        <?php $__currentLoopData = $categories->take(14); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="category-item" onclick="toggleSubcategories('<?php echo e($category->id); ?>', this)">
                                <!-- Main Category Name -->
                                <div class="main-category-name" style="color:black;font-weight: 500; margin: 8px 0;">
                                 <?php echo app('translator')->get('messages.' . $category->name); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="mb-3 col-lg-6">
                <div class="p-4 account-card alert fade show" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                    <!-- Subcategories Section (Dynamically displayed next to main categories) -->
                    <div id="subcategory-section">
                        <!-- Subcategories will be injected here dynamically when a category is clicked -->
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-2 mb-4 col-lg-12">
                <button type="button" onclick="submitSelection()" class="theme-btn-one">
                    <span>Continue</span>
                </button>
            </div>
        </div>
    </div>
</div>



<script>
 let selectedCategoryId = null;
let selectedSubcategoryId = null;

function toggleSubcategories(categoryId, categoryElement) {
    // Track the selected category and mark it as active
    selectedCategoryId = categoryId;

    // Remove active class from all categories and add it to the selected one
    const allCategoryItems = document.querySelectorAll('.category-item');
    allCategoryItems.forEach(item => {
        item.classList.remove('active-category');
    });
    categoryElement.classList.add('active-category');

    // Send an AJAX request to fetch the subcategories for the clicked category
    fetch(`/fetch-subcategories/${categoryId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch subcategories');
            }
            return response.json();
        })
        .then(data => {
            console.log('Subcategories data:', data);
            const subcategorySection = document.getElementById('subcategory-section');
            subcategorySection.innerHTML = '';

            // Check if there are subcategories
            if (data.length > 0) {
                let subcategoryList = '<h4 class="mb-4"><?php echo app('translator')->get('messages.Subcategories'); ?></h4>';
                data.forEach(subcategory => {
                    subcategoryList += `
                        <div class="subcategory-item" onclick="selectSubcategory('${subcategory.id}', this)" style="color:black">
                            ${subcategory.name}
                        </div>
                    `;
                });
                subcategorySection.innerHTML = subcategoryList;
            } else {
                subcategorySection.innerHTML = '<p>No subcategories found.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching subcategories:', error);
            const subcategorySection = document.getElementById('subcategory-section');
            subcategorySection.innerHTML = '<p>Error loading subcategories. Please try again.</p>';
        });
}

function selectSubcategory(subcategoryId, subcategoryElement) {
    // Track the selected subcategory and mark it as active
    selectedSubcategoryId = subcategoryId;

    // Remove active class from all subcategories and add it to the selected one
    const allSubcategoryItems = document.querySelectorAll('.subcategory-item');
    allSubcategoryItems.forEach(item => {
        item.classList.remove('active-subcategory');
    });
    subcategoryElement.classList.add('active-subcategory');
}

function submitSelection() {
    if (selectedCategoryId && selectedSubcategoryId) {
        // Redirect with the selected categories as query parameters
        window.location.href = `/user/ad_posts/location?cat_id=${selectedCategoryId}&sub_cat_id=${selectedSubcategoryId}`;
    } else {
        alert('Please select both a category and a subcategory.');
    }
}


</script>





<?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\eSupport\Yaka-Project\resources\views/newFrontend/user/ad_posts_categories.blade.php ENDPATH**/ ?>