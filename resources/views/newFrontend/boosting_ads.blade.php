@extends('newFrontend.master')

@section('content')

<style>


.boosting-section:hover {
    transform: scale(1.02);
}

.boosting-section h2 {
    font-size: 2rem;
    margin-bottom: 20px;
}

.boosting-list {
    list-style: none;
    padding: 0;
}

.boosting-list li {
    font-size: 1.2rem;
    margin-bottom: 10px;
    padding: 10px;
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.2);
    transition: background 0.3s ease-in-out;
}

.boosting-list li:hover {
    background-color: rgba(255, 255, 255, 0.4);
}

/* Ads Description */
.ad-type {
    margin: 40px 0;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    background: linear-gradient(135deg, rgb(255, 235, 235), white, rgb(226, 232, 240));
    transition: transform 0.3s ease-in-out;
    position: relative;
    overflow: hidden;
}

.ad-type:hover {
    transform: scale(1.05);
    background: rgb(255, 255, 255);
}

.ad-type h3 {
    font-size: 1.5rem;
    color: rgb(156, 11, 6);
    margin-bottom: 10px;
}

/* Steps Section */
.steps {
    text-align: center;
    padding: 50px 20px;
    background-color: #f8f9fa;
}

.steps h2 {
    font-size: 2rem;
    color: rgb(156, 11, 6);
    margin-bottom: 20px;
}

.step-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.step {
    background: white;
    padding: 20px;
    width: 350px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease-in-out, background 0.3s ease-in-out;
    position: relative;
}

.step:hover {
    transform: translateY(-5px);
    background: rgb(255, 240, 240);
}

.step i {
    font-size: 2rem;
    color: rgb(156, 11, 6);
    margin-bottom: 10px;
    display: block;
}

.step h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.step p {
    font-size: 1rem;
}

</style>

 <!-- Page Title -->
 <section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Boosting Ads</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">Home</a></li>
                        <li>Boosting Ads</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->


<!-- Boosting Ads Section -->
<div class="container" style=" max-width: 900px;">

    <!-- Ads Details -->
    <div class="ad-type">
        <h3>Jump Up Ads</h3>
        <p>Jump Up Ads allow you to move your ad back to the top of the list periodically, increasing visibility. This ensures your ad stays in front of potential buyers for a longer time.</p>
    </div>

    <div class="ad-type">
        <h3>Top Ads</h3>
        <p>At every page, there are 4 top slots available for top ads. If you apply for top ads, your ad will appear on top of those slots, increasing responses. Top ads are bigger than free ads, with a green blinking border for more visibility.</p>
    </div>

    <div class="ad-type">
        <h3>Super Ads</h3>
        <p>Super ads are designed to grab immediate attention, featuring a premium slot at the top with a blue blinking border and rocket symbol. They stand out as soon as they're promoted and also appear as free ads for extra visibility.</p>
    </div>

    <div class="ad-type">
        <h3>Urgent Ads</h3>
        <p>We have some special promotions for selling urgently. Urgent ads have a blinking red border and an urgent badge, which is a great advantage to get more attention quickly.</p>
    </div>
</div>

<!-- Steps Section -->
<section class="steps">
    <h2>How to Boost Your Ad?</h2>
    <div class="step-container">
        <div class="step">
            <i class="fas fa-upload"></i>
            <h3>1. Upload Your Ad</h3>
            <p>Add your product or service details and images.</p>
        </div>
        <div class="step">
            <i class="fas fa-bullhorn"></i>
            <h3>2. Choose a Boost Plan</h3>
            <p>Select a plan that best fits your needs.</p>
        </div>
        <div class="step">
            <i class="fas fa-chart-line"></i>
            <h3>3. Get More Views</h3>
            <p>Your ad gets higher visibility and engagement!</p>
        </div>
    </div>
</section>



@endsection

