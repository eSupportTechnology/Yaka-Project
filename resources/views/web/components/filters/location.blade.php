<div class="col-md-6 col-lg-12">
    <div class="product-widget">
        <h6 class="product-widget-title">{{GoogleTranslate::trans('Location', app()->getLocale())}}</h6>
        <ul class="product-widget-list product-widget-scroll">
            @foreach($locations as $location)
                <li class="product-widget-item">
                    <a href="{{route('ads.location',[ $nowSearchSubCategoryUrl==0 ? $category->url : $nowSearchSubCategoryUrl, $location->url])}}">
                        <span class="product-widget-text">{{GoogleTranslate::trans($location->name_en, app()->getLocale())}}</span>
                        @php
                            $locationId = $nowSearchSubCategoryUrl != 0 ? (\App\Models\Category::where('url', $nowSearchSubCategoryUrl)->where('status', 1 )->select('id')->firstOrFail())->id : (\App\Models\Category::where('url', $category->url)->where('status', 1 )->select('id')->firstOrFail())->id;

                            $adsCount = \App\Models\Ads::where('location', $location->id)->where('status', 1 );

                            if ($nowSearchSubCategoryUrl) {
                                $adsCount->where('sub_cat_id', $locationId);
                            } else {
                                $adsCount->where('cat_id', $category->id);
                            }
                            $adsCount = $adsCount->count();
                        @endphp

                        <span class="product-widget-number">({{$adsCount}})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
