
<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
            <div class="aside-top" style="padding:0">
                <a href="" class="brand-wrap" >
                    <img src="<?php echo e(asset('yaka-payment.png')); ?>" class="logo" alt="Yaka" />
                </a>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    <li class="menu-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                        <a class="menu-link" href="<?php echo e(route('dashboard')); ?>">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                   
                   

                </ul>
                <hr />

                <br />
                <br />
            </nav>
        </aside><?php /**PATH C:\xampp\htdocs\Yaka-Project\resources\views/adminPanel/newDashboard/Sidebar.blade.php ENDPATH**/ ?>