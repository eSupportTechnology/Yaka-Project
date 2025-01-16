@extends('web.user.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="dash-menu-list">
            <ul>
                <li><a  href="{{route('user.dashboard')}}">dashboard</a></li>
                <li><a   href="{{route('user.dashboard.ad-post.main')}}">ad post</a></li>
                <li><a href="{{route('user.dashboard.my-ads',['all'])}}">my ads</a></li>
                <li><a class="active"  href="{{route('user.dashboard.setting',[Session::get('user')['url']])}}">Profile</a></li>
                <li><a href="/chatify">message</a></li>
                <li><a href="{{route('logout')}}">logout</a></li>
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

                    <form class="setting-form" method="post" action="{{route('user.dashboard.setting.update',[Session::get('user')['url']])}}"  enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="userId" value="{{Session::get('user')['id']}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" onfocus="noneerror('first_name')" value="{{Session::get('user')['first_name'] ?? ''}} "  name="first_name">
                                    @if ($errors->has('first_name'))
                                        <div class="alert alert-danger" id="first_name" >
                                            {{ $errors->first('first_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" onfocus="noneerror('last_name')" value="{{Session::get('user')['last_name'] ?? ''}}" name="last_name" >
                                    @if ($errors->has('last_name'))
                                        <div class="alert alert-danger" id="last_name" >
                                            {{ $errors->first('last_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" value="{{Session::get('user')['company'] ?? ''}}" name="company">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" onfocus="noneerror('email')" value="{{Session::get('user')['email'] ?? ''}}" name="email">
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger" id="email" >
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Districts</label>
                                    <select id="location" name="location" onchange="selecterror('district')" class="form-control custom-select">
                                        <option value="0">Select Districts</option>
                                        @foreach($districts as $district)
                                            <option @if(Session::get('user')['location']== $district->id) selected  @endif value="{{$district->id}}">{{$district->name_en}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('location'))
                                        <div class="alert alert-danger" id="district" >
                                            {{ $errors->first('location') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Cities</label>
                                    <select id="cities" onchange="selecterror('city')" name="sublocation" class="form-control custom-select">

                                        @if(Session::get('user')['sub_location'] == "")
                                            <option value="0">Select Cities</option>
                                        @else
                                            @foreach($cities as $city)
                                                @if($city->id == Session::get('user')['sub_location'])
                                                    <option value="{{$city->id}}" selected>{{$city->name_en}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('sublocation'))
                                        <div class="alert alert-danger" id="city" >
                                            {{ $errors->first('sublocation') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Post Code</label>
                                    <input type="text" class="form-control" value="{{Session::get('user')['postCode'] ?? ''}}" name="postCode">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" value="Sri Lanka" readonly name="country">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" value="{{Session::get('user')['website'] ?? ''}}" name="website">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" onfocus="noneerror('phone_number')" value="{{Session::get('user')['phone_number'] ?? ''}}" name="phone_number">
                                    @if ($errors->has('phone_number'))
                                        <div class="alert alert-danger" id="phone_number" >
                                            {{ $errors->first('phone_number') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Birthday</label>
                                    <input type="date" class="form-control" value="{{Session::get('user')['birthday'] ?? ''}}" name="birthday">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-inline">
                                    <i class="fas fa-user-check"></i>
                                    <span>update profile</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function noneerror(field) {
        document.getElementById(field).style.display = "none";
    }
    function cnoneerror(field) {
        document.getElementById(field).style.display = "none";
    }
    function selecterror(field) {
        document.getElementById(field).style.display = "none";
    }
</script>
<script>
    $(document).ready(function(){
        $("#location").change(function() {
            var dataValue = $(this).val();
            if (dataValue) { // Check if brandValue is not null or undefined
                console.log(dataValue);

                $.ajax({
                    url: '{{url('/getsublocation')}}',
                    method: 'GET',
                    data: {
                        location: dataValue
                    },
                    success: function(response) {
                        console.log(response)
                        var select = $('#cities');
                        select.empty();
                        response.forEach(function(item) {
                            // Create a new option element
                            var option = $('<option ></option >');

                            // Set the value and text content of the option to the current item
                            option.attr('value', item.id);
                            option.text(item.name_en);

                            // Get the select element where you want to append the option

                            // Append the option to the select element
                            select.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.error("Brand value is null or undefined.");
            }
        });
    });
</script>

@endsection

