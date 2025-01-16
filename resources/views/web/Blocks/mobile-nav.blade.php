<nav class="mobile-nav">
    <div class="container">
        <div class="mobile-group">
            <a href="/" class="mobile-widget">
                <i class="fas fa-home"></i>
                <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('home', app()->getLocale())}}</span>
            </a>

            @if(isset(Session::get('user')['id']))
                <a href="{{route('user.dashboard')}}" class="mobile-widget">
                    <i class="fas fa-user"></i>
                    <span>{{Session::get('user')['first_name']}}</span>
                </a>
                <a href="{{route('user.dashboard.ad-post.main')}}" class="mobile-widget plus-btn">
                    <i class="fas fa-plus"></i>
                    <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Ad Post', app()->getLocale())}}</span>
                </a>
            @else
                <a href="{{route('login')}}" class="mobile-widget">
                    <i class="fas fa-user"></i>
                    <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('SignIn / SingUp', app()->getLocale())}} </span>
                </a>
                <a href="{{route('about-us')}}" class="mobile-widget">
                    <i class="fas fa-envelope"></i>
                    <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('About Us', app()->getLocale())}}</span>
                </a>
            @endif
           
            
            
            <a href="{{route('contact-us')}}" class="mobile-widget">
                <i class="fas fa-envelope"></i>
                <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Contact', app()->getLocale())}}</span>
            </a>
            
        </div>
    </div>
</nav>
