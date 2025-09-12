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

        /* .social-login-container {
            position: relative;
            left: 5rem;
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 300px;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #dadce0;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
        }

        .social-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        .google-btn {
            background-color: white;
            color: #3c4043;
            border: 1px solid #dadce0;
        }

        .google-btn:hover {
            background-color: #f8f9fa;
            color: #3c4043;
        }

        .facebook-btn {
            background-color: #1877f2;
            color: white;
            border: 1px solid #1877f2;
        }

        .facebook-btn:hover {
            background-color: #166fe5;
            color: white;
        }

        .btn-icon {
            width: 18px;
            height: 18px;
            margin-right: 12px;
        }

        .google-icon {
            background-image: url("data:image/svg+xml,%3Csvg width='18' height='18' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cpath d='M17.64 9.205c0-.639-.057-1.252-.164-1.841H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615Z' fill='%234285F4'/%3E%3Cpath d='M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18Z' fill='%2334A853'/%3E%3Cpath d='M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332Z' fill='%23FBBC05'/%3E%3Cpath d='M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58Z' fill='%23EA4335'/%3E%3C/g%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .facebook-icon {
            background-image: url("data:image/svg+xml,%3Csvg width='18' height='18' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='white' d='M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z'/%3E%3C/svg%3E");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        @media (max-width: 480px) {
            .social-login-container {
                width: 100%;
                max-width: 280px;
            }
        } */
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
