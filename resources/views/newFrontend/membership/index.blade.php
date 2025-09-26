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
        /* Add these styles to ensure consistent card sizing */
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

        /* Price Highlighting */
        .card-text:contains("price") {
            background: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin: 1rem 0;
            font-weight: 700;
            color: #2d3436;
            text-align: center;
        }

        /* Empty State Styling */
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
            content: '📭';
            display: block;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* Membership Card Specific Styling */
        .tab-pane#pending-ads .ad-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
        }

        .tab-pane#pending-ads .ad-card::before {
            background: var(--success-gradient);
        }

        .tab-pane#pending-ads .card-title::before {
            content: '🎯';
        }

        /* Voucher Code Styling */
        .card-text:last-child {
            background: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            font-weight: 600;
            border-left: 4px solid #667eea;
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
    <!-- End Page Title -->

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
                                {{-- <li><a href="">@lang('messages.message')</a></li> --}}
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
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="adsTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="active-ads-tab" data-bs-toggle="tab" href="#active-ads" role="tab"
                        aria-controls="active-ads" aria-selected="true">@lang('messages.active membership')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pending-ads-tab" data-bs-toggle="tab" href="#pending-ads" role="tab"
                        aria-controls="pending-ads" aria-selected="false">@lang('messages.my membership')</a>
                </li>
            </ul>

            <!-- Tabs Content -->
            <div class="mt-3 tab-content" id="adsTabsContent">
                <!-- Active Ads Tab -->
                <div class="tab-pane fade show active" id="active-ads" role="tabpanel" aria-labelledby="active-ads-tab">
                    <div class="row">
                        @forelse($packages as $package)
                            <div class="mb-4 col-md-4">
                                <div class="card ad-card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $package->month_count }} @lang('messages.month')</h5>
                                        <p class="card-text">@lang('messages.price'): @lang('messages.Rs')
                                            {{ number_format($package->price, 2) }}</p>
                                        <p class="card-text text-muted">@lang('messages.ads per month'):
                                            {{ $package->ads_per_month }}</p>
                                        <p class="card-text text-muted">@lang('messages.promotion voucher cost'):
                                            {{ $package->promotion_voucher_cost }}</p>
                                        <p class="card-text text-muted">@lang('messages.valid month'): {{ $package->valid_month }}
                                        </p>

                                        <!-- Purchase form -->
                                        <form action="{{ route('membership.payment.init') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="price" value="{{ $package->price }}">
                                            <input type="hidden" name="promotion_voucher_cost"
                                                value="{{ $package->promotion_voucher_cost }}">
                                            <input type="hidden" name="ads_per_month"
                                                value="{{ $package->ads_per_month }}">
                                            <input type="hidden" name="valid_month" value="{{ $package->valid_month }}">
                                            <button type="submit" class="theme-btn-one">@lang('messages.purchase now')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center">No active ads found.</p>
                        @endforelse
                    </div>

                </div>

                <!-- Pending Ads Tab -->
                <div class="tab-pane fade" id="pending-ads" role="tabpanel" aria-labelledby="pending-ads-tab">
                    <div class="row">
                        @forelse($myMemberships as $membership)
                            <div class="mb-4 col-md-4">
                                <div class="card ad-card">
                                    <div class="card-body">
                                        <h5 class="card-title">@lang('messages.valid month'): {{ $membership->valid_month }}</h5>
                                        <p class="card-text">@lang('messages.price'): @lang('messages.Rs')
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
                            <p class="text-center">You have no purchased memberships.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
