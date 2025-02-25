@extends('newFrontend.master')

@section('content')

<style> 


/* Sections */
.criteria-section1 {
    max-width: 1000px;
    height: 500px;
    justify-content: center;
    align-items: center;
    margin: 50px auto;
    padding-top: 40px;
    background: linear-gradient(135deg,rgb(233, 169, 233),rgb(255, 255, 255),rgb(195, 209, 228));
    box-shadow: 0px 4px 15px rgb(124, 6, 6);
    border-radius: 10px;
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}
.criteria-section {
    max-width: 900px;
    margin: 50px auto;
    padding: 60px;
    background: rgb(226, 226, 226)
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    opacity: 0;
    transform: translateY(50px);
    transition: opacity 1s ease-in-out, transform 1s ease-in-out;
}

/* Typography */
h1 {
    font-size: 36px;
    color: rgb(75, 0, 0);
    text-align: center;
    animation: fadeInDown 4s ease-in-out;
    text-shadow: 0 0 5px rgba(190, 7, 7, 0.73);
    animation: glow 1.5s infinite alternate;
}

h2 {
    font-size: 28px;
    color: rgb(6, 5, 85);
    font-weight: bold;
}
h2::after{
    content:"";
    display: block;
    width: 100%;
    height: 3px;
    background-color: rgba(190, 7, 7, 0.73);
    position: absolute;
    left: 0;
    bottom: -5px;
}

p {
    font-size: 18px;
    color: #555;
    line-height: 1.6;
    margin-top: 30px;
}

/* Alignment */
.center-text {
    text-align: center;
}

.left-align {
    text-align: left;
    transform: translateX(-50px);
}

.right-align {
    text-align: right;
    transform: translateX(50px);
}

/* Steps */
.steps {
    display: flex;
    justify-content: center;
    padding: 20px;
    margin-top: 20px;
    text-align: center;
}

.step {
    text-align: center;
    background: linear-gradient(135deg,rgb(194, 17, 41),rgb(255, 255, 255));
    padding: 10px;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    font-weight: bold;
    margin-left: 50px;
}
.step span{
    display: block;
    align-items: center;
    justify-content: center;
    color: white;
}
.step p{
    font-size: 22px;
    color: black;
}

/* Pricing Table */
.pricing-table {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.price-card {
    width: 30%;
    padding: 20px;
    text-align: center;
    border-radius: 8px;
    background: #f9f9f9;
    font-size: 20px;
    font-weight: bold;
    transition: transform 0.3s ease-in-out;
}

.price-card:hover {
    transform: scale(1.1);
}

.premium { background: gold; }
.vip { background:rgb(185, 2, 2); color:rgb(255, 255, 255); }

/* Animations */
.fade-in {
    animation: fadeIn 1s ease-in-out forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

.slide-in {
    animation: slideIn 1s ease-in-out forwards;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}

/* Responsive */
@media (max-width: 768px) {
    .steps, .pricing-table { flex-direction: column; }
    .price-card { width: 100%; margin-bottom: 15px; }
    .left-align, .right-align { text-align: center; transform: none; }
}
</style>

<!-- Page Title -->
<section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Ad Posting Criteria</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="index.html">Home</a></li>
                        <li>Ad Posting Criteria</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->
     <!--  Section: Main Title -->
     <section class="criteria-section1 fade-in center-text">
        <h1>Ad Posting Criteria</h1>
        <p>Welcome to our advertising platform!</p>
        <p> Please ensure your ad meets the following standards for a smooth experience.</p>
        <br>
        <ul class="text-center posting-criteria-list">
            <li class="mb-2">1. Use correct quality pictures regarding the item.</li>
            <li class="mb-2">2. Strictly only legal items.</li>
            <li class="mb-2">3. Photos should match the item or service.</li>
            <li class="mb-2">4. Do not post alcohol, tobacco, or related drugs.</li>
            <li class="mb-2">5. Use correct contact numbers.</li>
            <li class="mb-2">6. Do not post prohibited items.</li>
            <li class="mb-2">7. Do not post several items in a single ad.</li>
          </ul>
    </section>

    <!-- Section: General Guidelines -->
    <section class="criteria-section slide-in left-align">
        <h2>General Guidelines</h2>
        <p>
            Every advertisement posted on our platform should be *clear, concise, and accurate*. Misleading or inappropriate content will not be tolerated.  
            Ensure your ads contain *proper grammar and formatting* to provide the best user experience.  
            *Contact details must be valid* to avoid ad rejection.  
        </p>
    </section>

    <!--  Section: Approval Process -->
    <section class="criteria-section fade-in right-align">
        <h2>Ad Approval Process</h2>
        <p>
            Once you submit an ad, it goes through a *4-step approval process* to maintain quality. Ads are reviewed based on their content, legitimacy, and compliance with our policies.
        </p>
        <div class="steps">
            <div class="step"><span>1</span><p>Submit Ad</p></div>
            <div class="step"><span>2</span><p>Review</p></div>
            <div class="step"><span>3</span><p>Approval</p></div>
            <div class="step"><span>4</span><p>Live</p></div>
        </div>
    </section>

    <!-- Section: Expiry & Renewal -->
    <section class="criteria-section slide-in left-align">
        <h2>Ad Expiry & Renewal</h2>
        <p>
            Each ad remains active for *30 days*. To continue visibility, renew the ad before expiration.  
            Expired ads will be removed automatically from search results.  
            Our system sends notifications before expiration so you never miss a renewal deadline.  
        </p>
    </section>

    <!-- Section: Pricing Plans -->
    <section class="criteria-section fade-in right-align">
        <h2>Pricing & Featured Ads</h2>
        <p>
            We offer *multiple pricing plans* based on your advertising needs. Featured ads gain *higher visibility and premium exposure*, helping businesses reach potential customers faster.
        </p>
        <div class="pricing-table">
            <div class="price-card">
                <h3>Basic</h3>
                <p>Free - 30 Days</p>
            </div>
            <div class="price-card premium">
                <h3>Premium</h3>
                <p>$10 - 45 Days</p>
            </div>
            <div class="price-card vip">
                <h3>VIP</h3>
                <p>$25 - 60 Days</p>
            </div>
        </div>
    </section>
    @endsection

