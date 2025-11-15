@extends ('newFrontend.master')

@section('content')
    <link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">
    <style>
        .section-box {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            background: #f9f9f9;
            /* Light grey background */
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

        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>

    <style>
        .ai-generator-section {
            background: linear-gradient(to bottom, rgb(102, 17, 17), rgb(171, 18, 18), rgb(253, 6, 6));
            border-radius: 6px;
            padding: 12px;
            margin-bottom: 8px;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .ai-generator-section h6 {
            margin-bottom: 10px;
            font-weight: 600;
            color: white;
        }

        .generate-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 14px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .generate-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

        .generate-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .ai-loading {
            display: none;
            color: white;
            font-size: 12px;
            margin-top: 5px;
        }

        .language-selector {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 4px;
            padding: 4px 8px;
            font-size: 11px;
            min-width: 80px;
        }

        .language-selector option {
            background: #333;
            color: white;
        }
    </style>

    @php
        $cat_id = request()->get('cat_id');
        $sub_cat_id = request()->get('sub_cat_id');
    @endphp

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="setting-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-4 account-card alert fade show"
                        style="border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">

                        @if (isset($message))
                            <div class="alert alert-success" role="alert" style="padding: 12px 12px;margin-bottom: 24px;">
                                {{ $message }}
                            </div>
                        @endif

                        @php
        $cat_id = request()->get('cat_id');
    @endphp

                        <form id="adForm" action="{{ route('ads.update', $adsId) }}?cat_id={{ $cat_id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="userId" value="">
                            <input type="hidden" id="selected_package_name" name="selected_package_name">
                            <input type="hidden" id="selected_package_price" name="selected_package_price">
                            <input type="hidden" id="selected_package_duration" name="selected_package_duration">



                            @if ($ad->cat_id != 103)
                                <div class="row">
                                    <!-- category Information -->
                                    <div class="mb-3 col-lg-12">
                                        <div class="section-box">
                                            <div class="flex-wrap gap-3 d-flex">

                                                <!-- Brand -->
                                                <div class="mb-3 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label text-dark">
                                                            <strong>@lang('messages.Brand')</strong>
                                                        </label>
                                                        <select id="brand" name="brand"
                                                            class="form-control custom-select">
                                                            <option value="">@lang('messages.Brand')</option>
                                                            @foreach ($brands as $brand)
                                                                <option value="{{ $brand->id }}"
                                                                    {{ $ad->brand == $brand->id ? 'selected' : '' }}>
                                                                    {{ $brand->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Model -->
                                                <div class="mb-3 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label text-dark">
                                                            <strong>@lang('messages.Model')</strong>
                                                        </label>
                                                        <input type="text" id="model" name="model"
                                                            class="form-control" value="{{ old('model', $ad->model) }}">
                                                    </div>
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
                                            @if (request()->cat_id == 103)
                                                @lang('messages.Job Description')
                                            @else
                                                @lang('messages.Product Description')
                                            @endif
                                        </strong>
                                    </h4>
                                    <div class="mb-3 col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label text-dark"><strong>@lang('messages.Title')<i
                                                        class="text-danger">*</i></strong></label>
                                            <input type="text" name="title" value="{{ old('title', $ad->title) }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="flex-wrap gap-3 d-flex">
                                        <!-- Brand -->
                                        <div class="mb-3 col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>
                                                        @if (request()->cat_id == 103)
                                                            @lang('messages.Salary')
                                                        @else
                                                            @lang('messages.Price')
                                                        @endif
                                                        <i class="text-danger">*</i>
                                                    </strong>
                                                </label>
                                                <input type="number" name="price" value="{{ old('price', $ad->price) }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-lg-12">
                                            <div class="row">
                                                <div class="mb-3 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label text-dark"><strong>@lang('messages.Contact')<i
                                                                    class="text-danger">*</i></strong></label>
                                                        <input type="tel" name="mobile1" class="form-control"
                                                            pattern="[0-9]{10}" value="{{ old('mobile1', $ad->mobile1) }}"
                                                            placeholder="Enter 10-digit mobile number">
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="form-label text-dark"><strong>@lang('messages.Contact')<i
                                                                    class="text-danger">*</i></strong></label>
                                                        <input type="tel" name="mobile2" class="form-control"
                                                            pattern="[0-9]{10}" value="{{ old('mobile2', $ad->mobile2) }}"
                                                            placeholder="Enter 10-digit mobile number">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <div class="mb-3 col-lg-12">
                                        <div class="form-group">
                                            <label class="form-label text-dark"><strong>@lang('messages.Description') <i
                                                        class="text-danger">*</i></strong></label>

                                            <div class="ai-generator-section" id="aiGeneratorSection"
                                                style="display: none; position: relative; margin-bottom: 10px;">
                                                <div
                                                    style="display: flex; justify-content: space-between; align-items: center;">
                                                    <div>
                                                        <h6 style="margin-bottom: 5px;"><i class="fas fa-magic"></i>
                                                            AI
                                                            Description Generator</h6>
                                                        <p
                                                            style="font-size: 11px; margin-bottom: 0; opacity: 0.9; color: white">
                                                            Generate professional description automatically
                                                        </p>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <select class="language-selector" id="languageSelect"
                                                            style="margin-right: 10px;">
                                                            <option value="english">English</option>
                                                            <option value="sinhala">සිංහල</option>
                                                        </select>
                                                        <button type="button" class="generate-btn" id="generateDescBtn">
                                                            <i class="fas fa-robot"></i> Generate
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="ai-loading" id="aiLoading">
                                                    <i class="fas fa-spinner fa-spin"></i> Generating description...
                                                </div>
                                            </div>

                                            <textarea id="ad_description" name="description" class="form-control" rows="4" required>{{ old('description', $ad->description) }}</textarea>
                                        </div>
                                    </div>

                                    @if (request()->cat_id == 103)
                                        <!-- Required Work Experience -->
                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Required Work Experience (years)')</strong>
                                                </label>
                                                <input type="number" name="experience_years"
                                                    value="{{ old('experience_years', $ad->experience_years) }}"
                                                    class="form-control" min="0" placeholder="0">
                                            </div>
                                        </div>

                                        <!-- Required Education -->
                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Required Education')</strong>
                                                </label>
                                                <select name="education" class="form-control">
                                                    <option value="">@lang('messages.Select Education')</option>
                                                    @foreach (['Ordinary Level', 'Advanced Level', 'Certificate', 'Diploma', 'Higher Diploma', 'Degree', 'Masters', 'Doctorate', 'Skilled Apprentice'] as $edu)
                                                        <option value="{{ $edu }}"
                                                            @if ($ad->education == $edu) selected @endif>
                                                            {{ $edu }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Application Deadline -->
                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Application Deadline') (@lang('messages.Optional'))</strong>
                                                </label>
                                                <input type="date" name="application_deadline" class="form-control"
                                                    value="{{ old('application_deadline', $ad->application_deadline) }}">
                                            </div>
                                        </div>

                                        <!-- Mobile Number -->
                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Mobile Number') <i class="text-danger">*</i></strong>
                                                </label>
                                                <input type="tel" name="mobile_number"
                                                    value="{{ old('mobile_number', $ad->mobile_number) }}"
                                                    class="form-control" required pattern="[0-9]{10}"
                                                    placeholder="Enter 10-digit mobile number">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="mb-3 col-lg-12">
                                        <!-- Main Image -->
                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>
                                                        @if ($ad->cat_id == 103)
                                                            @lang('messages.Logo')
                                                        @else
                                                            @lang('messages.Upload Main Image')
                                                        @endif
                                                        <i class="text-danger">*</i>
                                                    </strong>
                                                </label>

                                                <input type="file" name="main_image" class="form-control"
                                                    id="main_image">

                                                <!-- Live preview for new selection -->
                                                <div id="main_image_preview" style="margin-top:10px;"></div>

                                                <!-- Existing main image -->
                                                @if ($ad->mainImage)
                                                    <div style="margin-top:10px;" id="existing_main_image">
                                                        <p class="text-muted mb-1">Current Image:</p>
                                                        <img src="{{ asset('storage/' . $ad->mainImage) }}"
                                                            alt="Current image" width="120" class="rounded shadow-sm">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Sub Images -->
                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>
                                                        @if ($ad->cat_id == 103)
                                                            @lang('messages.Description Image')
                                                        @else
                                                            @lang('messages.Upload Sub Image')
                                                        @endif
                                                    </strong>
                                                </label>
                                                <input type="file" name="sub_images[]" class="form-control"
                                                    id="sub_images" multiple>

                                                <!-- Live preview -->
                                                <div id="sub_images_preview" style="margin-top:10px;"></div>

                                                <!-- Existing sub images -->
                                                @if ($ad->subImage)
                                                    <div style="margin-top:10px;" id="existing_sub_images">
                                                        <p class="text-muted mb-1">Current Images:</p>
                                                        @foreach (json_decode($ad->subImage, true) as $subImg)
                                                            <img src="{{ asset('storage/' . $subImg) }}" alt="Sub image"
                                                                width="100" style="margin-right:5px;"
                                                                class="rounded shadow-sm">
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                @if (request()->cat_id == 20)
                                        <!-- Required Work Experience -->
                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Address')</strong>
                                                </label>
                                                <input type="text" name="address" class="form-control" value="{{ old('address', $ad->address) }}"
                                                     placeholder="Enter address">
                                            </div>
                                        </div>

                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Bed Room')</strong>
                                                </label>
                                                <input type="number" name="bed_room" class="form-control" value="{{ old('bed_room', $ad->bed_room) }}"
                                                    min="0" placeholder="0">
                                            </div>
                                        </div>

                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Bath Room')</strong>
                                                </label>
                                                <input type="number" name="bath_room" class="form-control" value="{{ old('bath_room', $ad->bath_room) }}"
                                                    min="0" placeholder="0">
                                            </div>
                                        </div>

                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.House Size (sqft)')</strong>
                                                </label>
                                                <input type="text" name="house_size" class="form-control" value="{{ old('house_size', $ad->house_size) }}"
                                                    min="0" placeholder="0 sqft">
                                            </div>
                                        </div>

                                        <div class="mb-3 col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label text-dark">
                                                    <strong>@lang('messages.Land Size (purches)')</strong>
                                                </label>
                                                <input type="text" name="land_size" class="form-control" value="{{ old('land_size', $ad->land_size) }}"
                                                    min="0" placeholder="0 purches">
                                            </div>
                                        </div>
                                    @endif

                                @if (request()->cat_id != 103)
                                    <!-- category Information -->
                                    <div class="mb-3 col-lg-12">
                                        <div class="section-box">
                                            <label class="form-label text-dark"><strong>@lang('messages.Condition')</strong></label>
                                            <div class="d-flex">
                                                @foreach (['New', 'Used'] as $option)
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="condition"
                                                            value="{{ $option }}"
                                                            {{ old('condition', $ad->condition ?? '') == $option ? 'checked' : '' }}>
                                                        <label class="form-check-label" style="margin-right:15px">
                                                            @lang('messages.' . $option)
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-lg-12">
                                        <div class="section-box">
                                            <label class="form-label text-dark"><strong>Additional
                                                    Information</strong></label>

                                            @php
                                                // Decode existing custom field data from the ad
                                                $customFields = json_decode($ad->custom_fields ?? '{}', true);
                                            @endphp

                                            @foreach ($formFields as $field)
                                                @php
                                                    $fieldName = 'field_' . $field->id;
                                                    $existingValue = old($fieldName, $customFields[$fieldName] ?? '');
                                                @endphp

                                                <div class="form-group mb-2">
                                                    <label
                                                        for="field_{{ $field->id }}">{{ $field->field_name }}</label>

                                                    @switch($field->field_type)
                                                        @case('text')
                                                            <input type="text" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                        @break

                                                        @case('number')
                                                            <input type="number" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                        @break

                                                        @case('email')
                                                            <input type="email" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                        @break

                                                        @case('textarea')
                                                            <textarea id="field_{{ $field->id }}" name="{{ $fieldName }}" class="form-control">{{ $existingValue }}</textarea>
                                                        @break

                                                        @case('dropdown')
                                                            <select id="field_{{ $field->id }}" name="{{ $fieldName }}"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                @foreach (explode(',', $field->options ?? '') as $option)
                                                                    <option value="{{ trim($option) }}"
                                                                        {{ $existingValue == trim($option) ? 'selected' : '' }}>
                                                                        {{ trim($option) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @break

                                                        @case('checkbox')
                                                            @foreach (explode(',', $field->options ?? '') as $option)
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        id="field_{{ $field->id }}_{{ $loop->index }}"
                                                                        name="{{ $fieldName }}[]" class="form-check-input"
                                                                        value="{{ trim($option) }}"
                                                                        {{ in_array(trim($option), (array) $existingValue) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="field_{{ $field->id }}_{{ $loop->index }}">
                                                                        {{ trim($option) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        @break

                                                        @case('radio')
                                                            @foreach (explode(',', $field->options ?? '') as $option)
                                                                <div class="form-check form-check-inline">
                                                                    <input type="radio"
                                                                        id="field_{{ $field->id }}_{{ $loop->index }}"
                                                                        name="{{ $fieldName }}" class="form-check-input"
                                                                        value="{{ trim($option) }}"
                                                                        {{ $existingValue == trim($option) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="field_{{ $field->id }}_{{ $loop->index }}">
                                                                        {{ trim($option) }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        @break

                                                        @case('tel')
                                                            <input type="tel" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                        @break

                                                        @case('date')
                                                            <input type="date" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                        @break

                                                        @case('time')
                                                            <input type="time" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                        @break

                                                        @case('month')
                                                            <input type="month" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                        @break

                                                        @default
                                                            <input type="text" id="field_{{ $field->id }}"
                                                                name="{{ $fieldName }}" class="form-control"
                                                                value="{{ $existingValue }}">
                                                    @endswitch
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Pricing Type -->
                                    <div class="mb-3 col-lg-12">
                                        <div class="section-box">
                                            <h4>@lang('messages.Pricing Type')</h4>
                                            <div class="flex-wrap d-flex align-items-center">
                                                @foreach (['Fixed', 'Negotiable', 'Daily', 'Weekly', 'Monthly', 'Yearly'] as $option)
                                                    <div class="form-check me-4">
                                                        <input class="form-check-input" type="radio" name="price_type"
                                                            value="{{ $option }}"
                                                            {{ old('price_type', $ad->price_type ?? '') == $option ? 'checked' : '' }}>
                                                        <label class="form-check-label" style="margin-right:15px">
                                                            @lang('messages.' . $option)
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Post Type -->
                                    <div class="mb-3 col-lg-12">
                                        <div class="section-box">
                                            <label class="form-label text-dark">
                                                <strong>@lang('messages.Post Type')</strong>
                                            </label>
                                            <div class="d-flex">
                                                @foreach (['Booking', 'Sale', 'Rent'] as $option)
                                                    <div class="form-check me-3">
                                                        <input class="form-check-input" type="radio" name="post_type"
                                                            value="{{ $option }}"
                                                            {{ old('post_type', $ad->post_type ?? '') == $option ? 'checked' : '' }}>
                                                        <label class="form-check-label" style="margin-right:15px">
                                                            @lang('messages.' . $option)
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif


                                @if (Auth::check() && Auth::user()->roles == 'staff')
                                    <div class="mb-3 col-lg-12">
                                        <div class="section-box">
                                            <h4>@lang('messages.Boosting Option')<i class="text-danger">*</i></h4>

                                            <!-- Top Ads, Super Ads, Urgent Ads Section -->
                                            <div class="mt-4 row">
                                                <div class="mb-3 col-md-4">
                                                    <div class="p-3 border rounded box border-success equal-height">
                                                        <h5 class="text-success">@lang('messages.Top Ads')</h5>
                                                        <p class="text-muted">@lang('messages.TopAds description')</p>
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-4">
                                                    <div class="p-3 border rounded box border-primary equal-height">
                                                        <h5 class="text-primary">@lang('messages.Super Ads')</h5>
                                                        <p class="text-muted">@lang('messages.SuperAds description')</p>
                                                    </div>
                                                </div>

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

                                                        <!-- Free Ad Option (Always visible) -->
                                                        <div class="mt-2 form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="boosting_option" id="package_free" value="0"
                                                                {{ old('boosting_option', $ad->boosting_option ?? 0) == 0 ? 'checked' : '' }}>
                                                            <label class="form-check-label text-dark" for="package_free">
                                                                <h5>@lang('messages.Free Ad')</h5>
                                                            </label>
                                                        </div>

                                                        @foreach ($packages as $package)
                                                            <div class="mt-2 form-check">
                                                                <input class="form-check-input package-radio"
                                                                    type="radio" name="boosting_option"
                                                                    id="package_{{ $package->id }}"
                                                                    value="{{ $package->id }}"
                                                                    data-name="{{ $package->name }}"
                                                                    {{ old('boosting_option', $ad->boosting_option ?? '') == $package->id ? 'checked' : '' }}>
                                                                <label class="form-check-label text-dark"
                                                                    for="package_{{ $package->id }}">
                                                                    <h5>@lang('messages.' . $package->name)</h5>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <!-- Package Type Selection Column -->
                                                <div class="col-md-4">
                                                    <div id="package-types"
                                                        class="{{ old('boosting_option', $ad->boosting_option ?? 0) ? '' : 'd-none' }}">
                                                        <h4>@lang('messages.Select Package Type')</h4>
                                                        @foreach ($packages as $package)
                                                            <div
                                                                class="package-types-for-{{ $package->id }} {{ old('boosting_option', $ad->boosting_option ?? 0) == $package->id ? '' : 'd-none' }}">
                                                                @foreach ($package->packageTypes as $packageType)
                                                                    <div class="mt-2 form-check">
                                                                        <input class="form-check-input package-type-radio"
                                                                            type="radio" name="package_type"
                                                                            id="packageType_{{ $packageType->id }}"
                                                                            value="{{ $packageType->id }}"
                                                                            data-price="{{ $packageType->price }}"
                                                                            data-duration="{{ $packageType->duration }}"
                                                                            {{ old('package_type', $ad->package_type ?? '') == $packageType->id ? 'checked' : '' }}>
                                                                        <label class="form-check-label text-dark"
                                                                            for="packageType_{{ $packageType->id }}">
                                                                            {{ $packageType->duration }}
                                                                            (@lang('messages.Rs')
                                                                            {{ number_format($packageType->price, 2) }})
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
                                @endif


                                @if (Auth::check() && Auth::user()->roles == 'staff')
                                    <div class="mt-2 form-check {{ old('boosting_option', $ad->boosting_option ?? 0) == 0 ? '' : 'd-none' }}"
                                        id="free-ad-option">
                                        <input class="form-check-input" type="radio" name="boosting_option"
                                            id="package_free" value="0"
                                            {{ old('boosting_option', $ad->boosting_option ?? 0) == 0 ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark" for="package_free">
                                            <h5>@lang('messages.Free Ad')</h5>
                                        </label>
                                    </div>
                                @endif

                                <div class="mt-4 col-lg-12">
                                    <button type="submit" id="publishBtn" class="theme-btn-one">
                                        <i class="fas fa-check"></i>
                                        <span>@lang('messages.Update Your Ad')</span>
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
                        data: {
                            brand_id: brandId,
                            sub_cat_id: subCatId
                        },
                        success: function(data) {
                            // Clear the model dropdown before appending new options
                            $('#model').html('<option value="">Select Model</option>');
                            if (data.length > 0) {
                                // Dynamically append the models to the dropdown
                                $.each(data, function(key, value) {
                                    let selected = selectedModelId == value.id ? "selected" :
                                        "";
                                    $('#model').append('<option value="' + value.id + '" ' +
                                        selected + '>' + value.name + '</option>');
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
                document.querySelector('.package-types-for-' + selectedPackageId).classList.remove(
                    'd-none');
                document.getElementById('package-types').classList.remove('d-none');
            });
        });
    </script>

    <script>
        // Preview main image
        document.getElementById('main_image').addEventListener('change', function(event) {
            const preview = document.getElementById('main_image_preview');
            preview.innerHTML = ''; // clear previous
            const file = event.target.files[0];
            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.width = 120;
                img.classList.add('rounded', 'shadow-sm');
                preview.appendChild(img);
            }
        });

        // Preview multiple sub images
        document.getElementById('sub_images').addEventListener('change', function(event) {
            const preview = document.getElementById('sub_images_preview');
            preview.innerHTML = ''; // clear previous
            const files = event.target.files;
            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.width = 100;
                    img.classList.add('rounded', 'shadow-sm');
                    img.style.marginRight = '5px';
                    preview.appendChild(img);
                });
            }
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const packageRadios = document.querySelectorAll(".package-radio");
            const packageTypeRadios = document.querySelectorAll(".package-type-radio");

            packageRadios.forEach(radio => {
                radio.addEventListener("change", function() {
                    document.getElementById("selected_package_name").value = this.dataset.name;
                });
            });

            packageTypeRadios.forEach(radio => {
                radio.addEventListener("change", function() {
                    document.getElementById("selected_package_price").value = this.dataset.price;
                    document.getElementById("selected_package_duration").value = this.dataset
                        .duration;
                    console.log("Selected Duration:", document.getElementById(
                        "selected_package_duration").value);
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
                const requiredInputs = form.querySelectorAll(
                    "input[required], select[required], textarea[required]");

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
                        const associatedField = firstError.closest('.form-group').querySelector(
                            'input, select, textarea');
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


    <script>
        $(document).ready(function() {
            let editorInstance = null;

            // Global flag to prevent multiple initializations
            window.ckEditorInitialized = window.ckEditorInitialized || false;

            // Function to completely destroy any existing CKEditor instances
            function destroyAllEditors() {
                // Destroy any existing instances on the element
                const element = document.querySelector('#ad_description');
                if (element && element.ckeditorInstance) {
                    element.ckeditorInstance.destroy();
                    element.ckeditorInstance = null;
                }

                // Clear global instance
                if (editorInstance) {
                    editorInstance.destroy();
                    editorInstance = null;
                }

                window.ckEditorInitialized = false;
            }

            // Function to initialize CKEditor (only once)
            function initializeCKEditor() {
                // Check if already initialized
                if (window.ckEditorInitialized || editorInstance) {
                    console.log('CKEditor already initialized, skipping...');
                    return Promise.resolve();
                }

                const textareaElement = document.querySelector('#ad_description');
                if (!textareaElement) {
                    console.error('Textarea with ID "ad_description" not found');
                    return Promise.reject('Element not found');
                }

                // Check if CKEditor is already attached to this element
                if (textareaElement.ckeditorInstance) {
                    console.log('CKEditor already attached to this element');
                    editorInstance = textareaElement.ckeditorInstance;
                    return Promise.resolve();
                }

                // Mark as initializing
                window.ckEditorInitialized = true;

                return ClassicEditor
                    .create(textareaElement, {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'underline', 'strikethrough', '|',
                                'link', 'bulletedList', 'numberedList', '|',
                                'insertTable', 'mediaEmbed', 'blockQuote', '|',
                                'undo', 'redo', 'codeBlock', 'alignment'
                            ]
                        },
                        table: {
                            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                        },
                        mediaEmbed: {
                            previewsInData: true
                        },
                    })
                    .then(editor => {
                        editorInstance = editor;
                        textareaElement.ckeditorInstance = editor;
                        console.log('CKEditor initialized successfully');

                        // Add real-time data synchronization for form validation
                        editor.model.document.on('change:data', () => {
                            const data = editor.getData();
                            textareaElement.value = data;

                            // Update validation state immediately
                            if (data.trim()) {
                                textareaElement.setCustomValidity('');
                            } else {
                                textareaElement.setCustomValidity('Description is required');
                            }

                            // Trigger input event to notify other listeners
                            textareaElement.dispatchEvent(new Event('input', {
                                bubbles: true
                            }));
                        });

                        // Initialize with current content if any
                        const initialData = editor.getData();
                        textareaElement.value = initialData;
                        if (!initialData.trim()) {
                            textareaElement.setCustomValidity('Description is required');
                        }

                        // Hide the original textarea but keep it accessible for validation
                        $(textareaElement).css({
                            'position': 'absolute',
                            'left': '-9999px',
                            'top': '-9999px',
                            'width': '1px',
                            'height': '1px',
                            'opacity': '0',
                            'pointer-events': 'none',
                            'tab-index': '-1'
                        });

                        // Handle focus events for validation highlighting
                        textareaElement.addEventListener('focus', () => {
                            if (editor && editor.editing && editor.editing.view) {
                                editor.editing.view.focus();
                            }
                        });

                        // Handle invalid events to focus on CKEditor
                        textareaElement.addEventListener('invalid', (e) => {
                            e.preventDefault();
                            if (editor && editor.editing && editor.editing.view) {
                                editor.editing.view.focus();

                                // Show custom validation message
                                showNotification('Please fill in the description field.', 'error');
                            }
                        });

                        return editor;
                    })
                    .catch(error => {
                        console.error('CKEditor initialization error:', error);
                        window.ckEditorInitialized = false;
                        throw error;
                    });
            }

            // Enhanced form submission handler to ensure data synchronization
            $('form').on('submit', function(e) {
                if (editorInstance) {
                    const editorData = editorInstance.getData();
                    const textareaElement = document.querySelector('#ad_description');

                    // Synchronize data
                    textareaElement.value = editorData;

                    // Validate manually before allowing submission
                    if (!editorData.trim()) {
                        e.preventDefault();
                        textareaElement.setCustomValidity('Description is required');
                        textareaElement.reportValidity();

                        // Focus on CKEditor
                        if (editorInstance.editing && editorInstance.editing.view) {
                            editorInstance.editing.view.focus();
                        }

                        showNotification('Please fill in the description field.', 'error');
                        return false;
                    } else {
                        textareaElement.setCustomValidity('');
                    }
                }
            });

            // Destroy any existing editors first, then initialize
            destroyAllEditors();

            // Wait a moment then initialize
            setTimeout(() => {
                initializeCKEditor();
            }, 100);

            // Show/hide AI generator based on brand and model selection
            function toggleAIGenerator() {
                const brandValue = $('#brand').val();
                const modelValue = $('#model').val() || $('input[name="model"]').val();
                const aiSection = $('#aiGeneratorSection');

                if (brandValue && modelValue && modelValue.trim() !== '') {
                    aiSection.show();
                } else {
                    aiSection.hide();
                }
            }

            // Monitor brand and model changes
            $('#brand').on('change', function() {
                setTimeout(toggleAIGenerator, 500);
            });

            $(document).on('change input', '#model, input[name="model"]', toggleAIGenerator);

            // AI Description Generation
            $(document).on('click', '#generateDescBtn', function() {
                const brandText = $('#brand option:selected').text();
                const modelValue = $('#model').val() || $('input[name="model"]').val();
                const language = $('#languageSelect').val() || 'English';

                if (!brandText || brandText === 'Brand' || !modelValue) {
                    alert('Please select both brand and model before generating description.');
                    return;
                }

                const $btn = $(this);
                $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Generating...');
                $('#aiLoading').show();

                $.ajax({
                    url: window.generateDescriptionRoute || '/generate-description',
                    method: 'POST',
                    data: {
                        brand: brandText,
                        model: modelValue,
                        language: language,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    timeout: 30000,
                    success: function(response) {
                        if (response && response.description) {
                            let generatedText = '';

                            if (response.description.parts && response.description.parts[0]) {
                                generatedText = response.description.parts[0].text;
                            } else if (typeof response.description === 'string') {
                                generatedText = response.description;
                            } else {
                                generatedText = JSON.stringify(response.description);
                            }

                            // Ensure editor is ready before setting data
                            if (editorInstance) {
                                editorInstance.setData(generatedText);
                            } else {
                                // Fallback to textarea
                                $('#ad_description').val(generatedText);
                            }

                            showNotification('Description generated successfully!', 'success');
                        } else {
                            showNotification(
                                'Failed to generate description. Invalid response format.',
                                'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error generating description:', error);
                        let errorMessage = 'Failed to generate description. ';

                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage += xhr.responseJSON.error;
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage += xhr.responseJSON.message;
                        } else if (status === 'timeout') {
                            errorMessage += 'Request timed out. Please try again.';
                        } else {
                            errorMessage +=
                                'Please check your internet connection and try again.';
                        }

                        showNotification(errorMessage, 'error');
                    },
                    complete: function() {
                        $btn.prop('disabled', false).html(
                            '<i class="fas fa-magic"></i> Generate Description');
                        $('#aiLoading').hide();
                    }
                });
            });

            function showNotification(message, type) {
                $('.ai-notification').remove();

                const notification = $(`
            <div class="ai-notification alert alert-${type === 'success' ? 'success' : 'danger'}" style="
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 300px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                border-radius: 4px;
                padding: 15px;
            ">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}" style="margin-right: 8px;"></i>
                ${message}
                <button type="button" class="btn-close" style="float: right; background: none; border: none; font-size: 18px; cursor: pointer;">&times;</button>
            </div>
        `);

                $('body').append(notification);

                // Close button functionality
                notification.find('.btn-close').on('click', function() {
                    notification.remove();
                });

                setTimeout(() => {
                    notification.fadeOut(300, function() {
                        $(this).remove();
                    });
                }, 5000);
            }

            // Form submission handler
            $('form').on('submit', function() {
                if (editorInstance) {
                    const editorData = editorInstance.getData();
                    $('#ad_description').val(editorData);
                }
            });

            // Initial toggle check
            setTimeout(toggleAIGenerator, 1000);

            // Cleanup on page unload
            $(window).on('beforeunload', function() {
                destroyAllEditors();
            });
        });

        // Additional safety check - prevent multiple script executions
        if (!window.ckEditorScriptLoaded) {
            window.ckEditorScriptLoaded = true;
            console.log('CKEditor script loaded');
        } else {
            console.log('CKEditor script already loaded, preventing duplicate execution');
        }
    </script>

@endsection
