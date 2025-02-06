@extends('newFrontend.master')

@section('content')

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<style>

/* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
:root {
    --primary-color:rgb(238, 235, 235); /* Maroon */
    --secondary-color:rgb(253, 221, 221);
    --text-color: #fff;
    --dark-color: #333;
    --light-color: #f4f4f4;
    --transition: all 0.3s ease-in-out;
}
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}
/* Hero Section */
.hero {
    background:rgb(255, 255, 255);
    color: var(--text-color);
    text-align: center;
    padding: 100px 20px;
    position: relative;
    overflow: hidden;
}
.hero h1 {
    font-size: 2.5rem;
    animation: fadeInDown 4s ease-in-out;
    color: rgb(177, 1, 1);
    text-shadow: 0 0 5px rgba(190, 7, 7, 0.73);
    animation: glow 1.5s infinite alternate;
}
@keyframes glow {
    0% {
        text-shadow: 0 0 5px rgb(143, 10, 10);
    }
    100% {
        text-shadow: 0 0 20px rgb(158, 10, 5);
    }
}
.hero p {
    font-size: 1.4rem;
    margin: 20px 0;
    animation: fadeInUp 2s ease-in-out;
}
.btn {
    display: inline-block;
    margin-top: 30px;
    padding: 12px 25px;
    background: rgb(175, 14, 9);
    color: var(--primary-color);
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    transition: var(--transition);
}
.btn:hover {
    background:  rgb(0, 0, 0);
    color: rgb(255, 255, 255);
}
/* Info Section */
.info {
    display: flex;
    justify-content: center;
    padding: 50px 20px;
    background: rgb(247, 247, 247)
    gap: 20px;
}
.box {
    background: linear-gradient(135deg,rgb(240, 186, 193),rgb(252, 251, 201));
    color: var(--text-color);
    padding: 30px;
    border-radius: 8px;
    text-align: center;
    width: 40%;
    transition: var(--transition);
}
.box:hover {
    transform: scale(1.05);
}
/* Steps Section */
.steps {
    text-align: center;
    padding: 50px 20px;
}
.steps h2 {
    font-size: 2rem;
    color: rgb(27, 2, 119)
}
.step-container {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-top: 20px;
}
.step {
    background: var(--primary-color);
    color: var(--text-color);
    padding: 20px;
    border-radius: 8px;
    width: 30%;
    transition: var(--transition);
}
.step i {
    font-size: 2.5rem;
    margin-bottom: 15px;
    color: rgb(156, 11, 6)
}
.step:hover {
    transform: translateY(-10px);
}
/* Plans Section */
.plans {
    text-align: center;
    padding: 50px 20px;
    background: rgb(250, 250, 250);
}
.plans h2{
    color: rgb(3, 14, 121);
}
.plan-cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}
.plan {
    background: var(--primary-color);
    color: var(--text-color);
    padding: 30px;
    border-radius: 8px;
    width: 30%;
    transition: var(--transition);
}
.plan h3 {
    font-size: 1.5rem;
}
.plan span {
    font-size: 1.2rem;
    font-weight: bold;
    display: block;
    margin: 10px 0;
    color: rgb(0, 0, 0);
}
.plan.popular {
    background: var(--secondary-color);
    color: var(--dark-color);
}
.plan:hover {
    transform: scale(1.1);
}
/* Testimonials */
.testimonials {
    text-align: center;
    padding: 50px 20px;
}
.testimonials h2{
    color: rgb(28, 6, 107);
    margin-bottom: 40px;
}
.testimonial {
    background: linear-gradient(135deg,rgb(233, 232, 172),rgb(245, 203, 203));
    color: var(--text-color);
    padding: 40px;
    border-radius: 10px;
    width: 50%;
    margin: 10px auto;
    transition: var(--transition);
}
.testimonial:hover {
    transform: translateY(-10px);
}
/* Stats Section */
.stats {
    text-align: center;
    padding: 50px 20px;
    background: var(--light-color);
}
.stat-box {
    display: inline-block;
    background: var(--primary-color);
    color: var(--text-color);
    padding: 20px;
    margin: 10px;
    border-radius: 8px;
    transition: var(--transition);
}
.stat-box:hover {
    transform: scale(1.1);
}
/* Call-To-Action */
.cta {
    text-align: center;
    padding: 50px 20px;
    background: linear-gradient(135deg,rgb(195, 215, 216),rgb(242, 244, 247),rgb(244, 207, 245));
    color: var(--text-color);
}
.cta h2 {
    font-size: 2rem;
    color: rgb(19, 4, 104)
}
.cta p {
    margin: 20px 0;
    font-size: 1.2rem;
}
.about-section {
    background:rgb(255, 255, 255);
    padding: 60px 20px;
    text-align: center;
}
.about-content {
    max-width: 1000px;
    margin: auto;
    background: linear-gradient(135deg,rgb(243, 220, 231), rgb(243, 240, 205),rgb(243, 220, 231));
    color: var(--text-color);
    padding: 40px;
    border-radius: 8px;
    transition: var(--transition);
}
.about-content h2 {
    font-size: 2rem;
    margin-bottom: 20px;
    animation: fadeInDown 1s ease-in-out;
    color: rgb(3, 14, 116);
}
.about-content p {
    font-size: 1rem;
    line-height: 1.7;
    margin: 20px 0;
    animation: fadeInUp 1s ease-in-out;
    color: rgb(0, 0, 0);
}
.about-content:hover {
    transform: scale(1.05);
}
/* Responsive Design */
@media (max-width: 1200px) {
    .about-content {
        width: 90%;
        padding: 35px;
    }
    .about-content h2 {
        font-size: 1.8rem;
    }
    .about-content p {
        font-size: 1.1rem;
    }
}
@media (max-width: 992px) {
    .about-content {
        width: 85%;
        padding: 30px;
    }
    .about-content h2 {
        font-size: 1.7rem;
    }
    .about-content p {
        font-size: 1.1rem;
    }
}
@media (max-width: 768px) {
    .about-section {
        padding: 50px 15px;
    }
    .about-content {
        width: 100%;
        padding: 25px;
    }
    .about-content h2 {
        font-size: 1.6rem;
    }
    .about-content p {
        font-size: 1rem;
    }
    /* Flexbox and column layout for smaller screens */
    .info, .step-container, .plan-cards {
        flex-direction: column;
        align-items: center;
    }
    .box, .step, .plan {
        width: 80%;
    }
    .testimonial {
        width: 90%;
    }
}
@media (max-width: 480px) {
    .about-section {
        padding: 40px 10px;
    }
    .about-content {
        width: 100%;
        padding: 20px;
    }
    .about-content h2 {
        font-size: 1.4rem;
    }
    .about-content p {
        font-size: 0.9rem;
    }
    /* Further flexbox adjustments for small screens */
    .info, .step-container, .plan-cards {
        flex-direction: column;
        align-items: center;
    }
    .box, .step, .plan {
        width: 100%;
        margin-bottom: 20px;
    }
}
/* Animations */
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
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
                        <li><a href="index.html">Home</a></li>
                        <li>Boosting Ads</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->

