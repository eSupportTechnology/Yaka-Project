<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<style>
.header-top {
    background-color:rgb(92, 2, 2); 
    color: white; 
    padding: 10px 0; /* Padding add */
}

.header-top a {
    color: white; 
    text-decoration: none; 
}

.header-top a:hover {
    text-decoration: underline; 
}

/* Icons and Text add white colour */
.info-list  li {
    color: #ffff; 
    list-style: none; 
    display: flex;
    align-items: center;
}

.info-list li i {
    color: #ffff; 
    margin-right: 8px; 
}

.info-list li a {
    color: #ffff; /* Links add #ffff color */
    text-decoration: none; /* underline delete */
}

.info-list li a:hover {
    text-decoration: underline; /* Hover affter add underline  */
}

.contact-info span {
    margin-right: 15px;
}


/* Social Links icons add white colour */
.social-links li a i {
    color: #ffff; /* Icons white colour */
    font-size: 18px; /* Icon size */
    transition: color 0.3s ease; /* Smooth hover effect */
}

.social-links li a:hover i {
    color:rgba(11, 11, 11, 0.89); /* Hover colour black */
}

/* Sign In icon සඳහා සුදු පාට */
.sign-in a {
    color: #ffff !important; /* Override any existing styles */
    text-decoration: none; /* Remove underline */
    display: flex;
    align-items: center; /* Align icon and text properly */
}

.sign-in a:hover {
    text-decoration: underline; /* Add underline on hover */
}

.sign-in a i {
    color: #ffff !important; /* Ensure the icon is white */
    margin-right: 5px; /* Add spacing between the icon and text */
}

/* Apply a red background color to the header-lower section */
.header-lower {
    background-color:rgb(49, 3, 3); /* Change the background to red */
    color: white; /* Ensure text is visible on the red background */
    padding: 15px 0; /* Add some padding for better spacing */
}

.header-lower a {
    color: white; /* Ensure links are white */
    text-decoration: none; /* Remove underline from links */
}

.header-lower a:hover {
    text-decoration: underline; /* Underline links on hover for better user experience */
}

.header-lower i {
    color: white; /* Ensure icons are white */
    margin-right: 10px; /* Add spacing between icons and text */
}


.logo {
    width: 230px;
}

.header {
    background-color:rgb(49, 3, 3); ;
    padding: 15px 0;
}
.logo {
    color: white;
    font-size: 24px;
    font-weight: bold;
    display: flex;
    align-items: center;
    text-align: left;
}
 .logo img {
    height: auto;
    margin-right: 10px;
    max-width: 230px;
    text-align: left;
}
.search-bar {
    width: 150%;
    max-width: 700px;
}
.search-bar input {
    border-radius: 10px;
    padding: 20px 20px;
}

@media (max-width: 768px) {
    .logo {
        justify-content: center;
        margin-bottom: 10px;
    }
    .logo img {
        margin-right: 0;
        width: 150px;  /* Adjust logo size for mobile */
    }
    .search-bar {
        width: 100%;
        max-width: 100%;
        margin-top: 10px;
    }
    .search-bar input {
        padding: 15px 20px;
        font-size: 14px;  /* Adjust font size for better readability */
    }
    .header {
        padding: 10px 0;
    }
    .container {
        flex-direction: column;
        align-items: center;  /* Align items vertically */
        justify-content: center;
    }
}


</style>



<!-- main header -->
<header class="main-header style-four">

<!-- header-top -->
<div class="header-top">
    <div class="auto-container">
        <div class="top-inner">
            <div class="contact-info">
                <span><i class="fas fa-phone"></i> Contact: 070 5 321 321</span>
                <span><i class="fas fa-envelope"></i> Email: info@yaka.lk</span>
                <span><i class="fas fa-map-marker-alt"></i> Location: Colombo 10, Sri Lanka</span>   
            </div>
            <div class="language-switcher">
                <a href="#">English</a> | 
                <a href="#">සිංහල</a> | 
                <a href="#">தமிழ்</a>
            </div>
            <div class="right-column clearfix">
                <ul class="social-links clearfix">
                   <li><a href="index-4.html"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="index-4.html"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="index-4.html"><i class="fab fa-youtube"></i></a></li>
                </ul>
                <div class="sign-in">
                    @auth
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none;">
                            <i class="fas fa-user"></i> {{ Auth::user()->first_name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                         <li><a class="dropdown-item" href="{{ route('user.dashboard') }}" style="color: black !important; text-decoration:none">Dashboard</a></li>
                         <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="background: none; border: none; text-decoration: none; color: inherit;">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>

                        </ul>
                    </div>

                    @else
                        <a style="text-decoration: none;" href="{{ route('custom.login') }}"><i class="fas fa-user"></i> Sign In</a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</div>

<!-- header-lower -->
<div class="header-lower" >
    <div class="auto-container">
        <div class="outer-box">
        <div class="container d-flex align-items-center justify-content-between">
        <!-- Logo -->
        <a href="{{ route('/') }}"><div class="logo">
        <img src="{{asset('Logo-re.png')}}" style="" alt="logo">
        </div></a>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" class="form-control" placeholder="Search, Category Name, Sub Category Name, District You Need...">
        </div>
            <div class="btn-box mt-2">
                <a href="{{ route('user.ad_posts') }}" class="theme-btn-one"><i class="icon-1"></i>Post Your Ads</a>
            </div>
        </div>
    </div>
</div>

<!--sticky Header-->
<div class="sticky-header" style=" background-color:rgb(49, 3, 3); ;">
    <div class="auto-container">
        <div class="outer-box">
            <div class="logo-box">
                <figure class="logo"><a href="{{ route('/') }}"> <img src="{{asset('Logo-re.png')}}" style="" alt="logo"></a></figure>
            </div>
    
            <div class="search-bar">
                <input type="text" class="form-control" placeholder="Search, Category Name, Sub Category Name, District You Need...">
            </div>
            
            <div class="btn-box">
                <a href="{{ route('user.ad_posts') }}" class="theme-btn-one"><i class="icon-1"></i>Post Your Ads</a>
            </div>
        </div>
    </div>
</div>
</header>
<!-- main-header end -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
<div class="menu-backdrop"></div>
<div class="close-btn"><i class="fas fa-times"></i></div>

<nav class="menu-box">
    <div class="nav-logo"><a href="index.html"><img src="newFrontend/Clasifico/assets/images/logo-2.png" alt="" title=""></a></div>
    <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
    <div class="contact-info">
        <h4>Contact Info</h4>
        <ul>
            <li>Chicago 12, Melborne City, USA</li>
            <li><a href="tel:+8801682648101">+88 01682648101</a></li>
            <li><a href="mailto:info@example.com">info@example.com</a></li>
        </ul>
    </div>
    <div class="social-links">
        <ul class="clearfix">
            <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
            <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
            <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
            <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
            <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
        </ul>
    </div>
</nav>
</div><!-- End Mobile Menu -->



