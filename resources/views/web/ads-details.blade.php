@extends('web.layout.layout')


@section('content')


    <!--=====================================
                    AD DETAILS PART START
        =======================================-->
    <section class="inner-section ad-details-part">
        <div class="container">
            <section class="inner-section" style="margin-bottom: 50px;">
                <div class="container" style="overflow: hidden; padding: 0;">
                    <figure id="zss">
                        @php
                            // Fetch 4 random banners with type 0 (Leaderboard)
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

            <div class="row content-reverse">
                <div class="col-lg-4">

                    <button type="button" class="common-card number" data-toggle="modal" data-target="#number">
                        <h3>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans($data->user->phone_number, app()->getLocale()) }}<h3>
                        <i class="fas fa-phone"></i>
                    </button>

                    <!-- AUTHOR CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('author info', app()->getLocale()) }}</h5>
                        </div>
                        <div class="ad-details-author">

                            @if ($data->user->profileImage != null)
                            <a href="#" class="author-img active">
                                <img src="{{asset('images/user/'.$data->user->profileImage)}}" alt="avatar">
                            </a>
                            @endif
                           
                            <div class="author-meta">
                                <h4><a href="#">{{$data->user->first_name.' '.$data->user->last_name}}</a></h4>
                                @php
                                    use Carbon\Carbon;
                                    $joined = Carbon::parse($data->user->created_at)->format('F d, Y');
                                @endphp
                                <h5>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('joined', app()->getLocale()) }}: {{$joined}}</h5>
                            </div>
                            <div class="author-widget">
                                <a href="/chatify/{{$data->user->id}}" title="Message" class="fas fa-envelope"></a>
                            </div>
                            <ul class="author-list">
                                @php
                                    $total_ads = \App\Models\Ads::where('user_id',$data->user->id)->where('status','<',10)->count();
                                @endphp
                                <li><h6>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('total ads ', app()->getLocale()) }}</h6><p>{{$total_ads}}</p></li>
                            </ul>
                        </div>
                    </div>
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
                    @php
                        // where('sub_cat_id' , $data->sub_cat_id)
                        $topads = \App\Models\Ads::where('status' ,0)->with('ads_vehicles','user', 'main_location', 'sub_location', 'category', 'subcategory')->paginate(4);
                    @endphp
                    @if( count($topads) >4 )
                        <!-- FEATURE CARD -->
                        <div class="common-card">
                            <div class="card-header">
                                <h5 class="card-title"> {{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('featured ads', app()->getLocale()) }}</h5>
                            </div>
                            <div class="ad-details-feature slider-arrow">
                                @foreach($topads as $ads)
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                        @include('web.components.cards.adCards')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-8">
                    <!-- AD DETAILS CARD -->
                    <div class="common-card">
                        <ol class="breadcrumb ad-details-breadcrumb">
                            @if($data->post_type == 0 && $data->post_type != null)
                                    <span class="flat-badge booking">booking</span>
                            @elseif($data->post_type == 1)
                                    <span class="flat-badge sale">sale</span>
                            @elseif($data->post_type == 2)
                                    <span class="flat-badge rent">rent</span>
                            @endif
                            <li class="breadcrumb-item">{{$data->category->name}}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{$data->subcategory->name}}</li>
                        </ol>
                        {{-- <h5 class="ad-details-address">{{$data->main_location->name_en .' / '.$data->sub_location->name_en}}</h5>--}}
                        <h3 class="ad-details-title" style="margin-bottom: 0">{{$data->title}}</h3>
                        <div class="ad-details-meta">
{{--                            <a class="view">--}}
{{--                                <i class="fas fa-eye"></i>--}}
{{--                                <span><strong>({{$data->view_counr}})</strong>preview</span>--}}
{{--                            </a>--}}
                        </div>
                        @if(empty($data->subImage))
                            <div class="ad-details-slider-group">
                                <img src="{{asset('images/Ads/'.$data->mainImage)}}"  style="width: 100%;">
                            </div>
                        @else
                            <div class="ad-details-slider-group">
                                <div class="ad-details-slider slider-arrow">
                                    @php
                                        // Explode the string by comma and trim each filename
                                        $imageArray = explode(", ", $data->subImage);

                                        // Remove square brackets and any whitespace from each filename
                                        $imageArray = array_map(function($filename) {
                                            return trim($filename, "[] ");
                                        }, $imageArray);

                                    @endphp
                                    @foreach($imageArray as $image)
                                        <div><img style="width: auto;margin: 0 auto" src="{{asset('images/Ads/'.$image)}}" alt="details"></div>
                                    @endforeach

                                </div>
                                @if($data->ads_package == 3)
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>top Ad</span>
                                    </div>
                                @elseif($data->ads_package == 4)
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>Urgent Ad</span>
                                    </div>
                                @elseif($data->ads_package == 5)
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>Bump Up Ad</span>
                                    </div>

                                @elseif($data->ads_package == 6)
                                    <div class="cross-vertical-badge product-badge">
                                        <i class="fas fa-fire"></i>
                                        <span>Spotlight Ad</span>
                                    </div>
                                @endif
                            </div>
                            <div class="ad-thumb-slider">
                            @foreach($imageArray as $image)
                                <div><img src="{{asset('images/Ads/'.$image)}}" alt="details"></div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                  
                    
                    <!-- SPECIFICATION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Specification', app()->getLocale()) }}</h5>
                        </div>
                        <ul class="ad-details-specific">
                            <li>
                                <h6>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Price', app()->getLocale())}}:</h6>
                                <p>LKR {{$data->price}}</p>
                            </li>
                            <li>
                                <h6>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('District', app()->getLocale())}}:</h6>
                                {{--   <p>{{$data->main_location->name_en}}</p>--}}
                            </li>
                            <li>
                                <h6>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('city', app()->getLocale())}}:</h6>
                                {{--  <p>{{$data->sub_location->name_en}}</p>--}}
                            </li>
                            <li>
                                <h6>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Category', app()->getLocale())}}:</h6>
                                 <p>{{$data->category->name}}</p>
                            </li>

                            <li>
                                <h6>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Sub Category', app()->getLocale())}}:</h6>
                                <p>{{$data->subcategory->name}}</p>
                            </li>



                            @include('web.components.adsDetailsSpecification.'.$data->category->url)

                        </ul>
                    </div>

                    <!-- DESCRIPTION CARD -->
                    <div class="common-card">
                        <div class="card-header">
                            <h5 class="card-title">{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Description', app()->getLocale()) }}</h5>
                        </div>
                        <p class="ad-details-desc">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($data->description, app()->getLocale())}}</p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--=====================================
                AD DETAILS PART END
    =======================================-->


    <!--=====================================
                RELATED PART START
    =======================================-->
    @php
        $relatedads = \App\Models\Ads::where('status' ,1)->where('sub_cat_id' , $data->sub_cat_id)->with('user', 'main_location', 'sub_location', 'category', 'subcategory')->paginate(5);
    @endphp
    @if(count($relatedads)>0)
        <section class="inner-section related-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-center-heading">
                        <h2>{{ \Stichoza\GoogleTranslate\GoogleTranslate::trans('Related', app()->getLocale()) }}  <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Ads', app()->getLocale())}}</span></h2>
                        <p>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('Lorem ipsum dolor sit amet consectetur adipisicing elit aspernatur illum vel sunt libero voluptatum repudiandae veniam maxime tenetur.', app()->getLocale())}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="related-slider slider-arrow">
                        @foreach($relatedads as $ads)
                            @include('web.components.cards.adCards')
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="center-50">
                        <a href="ad-column3.html" class="btn btn-inline">
                            <i class="fas fa-eye"></i>
                            <span>{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('view all related', app()->getLocale())}}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    <!--=====================================
                RELATED PART START
    =======================================-->

@endsection
