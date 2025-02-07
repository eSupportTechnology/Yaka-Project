<?php $__env->startSection('content'); ?>
<style>

/* Global Styles */


section {
    padding: 60px 20px;
}

/* Headings */
h2 {
    font-size: 2rem;
    color:rgb(4, 20, 66);
    margin-bottom: 20px;
    text-align: center;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(135deg,rgb(233, 169, 233),rgb(255, 255, 255),rgb(195, 209, 228));
    color: white;
    padding: 100px 20px;
    text-align: center;
}

.hero-content {
    max-width: 600px;
    margin: auto;
}
.about p{
    text-align: center;
    font-size: 1.2rem;
}
.cta-button {
    background: white;
    color: #a50034;
    padding: 12px 24px;
    font-size: 1.2rem;
    border-radius: 5px;
    cursor: pointer;
    border: none;
    transition: 0.3s;
    align: center;
}

.cta-button:hover {
    background:rgb(5, 5, 5);
    color: white;
}

/* Features Section */
.features ul {
    list-style: none;
    padding: 0;
}

.features li {
    background: linear-gradient(135deg,rgb(209, 86, 86),rgb(158, 47, 47));
    color: white;
    padding: 20px;
    margin: 10px auto;
    max-width: 600px;
    border-radius: 5px;
}

/* Plans Section */
.plan-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    text-align: center;
}

.plan {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 300px;
    animation: fadeIn 2s ease-in-out;
}

.featured {
    border: 2px solid #a50034;
}

.plan h3 {
    color: #a50034;
}

.plan button {
    background: #a50034;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 10px;
}

.plan button:hover {
    background:rgb(0, 0, 0);
    color: white;
}

/* How It Works */
.how-it-works {
    background: #fff;
}

.steps-container {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}

