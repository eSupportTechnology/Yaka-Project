<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard')}}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.admins')}}">
                <i class="mdi mdi-account-circle menu-icon"></i>
                <span class="menu-title">Admin</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.users')}}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.categories')}}">
                <i class="mdi mdi-folder menu-icon"></i>
                <span class="menu-title">Category</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.ads')}}">
                <i class="mdi mdi-folder menu-icon"></i>
                <span class="menu-title">Ads</span>
            </a>
        </li>


        <li class="nav-item nav-category">configuration</li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.configuration.brands-and-models')}}">
                <i class="mdi mdi-bullhorn menu-icon"></i>
                <span class="menu-title">Brands And Models</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.packages')}}">
                <i class="mdi mdi-bullhorn menu-icon"></i>
                <span class="menu-title">Package</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.adsTypes')}}">
                <i class="mdi mdi-bullhorn menu-icon"></i>
                <span class="menu-title">Types</span>
            </a>
        </li>


        <li class="nav-item nav-category">Banner</li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('dashboard.banner')}}">
                <i class="mdi mdi-bullhorn menu-icon"></i>
                <span class="menu-title">Banner</span>
            </a>
        </li>
    </ul>
</nav>