<!-- Hero Section -->
<section class="hero">
        <div class="hero-content">
            <h1>Boost Your Ads & Reach More Customers!</h1>
            <p>Don't miss out on the best deals in Sri Lanka’s largest marketplace!<br> Subscribe now for exclusive offers and discounts.</p>
            <a href="#" class="btn">Sign Up Today</a>
        </div>
    </section>

    <section class="about-section">
    <div class="about-content">
        <h2>Why Choose Our Boosting Ads?</h2>
        <p>
            In today's competitive marketplace, standing out can be a challenge. That's where our boosting ads 
            come into play. With our specialized advertising strategies, we help your brand break through the noise, 
            target the right audience, and drive more traffic to your website. By leveraging cutting-edge analytics 
            and marketing techniques, we ensure your ads reach the people who matter the most – your potential customers.
        </p>
        <p>
            Whether you're promoting a new product, offering discounts, or simply building brand awareness, our platform 
            provides the tools and insights you need to succeed. Our flexible pricing options allow businesses of all 
            sizes to take advantage of this powerful advertising solution. Boost your online presence today and watch 
            your business thrive in ways you never thought possible.
        </p>
    </div>
</section>

<div class="container">
    <div class="row">
      <div class="pt-5 pb-5 col-md-12">
        <h2 class="mt-5 mb-4 text-center">Boosting Ads</h2>
        <p class="mb-4 text-center">Our boosting methods are powered by a fully sophisticated AI-generated algorithm, ensuring quicker results.</p>
        <ul class="text-center boosting-list">
          <li class="mb-2">1. Jump up ads</li>
          <li class="mb-2">2. Top ads</li>
          <li class="mb-2">3. Urgent ads</li>
          <li class="mb-2">4. Super ad</li>
        </ul>
      </div>
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

     <!-- Information Section -->
     <section class="info">
        <div class="box">
            <h2>Why Boost Your Ads?</h2>
            <p>Boosting your ad increases its visibility, making sure more customers see it first. Gain up to 3x more engagement!</p>
        </div>
        <div class="box">
            <h2>Affordable Pricing Plans</h2>
            <p>Choose from flexible plans that fit your budget. Get the best value for money and maximize your ad’s impact.</p>
        </div>
    </section>

    <!-- Plans Section -->
    <section class="plans">
        <h2>Boosting Plans</h2>
        <div class="plan-cards">
            <div class="plan">
                <h3>Basic Plan</h3>
                <span>Rs. 500</span>
                <p>Boost your ad for 7 days.</p>
                <a href="#" class="btn">Choose Plan</a>
            </div>
            <div class="plan popular">
                <h3>Premium Plan</h3>
                <span>Rs. 1200</span>
                <p>Boost your ad for 14 days with premium visibility.</p>
                <a href="#" class="btn">Choose Plan</a>
            </div>
            <div class="plan">
                <h3>Ultimate Plan</h3>
                <span>Rs. 2500</span>
                <p>Boost your ad for 30 days with top ranking.</p>
                <a href="#" class="btn">Choose Plan</a>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials -->
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial">
            <p>"Boosting my ad helped me sell my product within 2 days! Highly recommended."</p>
            <h4>- Raveen, Colombo</h4>
        </div>
        <div class="testimonial">
            <p>"Amazing service! My business got 3x more leads after using the premium boost plan."</p>
            <h4>- Shalini, Kandy</h4>
        </div>
    </section>

    <!-- Stats Section 
    <section class="stats">
        <h2>Why Choose Our Boosting Service?</h2>
        <div class="stat-box">
            <h3>+500K</h3>
            <p>Ads Boosted</p>
        </div>
        <div class="stat-box">
            <h3>3X</h3>
            <p>More Visibility</p>
        </div>
        <div class="stat-box">
            <h3>95%</h3>
            <p>Customer Satisfaction</p>
        </div>
    </section> -->

    <!-- Call To Action -->
    <section class="cta">
        <h2>Start Boosting Your Ads Today!</h2>
        <p>Get more views, more customers, and better sales.</p>
        <a href="#" class="btn">Get Started</a>
    </section>

@endsection

