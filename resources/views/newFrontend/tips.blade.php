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
     
    
    </style>

  <!-- Page Title -->
  <section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Tips</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">Home</a></li>
                        <li>Tips</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Page Title -->
    <!-- tips-section -->
    <section class="tips-section">    
    <h1>Tips for Better Ads</h1>

    <div class="container">
        <div class="tips-box">
            <h3>1. Upload clear photos from different angles.</h2>
        </div>

        <div class="tips-box">
            <h3>2.Upload real photos. </h2>
        </div>

        <div class="tips-box">
            <h3>3. Add actual and clear details to impress customers. </h2>
        </div>

        <div class="tips-box">
            <h3>4.Add working contact numbers. </h2>
        </div>

        <div class="tips-box">
            <h3>5. Choose a competitive price. </h2>
        </div>

        <div class="tips-box">
            <h3>6.Select the negotiable option for a better response. </h2>
        </div>
        </div>
    </section>

@endsection

