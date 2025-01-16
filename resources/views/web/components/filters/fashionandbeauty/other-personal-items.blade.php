<form class="product-widget-form" action="{{route('ads.location',[ $nowSearchSubCategoryUrl==0 ? $category->url : $nowSearchSubCategoryUrl, $nowSearchLocation ?? ''])}}" id="filter" method="post">
    @csrf
    @method('POST')
    @include('web.components.filters.common')

</form>
<script>
    function submitForm() {
        document.getElementById("filter").submit();
    }
</script>
