@extends ('newFrontend.master')

@section('content')
  
<style>

.banner-section {
    background: linear-gradient(to bottom, rgb(102, 17, 17), rgb(171, 18, 18), rgb(253, 6, 6));
    padding: 30px;
    text-align: center;
    color: white;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.content-box {
    max-width: 80%;
    margin: auto;
}



/* Responsive adjustments */
@media (max-width: 768px) {
    .text h1 {
        font-size: 25px; 
    }

    .text p {
        font-size: 10px; 
    }

    .banner-section {
        height: auto;
        padding: 50px 20px;
    }
}

@media (max-width: 480px) {
    .text h1 {
        font-size: 15px;
    }

    .text p {
        font-size: 8px;
    }

    .banner-section {
        height: auto;
        padding: 40px 15px;
    }
}

       
.banner-container {
    width: 100%;
    background-color:#ffff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px 0;
	margin-top: 30px;
    margin-bottom: 50px;
    
}

.banner {
    width: 80%;
    max-width: 1000px;
    height: 150px;
    background: url('banner-image.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: black;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    font-size: 24px;
    padding: 20px;
}

.banner-text {
    flex: 1;
    text-align: left;
}

.banner-logo {
    font-size: 40px;
    font-weight: bold;
}

.banner-hashtags {
    flex: 1;
    text-align: right;
    font-size: 18px;
}

.carousel-inner {
    height: 100%; /* Makes sure the carousel inner has a consistent height */
}

.carousel-item {
    height: 100%; /* Ensures each carousel item matches the container's height */
}

.carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}

@media (max-width: 768px) {
    .banner {
                flex-direction: column;
                height: auto;
                padding: 20px;
                text-align: center;
            }

    .banner-text, .banner-hashtags {
                text-align: center;
                font-size: 16px;
            }
 }

.ad-banner-container {
    width: 100%;
    background-color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 5px 0;
    margin-top: 0px;
    margin-bottom: 30px;
}

.ad-banner {
    width: 60%;  /* Reduced width */
    max-width: 600px;  /* Smaller banner width */
    height: 80px;  /* Reduced height */
    background: url('banner-image.jpg') no-repeat center center/cover;
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    font-size: 10px; 
    padding: 5px;
}

.ad-carousel-item img {
    width: 800px !important;  
    height: 120px !important;  
    object-fit: cover; 
    margin: 0 auto; 
}

.top-banner .left .carousel-item img {
    max-width: 80%; /* Adjust the width percentage as needed */
    max-height: 50%; /* Ensure the aspect ratio is maintained */
    margin: 20px; /* Center the image horizontally */
    margin-left:-40px;
    margin-top:-25px;
}

.cont{
    max-width: 1200px;
    margin: 20px auto;
    
}

.heading {
    font-size: 30px;
    color: #333;
    margin-bottom: 15px;
    text-align: left;
    margin-left:124px;
}

.heading span {
    color: red;
    font-weight: bold;
    font-size: 32px;  /* Font size increased */
    display: inline-block;
    padding: 5px 10px; 
    font-style: italic;
}

.top-banner { 
    display: flex;
    align-items: flex-start; /* Align content to the top */
    justify-content: flex-start; /* Align everything to the left */
    padding: 20px;
    position: relative; /* Ensure proper placement */
}

.top-banner .left { 
    flex: 1; /* Adjust size */
    margin-left: 150px; /* Adjust spacing without negative margins */
}

.top-banner .left img { 
    max-width: 400px; 
    max-height: 600px; 
    border-radius: 10px;
}

.top-banner .right { 
    flex: 2; 
    margin-left: -50px; /* Replacing the negative margin */
    text-align: left;
    position: relative;
    top: 0;
    margin-top:210px; /* Adjust height properly */
}

.top-banner p { 
    color: #555;
    font-size: 16px;
    line-height: 1.5;
}

.top-banner .ad-box { 
    background-color: #fff;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    margin-top: 20px; /* Instead of negative margins */
}

.top-banner .ad-box h3 { 
    color: #222;
    font-size: 18px;
}

.top-banner .ad-box p { 
    font-size: 14px;
    color: #444;
}

.top-banner .ad-box .price { 
    color: blue;
    font-weight: bold;
    font-size: 20px;
}

.carousel-item .ad-box {
    background: white;
    padding-top: 10px; /* Reduced padding */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    text-align: left;
    max-width: 99%;
    margin: auto;
}

.carousel-control-prev, 
.carousel-control-next {
    filter: invert(100%);
}

#topAdsCarousel {
    margin-bottom: 30px; /* Space between the carousel and the cards */
}

/* Style for each ad card */
.ad-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: right;
    margin-bottom: 10px;
}

.ad-card h3 {
    font-size: 1.2rem;
    font-weight: bold;
}

.ad-card p {
    margin: 5px 0;
}

