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

    .equal-height {
        min-height: 220px; 
    }


</style>

@php
    $cat_id = request()->get('cat_id');
    $sub_cat_id = request()->get('sub_cat_id');
   
@endphp

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
                    <form action="{{ route('user.ad_posts.store') }}?cat_id={{ $cat_id }}&sub_cat_id={{ $sub_cat_id }}&location={{ $location }}&sublocation={{ $sublocation }}"
                     method="POST" enctype="multipart/form-data">
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
                                        <input class="form-check-input" type="radio" name="condition" value="{{ $option }}" >
                                        <label class="form-check-label"  style="margin-right:15px">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>Additional Information</strong></label>
                                <!-- Render the form fields -->
                                @foreach($formFields as $field)
                                    <div class="form-group">
                                        <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                        
                                        <!-- Check field type and render appropriate input box -->
                                        @if($field->field_type == 'text')
                                            <input type="text" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control" >
                                        @elseif($field->field_type == 'number')
                                            <input type="number" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control" >
                                        @elseif($field->field_type == 'email')
                                            <input type="email" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control" >
                                        @elseif($field->field_type == 'textarea')
                                            <textarea id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control" ></textarea>
                                        @elseif($field->field_type == 'select')
                                            <select id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control" >
                                                <option value="">Select</option>
                                                <!-- Options should be fetched dynamically if needed -->
                                            </select>
                                        @endif
                                    </div>
                                @endforeach
                        </div>
                    </div>

                   
              <!-- Pricing Type -->
                <div class="col-lg-12 mb-3">
                    <div class="section-box">
                        <h4>Pricing Type</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @foreach(['Fixed', 'Negotiable', 'Daily', 'Weekly', 'Monthly', 'Yearly'] as $option)
                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="pricing_type" value="{{ $option }}" >
                                    <label class="form-check-label" style="margin-right:15px">{{ $option }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                  
                    <!-- Post Type -->
                        <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>Post Type</strong></label>
                            <div class="d-flex">
                                @foreach(['Booking', 'Sale', 'Rent'] as $option)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="post_type" value="{{ $option }}" >
                                        <label class="form-check-label"  style="margin-right:15px">{{ $option }}</label>
                                    </div>
                                @endforeach
                            </div>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="section-box">
                                <h4>Boosting Option</h4>

                                <!-- Top Ads, Super Ads, Urgent Ads Section -->
                                <div class="row mt-4">
                                    <!-- Top Ads Box -->
                                    <div class="col-md-4 mb-3">
                                        <div class="box p-3 border border-success rounded equal-height">
                                            <h5 class="text-success">Top Ads</h5>
                                            <p class="text-muted">At every page, there are 4 top slots available for top ads. If you apply for top ads, your ad will appear on top of those slots, increasing responses. Top ads are bigger than free ads, with a green blinking border for more visibility.</p>
                                        </div>
                                    </div>

                                    <!-- Super Ads Box -->
                                    <div class="col-md-4 mb-3">
                                        <div class="box p-3 border border-primary rounded equal-height">
                                            <h5 class="text-primary">Super Ads</h5>
                                            <p class="text-muted">Super ads are designed to grab immediate attention, featuring a premium slot at the top with a blue blinking border and rocket symbol. They stand out as soon as they're promoted and also appear as free ads for extra visibility.</p>
                                        </div>
                                    </div>

                                    <!-- Urgent Ads Box -->
                                    <div class="col-md-4 mb-3">
                                        <div class="box p-3 border border-danger rounded equal-height">
                                            <h5 class="text-danger">Urgent Ads</h5>
                                            <p class="text-muted">We have some special promotions for selling urgently. Urgent ads have a blinking red border and an urgent badge, which is a great advantage to get more attention quickly.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Package and Package Type Selection Section -->
                                <div class="row mt-4">
                                    <!-- Package Selection Column -->
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <h5 class="mb-2">Select a Package:</h5>
                                            
                                            <!-- Free Ad Option -->
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="package_free" value="0" checked>
                                                <label class="form-check-label text-dark" for="package_free">
                                                    <h5>Free Ad</h5>
                                                </label>
                                            </div>

                                            @foreach($packages as $package)
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="radio" name="boosting_option" id="package_{{ $package->id }}" value="{{ $package->id }}">
                                                    <label class="form-check-label text-dark" for="package_{{ $package->id }}">
                                                        <h5>{{ $package->name }}</h5>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Package Type Selection Column -->
                                    <div class="col-md-4">
                                        <div id="package-types" class="d-none">
                                            <h4>Select Package Type:</h4>
                                            @foreach($packages as $package)
                                                <div class="package-types-for-{{ $package->id }} d-none">
                                                    @foreach($package->packageTypes as $packageType)
                                                        <div class="form-check mt-2">
                                                            <input class="form-check-input" type="radio" name="package_type" id="packageType_{{ $packageType->id }}" value="{{ $packageType->id }}">
                                                            <label class="form-check-label text-dark" for="packageType_{{ $packageType->id }}">
                                                                {{ $packageType->duration }} (LKR {{ number_format($packageType->price, 2) }})
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
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

<script>
    // Show package types based on selected package
    document.querySelectorAll('input[name="boosting_option"]').forEach(packageRadio => {
        packageRadio.addEventListener('change', function() {
            // Hide all package types first
            document.querySelectorAll('[class^="package-types-for-"]').forEach(element => {
                element.classList.add('d-none');
            });

            // Show package types for the selected package
            const selectedPackageId = this.value;
            document.querySelector('.package-types-for-' + selectedPackageId).classList.remove('d-none');
            document.getElementById('package-types').classList.remove('d-none');
        });
    });
</script>




@endsection

