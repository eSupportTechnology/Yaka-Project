@extends ('newFrontend.master')

@section('content')
<link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">
<style>
    /* Add these styles to ensure consistent card sizing */
.ad-card {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.ad-card .card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-img-top {
    object-fit: cover;
    height: 200px;
}

.card {
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 100%;
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
                                <li><a href="{{route('user.ad_posts.categories')}}">@lang('messages.ad post')</a></li>
                                <li><a  class="active" href="{{route('user.my_ads')}}" >@lang('messages.my ads')</a></li>
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

    <section class="dashboard-part mt-4">
    <div class="container mb-4">
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="adsTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="active-ads-tab" data-bs-toggle="tab" href="#active-ads" role="tab" aria-controls="active-ads" aria-selected="true">@lang('messages.Active Ads')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pending-ads-tab" data-bs-toggle="tab" href="#pending-ads" role="tab" aria-controls="pending-ads" aria-selected="false">@lang('messages.Pending Ads')</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3" id="adsTabsContent">
            <!-- Active Ads Tab -->
            <div class="tab-pane fade show active" id="active-ads" role="tabpanel" aria-labelledby="active-ads-tab">
                <div class="row">
                    @forelse($activeAds as $ad)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}">
                                <div class="card ad-card">
                                    <img src="{{ storage_public_url($ad->mainImage) }}" class="card-img-top" alt="Ad Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $ad->title }}</h5>
                                        <p class="card-text">@lang('messages.price'): @lang('messages.Rs') {{ number_format($ad->price, 2) }}</p>
                                        <p class="card-text text-muted">@lang('messages.Location'):
                                            @php
                                                $locale = App::getLocale();
                                                $locationName = 'name_' . $locale;
                                            @endphp
                                                {{ $ad->main_location ? $ad->main_location->$locationName : 'N/A' }} </p>
                                                <p class="card-text text-muted">
                                                    @lang('messages.Posted on') : {{ \Carbon\Carbon::parse($ad->created_at)->translatedFormat('d M Y g:i a') }}
                                                </p>

                                                <!-- Package Expire Date -->
                                                <p class="card-text text-muted">
                                                    @if(is_null($ad->package_expire_at))
                                                        @lang('messages.No Expire Date')
                                                    @else
                                                        @if(\Carbon\Carbon::now()->greaterThan($ad->package_expire_at))
                                                            <span class="text-danger">@lang('messages.Expired')</span>
                                                        @else
                                                            @lang('messages.Expires on') {{ \Carbon\Carbon::parse($ad->package_expire_at)->translatedFormat('d M Y') }}
                                                        @endif
                                                    @endif
                                                </p>

                                        <!-- Delete Button -->
                                        <form action="{{ route('ads.delete', ['adsId' => $ad->adsId]) }}" method="POST" class="d-inline mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ad?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-center">No active ads found.</p>
                    @endforelse
                </div>
            </div>

            <!-- Pending Ads Tab -->
            <div class="tab-pane fade" id="pending-ads" role="tabpanel" aria-labelledby="pending-ads-tab">
                <div class="row">
                    @forelse($pendingAds as $ad)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}">
                                <div class="card ad-card">
                                    <img src="{{ storage_public_url($ad->mainImage) }}" class="card-img-top" alt="Ad Image">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $ad->title }}</h5>
                                        <p class="card-text">@lang('messages.price'): @lang('messages.Rs') {{ number_format($ad->price, 2) }}</p>
                                        <p class="card-text text-muted">@lang('messages.Location'):
                                        @php
                                                $locale = App::getLocale();
                                                $locationName = 'name_' . $locale;
                                            @endphp
                                                {{ $ad->main_location ? $ad->main_location->$locationName : 'N/A' }} </p>
                                                <p class="card-text text-muted">
                                                    @lang('messages.Posted on') : {{ \Carbon\Carbon::parse($ad->created_at)->translatedFormat('d M Y g:i a') }}
                                                </p>

                                                <!-- Package Expire Date -->
                                                <p class="card-text text-muted">
                                                    @if(is_null($ad->package_expire_at))
                                                        @lang('messages.No Expire Date')
                                                    @else
                                                        @if(\Carbon\Carbon::now()->greaterThan($ad->package_expire_at))
                                                            <span class="text-danger">@lang('messages.Expired')</span>
                                                        @else
                                                            @lang('messages.Expires on') {{ \Carbon\Carbon::parse($ad->package_expire_at)->translatedFormat('d M Y') }}
                                                        @endif
                                                    @endif
                                                </p>

                                        <!-- Delete Button -->
                                        <form action="{{ route('ads.delete', ['adsId' => $ad->adsId]) }}" method="POST" class="d-inline mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ad?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <p class="text-center">No pending ads found.</p>
                    @endforelse
                </div>
            </div>
        </div>


    </div>
</section>




@endsection
