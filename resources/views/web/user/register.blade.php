<!DOCTYPE html>
<html lang="en">
<head>
    <!--=====================================
                META-TAG PART START
    =======================================-->
    <!-- REQUIRE META -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- AUTHOR META -->
    <meta name="author" content="Mironcoder">
    <meta name="email" content="mironcoder@gmail.com">
    <meta name="profile" content="https://themeforest.net/user/mironcoder">

    <!-- TEMPLATE META -->
    <meta name="name" content="Classicads">
    <meta name="type" content="Classified Advertising">
    <meta name="title" content="Classicads - Classified Ads HTML Template">
    <meta name="keywords" content="classicads, classified, ads, classified ads, listing, business, directory, jobs, marketing, portal, advertising, local, posting, ad listing, ad posting,">
    <!--=====================================
                META-TAG PART END
    =======================================-->

    <!-- FOR WEBPAGE TITLE -->
    <title>Classicads - User Form</title>

    <!--=====================================
                CSS LINK PART START
    =======================================-->
    <!-- FOR PAGE TITLE ICON -->
    <link rel="icon" href="{{asset('web/images/favicon.png')}}">

    <!-- FOR FONTAWESOME -->
    <link rel="stylesheet" href="{{asset('web/fonts/font-awesome/fontawesome.css')}}">

    <!-- FOR BOOTSTRAP -->
    <link rel="stylesheet" href="{{asset('web/css/vendor/bootstrap.min.css')}}">

    <!-- FOR COMMON STYLE -->
    <link rel="stylesheet" href="{{asset('web/css/custom/main.css')}}">

    <!-- FOR USER FORM PAGE STYLE -->
    <link rel="stylesheet" href="{{asset('web/css/custom/user-form.css')}}">
    <!--=====================================
                CSS LINK PART END
    =======================================-->
</head>
<body>
<!--=====================================
            USER-FORM PART START
=======================================-->
<section class="user-form-part">
    <div class="user-form-banner">
        <div class="user-form-content">
            <a href="#"><img src="{{asset('Logo-re.png')}}" alt="logo"></a>
            <h1>Advertise your assets <span>Buy what you want</span></h1>
            <p>Biggest online marketplace in Sri Lanka</p> 
        </div>
    </div>

    <div class="user-form-category">
        <div class="user-form-header">
            <a href="#"><img src="{{asset('yaka-payment.png')}}" alt="logo"></a>
            <a href="/"><i class="fas fa-arrow-left"></i></a>
        </div>
        <div class="user-form-category-btn">
            <ul class="nav nav-tabs">
                <li><a href="#login-tab" class="nav-link active" data-toggle="tab">sign up</a></li>
            </ul>
        </div>



        <div class="tab-pane active" id="register-tab">
            <div class="user-form-title">
                <h2>Register</h2>
                <p>Setup a new account in a minute.</p>
            </div>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
            {{-- <ul class="user-form-option">
                <li>
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                        <span>facebook</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                        <span>twitter</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fab fa-google"></i>
                        <span>google</span>
                    </a>
                </li>
            </ul> --}}
            {{-- <div class="user-form-devider">
                <p>or</p>
            </div> --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text"  name="first_name" class="form-control" value="{{old('first_name')}}" placeholder="First Name">
                            @if ($errors->has('first_name'))
                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="last_name"  class="form-control" value="{{old('last_name')}}" placeholder="Last Name">
                            @if ($errors->has('last_name'))
                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <input type="text"  name="phone_number" class="form-control" value="{{old('phone_number')}}" placeholder="Phone number">
                            <small class="form-alert">Please follow this example - 01XXXXXXXXX</small>
                            @if ($errors->has('phone_number'))
                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <input type="password"  name="password" autocomplete="new-password"   class="form-control" placeholder="Password">
                            <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                            <small class="form-alert">Password must be 8 characters</small>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <input type="password"  class="form-control" name="password_confirmation" placeholder="Repeat Password">
                            <button class="form-icon"><i class="eye fas fa-eye"></i></button>
                            <small class="form-alert">Password must be 8 characters</small>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>
{{--                    <div class="col-12">--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="custom-control custom-checkbox">--}}
{{--                                <input type="checkbox" class="custom-control-input" id="signup-check">--}}
{{--                                <label class="custom-control-label" for="signup-check">I agree to the all <a href="#">terms & consitions</a> of bebostha.</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-inline">
                                <i class="fas fa-user-check"></i>
                                <span>Create new account</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="user-form-direction">
                <p>Already have an account? click on the <span>( <a href="{{route('login')}}">sign in</a> )</span> button above.</p>
            </div>
        </div>
    </div>
</section>
<!--=====================================
            USER-FORM PART END
=======================================-->


<!--=====================================
            JS LINK PART START
=======================================-->
<!-- FOR BOOTSTRAP -->
<script src="{{asset('web/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('web/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('web/js/vendor/bootstrap.min.js')}}"></script>

<!-- FOR INTERACTION -->
<script src="{{asset('web/js/custom/main.js')}}"></script>
<!--=====================================
            JS LINK PART END
=======================================-->
</body>
</html>






