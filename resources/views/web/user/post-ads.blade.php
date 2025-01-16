@extends('web.user.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="dash-menu-list">
            <ul>
                <li><a  href="{{route('user.dashboard')}}">dashboard</a></li>
                <li><a  class="active" href="{{route('user.dashboard.ad-post.main')}}">ad post</a></li>
                <li><a  href="{{route('user.dashboard.my-ads',['all'])}}">my ads</a></li>
                <li><a href="{{route('user.dashboard.setting',[Session::get('user')['url']])}}">Profile</a></li>
                <li><a href="/chatify">message</a></li>
                <li><a href="{{route('logout')}}">logout</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
</section>
    <form class="adpost-form" method="post"   action="{{route('user.dashboard.ad-post.post')}}" enctype="multipart/form-data">
    <section class="adpost-part" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                        @csrf
                        @if(isset($subcategoryurl))
                                @php
                                    $catUrl = \App\Models\Category::where('url',$subcategoryurl)->with('cat')->first();

                                @endphp
                                @if($catUrl->cat[0]->url != "jobs")
                                    @include('web.components.AdsForms.'.$catUrl->cat[0]->url.'.'.$subcategoryurl)
                                @else
                                    @include('web.components.AdsForms.'.$catUrl->cat[0]->url.'.'.$catUrl->cat[0]->url)
                                @endif
                        @endif
                        <div class="adpost-card">
                            <div class="adpost-title">
                                <h3>Location Information</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" id="button">Districts</label>
                                        <select id="location" name="location" onchange="selecterror('district')" class="form-control custom-select">
                                            <option value="0">Select Districts</option>
                                            @foreach($districts as $district)
                                                <option @if(old('location')== $district->id) selected  @endif value="{{$district->id}}">{{$district->name_en}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('location'))
                                            <div class="alert alert-danger" id="district" >
                                                {{ $errors->first('location') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" id="button">Cities</label>
                                        <select id="cities" onchange="selecterror('city')" name="sublocation" class="form-control custom-select">
                                            <option value="0">Select Cities</option>
                                        </select>
                                        @if ($errors->has('sublocation'))
                                            <div class="alert alert-danger" id="city" >
                                                {{ $errors->first('sublocation') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
    
                            </div>
                        </div>
                        <div class="adpost-card">
                            <div class="adpost-title">
                                <h3>Boosting Option </h3>
                            </div>
                            <ul class="adpost-plan-list">
                                <li style="display: block ;">
                                    <div style="margin-bottom: 20px;display: flex;align-items: center">
                                        <h4>Free Ad</h4>
                                        <div class="adpost-plan-meta" style="display: flex;justify-content: space-around;width: 180px;">
                                            <input type="radio" name="plan_id" checked value="0" id="">
                                        </div>
                                    </div>
                                </li>
                                @foreach($plans as $plan)
                                <li style="display: block ;@if($plan->id==5) display: none @endif">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div style="margin-bottom: 20px;display: flex;align-items: center">
                                                <h4> {{$plan->name}} {{$plan->id}}</h4>
                                            </div>
                                            @foreach($plan->packageTypes as $packageType)
                                                <div style="display: flex;align-items: center;margin-left: 10px;margin-bottom: 15px;">
                                                    <div  class="adpost-plan-content">
                                                        <h6 style="margin: 0">{{$packageType->name}}   <span></span></h6>
                                                    </div>
                                                    <div class="adpost-plan-meta" style="display: flex;justify-content: space-around;width: 180px;">
                                                        <h5 style="margin-right: 10px">(LKR {{$packageType->price}})</h5>
                                                        <input type="radio" name="plan_id" value="{{$packageType->id}}" id="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-7">


                                            @php
                                                switch ($plan->id) {
                                                    case '3':
                                                        echo '
                                                        <ul>
                                                            <li>
                                                                <p>At every page there are 4 top slots available for top ads</p>
                                                            </li>
                                                            <li>
                                                                <p>If you apply for top ads, you can see your ad will appear on top of those
slots, you can get even more response than free ads </p>
                                                            </li>
                                                            <li>
                                                                <p> Top ads bigger than free ads & border blinking in green color also
highlighted symbol</p>
                                                            </li>
                                                        </ul>';
                                                        break;

                                                    case '4':
                                                        echo '
                                                        <ul>
                                                            <li>
                                                                <p> We have some special promotion for sell urgently</p>
                                                            </li>
                                                            <li>
                                                                <p>Urgent ads border blink in bright RED color also urgent badge which is great
advantage to get more attention quickly. </p>
                                                            </li>
                                                          
                                                        </ul>';
                                                        break;


                                                        case '6':
                                                        echo '
                                                        <ul>
                                                            <li>
                                                                <p>Super adds specially designed to get immediate attention from buyers as
soon as log into adds listing page. </p>
                                                            </li>
                                                            <li>
                                                                <p>Super adds has given premium slot of top of the adds listing with highlighted
blue blinking border around and rocket symbol, which attract buyers as soon
as add promoted to super add.  </p>
                                                            </li>
                                                            <li>
                                                                <p>Super adds also visible as a free add is an extra advantage.</p>
                                                            </li>
                                                          
                                                        </ul>';
                                                        break;
                                                }
                                            @endphp



                                           
                                        </div>
                                    </div>
    
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <input type="hidden" name="catId" value="{{$catId}}">
                        <input type="hidden" name="subcatId" value="{{$subcatId}}">
                        <input type="hidden" name="userId" value="{{Session::get('user')['id']}}">

                            <div class="form-group text-right">
                                <button class="btn btn-inline">
                                    <i class="fas fa-check-circle"></i>
                                    <span>published your ad</span>
                                </button>
                            </div>
                </div>
                {{-- <div class="col-lg-4">
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Author Information</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" id="button">Districts</label>
                                    <select id="location" name="location" onchange="selecterror('district')" class="form-control custom-select">
                                        <option value="0">Select Districts</option>
                                        @foreach($districts as $district)
                                            <option @if(old('location')== $district->id) selected  @endif value="{{$district->id}}">{{$district->name_en}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('location'))
                                        <div class="alert alert-danger" id="district" >
                                            {{ $errors->first('location') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" id="button">Cities</label>
                                    <select id="cities" onchange="selecterror('city')" name="sublocation" class="form-control custom-select">
                                        <option value="0">Select Cities</option>
                                    </select>
                                    @if ($errors->has('sublocation'))
                                        <div class="alert alert-danger" id="city" >
                                            {{ $errors->first('sublocation') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="adpost-card">
                        <div class="adpost-title">
                            <h3>Plan Information</h3>
                        </div>
                        <ul class="adpost-plan-list">
                            <li style="display: block ;">
                                <div style="margin-bottom: 20px;display: flex;align-items: center">
                                    <h4>Free Ad</h4>
                                    <div class="adpost-plan-meta" style="display: flex;justify-content: space-around;width: 180px;">
                                        <input type="radio" name="plan_id" checked value="0" id="">
                                    </div>
                                </div>
                            </li>
                            @foreach($plans as $plan)
                            <li style="display: block ;@if($plan->id==5) display: none @endif">
                                <div style="margin-bottom: 20px;display: flex;align-items: center">
                                    <h4> {{$plan->name}}</h4>
                                </div>
                                @foreach($plan->packageTypes as $packageType)
                                    <div style="display: flex;align-items: center;margin-left: 10px;margin-bottom: 15px;">
                                        <div  class="adpost-plan-content">
                                            <h6 style="margin: 0">{{$packageType->name}}   <span></span></h6>
                                        </div>
                                        <div class="adpost-plan-meta" style="display: flex;justify-content: space-around;width: 180px;">
                                            <h5 style="margin-right: 10px">(LKR {{$packageType->price}})</h5>
                                            <input type="radio" name="plan_id" value="{{$packageType->id}}" id="">
                                        </div>
                                    </div>
                                @endforeach

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    </form>

    <script>
        $(document).ready(function(){
            $("#brand").change(function() {
                var brandValue = $(this).val();
                if (brandValue) { // Check if brandValue is not null or undefined
                    console.log(brandValue);

                    $.ajax({
                        url: '{{url('/branmodel')}}',
                        method: 'GET',
                        data: {
                            brandId: brandValue
                        },
                        success: function(response) {
                            var select = $('#model');
                            select.empty();
                            response.forEach(function(item) {
                                // Create a new option element
                                var option = $('<option></option>');

                                // Set the value and text content of the option to the current item
                                option.attr('value', item.id);
                                option.text(item.name);

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
                                var option = $('<option></option>');

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

    <script>
        function preview(frameId) {
            var frame = document.getElementById(frameId);
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
        function clearImage(inputId, frameId) {
            document.getElementById(inputId).value = null;
            document.getElementById(frameId).src = "";
        }
    </script>
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

@endsection

