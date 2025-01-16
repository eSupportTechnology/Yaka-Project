<form class="product-widget-form" action="{{route('ads.location',[ $nowSearchSubCategoryUrl==0 ? $category->url : $nowSearchSubCategoryUrl, $nowSearchLocation ?? ''])}}" id="filter" method="post">
    @csrf
    @method('POST')

    @include('web.components.filters.common')




    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title"> {{GoogleTranslate::trans('service type', app()->getLocale())}}</h6>
            <div>
                <ul class="product-widget-list">
                    @php
                        $filter_service_type = Session::get('filter_service_type') ?? [];
                    @endphp
                    @foreach($typs as $key => $service_type)
                        <li class="product-widget-item">
                            <div class="product-widget-checkbox">
                                <input  name="service_type[]" @if(in_array($service_type->id, $filter_service_type)) checked @endif  value="{{$service_type->id}}" type="checkbox" id="new">
                            </div>
                            <label class="product-widget-label" for="check1">
                                <span class="product-widget-type" style="color: #0D0A0A">{{$service_type->name }} </span>
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
    </div>

</form>
<script>
    function submitForm() {
        document.getElementById("filter").submit();
    }
</script>
