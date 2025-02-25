@extends('newFrontend.master')

@section('content')



<!-- Page Title -->
<section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Ad Posting Criteria</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">Home</a></li>
                        <li>Ad Posting Criteria</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->
        <style>
    /* General Section Styling */
    .criteria-section, .criteria-section1 {
        text-align: center;
        border-radius: 10px;
        margin: 30px auto;
        animation: fadeIn 1s ease-in-out;
    }


    /* Title & Paragraph Styling */
    .criteria-section h2, .criteria-section1 h2 {
        font-size: 2rem;
        color: rgb(156, 11, 6);
        margin-bottom: 15px;
        text-transform: uppercase;
    }

    .criteria-section p, .criteria-section1 p {
        font-size: 1.2rem;
        color: #333;
        margin-bottom: 20px;
    }

    /* Posting Criteria List */
    .posting-criteria-list {
        list-style: none;
        padding: 0;
    }

    .posting-criteria-list li {
        background: rgb(156, 11, 6);
        color: white;
        padding: 12px;
        margin: 8px 0;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: 500;
        transition: transform 0.3s, background 0.3s;
    }

    .posting-criteria-list li:hover {
        background: rgb(200, 20, 15);
        transform: scale(1.05);
    }

    /* Step Container */
    .steps {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 30px;
    }

    /* Step Circle */
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: rgb(156, 11, 6);
        color: white;
        font-size: 1.4rem;
        font-weight: bold;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out, background 0.3s;
    }

    .step:hover {
        transform: scale(1.1);
        background-color: rgb(200, 20, 15);
    }

    .step span {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .step p {
        margin-top: 10px;
        font-size: 1rem;
        font-weight: 500;
        color: white;
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Main Title & Posting Criteria -->
<section class="criteria-section1 fade-in center-text" style="max-width: 1000px;">
    <h2>Welcome to Our Advertising Platform!</h2>
    <p>Please ensure your ad meets the following standards for a smooth experience.</p>
    <ul class="text-center posting-criteria-list">
        <li>1. Use correct quality pictures regarding the item.</li>
        <li>2. Strictly only legal items.</li>
        <li>3. Photos should match the item or service.</li>
        <li>4. Do not post alcohol, tobacco, or related drugs.</li>
        <li>5. Use correct contact numbers.</li>
        <li>6. Do not post prohibited items.</li>
        <li>7. Do not post several items in a single ad.</li>
    </ul>
</section>

<!-- Ad Approval Process -->
<section class="criteria-section fade-in right-align" style="margin:50px 0; background-color: rgb(233, 233, 233); padding:30px 20px;">
    <h2>Ad Approval Process</h2>
    <p>
        Once you submit an ad, it goes through a <b>4-step approval process</br> to maintain quality. Ads are reviewed based on their content, legitimacy, and compliance with our policies.
    </p>
    <div class="steps">
        <div class="step"><span>1</span><p>Submit Ad</p></div>
        <div class="step"><span>2</span><p>Review</p></div>
        <div class="step"><span>3</span><p>Approval</p></div>
        <div class="step"><span>4</span><p>Live</p></div>
    </div>
</section>


    @endsection

