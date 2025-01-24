@extends('web.layout.layout')


@section('content')

    <!--=====================================
                  SINGLE BANNER PART START
        =======================================-->
    <section class="inner-section single-banner" style="margin-bottom: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>{{$nowSearchSubCategoryUrl==0 ? \Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale()) : \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchSubCategoryUrl), app()->getLocale())}}</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('/')}}">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Home', app()->getLocale())}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$nowSearchSubCategoryUrl==0 ?  \Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale()): \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchSubCategoryUrl), app()->getLocale())}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="inner-section" style="margin-bottom: 50px;">
        <div class="container" style="overflow: hidden; padding: 0;">
            <figure id="zss">
                @php
                    $banners = App\Models\Banners::where('type', 0)->inRandomOrder()->limit(4)->get();
                @endphp
                @if($banners->count() >= 4)
                    @foreach ($banners as $banner)
                        <div class="zss" >
                            <img style="width: 100%;" src="{{ asset('banners/' . $banner->img) }}" alt="">
                        </div>
                    @endforeach
                    <div class="zss" style="background: url('{{ asset('banners/' . $banners[0]->img) }}') no-repeat; background-size: cover;"></div>
                @endif
            </figure>
        </div>
    </section>

    <!--=====================================
              SINGLE BANNER PART END
    =======================================-->


    <!--=====================================
                AD LIST PART START
    =======================================-->
    <section class="inner-section ad-list-part">
        <div class="container" style="background-color:white; padding:20px">
        <div class="row content-reverse">
            <!-- Left Filter Section -->
            <div class="col-lg-4 col-xl-3">
                <div class="row">
                    @if($nowSearchSubCategoryUrl != 0)
                        @include('web.components.filters.location')
                        @if($adsurl == 'jobs')
                            @include('web.components.filters.'.$adsurl.'.'.$adsurl)
                        @else
                            @include('web.components.filters.'.$adsurl.'.'.$nowSearchSubCategoryUrl)
                        @endif
                    @else
                        @include('web.components.filters.category')
                        @include('web.components.filters.sub-category')
                    @endif
                </div>
            </div>

            <!-- Main Content and Banner Section -->
            <div class="col-lg-8 col-xl-9">
                <div class="row">
                    <!-- Main Content Section -->
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="header-filter">
                                    <div class="filter-show">
                                        <span style="text-transform: capitalize">
                                            <i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>
                                            @if($nowSearchLocation == 0)
                                                {{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('All Locations', app()->getLocale()) }}
                                            @else
                                                {{ \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchLocation), app()->getLocale()) }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="filter-short">
                                        <span style="text-transform: capitalize">
                                            <i class="fas fa-tags" style="margin-right: 10px;"></i>
                                            {{ $nowSearchSubCategoryUrl == 0 ? \Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale()) : \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchSubCategoryUrl), app()->getLocale()) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($Urgent) > 0)
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="slider-arrow" style="width: 100%; padding: 0; margin-bottom: 50px">
                                        @foreach($Urgent as $ads)
                                            <div class="feature-card" style="width: 100%; padding: 0;">
                                                <a href="#" class="feature-img" style="height: 270px;width: 100%;margin: 0 auto;background: url({{asset('images/Ads/'.$ads->mainImage)}});background-size: cover;background-position: center">
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
                                                    <div class="cross-vertical-badge product-badge">
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

                                                <div class="feature-content" style="padding: 25px; position: absolute; background: none; border-radius: 0px 0px 8px 8px;">
                                                    <ol class="breadcrumb feature-category">
                                                        <li class="breadcrumb-item"><a href="{{route('ads',[$ads->category->url])}}">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())}}</a></li>
                                                        <li class="breadcrumb-item active" aria-current="page">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())}}</li>
                                                    </ol>
                                                    <h3 class="feature-title"><a href="{{route('ads.details',['id'=>$ads->id])}}">{{$ads->title}}</a></h3>
                                                    <div class="feature-meta">
                                                        <span class="feature-price">LKR {{$ads->price}}</span>
                                                        <span class="feature-time"><i class="fas fa-clock"></i>{{$ads->created_at->diffForHumans()}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="row">
                            @foreach($topAdsData as $ads)
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <div style="width:190px;  margin-bottom:10px" class="product-card
                                        @if($ads->ads_package == 5) 
                                        product-jump-up-card " onload="blinkBorder('product-jump-up-card');" 
                                        @elseif ($ads->ads_package == 3)
                                        product-top-card " onload="blinkBorder('product-top-card');" 
                                        @endif
                                    style="margin-bottom: 10px">
                                        <div style="width: 100%;margin: 0 auto;" class="product-media">
                                            <div class="product-img" style="height: 150px;background: url({{asset('images/Ads/'.$ads->mainImage)}});background-size: cover;background-position: center">
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
                                        <div class="product-content" >
                                            <ol class="breadcrumb product-category">
                                                <li><i class="fas fa-tags"></i></li>
                                                <li class="breadcrumb-item"><a href="{{route('ads',[$ads->category->url])}}">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())}}</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())}}</li>
                                            </ol>

                                            <h5 class="product-title">
                                                <a href="{{route('ads.details',['id'=>$ads->id])}}" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{$ads->title}}
                                                </a>
                                            </h5>


                                            <div class="product-meta">
                                                <span><i class="fas fa-clock"></i>{{$ads->created_at->diffForHumans()}}</span>
                                            </div>

                                            @php
                                                $job = \App\Models\Jobs::where('adsId',$ads->adsId)->select('salary_per_month')->first();
                                            @endphp
                                            @if(isset($job->salary_per_month))
                                            <div class="product-info">
                                                <h5 class="product-price"> {{$ads->category->url=='jobs' ? "salary per month ".$job->salary_per_month : "LKR ".$ads->price}}</h5>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @foreach($adsData as $ads)
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <div style="width:190px;  margin-bottom:10px" class="product-card
                                        @if($ads->ads_package == 5) 
                                        product-jump-up-card " onload="blinkBorder('product-jump-up-card');" 
                                        @elseif ($ads->ads_package == 3)
                                        product-top-card " onload="blinkBorder('product-top-card');" 
                                        @endif
                                    style="margin-bottom: 10px">
                                        <div style="width: 100%;margin: 0 auto;" class="product-media">
                                            <div class="product-img" style="height: 150px;background: url({{asset('images/Ads/'.$ads->mainImage)}});background-size: cover;background-position: center">
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
                                        <div class="product-content" >
                                            <ol class="breadcrumb product-category">
                                                <li><i class="fas fa-tags"></i></li>
                                                <li class="breadcrumb-item"><a href="{{route('ads',[$ads->category->url])}}">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->category->name, app()->getLocale())}}</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($ads->subcategory->name, app()->getLocale())}}</li>
                                            </ol>

                                            <h5 class="product-title">
                                                <a href="{{route('ads.details',['id'=>$ads->id])}}" style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    {{$ads->title}}
                                                </a>
                                            </h5>


                                            <div class="product-meta">
                                                <span><i class="fas fa-clock"></i>{{$ads->created_at->diffForHumans()}}</span>
                                            </div>

                                            @php
                                                $job = \App\Models\Jobs::where('adsId',$ads->adsId)->select('salary_per_month')->first();
                                            @endphp
                                            @if(isset($job->salary_per_month))
                                            <div class="product-info">
                                                <h5 class="product-price"> {{$ads->category->url=='jobs' ? "salary per month ".$job->salary_per_month : "LKR ".$ads->price}}</h5>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="row">
                         
                        </div>

                        <div class="row">
                            {{ $adsData->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                    <!-- Vertical Banner Section -->
                    <div class="col-lg-3">
                        <div class="banner-section" style="position: sticky; top: 10px;">
                            @php
                                // Fetch banners
                                $banners = App\Models\Banners::where('type', 1)->inRandomOrder()->limit(3)->get();
                            @endphp

                            @if($banners->count() > 0)
                                @foreach($banners as $banner)
                                    <div class="banner-ad mb-3">
                                        <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner" style="width: 100%; border-radius: 5px;">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
    <!--=====================================
                AD LIST PART END
    =======================================-->
@endsection
