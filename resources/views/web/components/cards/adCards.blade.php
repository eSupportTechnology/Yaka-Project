<div class="product-card

    @if($ads->ads_package == 5) 
    product-jump-up-card " onload="blinkBorder('product-jump-up-card');" 
    @elseif ($ads->ads_package == 3)
    product-top-card " onload="blinkBorder('product-top-card');" 
    @endif

   style="margin-bottom: 10px">
    <div style="width: 100%;margin: 0 auto;"  class="product-media">
        <div class="product-img" style="height: 220px;background: url({{asset('images/Ads/'.$ads->mainImage)}});background-size: cover;background-position: center">
{{--            <img  src="{{asset('images/Ads/'.$ads->mainImage)}}" alt="product">--}}
        </div>

        @if($ads->post_type == 0 && $ads->post_type != null)
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
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="{{asset('01.png')}}" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>top Ad</span>
            </div>

        @elseif($ads->ads_package == 4)
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="{{asset('03.png')}}" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>Urgent Ad</span>
            </div>
        @elseif($ads->ads_package == 5)
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="{{asset('04.png')}}" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>Jump up Ad</span>
            </div>

        @elseif($ads->ads_package == 6)
            <div class="cross-vertical-badge product-badge">
                <i style="font-size: 30px;"> 
                    <img src="{{asset('02.png')}}" alt="" style="width: 39px;margin-top: 4px;">
                </i>
                <span>Super Ad</span>
            </div>
        @endif
    </div>
    <div class="product-content">
        <ol class="breadcrumb product-category">
            <li><i class="fas fa-tags"></i></li>
            <li class="breadcrumb-item"><a href="{{route('ads',[$ads->category->url])}}">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())}}</li>
        </ol>

        <h5 class="product-title">
            <a href="{{route('ads.details',['id'=>$ads->id])}}">{{$ads->title}}</a>
{{--            <a href="{{route('ads.rukshan')}}">{{$ads->title}}</a>--}}
            <div class="product-meta">
{{--            <a href="{{route('ads.rukshan')}}">{{$ads->title}}</a>--}}
            {{--  <span><i class="fas fa-map-marker-alt"></i>{{$ads->main_location->name_en}}, {{$ads->sub_location->name_en}}</span>--}}

                <span><i class="fas fa-clock"></i>{{$ads->created_at->diffForHumans()}}</span>
            </div>
            @if(isset(Session::get('user')['id']) && Session::get('user')['id'] == $ads->user->id &&  $ads->status == 1 &&  $ads->ads_package == 0 && isset($bumpUp) && $bumpUp)
                <a style="margin: 5px 0" href="{{route('ads.bump-up',[$ads->id])}}">
                    <span class="flat-badge rent">Jump up</span>
                </a>
            @endif

{{--            @if(isset(Session::get('user')['id']) && Session::get('user')['id'] == $ads->user->id &&  $ads->status == 1)--}}
{{--                <a style="margin: 5px 0" href="#">--}}
{{--                    <span class="flat-badge sale">Delete</span>--}}
{{--                </a>--}}
{{--            @endif--}}
            @php
                $job = \App\Models\Jobs::where('adsId',$ads->adsId)->select('salary_per_month')->first();
            @endphp
            @if(isset($job->salary_per_month))
            <div class="product-info">

                <h5 class="product-price"> {{$ads->category->url=='jobs' ? "salary per month ".$job->salary_per_month : "LKR ".$ads->price}}</h5>
            </div>
            @endif
        </h5>
    </div>
</div>
