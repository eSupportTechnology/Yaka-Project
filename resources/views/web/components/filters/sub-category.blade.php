<div class="col-md-6 col-lg-12">
    <div class="product-widget">
        <h6 class="product-widget-title">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans('sub categories', app()->getLocale())}}</h6>
        <ul class="product-widget-list product-widget-scroll">
            @foreach($subCategories as $subcategory)
                <li class="product-widget-item">
                    <a href="{{route('ads',[$subcategory->url])}}">
                        <span class="product-widget-text">{{\Stichoza\GoogleTranslate\GoogleTranslate::trans($subcategory->name, app()->getLocale())}}</span>
                        @php
                            $adsCount = \App\Models\Ads::where('sub_cat_id', $subcategory->id )->where('status', 1 )->where('cat_id',$category->id)->count();
                        @endphp
                        <span class="product-widget-number">({{$adsCount}})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
