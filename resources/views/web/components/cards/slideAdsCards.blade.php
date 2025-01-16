<div class="feature-card">
    {{-- <a href="#" class="feature-img">
        <img style="width: auto;margin: 0 auto" src="{{asset('images/Ads/'.$ads->mainImage)}}" alt="feature">
    </a> --}}
    <a href="#" class="feature-img" style="height: 270px;width: 380px;margin: 0 auto;background: url({{asset('images/Ads/'.$ads->mainImage)}});background-size: cover;background-position: center">
        <!--<img  src="{{asset('images/Ads/'.$ads->mainImage)}}" alt="feature">-->
    </a>

    @if($ads->post_type == 0)
        <div class="product-type">
            <span class="flat-badge booking">booking</span>
        </div>

    @elseif($ads->post_type == 1)
        <div class="product-type">
            <span class="flat-badge sale">sale</span>
        </div>

    @elseif($ads->post_type == 2)
        <div class="product-type">
            <span class="flat-badge rent">rent</span>
        </div>
    @endif

    @if($ads->ads_package == 3)
        <div class="cross-vertical-badge product-badge" style="">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="{{asset('01.png')}}" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>top Ad</span>
        </div>

    @elseif($ads->ads_package == 4)
        <div class="cross-vertical-badge product-badge">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="{{asset('03.png')}}" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>Urgent Ad</span>
        </div>

    @elseif($ads->ads_package == 5)
        <div class="cross-vertical-badge product-badge">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="{{asset('04.png')}}" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>Jump up Ad</span>
        </div>

    @elseif($ads->ads_package == 6)
        <div class="cross-vertical-badge product-badge">
            <i style="font-size: 30px;display: block;width: 56px;">
                <img src="{{asset('02.png')}}" alt="" style="width: 39px;margin-top: 4px;">
            </i>
            <span>Super Ad</span>
        </div>
    @endif

    <div class="feature-content" style="padding: 25px; position: absolute;background: none;border-radius: 0px 0px 8px 8px;" >
        <ol class="breadcrumb feature-category">
            <li class="breadcrumb-item"><a href="{{route('ads',[$ads->category->url])}}">{{GoogleTranslate::trans($ads->category->name, app()->getLocale())}}</a>
            </li>
            <li class="breadcrumb-item active"
                aria-current="page">{{GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())}}</li>
        </ol>
        <h3 class="feature-title"><a href="{{route('ads.details',['id'=>$ads->id])}}">{{$ads->title}}</a>
        </h3>
        <div class="feature-meta">
            <span class="feature-price">LKR {{$ads->price}}</span>
            <span class="feature-time"><i  class="fas fa-clock"></i>{{$ads->created_at->diffForHumans()}}</span>
        </div>
    </div>
</div>
