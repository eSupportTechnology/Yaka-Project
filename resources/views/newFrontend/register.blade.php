<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Yaka</title>

<!-- Fav Icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="{{ asset('newFrontend/Clasifico/assets/css/font-awesome-all.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/flaticon.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/owl.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/nice-select.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/color.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('newFrontend/Clasifico/assets/css/user-form.css') }}" rel="stylesheet">
<style>
    .signup-section {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}
</style>


</head>


<!-- page wrapper -->
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
            <a href="/"><i class="fas fa-arrow-left"style="color: red;"></i></a>
        </div>
       

        <div class="tab-pane active" id="register-tab">
            
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

            <!-- New Sign-Up Form -->
            <section class="login-section signup-section bg-color-2">
                <div class="auto-container">
                    <div class="inner-container">
                        <div class="inner-box">
                            <h2 style=" text-align: center;">Sign up</h2>
                            <form action="{{ route('register') }}" method="POST" class="signup-form">
                                @csrf
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_number" value="{{ old('phone_number') }}" required>
                                    @error('phone_number')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" required>
                                    @error('password')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" required>
                                    @error('password_confirmation')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn-one">Sign Up</button>
                                </div>
                            </form>
                            <div class="other-text centred">
                                <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of New Sign-Up Form -->
        </div>
    </div>
</section>
<!--=====================================
            USER-FORM PART END
=======================================-->

<!-- jQuery plugins -->
<script src="{{ asset('newFrontend/Clasifico/assets/js/jquery.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/owl.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/wow.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/validation.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/jquery.fancybox.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/appear.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/scrollbar.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/jquery.nice-select.min.js') }}"></script>

<!-- main-js -->
<script src="{{ asset('newFrontend/Clasifico/assets/js/script.js') }}"></script>

    <script src="{{ asset('newFrontend/Clasifico/assets/popper.min.js') }}"></script>
    <script src="{{ asset('newFrontend/Clasifico/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('newFrontend/Clasifico/assets/js/owl.js') }}"></script>
    <script src="{{ asset('newFrontend/Clasifico/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('newFrontend/Clasifico/assets/js/appear.js') }}"></script>
    <script src="{{ asset('newFrontend/Clasifico/assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('newFrontend/Clasifico/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('newFrontend/Clasifico/assets/js/bxslider.js') }}"></script>
    <!-- main-js -->

    <script src="{{ asset('newFrontend/Clasifico/assets/js/script.js') }}"></script>
</body><!-- End of .page_wrapper -->
</html>