.price {
    font-size: 1.1rem;
    color: #d9534f;
    font-weight: bold;
}

.card-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

/* Card image styling if needed */
.ad-card img {
    max-width: 50%;
    border-radius: 8px;
}

.slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.card-container {
    display: flex;
    width: 200%;
    transition: transform 0.5s ease-in-out;
}

.ad-card {
    width: 20%;
    padding: 15px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    flex-shrink: 0;
}


</style>

        <!-- banner-section -->
        <section class="banner-section">
            <div class="auto-container" >
                <div class="content-box">
                    <div class="text">
                        <h1 style="font-size:45px">You can #Buy, #Rent, #Booking anything from here.</h1>
                        <p>Buy and sell everything from used cars to mobile phones and computers,<br> or search for property, jobs and more in Sri Lanka.
                        </p>
                    </div>
                    
                </div> 
            </div>
        </section>
        <!-- banner-section end -->

        <!-- ad - banner-section start -->
        <section class="ad-banner-container mb-0"> 
            <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($banners as $key => $banner)
                        @if($banner->type == 0)
                            <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                               <img src="{{ asset('banners/' . $banner->img) }}" class="d-block mx-auto" alt="Banner Image">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ad - banner-section end -->

        <!-- category-section -->
        <section class="category-section centred sec-pad mt-0">
            <div class="auto-container">
                <div class="sec-title">
                    <span>Categories</span>
                    <h2>Explore by Category</h2>
                </div>
                
                <div class="clearfix inner-content" style="display: flex; flex-wrap: wrap; justify-content: center;">
            @foreach($categories as $category)
                <div class="category-block-one wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                    <a href="{{ route('browse-ads', ['category' => $category->id]) }}" style="text-decoration: none;">
                        <div class="inner-box">
                            <div class="shape">
                                <div class="shape-1" style="background-image: url('{{ asset('newFrontend/Clasifico/assets/images/shape/shape-1.png') }}');"></div>
                                <div class="shape-2" style="background-image: url('{{ asset('newFrontend/Clasifico/assets/images/shape/shape-2.png') }}');"></div>
                            </div>

                            <div class="icon-box">
                                <img src="{{ asset('images/Category/' . $category->image) }}" 
                                    alt="{{ $category->name }}" 
                                    style="width: 70px; height: 70px; object-fit: contain;">
                            </div>

                            <h5 style="min-height: 50px; display: -webkit-box; 
                                    -webkit-line-clamp: 2; -webkit-box-orient: vertical; 
                                    overflow: hidden; text-overflow: ellipsis; ">
                                {{ $category->name }}
                            </h5>

                            <span>{{ $category->ads_count }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
</section>
<!-- category-section end -->

<!-- top add-section start -->
<div class="cont">
    <h2 class="heading"><b>Find your needs in our <br> 
        best <span>Top Ads</span></b></h2>

    <div class="top-banner"> <!-- Updated class reference here -->
        <div class="left">
        @if($topbanners->isNotEmpty())
            @foreach($topbanners as $key => $banner)
                @if($banner->type == 1)  
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('banners/' . $banner->img) }}" class="d-block w-100" alt="Banner Image">
                    </div>
                @endif
            @endforeach
        @else
            <p>No banners available</p>
        @endif

        </div>

        <div class="right">
            <div id="topAdsCarousel" class="carousel slide" data-bs-ride="carousel" style="margin-top:-320px;margin-left:-200px;">
                <div class="carousel-inner">
                    @foreach($topAds as $index => $ad)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="ad-box" style="width: 470px; height: 220px; background: url('{{ asset('images/Ads/' . $ad->mainImage) }}') no-repeat center center/cover; position: relative; color: white; padding: 15px; display: flex; flex-direction: column; justify-content: flex-end;">
                        <!-- Shadow Overlay -->
    <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0)); border-radius: 5px;"></div>

                        <button class="sale" style="position: absolute; top: 10px; right: 10px; width: 50px; height: 25px; border-radius: 2px; background-color: red; color: white; font-weight: bold; font-size: 12px; border: none; z-index: 2;">
    Sale
