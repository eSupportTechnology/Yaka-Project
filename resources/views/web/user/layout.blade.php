<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
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
    <title>Home - Classicads</title>

    <!--=====================================
                CSS LINK PART START
    =======================================-->
    <!-- FAVICON -->
    <link rel="icon" href="{{asset('web/images/favicon.png')}}">

    <!-- FONTS -->
    <link rel="stylesheet" href="{{asset('web/fonts/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('web/fonts/font-awesome/fontawesome.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- VENDOR -->
    <link rel="stylesheet" href="{{asset('web/css/vendor/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/vendor/bootstrap.min.css')}}">

    <!-- CUSTOM -->
    <link rel="stylesheet" href="{{asset('web/css/custom/main.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/custom/index.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/custom/ad-details.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/custom/ad-post.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--=====================================
                CSS LINK PART END
    =======================================-->
</head>
<body>

<!--=====================================
            HEADER PART START
=======================================-->
@include('web.Blocks.nav')
<!--=====================================
            HEADER PART END
=======================================-->


<!--=====================================
            SIDEBAR PART START
=======================================-->
@include('web.Blocks.sidebar')
<!--=====================================
            SIDEBAR PART END
=======================================-->


<!--=====================================
            MOBILE-NAV PART START
=======================================-->
@include('web.Blocks.mobile-nav')
<!--=====================================
            MOBILE-NAV PART END
=======================================-->


<!--=====================================
            BANNER PART START
=======================================-->
@include('web.Blocks.dashboard-banner')
<!--=====================================
            BANNER PART END
=======================================-->

@include('web.Blocks.dashboard-nav')

@yield('content')

<!--=====================================
            FOOTER PART PART
=======================================-->
<footer class="footer-part" style="background-color:rgb(92, 2, 2); padding: 15px 0; text-align: left;" >
    <div class="container">
        <div class="row newsletter">
            <div class="col-lg-9">
                <div class="news-content">
                    <h2>Subscribe for Latest Offers</h2>
                    <p>Don’t miss out on the best deals in Sri Lanka’s largest marketplace! Subscribe now to receive exclusive offers, promotions, and updates directly to your inbox. Be the first to know about discounts on a wide range of products and services, from electronics and fashion to home goods and vehicles. Our subscription ensures you stay connected with the latest opportunities and special events tailored just for you. Join our growing community of savvy shoppers and make the most of your shopping experience. Sign up today and start saving!</p>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="footer-info">
                    <a href="#"><img src="{{asset('Logo-re.png')}}" alt="logo"></a>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="footer-content">
                    <h3>Contact Us</h3>
                    <ul class="footer-address">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Colombo 10, Sri Lanka</p>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <p>
                                <a href="mailto:Yaka.lk@outlook.com">Yaka.lk@outlook.com</a> <span>|</span> 
                                <a href="mailto:Yakalksrilanka@gmail.com">Yakalksrilanka@gmail.com</a>
                            </p>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <p>
                                <a href="tel:+94705321321">070 5 321 321</a>
                            </p>
                        </li>
                    </ul>
                </div>
                
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="footer-content">
                    <h3>Quick Links</h3>
                    <ul class="footer-widget">
                        <li><a href="{{route('about-us')}}">About Us</a></li>
                        <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                        <li><a href="{{route('privacy-safety')}}">Privacy & Safety</a></li>
                        {{-- <li><a href="{{route('careers')}}">Careers</a></li> --}}
                        <li><a href="{{route('tems-conditions')}}">Tems & Conditions</a></li>
                        {{-- <li><a href="{{route('faq')}}">Faq</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4">
                <div class="footer-content">
                    <h3>General</h3>
                    <ul class="footer-widget">
                        <li><a href="{{route('tips')}}">Tips</a></li>
                        <li><a href="{{route('boosting-ads')}}">Boosting ads</a></li>
                        <li><a href="{{route('ads-posting-allowances')}}">Ad posting allowances</a></li>
                        <li><a href="{{route('ad-posting-criteria')}}">Ad posting criteria</a></li>
                        <li><a href="{{route('banner-ads')}}">Banner Ads</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-card-content">
                    <div class="footer-payment" style="
                    display: flex;
                    justify-content: space-between;
                ">
                       <ul class="footer-social">
                        {{-- <li><a href="#" target="_bank"><i class="fas fa-envelope"></i></a></li> --}}
                        <li><a href="https://www.facebook.com/profile.php?id=61565478456618" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://www.youtube.com/@Yakalk-g5d" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        {{-- <li><a href="#" target="_blank"><i class="fab fa-tiktok"></i></a></li> --}}
                        <li><a href="https://www.instagram.com/yaka.lk6/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://wa.me/0705321321" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                        
                    </div>
                    <div class="footer-app" style="display: flex;flex-wrap: wrap;">
                        <span style="width: 100%">Coming soon</span>
                        <a href="#"><img src="{{asset('web/images/play-store.png')}}" alt="play-store"></a>
                        <a href="#"><img src="{{asset('web/images/app-store.png')}}" alt="app-store"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-end">
        <div class="container">
            <div class="footer-end-content" style="display: flex;justify-content: center;">
                <p>© Copyright 2024 - SATASME HOLDINGS (Pvt) Ltd , All Rights Reserved</p>

            </div>
        </div>
    </div>
</footer>
<!--=====================================
            FOOTER PART END
=======================================-->


<!--=====================================
          CURRENCY MODAL PART START
=======================================-->
<div class="modal fade" id="currency">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Choose a Currency</h4>
                <button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <button class="modal-link active">United States Doller (USD) - $</button>
                <button class="modal-link">Euro (EUR) - €</button>
                <button class="modal-link">British Pound (GBP) - £</button>
                <button class="modal-link">Australian Dollar (AUD) - A$</button>
                <button class="modal-link">Canadian Dollar (CAD) - C$</button>
            </div>
        </div>
    </div>
</div>
<!--=====================================
          CURRENCY MODAL PART END
=======================================-->


<!--=====================================
          LANGUAGE MODAL PART END
=======================================-->
<div class="modal fade" id="language">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Choose a Language</h4>
                <button class="fas fa-times" data-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <button class="modal-link active">English</button>
                <button class="modal-link">bangali</button>
                <button class="modal-link">arabic</button>
                <button class="modal-link">germany</button>
                <button class="modal-link">spanish</button>
            </div>
        </div>
    </div>
</div>
<!--=====================================
           LANGUAGE MODAL PART END
=======================================-->

<script type="text/javascript">
    
    var url = "{{ route('changeLang') }}";
    
    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val();
    });
    
</script>
<!--=====================================
            JS LINK PART START
=======================================-->
<!-- VENDOR -->
<script src="{{asset('web/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('web/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('web/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/vendor/slick.min.js')}}"></script>

<!-- CUSTOM -->
<script src="{{asset('web/js/custom/slick.js')}}"></script>
<script src="{{asset('web/js/custom/main.js')}}"></script>
<!--=====================================
            JS LINK PART END
=======================================-->
</body>
</html?>







