<form class="product-widget-form" action="{{route('ads.location',[ $nowSearchSubCategoryUrl==0 ? $category->url : $nowSearchSubCategoryUrl, $nowSearchLocation ?? ''])}}" id="filter" method="post">
    @csrf
    @method('POST')

    @include('web.components.filters.common')

    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title">{{GoogleTranslate::trans('Brands', app()->getLocale())}}</h6>
            <ul class="product-widget-list product-widget-scroll">
                @php
                    $retrievedArray = Session::get('filter_brand') ?? [];
                @endphp
                @foreach($brands as $key => $brand)
                    <li class="product-widget-item">
                        <div class="product-widget-checkbox">
                            <input  name="brand[]" @if(in_array($brand->id, $retrievedArray)) checked @endif value="{{ $brand->id }}" type="checkbox" id="{{ $brand->url }}">
                        </div>
                        <label class="product-widget-label" for="{{ $brand->url }}">
                            <span class="product-widget-type" style="color: #0D0A0A">{{ $brand->name }}</span>
                            <span class="product-widget-number"></span>
                        </label>
                    </li>
                @endforeach
            </ul>
            <button type="submit" class="product-widget-btn">
                <i class="fas fa-search"></i>
                <span>Add Filter </span>
            </button>
        </div>
    </div>

    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title">{{GoogleTranslate::trans('Year of Manufacture', app()->getLocale())}}</h6>
            <div class="product-widget-group">
                <input type="number" value="{{session('filter_manufacture_year_min') ?? 0}}" name="manufacture_year_min" placeholder="min">
                <input type="number" value="{{session('filter_manufacture_year_max') ?? 0}}" name="manufacture_year_max" placeholder="max">
            </div>
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