</button>
                                <p style="color:white;">{{ $ad->category->name ?? 'Uncategorized' }} &raquo; {{ $ad->subcategory->name ?? '' }}</p>
                                <h3 style="color:white;font-weight:bold;">{{ $ad->title }}</h3>
                                
                                <p class="price" style="color:rgb(130, 128, 226);">LKR {{ number_format($ad->price, 2) }}</p>
                                <p style="color:white;"><i class="fas fa-clock"></i>
                                {{ $ad->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="small-carousel-wrapper" style="overflow: hidden; width: 580px; margin-top: -50px;">
        <div class="card-container d-flex" style="display: flex; transition: transform 0.5s ease-in-out;">
            @foreach($topAds as $index => $ad)
                <div class="ad-card" data-index="{{ $index }}" style="background: url('{{ asset('images/Ads/' . $ad->mainImage) }}') no-repeat center center/cover; height: 100px; width: 100px; margin: -2px; border: 3px solid transparent; transition: border 0.3s;">
                </div>
            @endforeach
        </div>

            <p style="margin-top:14px;font-size:14px;">The Top Ads section on Sri Lanka's largest classified website yaka.lk guarantees your listings premium placement at the top of search results.
                with higher visibility and priority ranking.Top ads ensure your products or services reach more potential buyers quickly and effectively.
            </p>
        </div> <!-- Closing right div -->

    </div> <!-- Closing top-banner div -->
</div> <!-- Closing cont div -->
<!-- top add-section end -->

        <!-- feature-style-two -->
        <section class="feature-style-two">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span>Urgents</span>
                    <h2>Urgent Ads</h2>
                    <p>We have some special promotion for sell urgently<br>
Urgent badge which is great advantage to get more attention quickly. <br /></p>
                </div>
                <div class="tabs-box">
                    
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">

                            <div class="clearfix row justify-content-center">
                            @foreach($latestAds as $ads)
                                <div class="col-lg-3 col-md-5 col-sm-12 feature-block justify-content-center">
                                    <div class="feature-block-one wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box" >
                                                <figure class="image"><img src="{{ asset('images/Ads/' . $ads->mainImage) }}" alt="" style="width: 370px; height: 220px; object-fit: cover;"></figure>
                                               
                                                <div class="feature" style="background-color: rgb(171, 18, 18);">Urgent</div>
                                            
                                            </div>
                                            <div class="lower-content">
                                            
                                              
                                                <h3 style="margin-top:20px;"><a href="browse-ads-details.html">{{$ads ->title}}</a></h3>
                                           
                                                <ul class="clearfix info">
                                                    
                                                    <li><i class="fas fa-map-marker-alt"></i>{{ $ad->sub_location ? $ad->sub_location->name_en : 'N/A' }},
                                                    {{ $ad->main_location ? $ad->main_location->name_en : 'N/A' }}</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Price:</span>{{$ads -> price}}</h5>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature-style-two end -->

      <!-- advertisement - banner-section start 
    <section class="banner-container">
        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach($banners as $key => $banner)
                    @if($banner->type == 0) 
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('banners/' . $banner->img) }}" 
                                alt="Banner Image">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
 advertisement - banner-section end -->

           <!-- ad - banner-section start -->
           <section class="ad-banner-container mb-0"> 
            <div id="ad-banner-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($banners as $key => $banner)
                        @if($banner->type == 0)
                            <div class="carousel-item ad-carousel-item {{ $key == 0 ? 'active' : '' }}">
                               <img src="{{ asset('banners/' . $banner->img) }}" class="d-block mx-auto" alt="Banner Image">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
        <!-- advertisement - banner-section end -->

        <script>
    document.addEventListener("DOMContentLoaded", function () {
        var carousel = document.getElementById("topAdsCarousel");
        var adCards = document.querySelectorAll(".ad-card");
        var cardContainer = document.querySelector(".card-container");
        var wrapperWidth = document.querySelector(".small-carousel-wrapper").offsetWidth;
        var cardWidth = 110; // Adjust this based on actual card width + margin

        // Function to update active border and slide small ads
        function updateActiveAd(index) {
            adCards.forEach(card => card.style.border = "3px solid transparent"); // Remove border
            let activeCard = document.querySelector(`.ad-card[data-index="${index}"]`);
            if (activeCard) {
                activeCard.style.border = "3px solid red"; // Highlight active ad
                let offset = Math.max(0, (index * cardWidth) - (wrapperWidth / 2) + (cardWidth / 2)); // Keep ads centered
                cardContainer.style.transform = `translateX(-${offset}px)`;
            }
        }

        // Bootstrap Carousel Event Listener
        carousel.addEventListener("slid.bs.carousel", function (event) {
            let activeIndex = event.to;
            updateActiveAd(activeIndex);
        });

        // Initially highlight the first ad
        updateActiveAd(0);

        // **New Slideshow Script for .top-banner**
        let bannerItems = document.querySelectorAll('.top-banner .carousel-item');
        
        // Check if there are any banners
        if (bannerItems.length > 0) {
            let currentIndex = 0;

            function showNextBanner() {
                bannerItems[currentIndex].classList.remove('active'); // Hide current banner
                currentIndex = (currentIndex + 1) % bannerItems.length; // Move to next (wrap around to the first one)
                bannerItems[currentIndex].classList.add('active'); // Show next banner
            }

            // Start the slideshow if there are banners
            setInterval(showNextBanner, 5000); // Change slide every 3 seconds
        }
    });
</script>

         
@endsection

       



 