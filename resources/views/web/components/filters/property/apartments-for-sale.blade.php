<form class="product-widget-form" action="{{route('ads.location',[ $nowSearchSubCategoryUrl==0 ? $category->url : $nowSearchSubCategoryUrl, $nowSearchLocation ?? ''])}}" id="filter" method="post">
    @csrf
    @method('POST')
    @include('web.components.filters.common')


    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title">{{GoogleTranslate::trans('apartment Size</h6>
            <div class="product-widget-group">
                <input type="number" value="{{session('filter_size_sf_min') ?? 0}}" name="size_sf_min" placeholder="min - 00">
                <input type="number" value="{{session('filter_size_sf_max') ?? 0}}" name="size_sf_max" placeholder="max - 1B">
            </div>
            <button type="submit" class="product-widget-btn">
                <i class="fas fa-search"></i>
                <span>Add Filter</span>
            </button>
        </div>
    </div>

    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title">Bathrooms </h6>
            <ul class="product-widget-list product-widget-scroll">
                @php
                    $retrievedArray = Session::get('filter_bathrooms') ?? [];
                @endphp
                @foreach(config('constants.BEDROOMS') as $key => $bathrooms)
                    <li class="product-widget-item">
                        <div class="product-widget-checkbox">
                            <input @if(in_array($key, $retrievedArray)) checked @endif  name="bathrooms[]" value="{{ $key }}" type="checkbox" id="">
                        </div>
                        <label class="product-widget-label" for="{">
                            <span class="product-widget-type" style="color: #0D0A0A">{{ $bathrooms }}</span>
                            <span class="product-widget-number"></span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <button type="submit" class="product-widget-btn">
                <i class="fas fa-search"></i>
                <span>Add Filter</span>
            </button>
        </div>
    </div>

    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title">{{GoogleTranslate::trans('Bedrooms', app()->getLocale())}}</h6>
            <ul class="product-widget-list product-widget-scroll">
                @php
                    $retrievedArray = Session::get('filter_rooms') ?? [];
                @endphp
                @foreach(config('constants.BEDROOMS') as $key => $rooms)
                    <li class="product-widget-item">
                        <div class="product-widget-checkbox">
                            <input @if(in_array($key, $retrievedArray)) checked @endif  name="rooms[]" value="{{ $key }}" type="checkbox" id="">
                        </div>
                        <label class="product-widget-label" for="{">
                            <span class="product-widget-type" style="color: #0D0A0A">{{ $rooms }}</span>
                            <span class="product-widget-number"></span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <button type="submit" class="product-widget-btn">
                <i class="fas fa-search"></i>
                <span>Add Filter</span>
            </button>
        </div>
    </div>



</form>
<script>
    function submitForm() {
        document.getElementById("filter").submit();
    }
</script>
