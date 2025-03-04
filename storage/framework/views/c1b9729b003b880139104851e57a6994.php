<?php $__env->startSection('content'); ?>



<!-- Page Title -->
<section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1><?php echo app('translator')->get('messages.Ad posting criteria'); ?></h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="<?php echo e(route( '/')); ?>"><?php echo app('translator')->get('messages.Home'); ?></a></li>
                        <li><?php echo app('translator')->get('messages.Ad posting criteria'); ?></li>
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
    <h2><?php echo app('translator')->get('messages.welcome_title'); ?></h2>
    <p><?php echo app('translator')->get('messages.welcome_description'); ?></p>
    <ul class="text-center posting-criteria-list">
        <li><?php echo app('translator')->get('messages.posting_criteria_1'); ?></li>
        <li><?php echo app('translator')->get('messages.posting_criteria_2'); ?></li>
        <li><?php echo app('translator')->get('messages.posting_criteria_3'); ?></li>
        <li><?php echo app('translator')->get('messages.posting_criteria_4'); ?></li>
        <li><?php echo app('translator')->get('messages.posting_criteria_5'); ?></li>
        <li><?php echo app('translator')->get('messages.posting_criteria_6'); ?></li>
        <li><?php echo app('translator')->get('messages.posting_criteria_7'); ?></li>
    </ul>
</section>

<!-- Ad Approval Process -->
<section class="criteria-section fade-in right-align" style="margin:50px 0; background-color: rgb(233, 233, 233); padding:30px 20px;">
    <h2><?php echo app('translator')->get('messages.approval_process_title'); ?></h2>
    <p><?php echo app('translator')->get('messages.approval_process_description'); ?></p>
    <div class="steps">
        <div class="step"><span>1</span><p><?php echo app('translator')->get('messages.approval_step_1'); ?></p></div>
        <div class="step"><span>2</span><p><?php echo app('translator')->get('messages.approval_step_2'); ?></p></div>
        <div class="step"><span>3</span><p><?php echo app('translator')->get('messages.approval_step_3'); ?></p></div>
        <div class="step"><span>4</span><p><?php echo app('translator')->get('messages.approval_step_4'); ?></p></div>
    </div>
</section>


    <?php $__env->stopSection(); ?>


<?php echo $__env->make('newFrontend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/add_post.blade.php ENDPATH**/ ?>