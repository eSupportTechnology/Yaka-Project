<section class="dash-header-part">
    <div class="container">
        <div class="dash-header-card">
            <div class="row">
                <div class="col-lg-5">
                    <div class="dash-header-left">
                        <div class="dash-avatar">
                            @if(isset(Session::get('user')['profileImage']) && Session::get('user')['profileImage']!='')
                                <a href="#"><img src="{{asset('images/user/'.Session::get('user')['profileImage'])}}" alt="user"></a>

                            @else
                                <a href="#"><img src="{{asset('web/images/user.png')}}" alt="user"></a>
                            @endif
                        </div>
                        <div class="dash-intro">
                            <h4><a href="#">{{Session::get('user')['first_name']." ".Session::get('user')['last_name']}}</a></h4>
                            <h5>{{Session::get('user')['url']}}</h5>
                            {{-- <h5>new seller</h5> --}}
                            <ul class="dash-meta">
                                <li>
                                    <i class="fas fa-phone-alt"></i>
                                    <span>{{Session::get('user')['phone_number']}}</span>
                                </li>
                                @if(Session::get('user')['email']!=null)
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <span>{{Session::get('user')['email']}}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="dash-header-right">
                        <div class="dash-focus dash-list">
                            <h2>{{GoogleTranslate::trans('Post', app()->getLocale())}}</h2>
                            <p>{{GoogleTranslate::trans('Your Ads', app()->getLocale())}}</p>
                        </div>
                        <div class="dash-focus dash-book">
                            <h2>{{GoogleTranslate::trans('Need', app()->getLocale())}}</h2>
                            <p> {{GoogleTranslate::trans('To Buy ', app()->getLocale())}}</p>
                        </div>
                        <div class="dash-focus dash-rev">
                            <h2>{{GoogleTranslate::trans('Boost', app()->getLocale())}}</h2>
                            <p>{{GoogleTranslate::trans('Your Ads', app()->getLocale())}}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="dash-header-alert alert fade show">
                        <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and Edit your password and account details.</p>
                        <button data-dismiss="alert"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div> --}}
            
