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
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" required>
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
