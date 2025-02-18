@extends ('newFrontend.master')

@section('content')
<link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">
<style>

.section-box {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 20px;
    background: #f9f9f9; /* Light grey background */
}
.section-box h4 {
    margin-bottom: 15px;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}
.form-check {
    display: flex;
    align-items: center;
}

.form-check-input {
    transform: scale(1.1); 
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
                    <li><a href="{{ route('/') }}">Home</a></li>
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
                                        @if(Auth::check() && Auth::user()->profileImage) 
                                            <a href="#"><img src="{{ asset('storage/profile_images/' . Auth::user()->profileImage) }}" 
                                            alt="user"></a>
                                        @else
                                            <a href="#"><img src="{{ asset('web/images/user.png') }}" alt="user"></a>
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
                                <li><a href="{{route('user.dashboard')}}">dashboard</a></li>
                                <li><a class="active" href="{{route('user.ad_posts')}}">ad post</a></li>
                                <li><a href="{{route('user.my_ads')}}" >my ads</a></li>
                                <li><a href="{{route('user.profile')}}">Profile</a></li>
                                <li><a href="#">Message</a></li>
                                <li>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

     
<div class="setting-part">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
            <div class="account-card alert fade show p-4" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

                    @if(isset($message))
                        <div class="alert alert-success" role="alert" style="padding: 12px 12px;margin-bottom: 24px;">
                            {{ $message }}
                        </div>
                    @endif
                    <form class="setting-form" method="POST" action="{{ route('user.ad_posts') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="">

                    <div class="row">
                        
                    <!-- Product Details -->
                    <div class="col-lg-12 mb-3">
                    <div class="section-box">
                            <h4>Product Details</h4>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Product Title</strong></label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Price</strong></label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Ad Description</strong></label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Upload Main Image</strong></label>
                                <input type="file" name="main_image" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>Upload Sub Images</strong></label>
                                <input type="file" name="sub_images[]" class="form-control" multiple>
                            </div>
                        </div>
                        </div>
                        </div>

                     <!-- category Information -->
                     <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <div class="d-flex flex-wrap gap-3">
                               <!-- Brand -->
<div class="col-lg-6 mb-3">
    <div class="form-group">
        <label class="form-label text-dark"><strong>Brand</strong></label>
        <select id="brand" name="brand" class="form-control custom-select">
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @if(request()->brand == $brand->id) selected @endif>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<!-- Model -->
<div class="col-lg-6 mb-3">
    <div class="form-group">
        <label class="form-label text-dark"><strong>Model</strong></label>
        <select id="model" name="model" class="form-control custom-select">
            <option value="">Select Model</option>
            @foreach($models as $model)
                <option value="{{ $model->id }}" @if(request()->model == $model->id) selected @endif>
                    {{ $model->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>


                            </div>
                            <div class="section-box">
                            <label class="form-label text-dark"><strong>Product Condition</strong></label>
                            <div class="d-flex">
                                @foreach(['New', 'Used'] as $option)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="condition" value="{{ $option }}" required>
                                        <label class="form-check-label"  style="margin-right:15px">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </div>
                    </div>

              <!-- Pricing Type -->
                <div class="col-lg-12 mb-3">
                    <div class="section-box">
                        <h4>Pricing Type</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @foreach(['Fixed', 'Negotiable', 'Daily', 'Weekly', 'Monthly', 'Yearly'] as $option)
                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="pricing_type" value="{{ $option }}" required>
                                    <label class="form-check-label" style="margin-right:15px">{{ $option }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                  
                    <!-- Ad Type -->
                        <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>Ad Type</strong></label>
                            <div class="d-flex">
                                @foreach(['Booking', 'Sale', 'Rent'] as $option)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="ad_type" value="{{ $option }}" required>
                                        <label class="form-check-label"  style="margin-right:15px">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                            </div>
                        </div>

                    <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <h4>Boosting Option</h4>

                            <!-- Free Ad Option -->
                            <div class="d-flex align-items-center mb-2">
                            <div class="form-check me-3">
                                <input class="form-check-input me-2" type="radio" name="boosting_option" id="freeAd" value="free" checked>
                                <label class="form-check-label text-dark" for="freeAd">Free Ad</label>
                            </div>
                            </div>

                            <!-- Top Ads Section -->
                            <div class="d-flex justify-content-between align-items-start">
                                <!-- Left: Radio Options -->
                                <div>
                                    <h5 class="mt-3 mb-2">Top Ads</h5>
                                    <div class="d-flex flex-column gap-3">

                                        <!-- 3 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="topAd3" value="3_days">
                                                <label class="form-check-label text-dark" for="topAd3">
                                                    3 DAYS (LKR 500.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 7 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="topAd7" value="7_days">
                                                <label class="form-check-label text-dark" for="topAd7">
                                                    7 DAYS (LKR 1400.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 15 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="topAd15" value="15_days">
                                                <label class="form-check-label text-dark" for="topAd15">
                                                    15 DAYS (LKR 1800.00)
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- Right: Description Text -->
                                <div class="text-muted ms-4 mb-3" style="max-width: 50%;">
                                    <p>At every page, there are 4 top slots available for top ads.</p>
                                    <p>If you apply for top ads, your ad will appear on top of those slots, increasing responses.</p>
                                    <p>Top ads are bigger than free ads, with a green blinking border for more visibility.</p>
                                </div>

                            </div>

                             <!-- urgent Ads Section -->
                             <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="mt-3 mb-2">Urgent Ads</h5>
                                    <div class="d-flex flex-column gap-3">

                                        <!-- 3 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="urgentAd3" value="3_days">
                                                <label class="form-check-label text-dark" for="urgentAd3">
                                                    3 DAYS (LKR 700.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 7 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="urgentAd7" value="7_days">
                                                <label class="form-check-label text-dark" for="urgentAd7">
                                                    7 DAYS (LKR 800.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 15 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="urgentAd15" value="15_days">
                                                <label class="form-check-label text-dark" for="urgentAd15">
                                                    15 DAYS (LKR 900.00)
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="text-muted ms-4 mt-4 mb-3" style="max-width: 50%;">
                                    <p>We have some special promotion for sell urgently</p>
                                    <p>Urgent ads border blink in bright RED color also urgent badge which is great advantage to get more attention quickly.</p>
                                </div>
                            </div>

                             <!-- Super Ads Section -->
                             <div class="d-flex justify-content-between align-items-start mt-4">
                                <div>
                                    <h5 class="mt-3 mb-2">Super Ads</h5>
                                    <div class="d-flex flex-column gap-3">

                                        <!-- 3 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="superAd3" value="3_days">
                                                <label class="form-check-label text-dark" for="superAd3">
                                                    3 DAYS (LKR 2400.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 7 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="superAd7" value="7_days">
                                                <label class="form-check-label text-dark" for="superAd7">
                                                    7 DAYS (LKR 3000.00)
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 15 Days -->
                                        <div class="d-flex align-items-center">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="superAd15" value="15_days">
                                                <label class="form-check-label text-dark" for="superAd15">
                                                    15 DAYS (LKR 3500.00)
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="text-muted ms-4 mt-4" style="max-width: 50%;">
                                    <p>Super adds specially designed to get immediate attention from buyers as soon as log into adds listing page.</p>
                                    <p>Super adds has given premium slot of top of the adds listing with highlighted blue 
                                        blinking border around and rocket symbol, which attract buyers as soon as add promoted to super add.</p>
                                    <p>Super adds also visible as a free add is an extra advantage.</p>
                                </div>
                            </div>

                        </div>
                    </div>


                    

                    <div class="col-lg-12 mt-4">
                        <button type="submit" class="theme-btn-one">
                            <i class="fas fa-check"></i>
                            <span>Publish Your Ad</span>
                        </button>
                    </div>
                </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
 $(document).ready(function() {
    let urlParams = new URLSearchParams(window.location.search);
    let catId = urlParams.get('cat_id');
    let subCatId = urlParams.get('sub_cat_id');
    let selectedBrandId = "{{ request()->brand }}"; // Get pre-selected brand from request
    let selectedModelId = "{{ request()->model }}"; // Get pre-selected model from request

    // Function to Fetch Brands
    function fetchBrands(subCatId) {
        if (subCatId) {
            $.ajax({
                url: "{{ route('get.brands') }}",
                type: "GET",
                data: { subcategory_id: subCatId },
                success: function(data) {
                    $('#brand').html('<option value="">Select Brand</option>');
                    $.each(data, function(key, value) {
                        let selected = selectedBrandId == value.id ? "selected" : "";
                        $('#brand').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                    });

                    // If a brand is pre-selected, fetch models for it
                    if (selectedBrandId) {
                        fetchModels(selectedBrandId);
                    }
                }
            });
        }
    }

    function fetchModels(brandId, subCatId) {
    if (brandId && subCatId) {
        $.ajax({
            url: "{{ route('get.models') }}",
            type: "GET",
            data: { brand_id: brandId, sub_cat_id: subCatId },
            success: function(data) {
                $('#model').html('<option value="">Select Model</option>');
                $.each(data, function(key, value) {
                    let selected = selectedModelId == value.id ? "selected" : "";
                    $('#model').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                });
            },
            error: function(response) {
                console.log('Error:', response);
            }
        });
    }
}




    // Auto-fetch brands if category and subcategory exist in URL
    if (subCatId) {
        fetchBrands(subCatId);
    }

    // Fetch Models when Brand is selected
    $('#brand').change(function() {
        let brandId = $(this).val();
        fetchModels(brandId);
    });

    // If brand is already selected (from request), fetch its models
    if (selectedBrandId) {
        fetchModels(selectedBrandId);
    }
});



</script>


@endsection

