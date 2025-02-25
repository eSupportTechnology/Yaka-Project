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
    margin-bottom: 5px;
    padding: 5px 20px;
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
    margin-bottom: 5px;
    padding: 5px 20px;
    background-color: #f7f7f7;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.subcategory-item:hover {
    background-color: #e0e0e0;
}


</style>

<!-- Page Title -->
<section  class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            <div class="content-box centred mr-0">
                <div class="title">
                    <h1>Dashboard</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="<?php echo e(route('/')); ?>">Home</a></li>
                    <li>Dashboard</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

        <section class="dash-header-part mb-4">
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
                                <li><a href="<?php echo e(route('user.dashboard')); ?>">dashboard</a></li>
                                <li><a class="active" href="<?php echo e(route('user.ad_posts.categories')); ?>">ad post</a></li>
                                <li><a href="<?php echo e(route('user.my_ads')); ?>" >my ads</a></li>
                                <li><a href="<?php echo e(route('user.profile')); ?>">Profile</a></li>
                                <li><a href="#">Message</a></li>
                                <li>
                                    <a href="<?php echo e(route('user.logout')); ?>">Logout</a>
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
            <!-- Districts Section -->
            <div class="col-lg-6 mb-3">
                <div class="account-card alert fade show p-4" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                    <h4>Districts</h4>

                    <!-- Districts List -->
                    <div class="main-categories">
                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="category-item" onclick="toggleCities('<?php echo e($district->id); ?>', this)">
                                <div class="main-category-name" style="color:black;font-weight: 500; margin: 0px 0;">
                                    <?php echo e($district->name_en); ?>

                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Cities Section -->
            <div class="col-lg-6 mb-3">
                <div class="account-card alert fade show p-4" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                    <!-- Cities will be injected here -->
                    <div id="subcategory-section">
                        <!-- Cities will be dynamically displayed when a district is clicked -->
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-lg-12 mt-2 mb-4">
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
    let selectedDistrictId = null;
    let selectedCityId = null;

    function toggleCities(districtId, districtElement) {
        selectedDistrictId = districtId;

        // Remove active class from all districts and add it to the clicked district
        const allDistrictItems = document.querySelectorAll('.category-item');
        allDistrictItems.forEach(item => {
            item.classList.remove('active-category');
        });
        districtElement.classList.add('active-category');

        // Send an AJAX request to fetch the cities for the clicked district
        fetch(`/fetch-cities/${districtId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch cities');
                }
                return response.json();
            })
            .then(data => {
                const subcategorySection = document.getElementById('subcategory-section');
                subcategorySection.innerHTML = '';

                // Check if there are cities
                if (data.length > 0) {
                    let cityList = '<h4 class="mb-4">Cities</h4>';
                    data.forEach(city => {
                        cityList += `
                            <div class="subcategory-item" onclick="selectCity('${city.id}', '${city.name_en}', this)" style="color:black">
                                ${city.name_en}
                            </div>
                        `;
                    });
                    subcategorySection.innerHTML = cityList;
                } else {
                    subcategorySection.innerHTML = '<p>No cities found.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching cities:', error);
                const subcategorySection = document.getElementById('subcategory-section');
                subcategorySection.innerHTML = '<p>Error loading cities. Please try again.</p>';
            });
    }

    function selectCity(cityId, cityName, cityElement) {
        selectedCityId = cityId;

        // Remove active class from all cities and add it to the selected one
        const allCityItems = document.querySelectorAll('.subcategory-item');
        allCityItems.forEach(item => {
            item.classList.remove('active-subcategory');
        });
        cityElement.classList.add('active-subcategory');
    }

    function submitSelection() {
    const urlParams = new URLSearchParams(window.location.search);
    const catId = urlParams.get('cat_id');
    const subCatId = urlParams.get('sub_cat_id');

    // If no cities are available, set sublocation (city) to null
    const subcategorySection = document.getElementById('subcategory-section');
    if (!subcategorySection || subcategorySection.innerHTML.includes('No cities found.')) {
        selectedCityId = null;
    }

    if (selectedDistrictId) {
        // Redirect with the selected district and city IDs along with existing cat_id and sub_cat_id
        window.location.href = `/user/ad_posts?cat_id=${catId}&sub_cat_id=${subCatId}&location=${selectedDistrictId}&sublocation=${selectedCityId ?? ''}`;
    } else {
        alert('Please select a district.');
    }
}

</script>






<?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/user/ad_posts_location.blade.php ENDPATH**/ ?>