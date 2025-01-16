@extends('web.user.layout')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="dash-menu-list">
            <ul>
                <li><a  href="{{route('user.dashboard')}}">dashboard</a></li>
                <li><a   href="{{route('user.dashboard.ad-post.main')}}">ad post</a></li>
                <li><a class="active" href="{{route('user.dashboard.my-ads',['all'])}}">my ads</a></li>
                <li><a href="{{route('user.dashboard.setting',[Session::get('user')['url']])}}">Profile</a></li>
                <li><a href="/chatify">message</a></li>
                <li><a href="{{route('logout')}}">logout</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
</section>
    <section class="myads-part" style="margin: 50px 50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-title">
                        <div style="display: flex">
                            <h5><a style="width: 125px;@if($type=='active')     color: var(--white);
                                        background: var(--primary);
                                        text-shadow: var(--primary-tshadow); @endif"
                                   href="{{route('user.dashboard.my-ads',['active'])}}">Active Ads</a></h5><span
                                style="margin: 0 10px">/</span><h5><a style="width: 125px;@if($type=='pending')     color: var(--white);
                                        background: var(--primary);
                                        text-shadow: var(--primary-tshadow); @endif"
                                                                      href="{{route('user.dashboard.my-ads',['pending'])}}">Pending
                                    Ads</a></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    @foreach($data as $key => $ads)
                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                            @include('web.components.cards.adCards')
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-pagection">
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

