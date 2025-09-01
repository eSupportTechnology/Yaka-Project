<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Yaka</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('Logo-icon.png') }}" type="image/x-icon">
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

        /* Additional styles for multi-step form */
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            padding: 0;
        }

        .step {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #e0e6ed;
            margin: 0 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .step.active {
            background: #ff6c02;
            transform: scale(1.2);
        }

        .step.completed {
            background: #28a745;
        }

        .step::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 24px;
            width: 16px;
            height: 2px;
            background: #e0e6ed;
            transform: translateY(-50%);
        }

        .step:last-child::after {
            display: none;
        }

        .step.completed::after {
            background: #28a745;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .password-input-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
            font-size: 18px;
            z-index: 10;
        }

        .resend-section {
            text-align: center;
            margin-top: 15px;
        }

        .resend-btn {
            background: none;
            border: none;
            color: #ff6c02;
            cursor: pointer;
            font-weight: 600;
            text-decoration: underline;
            font-size: 14px;
        }

        .resend-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .countdown {
            color: #6c757d;
            font-size: 14px;
            margin-top: 5px;
        }

        .step-title {
            color: #333;
            margin-bottom: 10px;
        }

        .step-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group input:focus {
            border-color: #ff6c02 !important;
            box-shadow: 0 0 0 2px rgba(255, 108, 2, 0.1) !important;
        }

        .theme-btn-one:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Alert improvements */
        .alert {
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
    </style>
</head>
<body>
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
            <a href="/"><i class="fas fa-arrow-left" style="color: red;"></i></a>
        </div>

        <div class="tab-pane active" id="register-tab">
            <!-- Step Indicator -->


            <!-- Reset Password Section -->
            <section class="login-section ">
                <div class="step-indicator">
                    <div class="step active" id="step1"></div>
                    <div class="step" id="step2"></div>
                    <div class="step" id="step3"></div>
                </div>
                <div class="auto-container">
                    <div class="inner-container">
                        <div class="inner-box">
                            <!-- Alert Container -->
                            <div id="alert-container">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Step 1: Send Reset Code -->
                            <div class="form-step active" id="form-step-1">
                                <h2 class="step-title">Reset Password</h2>
                                <p class="step-description">Enter your phone number to receive a verification code</p>

                                <form id="send-code-form" class="login-form">
                                    @csrf
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="mobile" id="mobile" required>
                                        <div class="error-message" id="mobile-error"></div>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn-one">Send Verification Code</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Step 2: Verify Code -->
                            <div class="form-step" id="form-step-2">
                                <h2 class="step-title">Verify Code</h2>
                                <p class="step-description">Enter the 6-digit code sent to your phone</p>

                                <form id="verify-code-form" class="login-form">
                                    @csrf
                                    <div class="form-group">
                                        <label>Verification Code</label>
                                        <input type="text" name="verification_code" id="verification_code" maxlength="6" required>
                                        <div class="error-message" id="code-error"></div>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn-one">Verify Code</button>
                                    </div>

                                    <div class="resend-section">
                                        <button type="button" id="resend-btn" class="resend-btn">Resend Code</button>
                                        <div class="countdown" id="countdown" style="display: none;"></div>
                                    </div>
                                </form>
                            </div>

                            <!-- Step 3: Reset Password -->
                            <div class="form-step" id="form-step-3">
                                <h2 class="step-title">New Password</h2>
                                <p class="step-description">Create your new secure password</p>

                                <form id="reset-password-form" class="login-form">
                                    @csrf
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <div class="password-input-wrapper">
                                            <input type="password" name="password" id="password" required>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div class="error-message" id="password-error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <div class="password-input-wrapper">
                                            <input type="password" name="password_confirmation" id="password_confirmation" required>
                                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </div>
                                        <div class="error-message" id="confirm-password-error"></div>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn-one">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
<script src="{{ asset('newFrontend/Clasifico/assets/js/bxslider.js') }}"></script>
<script src="{{ asset('newFrontend/Clasifico/assets/js/script.js') }}"></script>

<script>
    $(document).ready(function() {
        let currentStep = 1;
        let userMobile = '';
        let verificationCode = '';
        let countdownTimer = null;

        // Form submission handlers
        $('#send-code-form').on('submit', handleSendCode);
        $('#verify-code-form').on('submit', handleVerifyCode);
        $('#reset-password-form').on('submit', handleResetPassword);
        $('#resend-btn').on('click', resendCode);

        // Input formatting
        $('#mobile').on('input', function() {
            $(this).val($(this).val().replace(/[^\d]/g, ''));
        });

        $('#verification_code').on('input', function() {
            $(this).val($(this).val().replace(/[^\d]/g, ''));
        });

        function handleSendCode(e) {
            e.preventDefault();
            const mobile = $('#mobile').val().trim();

            clearErrors();

            if (!mobile || !validatePhoneNumber(mobile)) {
                showError('mobile-error', 'Please enter a valid phone number (10-15 digits)');
                return;
            }

            const $submitBtn = $(this).find('button[type="submit"]');
            const originalText = $submitBtn.text();

            $submitBtn.prop('disabled', true).text('Sending...');
            $(this).addClass('loading');

            $.ajax({
                url: '/api/password/reset-code',
                method: 'POST',
                data: {
                    mobile: mobile,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    userMobile = mobile;
                    showAlert('Verification code sent successfully!', 'success');
                    goToStep(2);
                    startCountdown();
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    if (response && response.message) {
                        showAlert(response.message, 'danger');
                    } else {
                        showAlert('Failed to send verification code. Please try again.', 'danger');
                    }
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).text(originalText);
                    $('#send-code-form').removeClass('loading');
                }
            });
        }

        function handleVerifyCode(e) {
            e.preventDefault();
            const code = $('#verification_code').val().trim();

            clearErrors();

            if (!code || code.length !== 6) {
                showError('code-error', 'Please enter a valid 6-digit code');
                return;
            }

            const $submitBtn = $(this).find('button[type="submit"]');
            const originalText = $submitBtn.text();

            $submitBtn.prop('disabled', true).text('Verifying...');
            $(this).addClass('loading');

            $.ajax({
                url: '/api/password/verify-code',
                method: 'POST',
                data: {
                    mobile: userMobile,
                    verification_code: code,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    verificationCode = code;
                    showAlert('Code verified successfully!', 'success');
                    goToStep(3);
                    clearCountdown();
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    if (response && response.message) {
                        showAlert(response.message, 'danger');
                    } else {
                        showAlert('Invalid verification code. Please try again.', 'danger');
                    }
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).text(originalText);
                    $('#verify-code-form').removeClass('loading');
                }
            });
        }

        function handleResetPassword(e) {
            e.preventDefault();
            const password = $('#password').val();
            const passwordConfirmation = $('#password_confirmation').val();

            clearErrors();

            if (!password || password.length < 8) {
                showError('password-error', 'Password must be at least 8 characters long');
                return;
            }

            if (password !== passwordConfirmation) {
                showError('confirm-password-error', 'Passwords do not match');
                return;
            }

            const $submitBtn = $(this).find('button[type="submit"]');
            const originalText = $submitBtn.text();

            $submitBtn.prop('disabled', true).text('Resetting...');
            $(this).addClass('loading');

            $.ajax({
                url: '/api/password/reset',
                method: 'POST',
                data: {
                    mobile: userMobile,
                    verification_code: verificationCode,
                    password: password,
                    password_confirmation: passwordConfirmation,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showAlert('Password reset successfully! Redirecting to login...', 'success');
                    setTimeout(function() {
                        window.location.href = '/login';
                    }, 2000);
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    if (response && response.message) {
                        showAlert(response.message, 'danger');
                    } else {
                        showAlert('Failed to reset password. Please try again.', 'danger');
                    }
                },
                complete: function() {
                    $submitBtn.prop('disabled', false).text(originalText);
                    $('#reset-password-form').removeClass('loading');
                }
            });
        }

        function resendCode() {
            if (!userMobile) return;

            const $resendBtn = $('#resend-btn');
            $resendBtn.prop('disabled', true).text('Sending...');

            $.ajax({
                url: '/api/password/reset-code',
                method: 'POST',
                data: {
                    mobile: userMobile,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showAlert('Verification code sent again!', 'success');
                    startCountdown();
                },
                error: function(xhr) {
                    const response = xhr.responseJSON;
                    if (response && response.message) {
                        showAlert(response.message, 'danger');
                    } else {
                        showAlert('Failed to resend code. Please try again.', 'danger');
                    }
                    $resendBtn.prop('disabled', false).text('Resend Code');
                }
            });
        }

        function goToStep(step) {
            // Hide all steps
            $('.form-step').removeClass('active');
            $('.step').removeClass('active completed');

            // Show current step
            $(`#form-step-${step}`).addClass('active');

            // Update step indicators
            for (let i = 1; i < step; i++) {
                $(`#step${i}`).addClass('completed');
            }
            $(`#step${step}`).addClass('active');

            currentStep = step;
        }

        function startCountdown() {
            let timeLeft = 60;
            const $resendBtn = $('#resend-btn');
            const $countdown = $('#countdown');

            $resendBtn.hide();
            $countdown.show();

            countdownTimer = setInterval(function() {
                $countdown.text(`Resend available in ${timeLeft} seconds`);
                timeLeft--;

                if (timeLeft < 0) {
                    clearCountdown();
                }
            }, 1000);
        }

        function clearCountdown() {
            if (countdownTimer) {
                clearInterval(countdownTimer);
                countdownTimer = null;
            }

            $('#resend-btn').show().prop('disabled', false).text('Resend Code');
            $('#countdown').hide();
        }

        function showAlert(message, type) {
            const alertHtml = `<div class="alert alert-${type}" role="alert">${message}</div>`;
            $('#alert-container').html(alertHtml);

            // Auto-hide success messages
            if (type === 'success') {
                setTimeout(function() {
                    $('.alert-success').fadeOut();
                }, 3000);
            }
        }

        function showError(elementId, message) {
            $(`#${elementId}`).text(message);
        }

        function clearErrors() {
            $('.error-message').text('');
        }

        function validatePhoneNumber(phone) {
            const phoneRegex = /^[0-9]{10,15}$/;
            return phoneRegex.test(phone);
        }
    });

    function togglePassword(inputId) {
        const $input = $(`#${inputId}`);
        const $icon = $input.siblings('.password-toggle').find('i');

        if ($input.attr('type') === 'password') {
            $input.attr('type', 'text');
            $icon.removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $input.attr('type', 'password');
            $icon.removeClass('fa-eye').addClass('fa-eye-slash');
        }
    }
</script>
</body>
</html>
