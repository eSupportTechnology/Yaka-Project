<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<title>Yaka</title>

<!-- Fav Icon -->
<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Stylesheets -->
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/font-awesome-all.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/flaticon.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/owl.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/bootstrap.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/jquery.fancybox.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/animate.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/nice-select.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/color.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/style.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/responsive.css')); ?>" rel="stylesheet">
<link href="<?php echo e(asset('newFrontend/Clasifico/assets/css/user-form.css')); ?>" rel="stylesheet">
<style>
    .signup-section {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}
</style>
</head>
<body>
    <section class="user-form-part">
        <div class="user-form-banner">
            <div class="user-form-content">
                <a href="#"><img src="<?php echo e(asset('Logo-re.png')); ?>" alt="logo"></a>
                <h1>Advertise your assets <span>Buy what you want</span></h1>
                <p>Biggest online marketplace in Sri Lanka</p> 
            </div>
        </div>
    
        <div class="user-form-category">
            <div class="user-form-header">
                <a href="#"><img src="<?php echo e(asset('yaka-payment.png')); ?>" alt="logo"></a>
                <a href="/"><i class="fas fa-arrow-left"style="color: red;"></i></a>
            </div>
           
    
            <div class="tab-pane active" id="register-tab">
                
                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
    
                <?php if(session('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
    
    <!-- Login Section -->
    <section class="login-section bg-color-2">
        <div class="auto-container">
            <div class="inner-container">
                <div class="inner-box">
                    <h2>Log in</h2>
                    <form action="<?php echo e(route('custom.login')); ?>" method="POST" class="login-form">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone_number" required>
                            <?php $__errorArgs = ['phone_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" required>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="error-message"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group message-btn">
                            <button type="submit" class="theme-btn-one">Login Now</button>
                        </div>
                    </form>
                    <div class="other-content centred">
                        <div class="text"><span>or</span></div>
                        <div class="othre-text">
                            <p>Don’t have an account? <a href="<?php echo e(route('register')); ?>">Register Now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- jQuery plugins -->
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/jquery.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/owl.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/wow.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/validation.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/jquery.fancybox.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/appear.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/scrollbar.js')); ?>"></script>
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/jquery.nice-select.min.js')); ?>"></script>

<!-- main-js -->
<script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/script.js')); ?>"></script>

    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/owl.js')); ?>"></script>
    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/jquery.fancybox.js')); ?>"></script>
    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/appear.js')); ?>"></script>
    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/scrollbar.js')); ?>"></script>
    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/jquery.nice-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/bxslider.js')); ?>"></script>
    <!-- main-js -->

    <script src="<?php echo e(asset('newFrontend/Clasifico/assets/js/script.js')); ?>"></script>
</body>
</html>

<?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/newFrontend/login.blade.php ENDPATH**/ ?>