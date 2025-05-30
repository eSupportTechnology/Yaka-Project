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

<section  class="page-title style-two banner-part" style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            <div class="mr-0 content-box centred">
                <div class="title">
                    <h1>@lang('messages.Dashboard')</h1>
                </div>
                <ul class="clearfix bread-crumb">
                    <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                    <li>@lang('messages.Dashboard')</li>
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
                                <li><a href="{{route('user.dashboard')}}">@lang('messages.Dashboard')</a></li>
                                <li><a  class="active" href="{{route('user.ad_posts.categories')}}">@lang('messages.ad post')</a></li>
                                <li><a href="{{route('user.my_ads')}}" >@lang('messages.my ads')</a></li>
                                <li><a href="{{route('user.profile')}}">@lang('messages.Profile')</a></li>
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
    <div class="container" >
        <div class="row">
            <div class="col-lg-12">
            <div class="p-4 account-card alert fade show" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

                    @if(isset($message))
                        <div class="alert alert-success" role="alert" style="padding: 12px 12px;margin-bottom: 24px;">
                            {{ $message }}
                        </div>
                    @endif
                    <form id="adForm" action="{{ route('user.ad_posts.store') }}?cat_id={{ $cat_id }}&sub_cat_id={{ $sub_cat_id }}&location={{ $location }}&sublocation={{ $sublocation }}"
                     method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="userId" value="">
                    <input type="hidden" id="selected_package_name" name="selected_package_name">
                    <input type="hidden" id="selected_package_price" name="selected_package_price">
                    <input type="hidden" id="selected_package_duration" name="selected_package_duration"> <!-- Added for duration -->

                    @if(request()->cat_id != 103)
                    <div class="row">
                     <!-- category Information -->
                     <div class="mb-3 col-lg-12">
                        <div class="section-box">
                            <div class="flex-wrap gap-3 d-flex">
                               <!-- Brand -->
                                <div class="mb-3 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label text-dark"><strong>@lang('messages.Brand')</strong></label>
                                        <select id="brand" name="brand" class="form-control custom-select">
                                            <option value="">@lang('messages.Brand')</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" @if(request()->brand == $brand->id) selected @endif>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Model -->
                                <div class="mb-3 col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label text-dark"><strong>@lang('messages.Model')</strong></label>
                                        {{--  <select id="model" name="model" class="form-control custom-select">
                                            <option value="">@lang('messages.Model')</option>
                                            @foreach($models as $model)
                                                <option value="{{ $model->id }}" @if(request()->model == $model->id) selected @endif>
                                                    {{ $model->name }}
                                                </option>
                                            @endforeach
                                        </select>  --}}
                                        <input type="text" id="model" name="model" class="form-control" >
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>
                    @endif

                    <!-- Product Details -->
                    <div class="mb-3 col-lg-12">
                    <div class="section-box">
                             <h4>
                                <strong>
                                    @if(request()->cat_id == 103)
                                        @lang('messages.Job Description')
                                    @else
                                        @lang('messages.Product Description')
                                    @endif
                                </strong>
                            </h4>
                        <div class="mb-3 col-lg-12">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>@lang('messages.Title')<i class="text-danger">*</i></strong></label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <div class="form-group">
                                <label class="form-label text-dark">
                                    <strong>
                                         @if(request()->cat_id == 103)
                                            @lang('messages.Salary')
                                        @else
                                            @lang('messages.Price')
                                        @endif
                                        <i class="text-danger">*</i>
                                    </strong>
                                </label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 col-lg-12">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>@lang('messages.Description') <i class="text-danger">*</i></strong></label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>
                        @if(request()->cat_id == 103)
                            <!-- Required Work Experience -->
                            <div class="mb-3 col-lg-12">
                                <div class="form-group">
                                    <label class="form-label text-dark">
                                        <strong>@lang('messages.Required Work Experience (years)')</strong>
                                    </label>
                                    <input type="number" name="experience_years" class="form-control" min="0" placeholder="0">
                                </div>
                            </div>

                            <!-- Required Education -->
                            <div class="mb-3 col-lg-12">
                                <div class="form-group">
                                    <label class="form-label text-dark">
                                        <strong>@lang('messages.Required Education')</strong>
                                    </label>
                                    <select name="education" class="form-control custom-select">
                                        <option value="">-- @lang('messages.Select Education') --</option>
                                        <option value="Ordinary Level">Ordinary Level</option>
                                        <option value="Advanced Level">Advanced Level</option>
                                        <option value="Certificate">Certificate</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Higher Diploma">Higher Diploma</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Masters">Masters</option>
                                        <option value="Doctorate">Doctorate</option>
                                        <option value="Skilled Apprentice">Skilled Apprentice</option>
                                    </select>
                                </div>
                            </div>


                            <!-- Application Deadline -->
                            <div class="mb-3 col-lg-12">
                                <div class="form-group">
                                    <label class="form-label text-dark">
                                        <strong>@lang('messages.Application Deadline') (@lang('messages.Optional'))</strong>
                                    </label>
                                    <input type="date" name="application_deadline" class="form-control">
                                </div>
                            </div>

                            <!-- Mobile Number -->
                        <div class="mb-3 col-lg-12">
                            <div class="form-group">
                                <label class="form-label text-dark">
                                    <strong>@lang('messages.Mobile Number') <i class="text-danger">*</i></strong>
                                </label>
                                <input type="tel" name="mobile_number" class="form-control" required pattern="[0-9]{10}" placeholder="Enter 10-digit mobile number">
                            </div>
                        </div>

                        @endif


                        <div class="mb-3 col-lg-12">
                            <div class="form-group">
                                 <label class="form-label text-dark">
                                    <strong>
                                        @if(request()->cat_id == 103)
                                            @lang('messages.Logo')
                                        @else
                                            @lang('messages.Upload Main Image')
                                        @endif
                                        <i class="text-danger">*</i>
                                    </strong>
                                </label>
                                <small class=" text-muted">jpeg,png,jpg,gif,bmp,svg,webp,tiff ,up to 20MB.</small>
                                <input type="file" name="main_image" class="form-control" id="main_image" required>
                                <div id="main_image_preview" style="margin-top: 10px;"></div> <!-- Preview section for main image -->
                            </div>
                        </div>
                        <div class="mb-3 col-lg-12">
                            <div class="form-group">
                                <label class="form-label text-dark">
                                    <strong>
                                        @if(request()->cat_id == 103)
                                            @lang('messages.Description Image')
                                        @else
                                            @lang('messages.Upload Sub Image')
                                        @endif
                                    </strong>
                                </label>
                                <small class=" text-muted">Simply select all images at once.</small>
                                <input type="file" name="sub_images[]" class="form-control" id="sub_images" multiple>
                                <div id="sub_images_preview" style="margin-top: 10px;"></div>
                            </div>
                        </div>

                        </div>
                        </div>
                    
                @if(request()->cat_id != 103)
                     <!-- category Information -->
                     <div class="mb-3 col-lg-12">
                            <div class="section-box">
                            <label class="form-label text-dark"><strong>@lang('messages.Condition')</strong></label>
                            <div class="d-flex">
                                @foreach(['New', 'Used'] as $option)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="condition" value="{{ $option }}" >
                                        <label class="form-check-label" style="margin-right:15px">@lang('messages.' . $option)</label>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                

                
                    <div class="mb-3 col-lg-12">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>Additional Information</strong></label>
                                <!-- Render the form fields -->
                                @foreach($formFields as $field)
                                    <div class="form-group">

                                        <!-- Check field type and render appropriate input box -->
                                        @if($field->field_type == 'text')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <input type="text" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                        @elseif($field->field_type == 'number')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <input type="number" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                        @elseif($field->field_type == 'email')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <input type="email" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                        @elseif($field->field_type == 'textarea')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <textarea id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control"></textarea>
                                        @elseif($field->field_type == 'dropdown')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <select id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                                <option value="">Select</option>
                                                <!-- Add dynamic options here if necessary -->
                                            </select>
                                            @elseif($field->field_type == 'checkbox')
                                            <div class="form-check">
                                                <input type="checkbox" id="field_{{ $field->id }}" name="field_{{ $field->id }}[]" class="form-check-input" style="width: auto; height: auto;">
                                                <label for="field_{{ $field->id }}" class="form-check-label">
                                                    {{ $field->field_name }}
                                                </label>
                                            </div>
                                        @elseif($field->field_type == 'radio')
                                            <!-- Assuming you have options, you can use a loop to render radio buttons -->
                                            <div id="field_{{ $field->id }}">
                                                <input type="radio" name="field_{{ $field->id }}" value="option1" id="option1_{{ $field->id }}"> Option 1
                                                <input type="radio" name="field_{{ $field->id }}" value="option2" id="option2_{{ $field->id }}"> Option 2
                                            </div>
                                        @elseif($field->field_type == 'tel')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <input type="tel" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                        @elseif($field->field_type == 'date')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <input type="date" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                        @elseif($field->field_type == 'time')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <input type="time" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                        @elseif($field->field_type == 'month')
                                            <label for="field_{{ $field->id }}">{{ $field->field_name }}</label>
                                            <input type="month" id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control">
                                        @endif

                                    </div>
                                @endforeach
                        </div>
                    </div>

               

               
              <!-- Pricing Type -->
                <div class="mb-3 col-lg-12">
                    <div class="section-box">
                        <h4>@lang('messages.Pricing Type')</h4>
                        <div class="flex-wrap d-flex align-items-center">
                            @foreach(['Fixed', 'Negotiable', 'Daily', 'Weekly', 'Monthly', 'Yearly'] as $option)
                                <div class="form-check me-4">
                                    <input class="form-check-input" type="radio" name="pricing_type" value="{{ $option }}" >
                                    <label class="form-check-label" style="margin-right:15px">@lang('messages.' . $option)</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                
                    <!-- Post Type -->
                        <div class="mb-3 col-lg-12">
                        <div class="section-box">
                            <label class="form-label text-dark"><strong>@lang('messages.Post Type')</strong></label>
                            <div class="d-flex">
                                @foreach(['Booking', 'Sale', 'Rent'] as $option)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="radio" name="post_type" value="{{ $option }}" >
                                        <label class="form-check-label"  style="margin-right:15px">@lang('messages.' . $option)</label>
                                    </div>
                                @endforeach
                            </div>
                            </div>
                        </div>
                @endif
                        <div class="mb-3 col-lg-12">
                            <div class="section-box">
                                <h4>@lang('messages.Boosting Option')<i class="text-danger">*</i></h4>

                                <!-- Top Ads, Super Ads, Urgent Ads Section -->
                                <div class="mt-4 row">
                                    <!-- Top Ads Box -->
                                    <div class="mb-3 col-md-4">
                                        <div class="p-3 border rounded box border-success equal-height">
                                            <h5 class="text-success">@lang('messages.Top Ads')</h5>
                                            <p class="text-muted">@lang('messages.TopAds description')</p>
                                        </div>
                                    </div>

                                    <!-- Super Ads Box -->
                                    <div class="mb-3 col-md-4">
                                        <div class="p-3 border rounded box border-primary equal-height">
                                            <h5 class="text-primary">@lang('messages.Super Ads')</h5>
                                            <p class="text-muted">@lang('messages.SuperAds description')</p>
                                        </div>
                                    </div>

                                    <!-- Urgent Ads Box -->
                                    <div class="mb-3 col-md-4">
                                        <div class="p-3 border rounded box border-danger equal-height">
                                            <h5 class="text-danger">@lang('messages.Urgent Ads')</h5>
                                            <p class="text-muted">@lang('messages.UrgentAds description')</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Package and Package Type Selection Section -->
                                <div class="mt-4 row">
                                    <!-- Package Selection Column -->
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <h5 class="mb-2">@lang('messages.Select a Package'):</h5>

                                            <!-- Free Ad Option -->
                                            <div class="mt-2 form-check">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="package_free" value="0" checked>
                                                <label class="form-check-label text-dark" for="package_free">
                                                    <h5>@lang('messages.Free Ad')</h5>
                                                </label>
                                            </div>

                                            @foreach($packages as $package)
                                                <div class="mt-2 form-check">
                                                    <input class="form-check-input package-radio" type="radio" name="boosting_option" id="package_{{ $package->id }}" value="{{ $package->id }}" data-name="{{ $package->name }}">
                                                    <label class="form-check-label text-dark" for="package_{{ $package->id }}">
                                                        <h5>@lang('messages.' . $package->name)</h5>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Package Type Selection Column -->
                                    <div class="col-md-4">
                                        <div id="package-types" class="d-none">
                                            <h4>@lang('messages.Select Package Type')</h4>
                                            @foreach($packages as $package)
                                                <div class="package-types-for-{{ $package->id }} d-none">
                                                    @foreach($package->packageTypes as $packageType)
                                                        <div class="mt-2 form-check">
                                                            <input class="form-check-input package-type-radio" type="radio" name="package_type" id="packageType_{{ $packageType->id }}" value="{{ $packageType->id }}" data-price="{{ $packageType->price }}"  data-duration="{{ $packageType->duration }}">
                                                            <label class="form-check-label text-dark" for="packageType_{{ $packageType->id }}">
                                                                {{ $packageType->duration }} (@lang('messages.Rs') {{ number_format($packageType->price, 2) }})
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



                    <div class="mt-4 col-lg-12">
                        <button type="submit" id="publishBtn" class="theme-btn-one">
                            <i class="fas fa-check"></i>
                            <span>@lang('messages.Publish Your Ad')</span>
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
    let subCatId = urlParams.get('sub_cat_id');
    let selectedBrandId = "{{ request()->brand }}";
    let selectedModelId = "{{ request()->model }}";

    // Function to Fetch Models dynamically without reloading the page
    function fetchModels(brandId, subCatId) {
        if (brandId && subCatId) {
            $.ajax({
                url: "{{ route('get.models') }}",
                type: "GET",
                data: { brand_id: brandId, sub_cat_id: subCatId },
                success: function(data) {
                    // Clear the model dropdown before appending new options
                    $('#model').html('<option value="">Select Model</option>');
                    if (data.length > 0) {
                        // Dynamically append the models to the dropdown
                        $.each(data, function(key, value) {
                            let selected = selectedModelId == value.id ? "selected" : "";
                            $('#model').append('<option value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                        });
                    } else {
                        $('#model').html('<option value="">No models available</option>');
                    }
                },
                error: function(response) {
                    console.log('Error fetching models:', response);
                }
            });
        }
    }

    $('#brand').change(function() {
        let brandId = $(this).val();
        if (brandId) {
            // Update URL with selected brand_id
            let newUrl = new URL(window.location.href);
            newUrl.searchParams.set('brand', brandId);
            window.history.pushState({}, '', newUrl);

            // Trigger page refresh after URL is updated
            location.reload();
        }
    });

    if (selectedBrandId) {
        fetchModels(selectedBrandId, subCatId);
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

<script>
$(document).ready(function() {
    // Function to display main image preview
    $('#main_image').change(function() {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#main_image_preview').html('<img src="' + e.target.result + '" alt="Main Image" style="max-width: 20%; height: auto; border: 1px solid #ddd; padding: 5px;">');
        }
        reader.readAsDataURL(this.files[0]);
    });
});
</script>
<script>
let allFiles = [];

document.getElementById('sub_images').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('sub_images_preview');
    const newFiles = event.target.files;

    // Add new files to the allFiles array
    for (let i = 0; i < newFiles.length; i++) {
        allFiles.push(newFiles[i]);
    }

    // Clear the preview container
    previewContainer.innerHTML = '';

    // Display all files in the preview container
    allFiles.forEach(file => {
        const reader = new FileReader();

        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.margin = '5px';
            previewContainer.appendChild(img);
        };

        reader.readAsDataURL(file);
    });

    // Debug: Log all files
    console.log('All Files:', allFiles);
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const packageRadios = document.querySelectorAll(".package-radio");
        const packageTypeRadios = document.querySelectorAll(".package-type-radio");

        packageRadios.forEach(radio => {
            radio.addEventListener("change", function () {
                document.getElementById("selected_package_name").value = this.dataset.name;
            });
        });

        packageTypeRadios.forEach(radio => {
            radio.addEventListener("change", function () {
                document.getElementById("selected_package_price").value = this.dataset.price;
                document.getElementById("selected_package_duration").value = this.dataset.duration; // Store package duration
                console.log("Selected Duration:", document.getElementById("selected_package_duration").value);

            });
        });
    });
    </script>



     <script>
        document.addEventListener("DOMContentLoaded", function() {
                // Get the form element
                const form = document.getElementById("adForm");
                
                if (!form) {
                    console.error("Form with ID 'adForm' not found");
                    return;
                }
                
                // Disable HTML5 validation
                form.setAttribute("novalidate", "true");
                
                // Add custom validation on form submit
                form.addEventListener("submit", function(event) {
                    // Always prevent default submission first
                    event.preventDefault();
                    
                    // Clear any previous error messages
                    clearErrors();
                    
                    // Flag to track if there are any validation errors
                    let hasErrors = false;
                    
                    // Get all required inputs
                    const requiredInputs = form.querySelectorAll("input[required], select[required], textarea[required]");
                    
                    // Check each required field
                    requiredInputs.forEach(function(input) {
                        if (!input.value.trim()) {
                            markAsError(input);
                            hasErrors = true;
                        }
                    });
                    
                    // Check required file inputs specifically
                    const fileInputs = form.querySelectorAll("input[type='file'][required]");
                    fileInputs.forEach(function(input) {
                        if (input.files.length === 0) {
                            markAsError(input);
                            hasErrors = true;
                        }
                    });
                    
                    // If no errors, submit the form
                    if (!hasErrors) {
                        form.removeAttribute("novalidate");
                        form.submit();
                    } else {
                        // Scroll to the first error
                        const firstError = document.querySelector(".error-message");
                        if (firstError) {
                            firstError.scrollIntoView({
                                behavior: "smooth",
                                block: "center"
                            });
                            
                            // Focus on the input field associated with the first error
                            const associatedField = firstError.closest('.form-group').querySelector('input, select, textarea');
                            if (associatedField) {
                                associatedField.focus();
                            }
                        }
                    }
                });
                
                // Function to mark field as error with a specific error message
                function markAsError(field) {
                    // Find the field's label text to make the error message specific
                    const formGroup = field.closest(".form-group");
                    if (formGroup) {
                        const label = formGroup.querySelector("label");
                        let fieldName = "This field";
                        
                        if (label) {
                            // Extract field name from the label (without the asterisk)
                            const labelText = label.textContent.trim();
                            fieldName = labelText.replace(/\*/g, '').trim();
                        }
                        
                        // Remove any existing error message
                        const existingError = formGroup.querySelector(".error-message");
                        if (existingError) {
                            existingError.remove();
                        }
                        
                        // Create error container
                        const errorContainer = document.createElement("div");
                        errorContainer.className = "error-message";
                        errorContainer.style.color = "#dc3545";
                        errorContainer.style.fontSize = "14px";
                        errorContainer.style.marginTop = "5px";
                        errorContainer.style.marginBottom = "10px";
                        errorContainer.textContent = fieldName + " is required";
                        
                        // Add error message below the input
                        field.insertAdjacentElement('afterend', errorContainer);
                        
                        // Apply red border to input
                        field.style.border = "2px solid #dc3545";
                    }
                }
                
                // Function to clear all errors
                function clearErrors() {
                    // Remove red borders
                    const errorFields = form.querySelectorAll("input, select, textarea");
                    errorFields.forEach(function(field) {
                        field.style.border = "";
                    });
                    
                    // Remove error messages
                    const errorMessages = form.querySelectorAll(".error-message");
                    errorMessages.forEach(function(message) {
                        message.remove();
                    });
                }
                
                // Add input event listeners to clear errors as user types
                form.querySelectorAll("input, select, textarea").forEach(function(input) {
                    input.addEventListener("input", function() {
                        this.style.border = "";
                        
                        // Remove error message if it exists
                        const nextElement = this.nextElementSibling;
                        if (nextElement && nextElement.classList.contains("error-message")) {
                            nextElement.remove();
                        }
                    });
                });
            });
        </script>








@endsection

