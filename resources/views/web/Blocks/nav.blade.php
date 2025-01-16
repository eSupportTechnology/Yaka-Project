<div style="background-color:rgb(92, 2, 2) !important; padding: 6px 12px 6px 12px !important;" class="header-content">

    <div style="color: #ffffff !important;" class="header-form row">
        <div class="col-md-4 col-sm-10 d-flex"><i style="margin-right:15px !important;" class="fa-solid fa-phone mt-1"></i> <span>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Contact',app()->getLocale())}} : 070 5 321 321</span></div>
        <div class="col-md-4 col-sm-10 d-flex"><i style="margin-right:15px !important;"  class="fa-solid fa-envelope  mt-1"></i> <span>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Email', app()->getLocale())}} : Info@yaka.lk</span></div>
        <div class="col-md-4 col-sm-10 d-flex"><i style="margin-right:15px !important;"  class="fa-solid fa-location-dot  mt-1"></i> <span>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Loaction', app()->getLocale())}} : Colombo 10, Sri Lanka</span>
        </div>
    </div>

    <div style="color: #ffffff !important;" class="header-right"> 
    <button 
        class="btn changeLang" 
        data-lang="en" 
        style="padding: 12px 25px; border-radius: 8px; font-size: 16px; background-color: {{ session()->get('locale') == 'en' ?  : '#6c#28a74757d' }}; color: white; border: none;">
        English
    </button>
    <button 
        class="btn changeLang" 
        data-lang="si" 
        style="padding: 12px 25px; border-radius: 8px; font-size: 17px; background-color: {{ session()->get('locale') == 'si' ?  : '#6c#28a74757d' }}; color: white; border: none;">
        සිංහල
    </button>
    <button 
        class="btn changeLang" 
        data-lang="ta" 
        style="padding: 12px 25px; border-radius: 8px; font-size: 16px; background-color: {{ session()->get('locale') == 'ta' ?  : '#6c#28a74757d' }}; color: white ; border: none;">
        தமிழ்
    </button>
</div>


   

    <div style="color: #ffffff !important;" class="header-right">

        <span>
            <a href="https://www.facebook.com/profile.php?id=61565478456618" target="_blank">
                <i style="font-size: 20px  !important; color: white !important;" class="fab fa-facebook p-2"></i>
            </a>
        </span>
        <span>
            <a href="https://www.instagram.com/yaka.lk6/" target="_blank">
                <i style="font-size: 20px  !important; color: white !important;" class="fab fa-instagram p-2"></i>
            </a>
        </span>
   {{-- <span>
            <a href="" target="_blank">
                <i style="font-size: 20px  !important; color: white !important;" class="fab fa-tiktok p-2"></i>
            </a>
        </span> --}}
        <span>
            <a href="https://www.youtube.com/@Yakalk-g5d" target="_blank">
                <i style="font-size: 20px  !important; color: white !important;" class="fab fa-youtube p-2"></i>
            </a>
        </span>
        <!-- Added Instagram Icon -->

        <!-- Added TikTok Icon -->

    </div>

</div>

<header class="header-part"  style="background-color:rgb(49, 3, 3); padding: 15px 0;">
    <div class="container">
        <div class="header-content">
            <div class="header-left">
                <a style="margin: 0px 45px 0 0;" href="{{route('/')}}" class="header-logo">
                    <img src="{{asset('Logo-re.png')}}" alt="logo">
                </a>


                <button type="button" class="header-widget search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <form class="header-form" method="get" action="{{route('search')}}">
                <div class="header-search">
                    <button type="submit" title="Search Submit "><i class="fas fa-search"></i></button>
                    <input required type="text" value="{{ $_GET['search'] ?? "" }}" placeholder="{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Search,  Category Name , sub category Name , district  you needs...', app()->getLocale())}}" name="search">
                </div>
            </form>

            <div class="header-right">
                @if(isset(Session::get('user')['id']))
                    <a href="{{route('user.dashboard')}}" class="btn btn-inline post-btn">
                        <i class="fas fa-user"></i>
                        <span>{{Session::get('user')['first_name']. ' '.Session::get('user')['last_name']}}</span>
                    </a>
                @else
                    <a href="{{route('login')}}" class="btn btn-inline post-btn">
                        <i class="fas fa-user"></i>
                        <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Login / Register', app()->getLocale())}}</span>
                    </a>
                @endif
                <a href="{{route('user.dashboard.ad-post.main')}}" class="btn btn-inline post-btn">
                    <i class="fas fa-plus-circle"></i>
                    <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('post your ad', app()->getLocale())}}</span>
                </a>
            </div>
        </div>
    </div>

{{--        <div style="background-color: #ffffff !important; padding: 6px 12px 6px 12px !important; border-top:solid rgb(211, 208, 208) 1px !important; border-bottom:solid rgb(211, 208, 208) 1px !important;" class="header-content">--}}
{{--            <div class="header-left ">--}}
{{--                <ul class="nav">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a style="color: #5DA300" class="nav-link" href="http://127.0.0.1:8000"><p>Home</p></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a style="color: #000000" class="nav-link" href="#"><p>About</p></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a style="color: #000000" class="nav-link disabled"><p>Contact</p></a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}

</header>



