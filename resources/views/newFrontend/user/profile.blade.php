@extends ('newFrontend.master')

@section('content')
<style>
    .custom-select{
        border: 1px solid  !important; /* Use !important to override framework styles */
        border-radius: 6px;
        //padding: 8px 12px;
        font-size: 16px;
        color: var(--gray);
        background: var(--white);
        border-color: var(--primary);
        appearance: none;         /* Hides default arrow in some browsers */
        -webkit-appearance: none; /* Safari/Chrome */
        -moz-appearance: none;    /* Firefox */
    }

  </style>
<link href="{{ asset('newFrontend/Clasifico/assets/css/userdashboard.css') }}" rel="stylesheet">

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
                                            <a href="#"><img src="{{ url('storage/profile_images/' . Auth::user()->profileImage) }}"
                                            alt="user"></a>
                                        @else
                                            <a href="#"><img src="{{ url('web/images/user.png') }}" alt="user"></a>
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
                                <li><a href="{{route('user.my_ads')}}" >@lang('messages.my ads')</a></li>
                                <li><a  class="active" href="{{route('user.profile')}}">@lang('messages.Profile')</a></li>
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
                    <div class="account-title">
                        <h3>@lang('messages.Edit Profile')</h3>
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

                    <div class="mt-4 row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">@lang('messages.First Name')</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">@lang('messages.Last Name')</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-label">@lang('messages.Email')</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">@lang('messages.Company')</label>
                                    <input type="text" class="form-control" value="{{ old('company', $user->company) }}" name="company">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('messages.District')</label>
                                    <select id="district" name="location" class="form-control custom-select"  >
                                        <option value="" >@lang('messages.Select District')</option>
                                        @foreach($districts as $district)
                                            @php
                                                $locale = App::getLocale();
                                                $districtName = 'name_' . $locale;
                                            @endphp
                                            <option value="{{ $district->id }}"
                                                {{ (old('location', $user->location ?? '') == $district->id) ? 'selected' : '' }}>
                                                {{ $district->$districtName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        <div class="col-lg-6">
                            <div class="form-group" >
                                <label class="form-label">@lang('messages.City')</label>
                                <select id="cities" name="sublocation" class="form-control custom-select"  >
                                    <option value="" >@lang('messages.Select City')</option>
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
                        <div class="mt-4 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('messages.Post Code')</label>
                                    <input type="text" class="form-control" value="{{ old('postCode', $user->postCode) }}" name="postCode">
                                </div>
                            </div>
                            <div class="mt-4 col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('messages.Country')</label>
                                    <input type="text" class="form-control" value="Sri Lanka" readonly name="country">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">@lang('messages.Website')</label>
                                    <input type="text" class="form-control" value="{{ old('website', $user->website) }}" name="website">
                                </div>
                            </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">@lang('messages.Phone')</label>
                                <input type="text" class="form-control" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">@lang('messages.Birthday')</label>
                                <input type="date" class="form-control" name="birthday" value="{{ old('birthday', $user->birthday) }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">@lang('messages.Profile Image')</label>
                                <input type="file" class="form-control" name="profileImage" accept="image/*" style="padding: 4px">
                            </div>
                            @if($user->profileImage)
                            <img src="{{ asset('storage/profile_images/' . $user->profileImage) }}" alt="Profile Image" class="img-fluid" width="100">
                            @endif
                        </div>

                        <div class="col-lg-12" style="padding-top: 5px">
                            <button class="theme-btn-one">
                                <i class="fas fa-user-check"></i>
                                <span>@lang('messages.Update Profile')</span>
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




<!-- Nice Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

<script>
  $(document).ready(function () {
    // Initialize nice-select on page load
    $('select').niceSelect();

    $('#district').on('change', function () {
        var district_id = $(this).val();
        if (district_id) {
            $.ajax({
                url: '{{ route("get.cities") }}',
                type: "GET",
                data: { district_id: district_id },
                dataType: "json",
                success: function (data) {
                    console.log(data);

                    // Clear and add new options
                    $('#cities').empty().append('<option value="">Select City</option>');
                    $.each(data, function (key, value) {
                        $('#cities').append('<option value="' + value.id + '">' + value.name_en + '</option>');
                    });

                    // Rebuild Nice Select Dropdown
                    $('#cities').niceSelect('update');
                },
                error: function () {
                    console.log("Error fetching cities.");
                }
            });
        } else {
            $('#cities').empty().append('<option value="">Select City</option>');
            $('#cities').niceSelect('update'); // Reset dropdown
        }
    });

    // ✅ Fix: Update only the City dropdown UI
    $('#cities').on('change', function () {
        var selectedText = $('#cities option:selected').text();
        $('#cities').next('.nice-select').find('.current').text(selectedText);
    });
});


</script>

@endsection
