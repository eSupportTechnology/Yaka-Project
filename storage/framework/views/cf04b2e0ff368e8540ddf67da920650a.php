<?php $__env->startSection('content'); ?>
<div class="row">
        <h1>Welcome to admin panel.</h1>
        <div class="col-sm-12">
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

             <dotlottie-player src="https://lottie.host/f4161653-a903-4d65-b8c2-0bf4fd4421f5/YlKLOKHVb0.json" background="transparent" speed="1" style="    width: 100%;height: 50%;" loop autoplay></dotlottie-player>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('newAdminDashboard.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views\newAdminDashboard\Home.blade.php ENDPATH**/ ?>