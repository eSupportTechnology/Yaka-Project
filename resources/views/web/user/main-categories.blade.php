@extends('web.user.layout')


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="dash-menu-list">
            <ul>
                <li><a  href="{{route('user.dashboard')}}">dashboard</a></li>
                <li><a  class="active" href="{{route('user.dashboard.ad-post.main')}}">ad post</a></li>
                <li><a href="{{route('user.dashboard.my-ads',['all'])}}">my ads</a></li>
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
    <section id="up" class="adpost-part" style="margin: 50px 50px">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-card alert fade show">
                        <div class="account-title">
                            <h3>Main Categories</h3>
                        </div>
                        <ul class="account-card-text">
                            @foreach($maincategories as $maincategory)
                            <li   style="cursor: pointer;">
                                <a href="{{route('user.dashboard.ad-post.sub',[$maincategory->url])}}"><p @if(isset($okmaincategory) && $okmaincategory->url == $maincategory->url) @endif >{{ $maincategory->name }}</p></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            @if(isset($subcategories))
                <div class="col-lg-6" style="    height: 701px;
    overflow: hidden;
    overflow-y: scroll;">
                    <div class="account-card alert fade show">
                        <div class="account-title">
                            <h3>Sub Categories</h3>
                        </div>
                        <ul class="account-card-text">
                            @foreach($subcategories as $subcategory)
                                <li style="cursor: pointer">
                                    <a href="{{route('user.dashboard.ad-post.main.sub',[$okmaincategory->url,$subcategory->url])}}"><p>{{ $subcategory->name }}</p></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            </div>
        </div>
    </section>

@endsection
