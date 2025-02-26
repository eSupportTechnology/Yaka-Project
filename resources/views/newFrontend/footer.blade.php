<style>
    .fb-icon i {
    background-color: #3b5998; 
}

.insta-icon i {
    background: linear-gradient(45deg, #f9ce34, #ee2a7b, #6228d7);
}

.twitter-icon i {
    background-color: #0082ca;
}

.linkedin-icon i {
    background-color: #0082ca;
}

.whatsppfb-icon i {
    background-color: #25d366;
}

.utube-icon i {
    background-color: #ed302f;
}


.sidebar-icon i {
    width: 43px;
    height: 43px;
    display: flex;  
    justify-content: center;  
    align-items: center; 
    border-radius: 50%; 
    color: white;
}

</style>
<!-- main-footer -->
 <footer class="main-footer">
            <div class="footer-top" style="  background:rgb(88, 12, 12) ;">
                <div class="auto-container">
                    <div class="widget-section">
                        <div class="clearfix row">
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget logo-widget">
                                    <figure class="footer-logo"><a href="index.html"><img src="{{asset('Logo-re.png')}}" alt=""></a></figure>
                                    <div class="text">
                                        <p>@lang('messages.para4')</p>
                                    </div>
                                    <ul class="clearfix social-links sidebar-social-media">
                                        <li><a href="index.html" class="sidebar-icon fb-icon"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="index.html" class="sidebar-icon twitter-icon"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="index.html" class="sidebar-icon insta-icon"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="index.html" class="sidebar-icon utube-icon"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget links-widget ml-70">
                                    <div class="widget-title">
                                        <h3>@lang('messages.Quick Links')</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="clearfix links-list">
                                            <li><a href="{{route(name: 'about-us')}}">@lang('messages.About')</a></li>
                                            <li><a href="{{route('contact-us')}}">@lang('messages.Contact')</a></li>
                                            <li><a href="{{route('privacy-safety')}}">@lang('messages.Privacy & Safety')</a></li>
                                            <li><a href="{{route('terms-conditions')}}">@lang('messages.Terms & Conditions')</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget links-widget ml-70">
                                    <div class="widget-title">
                                        <h3>@lang('messages.General')</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="clearfix links-list">
                                            <li><a href="{{route('tips')}}">@lang('messages.Tips')</a></li>
                                            <li><a href="{{route('boosting_ads')}}">@lang('messages.Boosting ads')</a></li>
                                            <li><a href="{{route('add_posting')}}">@lang('messages.Ad posting allowances')</a></li>
                                            <li><a href="{{route('add_post')}}">@lang('messages.Ad posting criteria')</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                                <div class="footer-widget contact-widget">
                                    <div class="widget-title">
                                        <h3>@lang('messages.Contact')</h3>
                                    </div>
                                    <div class="widget-content">
                                        <ul class="clearfix info-list">
                                            <li>
                                                <i class="fas fa-map-marker-alt"></i>
                                               Colombo 10,Sri Lanka
                                            </li>
                                            <li>
                                                <i class="fas fa-microphone"></i>
                                                <a href="tel:070 5 321 321">070 5 321 321</a>
                                            </li>
                                            <li>
                                                <i class="fas fa-envelope"></i>
                                                <a href="mailto:Yaka.lk@outlook.com">Yaka.lk@outlook.com</a>
                                                <a href="mailto:Yakalksrilanka@gmail.com">Yakalksrilanka@gmail.com</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="clearfix footer-inner">
                        <div class="copyright pull-left"><p>Copyright © 2025 . All Rights Reserved.</p></div>
                        <ul class="clearfix footer-nav pull-right">
                            <li><a href="index.html"></a></li>
                            <li><a href="index.html"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->