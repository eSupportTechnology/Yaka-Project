@extends ('newFrontend.master')

@section('content')

<!-- Page Title -->
<section class="page-title style-two" style="background-image: url(assets/images/background/page-title.jpg);">
    <div class="auto-container">
        <div class="content-box centred mr-0">
            <div class="title">
                <h1>Sign up</h1>
            </div>
            <ul class="bread-crumb clearfix">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>Sign up</li>
            </ul>
        </div>
    </div>
</section>
<!-- End Page Title -->

<!-- signup-section -->
<section class="login-section signup-section bg-color-2">
    <div class="auto-container">
        <div class="inner-container">
            <div class="inner-box">
                <h2>Sign up</h2>
                <form action="{{ route('register') }}" method="POST" class="signup-form">
                    @csrf
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                        <!-- Display errors for first_name -->
                        @error('first_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                        <!-- Display errors for last_name -->
                        @error('last_name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" required>
                        <!-- Display errors for phone_number -->
                        @error('phone_number')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" required>
                        <!-- Display errors for email -->
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                        <!-- Display errors for password -->
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" required>
                        <!-- Display errors for password_confirmation -->
                        @error('password_confirmation')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group message-btn">
                        <button type="submit" class="theme-btn-one">Sign up</button>
                    </div>
                </form>
                <div class="othre-text centred">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- signup-section end -->

@endsection
