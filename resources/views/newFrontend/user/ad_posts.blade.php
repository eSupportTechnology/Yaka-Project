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
            <div class="content-box centred mr-0">
                <div class="title">
                    <h1>@lang('messages.Dashboard')</h1>
                </div>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                    <li>@lang('messages.Dashboard')</li>
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
                                <li><a href="{{route('user.dashboard')}}">@lang('messages.Dashboard')</a></li>
                                <li><a  class="active" href="{{route('user.ad_posts.categories')}}">@lang('messages.ad post')</a></li>
                                <li><a href="{{route('user.my_ads')}}" >@lang('messages.my ads')</a></li>
                                <li><a href="{{route('user.profile')}}">@lang('messages.Profile')</a></li>
                                <li><a href="">@lang('messages.message')</a></li>
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
            <div class="account-card alert fade show p-4" style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

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

                    <div class="row">
                     <!-- category Information -->
                     <div class="col-lg-12 mb-3">
                        <div class="section-box">
                            <div class="d-flex flex-wrap gap-3">
                               <!-- Brand -->
                                <div class="col-lg-6 mb-3">
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
                                <div class="col-lg-6 mb-3">
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

                    <!-- Product Details -->
                    <div class="col-lg-12 mb-3">
                    <div class="section-box">
                            <h4><strong>@lang('messages.Product Description')</h4>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>@lang('messages.Title')<i class="text-danger">*</i></strong></label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>@lang('messages.Price')<i class="text-danger">*</i></strong></label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>@lang('messages.Description') <i class="text-danger">*</i></strong></label>
                                <textarea name="description" class="form-control" rows="4" required></textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>@lang('messages.Upload Main Image') <i class="text-danger">*</i></strong></label>
                                <input type="file" name="main_image" class="form-control" id="main_image" required>
                                <div id="main_image_preview" style="margin-top: 10px;"></div> <!-- Preview section for main image -->
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label class="form-label text-dark"><strong>@lang('messages.Upload Sub Image') <i class="text-danger">*</i></strong></label>
                                <small class=" text-muted">Simply select all images at once.</small>
                                <input type="file" name="sub_images[]" class="form-control" id="sub_images" multiple>
                                <div id="sub_images_preview" style="margin-top: 10px;"></div>
                            </div>
                        </div>

                        </div>
                        </div>

                     <!-- category Information -->
                     <div class="col-lg-12 mb-3">
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

                    <div class="col-lg-12 mb-3">
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
                <div class="col-lg-12 mb-3">
                    <div class="section-box">
                        <h4>@lang('messages.Pricing Type')</h4>
                        <div class="d-flex flex-wrap align-items-center">
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
                        <div class="col-lg-12 mb-3">
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

                        <div class="col-lg-12 mb-3">
                            <div class="section-box">
                                <h4>@lang('messages.Boosting Option')<i class="text-danger">*</i></h4>

                                <!-- Top Ads, Super Ads, Urgent Ads Section -->
                                <div class="row mt-4">
                                    <!-- Top Ads Box -->
                                    <div class="col-md-4 mb-3">
                                        <div class="box p-3 border border-success rounded equal-height">
                                            <h5 class="text-success">@lang('messages.Top Ads')</h5>
                                            <p class="text-muted">@lang('messages.TopAds description')</p>
                                        </div>
                                    </div>

                                    <!-- Super Ads Box -->
                                    <div class="col-md-4 mb-3">
                                        <div class="box p-3 border border-primary rounded equal-height">
                                            <h5 class="text-primary">@lang('messages.Super Ads')</h5>
                                            <p class="text-muted">@lang('messages.SuperAds description')</p>
                                        </div>
                                    </div>

                                    <!-- Urgent Ads Box -->
                                    <div class="col-md-4 mb-3">
                                        <div class="box p-3 border border-danger rounded equal-height">
                                            <h5 class="text-danger">@lang('messages.Urgent Ads')</h5>
                                            <p class="text-muted">@lang('messages.UrgentAds description')</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Package and Package Type Selection Section -->
                                <div class="row mt-4">
                                    <!-- Package Selection Column -->
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <h5 class="mb-2">@lang('messages.Select a Package'):</h5>

                                            <!-- Free Ad Option -->
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="radio" name="boosting_option" id="package_free" value="0" checked>
                                                <label class="form-check-label text-dark" for="package_free">
                                                    <h5>@lang('messages.Free Ad')</h5>
                                                </label>
                                            </div>

                                            @foreach($packages as $package)
                                                <div class="form-check mt-2">
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
                                                        <div class="form-check mt-2">
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



                    <div class="col-lg-12 mt-4">
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








@endsection

