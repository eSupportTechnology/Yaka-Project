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


</head>


<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">

        <!-- preloader -->
        <div class="preloader"></div>
        <!-- preloader -->

        @include('newFrontend.header')
        
        @yield('content')

        @include('newFrontend.footer')
           <!--Scroll to top-->
           <button class="scroll-top scroll-to-target" data-target="html">
            <span class="far fa-long-arrow-up"></span>
        </button>
    </div>

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
