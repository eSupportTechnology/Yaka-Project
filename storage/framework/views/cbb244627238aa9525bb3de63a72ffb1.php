<?php $__env->startSection('content'); ?>

<style>
        /* Google Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* Basic Reset */
        .tips-section{
            background-color: rgba(255, 255, 255, 0.98); 
            padding: 50px 0px;
        }

        .tips-box {
            background: linear-gradient(135deg,rgb(248, 223, 223),rgb(255, 255, 255),rgb(226, 232, 240));
            padding: 20px;

            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            width:80%;
        }

        .tips-box:hover {
            transform: scale(1.05);
            background: rgb(255, 255, 255);
        }

        .tips-box h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
        }


    </style>

  <!-- Page Title -->
  <section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Tips for Better Ads</h1>
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
    <div class="container d-flex flex-column align-items-center">
        <div class="tips-box">
            <h3>1. Upload clear photos from different angles</h3>
        </div>

        <div class="tips-box">
            <h3>2. Upload real photos</h3>
        </div>

        <div class="tips-box">
            <h3>3. Add actual and clear details to impress customers</h3>
        </div>

        <div class="tips-box">
            <h3>4. Add working contact numbers</h3>
        </div>

        <div class="tips-box">
            <h3>5. Choose a competitive price</h3>
        </div>

        <div class="tips-box">
            <h3>6. Select the negotiable option for a better response</h3>
        </div>
    </div>
</section>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/tips.blade.php ENDPATH**/ ?>