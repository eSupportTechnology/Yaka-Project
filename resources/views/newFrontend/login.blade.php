<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="google-adsense-account" content="ca-pub-1349383843692439">
    <script src="https://cdn.tailwindcss.com"></script>


    <title>Yaka</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('Logo-icon.png') }}" type="image/x-icon">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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

<body>
    <section class="user-form-part">
        <div class="user-form-banner">
            <div class="user-form-content">
                <a href="#"><img src="{{ asset('Logo-re.png') }}" alt="logo"></a>
                <h1>Advertise your assets <span>Buy what you want</span></h1>
                <p>Biggest online marketplace in Sri Lanka</p>
            </div>
        </div>

        <div class="user-form-category">
            <div class="user-form-header">
                <a href="#"><img src="{{ asset('yaka-payment.png') }}" alt="logo"></a>
                <a href="/"><i class="fas fa-arrow-left"style="color: red;"></i></a>
            </div>


            <div class="tab-pane active" id="register-tab">



                <!-- Login Section -->
                <section class="login-section bg-color-2">
                    <div class="auto-container">
                        <div class="inner-container">
                            <div class="inner-box">
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

                                @if ($errors->has('phone_number') || $errors->has('password'))
                                    <div class="alert alert-danger">
                                        Invalid phone number or password. Please try again.
                                    </div>
                                @endif

                                @if (session('active_error'))
                                    <div class="alert alert-danger">
                                        {{ session('active_error') }} <a
                                            href="{{ route('verify-mobile') }}">Verify</a>
                                    </div>
                                @endif
                                <h2>Log in</h2>
                                <form action="{{ route('custom.login') }}" method="POST" class="login-form">
                                    @csrf
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_number" required>
                                        @error('phone_number')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div style="position: relative;">
                                            <input type="password" id="password" name="password" required>
                                            <span id="togglePassword"
                                                style="position: absolute; right: 10px; top: 10px; cursor: pointer;">
                                                <i class="fas fa-eye-slash"></i>
                                            </span>
                                        </div>
                                        @error('password')
                                            <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn-one">Login Now</button>
                                    </div>

                                    <div class="othre-text right">
                                        <p><a href="{{ route('password.request') }}" class="theme-btn-reset">Forgot
                                                Password?</a></p>
                                    </div>

                                </form>
                                <div class="other-content centred">
                                    <div class="text"><span>or</span></div>
                                    <div class="othre-text">
                                        <p>Don’t have an account? <a href="{{ route('register') }}">Register Now</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-full max-w-sm space-y-4">
                                        <!-- Google Login Button -->
                                        <a href="{{ url('auth/google') }}"
                                            class="w-full flex items-center justify-center px-6 py-2 border border-gray-300 rounded-lg shadow-sm bg-white text-gray-700 font-medium hover:bg-gray-50 hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                                            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                                <path fill="#4285F4"
                                                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                                <path fill="#34A853"
                                                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                                <path fill="#FBBC05"
                                                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                                <path fill="#EA4335"
                                                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                            </svg>
                                            Continue with Google
                                        </a>

                                        <!-- Facebook Login Button -->
                                        <a href="{{ url('auth/facebook') }}"
                                            class="w-full flex items-center justify-center px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow-sm hover:bg-blue-700 hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                                            <svg class="w-5 h-5 mr-3 fill-current" viewBox="0 0 24 24">
                                                <path
                                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                            </svg>
                                            Continue with Facebook
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

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

                <script>
                    document.getElementById('togglePassword').addEventListener('click', function() {
                        var passwordField = document.getElementById('password');
                        var icon = this.querySelector('i');

                        if (passwordField.type === 'password') {
                            passwordField.type = 'text';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        } else {
                            passwordField.type = 'password';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        }
                    });
                </script>
</body>

</html>
