@extends ('newFrontend.master')

@section('content')
    <link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --card-hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            --border-radius: 15px;
        }

        .container {
            max-width: 1200px;
        }

        .ad-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
            background: white;
            height: 100%;
        }

        .ad-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .ad-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--card-hover-shadow);
        }

        .ad-card:hover::before {
            opacity: 1;
        }

        .card-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-title::before {
            content: '✨';
            font-size: 1.2rem;
        }

        .card-text {
            margin-bottom: 0.75rem;
            font-size: 1rem;
            line-height: 1.6;
        }

        .card-text:not(.text-muted) {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .text-muted {
            color: #6c757d !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .text-muted::before {
            content: '•';
            color: var(--primary-gradient);
            font-weight: bold;
        }

        .text-center {
            padding: 4rem 2rem;
            color: #6c757d;
            font-size: 1.2rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin: 2rem 0;
        }

        .text-center::before {
            display: block;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .tab-pane#pending-ads .ad-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
        }

        .tab-pane#pending-ads .ad-card::before {
            background: var(--success-gradient);
        }

        .tab-pane#pending-ads .card-title::before {
            content: '🎯';
        }

        .card-text:last-child {
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-weight: 600;
        }

        @media (min-width: 992px) {
            .col-md-4 {
                flex: 0 0 32%;
                max-width: 32%;
            }
        }

        @media (max-width: 991px) {
            .col-md-4 {
                flex: 0 0 48%;
                max-width: 48%;
            }
        }

        @media (max-width: 576px) {
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    <section class="page-title style-two banner-part"
        style="background-image: url(assets/images/background/page-title.jpg); height:350px">
        <div class="auto-container">
            <div class="mr-0 content-box centred">
                <div class="title">
                    <h1>@lang('messages.membership')</h1>
                </div>
                <ul class="clearfix bread-crumb">
                    <li><a href="{{ route('/') }}">@lang('messages.Home')</a></li>
                    <li>@lang('messages.membership')</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="mb-4 dash-header-part">
        <div class="container">
            <div class="dash-header-card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); min-height:230px; height:auto">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="row">
                    <div class="col-lg-5">
                        <div class="dash-header-left">
                            <div class="dash-avatar">
                                @if (Auth::check() && Auth::user()->profileImage)
                                    <a href="#"><img
                                            src="{{ asset('storage/profile_images/' . Auth::user()->profileImage) }}"
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
                                <li><a href="{{ route('user.dashboard') }}">@lang('messages.Dashboard')</a></li>
                                <li><a class="active" href="{{ route('membership-package') }}">@lang('messages.membership')</a></li>
                                <li><a href="{{ route('user.ad_posts.categories') }}">@lang('messages.ad post')</a></li>
                                <li><a href="{{ route('user.my_ads') }}">@lang('messages.my ads')</a></li>
                                <li><a href="{{ route('user.profile') }}">@lang('messages.Profile')</a></li>
                                <li>
                                    <a href="{{ route('user.logout') }}">@lang('messages.Logout')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-4 dashboard-part">
        <div class="container mb-4">
            <ul class="nav nav-tabs" id="adsTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-ads-tab" data-bs-toggle="tab" href="#active-ads-section"
                        role="tab" aria-controls="active-ads-section" aria-selected="true">@lang('messages.active membership')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pending-ads-tab" data-bs-toggle="tab" href="#pending-ads-section" role="tab"
                        aria-controls="pending-ads-section" aria-selected="false">@lang('messages.my membership')</a>
                </li>
            </ul>

            <div class="mt-3 tab-content" id="adsTabsContent">

                <div class="tab-pane fade show active" id="active-ads-section" role="tabpanel"
                    aria-labelledby="active-ads-tab">

                    <div class="row mt-4 mb-4" id="extra-fields"></div>

                    <div class="row" id="active-ads">
                        <p class="text-center text-muted">Please select a category to view available membership plans.</p>
                    </div>
                    
                    <div class="clearfix inner-content responsive-category" id="category-filter"
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 30px; padding: 8px; justify-items: center;">
                        @foreach ($categories->take(14) as $category)
                            <div class="category-block-one category-box"
                                style="min-width: 150px; flex: 1 1 150px; cursor: pointer; width: 100%; break-inside: avoid;"
                                data-category-id="{{ $category->id }}">

                                <div class="inner-box text-center p-3">
                                    <div class="shape">
                                        <div class="shape-1"
                                            style="background-image: url('{{ asset('newFrontend/Clasifico/assets/images/shape/shape-1.png') }}');">
                                        </div>
                                        <div class="shape-2"
                                            style="background-image: url('{{ asset('newFrontend/Clasifico/assets/images/shape/shape-2.png') }}');">
                                        </div>
                                    </div>

                                    <div class="icon-box">
                                        <img src="{{ asset('images/Category/' . $category->image ?? 'default.png') }}"
                                            alt="{{ $category->name }}"
                                            style="width: 70px; height: 70px; object-fit: contain;">
                                    </div>

                                    <h5
                                        style="min-height: 60px; display: -webkit-box;
                                            -webkit-line-clamp: 2; -webkit-box-orient: vertical;
                                            overflow: hidden; text-overflow: ellipsis; ">
                                        @lang('messages.' . $category->name)
                                    </h5>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="clearfix inner-content responsive-category" id="category-filter"
                        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 30px; padding: 8px; justify-items: center;">
                        @foreach ($categories->take(14) as $category)
                            <div class="category-block-one" style="width: 100%; break-inside: avoid;">


                            </div>
                        @endforeach
                    </div>




                </div>

                <div class="tab-pane fade" id="pending-ads-section" role="tabpanel" aria-labelledby="pending-ads-tab">
                    <div class="row">
                        @forelse($myMemberships as $membership)
                            <div class="mb-4 col-md-4">
                                <div class="card ad-card">
                                    <div class="card-body">
                                        <h5 class="card-title">@lang('messages.valid month'): {{ $membership->valid_month }}</h5>
                                        <p class="card-text">@lang('messages.price'): Rs
                                            {{ number_format($membership->price, 2) }}</p>
                                        <p class="card-text text-muted">@lang('messages.ads per month'):
                                            {{ $membership->ads_per_month }}</p>
                                        <p class="card-text text-muted">@lang('messages.promotion voucher cost'):
                                            {{ $membership->promotion_voucher_cost }}</p>
                                        <p class="card-text text-muted">@lang('messages.start date'):
                                            {{ \Carbon\Carbon::parse($membership->start_date)->format('d M Y') }}</p>
                                        <p class="card-text text-muted">@lang('messages.expiry date'):
                                            {{ \Carbon\Carbon::parse($membership->expiry_date)->format('d M Y') }}</p>
                                        <p class="card-text text-muted">@lang('messages.voucher code'):
                                            {{ $membership->voucher_code }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">📭 You have no purchased memberships.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="membership-benefits-section py-5"
        style="background: linear-gradient(135deg, #690303 0%, #B00505 100%);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card"
                        style="border: none; border-radius: 20px; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1); overflow: hidden;">
                        <div class="card-body p-5">
                            <h3 class="text-center mb-5" style="font-weight: 700; color: #2c3e50; font-size: 2rem;">
                                @lang('messages.benefits of being a loyalty member')
                            </h3>

                            <div class="row align-items-start">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Benefit 1: Own Stall -->
                                    <div class="benefit-item d-flex align-items-center mb-4">
                                        <div class="benefit-number me-3"
                                            style="background: linear-gradient(135deg, #B00505 0%, #B00505 100%); color: white; width: 35px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                            1</div>
                                        <div class="benefit-content flex-grow-1">
                                            <p class="mb-0"
                                                style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; margin-left: 10px;">
                                                @lang('messages.your own stall on yaka.lk')
                                            </p>
                                        </div>
                                        <div class="benefit-icon ms-3" style="flex-shrink: 0;">
                                            <img src="{{ asset('images\benefits\stall.png') }}" alt="Stall"
                                                style="width: 80px; height: 80px; object-fit: contain;">
                                        </div>
                                    </div>

                                    <!-- Benefit 2: Badges -->
                                    <div class="benefit-item d-flex align-items-center mb-4">
                                        <div class="benefit-number me-3"
                                            style="background: linear-gradient(135deg, #B00505 0%, #B00505 100%); color: white; width: 35px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                            2</div>
                                        <div class="benefit-content flex-grow-1">
                                            <p class="mb-0"
                                                style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; margin-left: 10px;">
                                                @lang('messages.badges') <span style="font-weight: 700;">@lang('messages.member')/
                                                    @lang('messages.verified')</span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Badge Icons -->
                                    <div class="d-flex justify-content-around mb-5 px-4">
                                        <div class="badge-display text-center">
                                            <div
                                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #B00505 0%, #ff4b2b 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(255, 65, 108, 0.3); margin: 0 auto 10px;">
                                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M7 22V11M2 13V20C2 21.1046 2.89543 22 4 22H17.4262C18.907 22 20.1662 20.9197 20.3914 19.4562L21.4683 12.4562C21.7479 10.6389 20.3418 9 18.5032 9H15C14.4477 9 14 8.55228 14 8V4.46584C14 3.10399 12.896 2 11.5342 2C11.2093 2 10.915 2.1913 10.7831 2.48812L7.26394 10.4061C7.10344 10.7673 6.74532 11 6.35013 11H4C2.89543 11 2 11.8954 2 13Z"
                                                        stroke="white" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <p class="mb-0 fw-bold" style="color: #2c3e50;">@lang('messages.member')</p>
                                        </div>
                                        <div class="badge-display text-center">
                                            <div
                                                style="width: 80px; height: 80px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 25px rgba(79, 172, 254, 0.3); margin: 0 auto 10px;">
                                                <svg width="50" height="50" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9 12L11 14L15 10M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"
                                                        stroke="white" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <p class="mb-0 fw-bold" style="color: #2c3e50;">@lang('messages.verified')</p>
                                        </div>
                                    </div>

                                    <!-- Benefit 3: Reviews -->
                                    <div class="benefit-item d-flex align-items-center mb-4">
                                        <div class="benefit-number me-3"
                                            style="background: linear-gradient(135deg, #B00505 0%, #B00505 100%); color: white; width: 35px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                            3</div>
                                        <div class="benefit-content flex-grow-1">
                                            <p class="mb-0"
                                                style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; margin-left: 10px;">
                                                @lang('messages.get reviews for your stall')
                                            </p>
                                        </div>
                                        <div class="benefit-icon ms-3" style="flex-shrink: 0;">
                                            <img src="{{ asset('images\benefits\voucher.png') }}" alt="Reviews"
                                                style="width: 80px; height: 80px; object-fit: contain;">
                                        </div>
                                    </div>

                                    <!-- Benefit 4: Promo Codes -->
                                    <div class="benefit-item d-flex align-items-center mb-4">
                                        <div class="benefit-number me-3"
                                            style="background: linear-gradient(135deg, #B00505 0%, #B00505 100%); color: white; width: 35px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                            4</div>
                                        <div class="benefit-content flex-grow-1">
                                            <p class="mb-0"
                                                style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; margin-left: 10px;">
                                                @lang('messages.free promo codes')
                                            </p>
                                        </div>
                                        <div class="benefit-icon ms-3" style="flex-shrink: 0;">
                                            <img src="{{ asset('images\benefits\review.png') }}" alt="Promo"
                                                style="width: 80px; height: 80px; object-fit: contain;">
                                        </div>
                                    </div>

                                    <!-- Benefit 5: Location -->
                                    <div class="benefit-item d-flex align-items-center mb-4">
                                        <div class="benefit-number me-3"
                                            style="background: linear-gradient(135deg, #B00505 0%, #B00505 100%); color: white; width: 35px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                            5</div>
                                        <div class="benefit-content flex-grow-1">
                                            <p class="mb-0"
                                                style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; margin-left: 10px;">
                                                @lang('messages.add your shop location')
                                            </p>
                                        </div>
                                        <div class="benefit-icon ms-3" style="flex-shrink: 0;">
                                            <svg width="60" height="60" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z"
                                                    fill="#e74c3c" />
                                                <path
                                                    d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2Z"
                                                    stroke="#e74c3c" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Benefit 6: Statistics -->
                                    <div class="benefit-item d-flex align-items-center mb-4">
                                        <div class="benefit-number me-3"
                                            style="background: linear-gradient(135deg, #B00505 0%, #B00505 100%); color: white; width: 35px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                            6</div>
                                        <div class="benefit-content flex-grow-1">
                                            <p class="mb-0"
                                                style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; margin-left: 10px;">
                                                @lang('messages.you can see statistics')
                                            </p>
                                        </div>
                                        <div class="benefit-icon ms-3" style="flex-shrink: 0;">
                                            <img src="{{ asset('images\benefits\statics.png') }}" alt="Statistics"
                                                style="width: 80px; height: 80px; object-fit: contain;">
                                        </div>
                                    </div>

                                    <!-- Benefit 7: Customer Support -->
                                    <div class="benefit-item d-flex align-items-center mb-4">
                                        <div class="benefit-number me-3"
                                            style="background: linear-gradient(135deg, #B00505 0%, #B00505 100%); color: white; width: 35px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0;">
                                            7</div>
                                        <div class="benefit-content flex-grow-1">
                                            <p class="mb-0"
                                                style="color: #2c3e50; font-size: 1.1rem; font-weight: 500; margin-left: 10px;">
                                                @lang('messages.customer support')
                                            </p>
                                        </div>
                                        <div class="benefit-icon ms-3" style="flex-shrink: 0;">
                                            <img src="{{ asset('images\benefits\customer-care.png') }}" alt="Support"
                                                style="width: 80px; height: 80px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Call to Action -->
                            <div class="text-center mt-5">
                                <a href="#active-ads-section" class="theme-btn-one"
                                    style="color: white; border: none;
                                    border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 10px 30px
                                    rgba(102, 126, 234, 0.4); transition: all 0.3s ease;"
                                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 35px rgba(102, 126, 234, 0.5)'"
                                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 30px rgba(102, 126, 234, 0.4)'">
                                    @lang('messages.become a member now')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.category-box').on('click', function() {
            let categoryId = $(this).data('category-id');
            $('.category-box').removeClass('border-primary');
            $(this).addClass('border-primary');

            $.ajax({
                url: "{{ route('membership.byCategory', '') }}/" + categoryId,
                type: "GET",
                success: function(response) {
                    let html = '';
                    let extraFields = '';

                    if (response.length > 0) {
                        // Add extra fields for business info
                        extraFields = `
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-dark">@lang('messages.business name')</label>
                                <input type="text" id="business_name" class="form-control" placeholder="Enter business name" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-dark">@lang('messages.email')</label>
                                <input type="email" id="business_email" class="form-control" placeholder="Enter email" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold text-dark">@lang('messages.phone number')</label>
                                <input type="text" id="business_phone" class="form-control" placeholder="Enter phone number" required>
                            </div>
                        `;

                        // Display memberships
                        response.forEach(function(package) {
                            html += `
                                <div class="mb-4 col-md-4">
                                    <div class="card ad-card">
                                        <div class="card-body">
                                            <h5 class="card-title">${package.month_count} @lang('messages.month')</h5>
                                            <p class="card-text">@lang('messages.price'): Rs ${parseFloat(package.price).toFixed(2)}</p>
                                            <p class="card-text text-muted">@lang('messages.ads per month'): ${package.ads_per_month}</p>
                                            <p class="card-text text-muted">@lang('messages.promotion voucher cost'): ${package.promotion_voucher_cost}</p>
                                            <p class="card-text text-muted">@lang('messages.valid month'): ${package.valid_month}</p>

                                            <form action="{{ route('membership.payment.init') }}" method="POST" class="membership-form">
                                                @csrf
                                                <input type="hidden" name="price" value="${package.price}">
                                                <input type="hidden" name="promotion_voucher_cost" value="${package.promotion_voucher_cost}">
                                                <input type="hidden" name="ads_per_month" value="${package.ads_per_month}">
                                                <input type="hidden" name="valid_month" value="${package.valid_month}">
                                                <input type="hidden" name="business_name">
                                                <input type="hidden" name="business_email">
                                                <input type="hidden" name="business_phone">
                                                <button type="submit" class="theme-btn-one purchase-btn">@lang('messages.purchase now')</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>`;
                        });
                    } else {
                        html = '<p class="text-center">📭 No membership plan available for this category.</p>';
                    }

                    $('#active-ads').html(html);
                    $('#extra-fields').html(extraFields);
                },
                error: function() {
                    alert('Failed to load membership plans.');
                }
            });
        });

        // Validate business fields before submitting purchase
        $(document).on('submit', '.membership-form', function(e) {
            let name = $('#business_name').val();
            let email = $('#business_email').val();
            let phone = $('#business_phone').val();

            if (!name || !email || !phone) {
                e.preventDefault();
                alert('⚠️ Please fill in Business Name, Email, and Phone Number before purchasing.');
                return false;
            }

            // Pass values to hidden inputs before submit
            $(this).find('input[name="business_name"]').val(name);
            $(this).find('input[name="business_email"]').val(email);
            $(this).find('input[name="business_phone"]').val(phone);
        });
    });
</script>

@endsection
