@extends ('newFrontend.master')

@section('content')
<link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">

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
                                <li><a href="{{route('user.ad_posts')}}">ad post</a></li>
                                <li><a  class="active" href="{{route('user.my_ads')}}" >my ads</a></li>
                                <li><a href="{{route('user.profile')}}">Profile</a></li>
                                <li><a href="">message</a></li>
                                <li>
                                    <a href="{{route('logout')}}" onclick="return confirm('Are you sure you want to logout?');">Logout</a>
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
                <a class="nav-link active" id="active-ads-tab" data-bs-toggle="tab" href="#active-ads" role="tab" aria-controls="active-ads" aria-selected="true">Active Ads</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pending-ads-tab" data-bs-toggle="tab" href="#pending-ads" role="tab" aria-controls="pending-ads" aria-selected="false">Pending Ads</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3" id="adsTabsContent">
            <!-- Active Ads Tab -->
            <div class="tab-pane fade show active" id="active-ads" role="tabpanel" aria-labelledby="active-ads-tab">
                <div class="row">
                    @forelse($activeAds as $ad)
                        <div class="col-md-6">
                            <div class="card">
                                <img src="{{ asset('images/Ads/' . $ad->mainImage) }}" class="card-img-top" alt="Ad Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $ad->title }}</h5>
                                    <p class="card-text">Price: Rs {{ number_format($ad->price, 2) }}</p>
                                    <p class="card-text text-muted">Location: {{ $ad->location }}</p>
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
                    @forelse($pendingAds as $ad)
                        <div class="col-md-6">
                            <div class="card">
                                <img src="{{ asset('images/Ads/' . $ad->mainImage) }}" class="card-img-top" alt="Ad Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $ad->title }}</h5>
                                    <p class="card-text">Price: Rs {{ number_format($ad->price, 2) }}</p>
                                    <p class="card-text text-muted">Location: {{ $ad->location }}</p>
                                </div>
                            </div>
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
