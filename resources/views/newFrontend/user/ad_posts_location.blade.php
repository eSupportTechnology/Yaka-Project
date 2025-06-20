@extends ('newFrontend.master')

@section('content')
<link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">
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

<section  class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            @if(Auth::check() && Auth::user()->roles != 'staff')
            <div class="content-box centred mr-0">
                <div class="title">
                    <h1>@lang('messages.Dashboard')</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                    <li>@lang('messages.Dashboard')</li>
                </ul>
            </div>
            @endif
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
                                        @if(Auth::check() && Auth::user()->profileImage)
                                            <a href="#"><img src="{{ url('storage/profile_images/' . Auth::user()->profileImage) }}"
                                            alt="user"></a>
                                        @else
                                            <a href="#"><img src="{{ url('web/images/user.png') }}" alt="user"></a>
                                        @endif
                                    </div>

                                    <div class="dash-intro">
                                        <h4><a href="#">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></h4>
                                        <h5>{{ Auth::user()->email }}</h5>

                                        <ul class="dash-meta">
                                            <li>
                                                <i class="fas fa-phone"></i>
                                                <span>{{ Auth::user()->phone_number }}</span>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope"></i>
                                                <span>{{ Auth::user()->email }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                                @if(Auth::check() && Auth::user()->roles != 'staff')
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
                                @endif
            </div>



                <div class="row">
                    <div class="col-lg-12">
                        <div class="dash-menu-list">
                            <ul>
                                @if(Auth::check() && Auth::user()->roles != 'staff')
                                <li><a href="{{route('user.dashboard')}}">@lang('messages.Dashboard')</a></li>
                                @endif
                                <li><a  class="active" href="{{route('user.ad_posts.categories')}}">@lang('messages.ad post')</a></li>
                                    @if(Auth::check() && Auth::user()->roles != 'staff')
                                <li><a href="{{route('user.my_ads')}}" >@lang('messages.my ads')</a></li>
                                <li><a href="{{route('user.profile')}}">@lang('messages.Profile')</a></li>
                                    @endif
                                {{-- <li><a href="">@lang('messages.message')</a></li> --}}
                                <li>
                                    <a href="{{route('user.logout')}}">@lang('messages.Logout')</a>
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
                    <h4>@lang('messages.District')</h4>

                   <!-- Districts List -->
                    <div class="main-categories">
                        @foreach($districts as $district)
                            @php
                                $locale = App::getLocale();
                                $districtName = 'name_' . $locale;
                            @endphp
                            <div class="category-item" onclick="toggleCities('{{ $district->id }}', this)">
                                <div class="main-category-name" style="color:black; font-weight: 500; margin: 0px 0;">
                                    {{ $district->$districtName ?? $district->name_en }}
                                </div>
                            </div>
                        @endforeach
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

                    // Get the current locale
                    const locale = document.documentElement.lang || 'en';

                    if (data.length > 0) {
                        let cityList = '<h4 class="mb-4">@lang('messages.City')</h4>';

                        data.forEach(city => {
                            // Dynamically use the translated name based on the current locale
                            const cityName = city[`name_${locale}`] || city.name_en;

                            // Add the city name dynamically
                            cityList += `
                                <div class="subcategory-item" onclick="selectCity('${city.id}', '${cityName}', this)" style="color:black">
                                    ${cityName}
                                </div>
                            `;
                        });

                        subcategorySection.innerHTML = cityList;
                    } else {
                        subcategorySection.innerHTML = '<p>No cities found</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching cities:', error);
                    const subcategorySection = document.getElementById('subcategory-section');
                    subcategorySection.innerHTML = '<p>Error loading cities</p>';
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






@endsection

