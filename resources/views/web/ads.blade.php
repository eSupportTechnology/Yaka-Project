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

                        <div class="col-md-6 col-lg-12" style="overflow: hidden;padding: 0px;">
                            <figure id="zss">
                                @php
                                    // Fetch 4 random banners with type 0 (Leaderboard)
                                    $banners = App\Models\Banners::where('type', 1)->inRandomOrder()->limit(4)->get();
                                @endphp

                                @if($banners->count() >= 4)
                                    @foreach ($banners as $banner)
                                        <div class="zss" >
                                            <img style="width: 100%;" src="{{ asset('banners/' . $banner->img) }}" alt="">
                                        </div>
                                    @endforeach
                                    <div class="zss" style="height: 500px;background: url('{{ asset('banners/' . $banners[0]->img) }}') no-repeat; background-size: cover;"></div>
                                @endif
                            </figure>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header-filter">
                                <div class="filter-show">
                                    <span style="text-transform: capitalize"><i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i>  @if($nowSearchLocation == 0) {{\Stichoza\GoogleTranslate\GoogleTranslate::trans('All Locations', app()->getLocale())}} @else {{ \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchLocation), app()->getLocale()) }}@endif</span>
                                </div>
                                <div class="filter-short">
                                    <span style="text-transform: capitalize"><i class="fas fa-tags" style="margin-right: 10px;"></i> {{$nowSearchSubCategoryUrl==0 ? \Stichoza\GoogleTranslate\GoogleTranslate::trans($category->name, app()->getLocale()) : \Stichoza\GoogleTranslate\GoogleTranslate::trans(preg_replace('/-/', ' ', $nowSearchSubCategoryUrl), app()->getLocale()) }}</span>
                                </div>
                                {{-- <div class="filter-action">
                                    <a href="ad-column3.html" title="Three Column" class="active"><i class="fas fa-th"></i></a>
                                    <a href="ad-column2.html" title="Two Column"><i class="fas fa-th-large"></i></a>
                                    <a href="ad-column1.html" title="One Column"><i class="fas fa-th-list"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @if(count($Urgent)>0)
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ad-feature-slider slider-arrow">
                                    @foreach($Urgent as $ads)
                                        @include('web.components.cards.slideAdsCards')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        @foreach($topAdsData as $ads)
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                @include('web.components.cards.adCards')
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        @foreach($adsData as $ads)
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                @include('web.components.cards.adCards')
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        {{ $adsData->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                AD LIST PART END
    =======================================-->
@endsection
