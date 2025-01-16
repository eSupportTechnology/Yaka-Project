<form class="product-widget-form" action="{{route('ads.location',[ $nowSearchSubCategoryUrl==0 ? $category->url : $nowSearchSubCategoryUrl, $nowSearchLocation ?? ''])}}" id="filter" method="post">
    @csrf
    @method('POST')
    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title">{{GoogleTranslate::trans('Salary', app()->getLocale())}}</h6>
            <div class="product-widget-group">
                <input type="number" value="{{session('filter_minsalary_per_month') ?? 0}}" name="minsalary_per_month" placeholder="min - 00">
                <input type="number" value="{{session('filter_maxsalary_per_month') ?? 0}}" name="maxsalary_per_month" placeholder="max - 1B">
            </div>
            <button type="submit" class="product-widget-btn">
                <i class="fas fa-search"></i>
                <span>Add Filter</span>
            </button>
        </div>
    </div>

    <div class="col-md-6 col-lg-12">
        <div class="product-widget">
            <h6 class="product-widget-title">{{GoogleTranslate::trans('Job Type', app()->getLocale())}}</h6>
            <ul class="product-widget-list product-widget-scroll">
                @php
                    $retrievedArray = Session::get('filter_job_type') ?? [];
                @endphp
                @foreach(config('constants.JOBTYPE') as $jobtype)
                    <li class="product-widget-item">
                        <div class="product-widget-checkbox">
                            <input  name="job_type[]" @if(in_array($jobtype, $retrievedArray)) checked @endif value="{{ $jobtype }}" type="checkbox" id="{{ $jobtype }}">
                        </div>
                        <label class="product-widget-label" for="{{ $jobtype }}">
                            <span class="product-widget-type" style="color: #0D0A0A">{{ $jobtype }}</span>
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
            <h6 class="product-widget-title">{{GoogleTranslate::trans('Education', app()->getLocale())}}</h6>
            <ul class="product-widget-list product-widget-scroll">
                @php
                    $retrievedArray = Session::get('filter_education') ?? [];
                @endphp
                @foreach(config('constants.EDUCATION') as $ed)
                    <li class="product-widget-item">
                        <div class="product-widget-checkbox">
                            <input  name="education[]" @if(in_array($ed, $retrievedArray)) checked @endif value="{{ $ed }}" type="checkbox" id="{{ $ed }}">
                        </div>
                        <label class="product-widget-label" for="{{ $ed }}">
                            <span class="product-widget-type" style="color: #0D0A0A">{{ $ed }}</span>
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
</form>
<script>
    function submitForm() {
        document.getElementById("filter").submit();
    }
</script>
