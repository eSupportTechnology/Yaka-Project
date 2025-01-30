@extends ('newFrontend.master')

@section('content')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        
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

.text h1 {
    font-size: 45px;
    line-height: 1.2;
}

.text p {
    font-size: 18px;
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

        <!-- category-section -->
        <section class="category-section centred sec-pad">
            <div class="auto-container">
                <div class="sec-title">
                    <span>Categories</span>
                    <h2>Explore by Category</h2>
                </div>
                
                <div class="inner-content clearfix" style="display: flex; flex-wrap: wrap; justify-content: center;">
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
                                    overflow: hidden; text-overflow: ellipsis;">
                                {{ $category->name }}
                            </h5>

                            <span>{{ $category->ads_count }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
       

        <!-- <div class="more-btn" style="text-align: center; margin-top: 20px;">
            <a href="index.html" class="theme-btn-one" >
                All Categories
            </a>
        </div> -->
    </div>
</section>
<!-- category-section end -->


        <!-- feature-style-two -->
        <section class="feature-style-two">
            <div class="auto-container">
                <div class="sec-title centred">
                    <span>Features</span>
                    <h2>Featured Ads</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt labore <br />dolore magna aliqua enim.</p>
                </div>
                <div class="tabs-box">
                    <div class="tab-btn-box centred">
                        <ul class="tab-btns tab-buttons clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">Recent Listing</li>
                            <li class="tab-btn" data-tab="#tab-2">Popular Listing</li>
                        </ul>
                    </div>
                    <div class="tabs-content">
                        <div class="tab active-tab" id="tab-1">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInDown animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-1.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-1.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>1 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInDown animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-2.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-2.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(25)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>2 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$2,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInDown animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-3.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-3.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(40)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>3 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,500.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-4.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-4.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(28)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>4 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-5.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-5.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(15)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>5 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$1,800.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one wow fadeInUp animated animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-6.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-6.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>6 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,200.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-1.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-1.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>1 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-2.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-2.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(25)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>2 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$2,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-3.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-3.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(40)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>3 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,500.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-4.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-4.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(28)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>4 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,000.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-5.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-5.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(15)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>5 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$1,800.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                                    <div class="feature-block-one">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image"><img src="newFrontend/Clasifico/assets/images/resource/feature-6.jpg" alt=""></figure>
                                                <div class="shape"></div>
                                                <div class="feature">Featured</div>
                                                <div class="icon">
                                                    <div class="icon-shape"></div>
                                                    <i class="icon-16"></i>
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <div class="author-box">
                                                    <div class="inner">
                                                        <img src="newFrontend/Clasifico/assets/images/resource/author-6.png" alt="">
                                                        <h6>Michael Bean<i class="icon-18"></i></h6>
                                                        <span>For sell</span>
                                                    </div>
                                                </div>
                                                <div class="category"><i class="fas fa-tags"></i><p>Electronics</p></div>
                                                <h3><a href="browse-ads-details.html">Villa on Grand Avenue</a></h3>
                                                <ul class="rating clearfix">
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><i class="icon-17"></i></li>
                                                    <li><a href="index.html">(32)</a></li>
                                                </ul>
                                                <ul class="info clearfix">
                                                    <li><i class="far fa-clock"></i>6 months ago</li>
                                                    <li><i class="fas fa-map-marker-alt"></i>G87P, Birmingham, UK</li>
                                                </ul>
                                                <div class="lower-box">
                                                    <h5><span>Start From:</span>$3,200.00</h5>
                                                    <ul class="react-box">
                                                        <li><a href="index.html"><i class="icon-21"></i></a></li>
                                                        <li><a href="index.html"><i class="icon-22"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature-style-two end -->

      <!-- advertisement - banner-section start -->
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
    <!-- advertisement - banner-section end -->

@endsection

       



 