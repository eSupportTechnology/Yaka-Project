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
                                        <a href="#">
                                            <img src="{{ asset('yaka-payment.png') }}" alt="user">
                                        </a>
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
                                <li><a href="">ad post</a></li>
                                <li><a href="">my ads</a></li>
                                <li><a  class="active" href="{{route('user.profile')}}">Profile</a></li>
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

     
<div class="setting-part"  style="margin: 50px 50px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="account-card alert fade show">
                    <div class="account-title">
                        <h3>Edit Profile</h3>
                    </div>

                    @if(isset($message))
                        <div class="alert alert-success" role="alert" style="padding: 12px 12px;margin-bottom: 24px;">
                            {{ $message }}
                        </div>
                    @endif

                
                    <form class="setting-form" method="post" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="userId" value="{{ $user->id }}">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">District</label>
                                <select id="district" name="location" class="form-control custom-select">
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ $user->location == $district->id ? 'selected' : '' }}>
                                            {{ $district->name_en }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">City</label>
                                <select id="cities" name="sublocation" class="form-control custom-select">
                                    <option value="">Select City</option>
                                    @if($user->location)
                                        @foreach(App\Models\Cities::where('district_id', $user->location)->get() as $city)
                                            <option value="{{ $city->id }}" {{ $user->sub_location == $city->id ? 'selected' : '' }}>
                                                {{ $city->name_en }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Birthday</label>
                                <input type="date" class="form-control" name="birthday" value="{{ old('birthday', $user->birthday) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button class="theme-btn-one">
                                <i class="fas fa-user-check"></i>
                                <span>Update Profile</span>
                            </button>
                        </div>
                    </div>
                </form>



                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#district').on('change', function () {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: '{{ route("get.cities") }}',
                    type: "GET",
                    data: { district_id: district_id },
                    dataType: "json",
                    success: function (data) {
                        $('#cities').empty().append('<option value="">Select City</option>');
                        $.each(data, function (key, value) {
                            $('#cities').append('<option value="' + value.id + '">' + value.name_en + '</option>');
                        });
                    },
                    error: function () {
                        console.log("Error fetching cities.");
                    }
                });
            } else {
                $('#cities').empty().append('<option value="">Select City</option>');
            }
        });
    });
</script>

@endsection

