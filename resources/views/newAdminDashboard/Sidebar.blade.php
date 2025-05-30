<style>
    .nav-category-container {
    padding: 10px 0;
}

.nav-divider {
    border: 0;
    height: 1px;
    background: #e0e0e0; /* Light gray color for the divider */
    margin: 0;
}

.nav-category {
    font-size: 14px;
    font-weight: bold;
    color: #6c757d; /* Muted text color */
    margin-top: 15px;
    padding-left: 10px;
}

</style> 

<aside class="navbar-aside shadow-sm" id="offcanvas_aside">
    <div class="aside-top" style="padding:0">
        <a href="" class="brand-wrap">
            <img src="{{asset('yaka-payment.png')}}" class="logo" alt="Yaka" />
        </a>
        <div>
            <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
        </div>
    </div>
    <nav>
        <ul class="menu-aside">
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('dashboard') }}">
                    <i class="icon material-icons md-home"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dashboard.admins') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('dashboard.admins') }}">
                    <i class="icon material-icons md-person"></i>
                    <span class="text">Admin</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dashboard.users') ? 'active' : '' }}">
                <a class="menu-link" href="{{ route('dashboard.users') }}">
                    <i class="icon material-icons md-people"></i>
                    <span class="text">User</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dashboard.categories') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('dashboard.categories')}}">
                    <i class="icon material-icons md-category"></i>
                    <span class="text">Category</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dashboard.form_fields') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('dashboard.form_fields')}}">
                    <i class="icon material-icons md-description"></i>
                    <span class="text">Form Fields for catgories</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dashboard.ads') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('dashboard.ads')}}">
                    <i class="icon material-icons md-folder"></i>
                    <span class="text">Ads</span>
                </a>
            </li>

            <!-- Separator for Configuration -->
            <div class="nav-category-container">
                <hr class="nav-divider" />
                <li class="nav-item nav-category">Configuration</li>
            </div>

            <li class="menu-item {{ request()->routeIs('dashboard.configuration.brands-and-models') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('dashboard.configuration.brands-and-models')}}">
                    <i class="icon material-icons md-business"></i>
                    <span class="text">Brands And Models</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dashboard.packages') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('dashboard.packages')}}">
                    <i class="icon material-icons md-markunread_mailbox"></i>
                    <span class="text">Package</span>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('dashboard.adsTypes') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('dashboard.adsTypes')}}">
                    <i class="icon material-icons md-format_list_bulleted"></i>
                    <span class="text">Types</span>
                </a>
            </li>

            <!-- Separator for Banner -->
            <div class="nav-category-container">
                <hr class="nav-divider" />
                <li class="nav-item nav-category">Banner</li>
            </div>

            <li class="menu-item {{ request()->routeIs('dashboard.banner') ? 'active' : '' }}">
                <a class="menu-link" href="{{route('dashboard.banner')}}">
                    <i class="icon material-icons md-image"></i>
                    <span class="text">Banner</span>
                </a>
            </li>
        </ul>
        <hr />
        <br />
        <br />
    </nav>
</aside>
