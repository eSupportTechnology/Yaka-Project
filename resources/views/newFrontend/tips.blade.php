@extends('newFrontend.master')

@section('content')

<style>
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* Basic Reset */
        .tips-section{
            background-color: rgba(255, 255, 255, 0.98); 
        }
        h1 {
            padding-top: 50px;
            font-size: 3rem;
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            text-align: center;
            color: rgba(134, 0, 0, 0.87);
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }

        .tips-box {
            background: linear-gradient(135deg,rgb(248, 223, 223),rgb(255, 255, 255),rgb(226, 232, 240));
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .tips-box:hover {
            transform: scale(1.05);
            background: rgb(255, 255, 255);
        }

        .tips-box h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }

        .tips-box p {
            font-size: 1.2rem;
            color: black;
        }

        .image-box {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .image-box img {
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .tips-box h2 {
                font-size: 1.8rem;
            }

            .tips-box p {
                font-size: 1rem;
            }

            .image-box img {
                width: 100%;
            }
        }
        /* Sections */
    .content-section {
        background-color: rgba(248, 248, 248, 0.98); 
        padding: 30px;
        margin: 30px 0;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        text-align: left;
        animation: fadeInUp 1s ease-in-out;
    }

    .content-section h2 {
        font-size: 2rem;
        color:rgb(23, 8, 80);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .content-section p {
        font-size: 1.2rem;
        line-height: 1.6;
        margin-top: 10px;
        color: black;
    }

    .content-list {
        list-style: none;
        padding: 0;
        margin-top: 15px;
    }

    .content-list li {
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 8px;
        margin: 10px 0;
        color: black;
    }

    .content-list i {
        color:rgb(87, 5, 19);
        font-size: 1.3rem;
    }

    .animated-button {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 25px;
        font-size: 1.2rem;
        font-weight: bold;
        color: white;
        background: linear-gradient(90deg,rgb(134, 2, 2),rgb(156, 11, 6));
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        text-decoration: none;
    }

    .animated-button:hover {
        background: linear-gradient(90deg,rgb(0, 0, 0),rgb(2, 2, 2));
        transform: scale(1.05);
        color: white;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .content-section h2 {
            font-size: 1.8rem;
        }

        .content-section p {
            font-size: 1rem;
        }

        .content-list li {
            font-size: 1rem;
        }
    }
    </style>

  <!-- Page Title -->
  <section class="page-title style-two" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Tips</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="index.html">Home</a></li>
                        <li>Tips</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->
    <!-- tips-section -->
    <section class="tips-section">    
    <h1>Growing Marketplace Tips</h1>

    <div class="container">
        <div class="tips-box">
            <h3>1. Understand Your Market</h2>
            <p>Analyze your target audience, competitors, and trends to stay ahead.</p>
        </div>

        <div class="tips-box">
            <h3>2. Focus on User Experience</h2>
            <p>Ensure easy navigation, fast loading times, and a seamless checkout process.</p>
        </div>

        <div class="tips-box">
            <h3>3. Leverage Social Media</h2>
            <p>Utilize platforms like Facebook, Instagram, and LinkedIn for promotions.</p>
        </div>

        <div class="tips-box">
            <h3>4. Offer Competitive Pricing</h2>
            <p>Balance affordability with profitability to attract and retain customers.</p>
        </div>

        <div class="tips-box">
            <h3>5. Optimize for Mobile</h2>
            <p>Ensure your website is fully responsive and mobile-friendly.</p>
        </div>

        <a href="#" class="animated-button">Learn More</a>
    </div>
    </section>

    <!-- Customer Trust & Security Section -->
<section class="content-section">
    <div class="container">
        <h2><i class="fas fa-shield-alt"></i> Customer Trust & Security</h2>
        <p>Customer trust is the foundation of a successful marketplace. Here’s how you can ensure safety and security for your users:</p>
        
        <ul class="content-list">
            <li><i class="fas fa-lock"></i> Implement SSL encryption for secure transactions.</li>
            <li><i class="fas fa-user-check"></i> Enable two-factor authentication (2FA) for user accounts.</li>
            <li><i class="fas fa-search"></i> Conduct regular security audits and vulnerability scans.</li>
            <li><i class="fas fa-file-alt"></i> Maintain a clear and transparent privacy policy.</li>
            <li><i class="fas fa-balance-scale"></i> Ensure fair dispute resolution and buyer protection policies.</li>
        </ul>
    </div>
</section>

<!-- Marketing & Growth Strategies Section -->
<section class="content-section">
    <div class="container">
        <h2><i class="fas fa-bullhorn"></i> Marketing & Growth Strategies</h2>
        <p>Want to expand your marketplace? Implement these marketing and growth strategies to attract and retain customers:</p>

        <ul class="content-list">
            <li><i class="fas fa-chart-line"></i> Use SEO techniques to rank higher in search engines.</li>
            <li><i class="fab fa-facebook"></i> Leverage social media marketing on Facebook, Instagram, and LinkedIn.</li>
            <li><i class="fas fa-envelope"></i> Run targeted email marketing campaigns to engage users.</li>
            <li><i class="fas fa-ad"></i> Invest in Google Ads and social media paid promotions.</li>
            <li><i class="fas fa-user-friends"></i> Build a referral program to increase customer acquisition.</li>
        </ul>

        <a href="#" class="animated-button">Get Started</a>
    </div>
</section>
@endsection