.step {
    background: linear-gradient(135deg,rgb(238, 183, 183),rgb(255, 255, 255),rgb(240, 197, 197));
    color: black;
    padding: 20px;
    border-radius: 15px;
    width: 250px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Reviews */
.reviews {
    background:rgb(255, 255, 255);
}

.review {
    background: rgb(253, 248, 205);
    padding: 30px;
    margin: 15px auto;
    width: 60%;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgb(134, 9, 9);
    text-align:center;
}

.review h4 {
    color: #a50034;
    margin-top: 10px;
}

/* FAQ */
.faq-item {
    background: linear-gradient(135deg,rgb(238, 183, 183),rgb(255, 255, 255),rgb(240, 197, 197));
    color: black;
    padding: 20px;
    margin: 10px auto;
    max-width: 600px;
    border-radius: 10px;
}

/* Responsive Styles */
@media (max-width: 1024px) {
    h2 {
        font-size: 2rem;
    }

    .plan-container {
        flex-direction: column;
        align-items: center;
    }

    .plan {
        width: 80%;
    }

    .review {
        width: 80%;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 80px 20px;
    }

    h2 {
        font-size: 1.8rem;
    }

    .steps-container {
        flex-direction: column;
    }

    .step {
        width: 80%;
    }

    .review {
        width: 90%;
    }
}

@media (max-width: 480px) {
    h2 {
        font-size: 1.5rem;
    }

    .hero-section {
        padding: 60px 20px;
    }

    .cta-button {
        font-size: 1rem;
        padding: 10px 18px;
    }

    .plan {
        width: 100%;
    }

    .review {
        width: 95%;
    }
}
</style>

<!-- Page Title -->
<section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Ad Posting Allowances</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="index.html">Home</a></li>
                        <li>Ad Posting Alloances</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->
<section class="hero-section">
        <div class="hero-content">
            <h1>Enhance Your Ad Posting Experience</h1>
            <p>Post your ads with premium visibility and get more engagement instantly. Choose the best plan to maximize your reach.</p>
            <button class="cta-button">Get Started</button>
        </div>
    </section>

    <section class="about">
        <h2>Why Upgrade Your Ad Posting?</h2>
        <p>Upgrading your ad posting plan provides increased exposure, better ranking, and more potential buyers. <br>Our platform ensures that your listings get the attention they deserve.</p>
        <p>With a premium plan, your ads will stay visible for a longer period, ensuring maximum engagement and quicker responses.</p>
    </section>

    <section class="features">
        <h2>Key Benefits of Premium Plans</h2>
        <ul>
            <li>🔹 Featured Listings - Appear at the top of search results.</li>
            <li>🔹 Extended Duration - Keep your ads active for a longer period.</li>
            <li>🔹 Priority Support - Get faster assistance when needed.</li>
            <li>🔹 Higher Engagement - Reach more potential customers.</li>
        </ul>
    </section>

    <section class="plans">
        <h2>Choose Your Plan</h2>
        <div class="plan-container">
            <div class="plan">
                <h3>Basic Plan</h3>
                <p>✔ 5 Ads per Month</p>
                <p>✔ Standard Visibility</p>
                <p>✔ 30 Days Active</p>
                <p><strong>$9.99/month</strong></p>
                <button>Select Plan</button>
            </div>
            <div class="plan featured">
                <h3>Pro Plan</h3>
                <p>✔ 15 Ads per Month</p>
                <p>✔ Featured Ads</p>
                <p>✔ 60 Days Active</p>
                <p><strong>$19.99/month</strong></p>
                <button>Select Plan</button>
            </div>
            <div class="plan">
                <h3>Enterprise Plan</h3>
                <p>✔ Unlimited Ads</p>
                <p>✔ Top Priority Visibility</p>
                <p>✔ 90 Days Active</p>
                <p><strong>$49.99/month</strong></p>
                <button>Contact Us</button>
            </div>
        </div>
    </section>

    <!-- New Section: How It Works -->
    <section class="how-it-works">
        <h2>How It Works</h2>
        <div class="steps-container">
            <div class="step">
                <h3>1. Sign Up</h3>
                <p>Create your account in just a few minutes. It's quick, easy, and free!</p>
            </div>
            <div class="step">
                <h3>2. Choose a Plan</h3>
                <p>Select the best plan that suits your needs for better visibility and engagement.</p>
            </div>
            <div class="step">
                <h3>3. Post Your Ad</h3>
                <p>Upload your ad details, and our system will ensure maximum reach and exposure.</p>
            </div>
            <div class="step">
                <h3>4. Get More Views</h3>
                <p>Watch as your ad gets more clicks, inquiries, and conversions effortlessly.</p>
            </div>
        </div>
    </section>

    <!-- New Section: Customer Reviews -->
    <section class="reviews">
        <h2>What Our Customers Say</h2>
        <div class="review">
            <p>"My business grew rapidly after using the premium ad service. Highly recommended!"</p>
            <h4>– Sarah J.</h4>
        </div>
        <div class="review">
            <p>"The featured ad plan was a game-changer for me. I got more responses in just 3 days!"</p>
            <h4>– Michael R.</h4>
        </div>
        <div class="review">
            <p>"Fantastic service! My ad stayed at the top for weeks, bringing in more customers."</p>
            <h4>– Emily D.</h4>
        </div>
    </section>

    <section class="faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-item">
            <h3>How does ad posting work?</h3>
            <p>Once you select a plan, you can start posting your ads immediately. Higher-tier plans offer better visibility.</p>
        </div>
        <div class="faq-item">
            <h3>Can I cancel my subscription?</h3>
            <p>Yes, you can cancel at any time. However, your active ads will remain posted until the end of your current cycle.</p>
        </div>
        <div class="faq-item">
            <h3>Is there a refund policy?</h3>
            <p>We offer a 7-day money-back guarantee if you're not satisfied with our services.</p>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="pt-5 pb-5 col-md-12">
                <h2 class="mt-5 mb-4 text-center">Ads Posting Allowances</h2>
                <p class="mb-4 text-center">Free ad posting is available in every category. Contact us to become a Yaka.lk subscriber and own your stall today.</p>
                
                <ul class="posting-allowances-list">
                    <?php
                        $categories = \App\Models\Category::where('mainId', 0)->where('status', 1)->get();
                    ?>
    
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="mb-2"><?php echo e($key+1); ?>. - <?php echo e($cat->name); ?> - <?php echo e($cat->free_add_count); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
    

    <?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/add_posting.blade.php ENDPATH**/ ?>