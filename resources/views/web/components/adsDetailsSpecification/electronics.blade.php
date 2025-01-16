@if(!empty($data->ads_electronics[0]->condition))
    <li>
        <h6> {{ GoogleTranslate::trans('Condition', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans( config('constants.CONDITION')[$data->ads_electronics[0]->condition] , app()->getLocale()) }}</p>
    </li>
@endif
@if(!empty($data->ads_electronics[0]->brand))
    <li>
        <h6> {{ GoogleTranslate::trans('Brand', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans( $brands[$data->ads_electronics[0]->brand] , app()->getLocale())}}</p>
    </li>
@endif

@if(!empty($data->ads_electronics[0]->model))
    <li>
        <h6>{{ GoogleTranslate::trans('Model', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $model[$data->ads_electronics[0]->model] , app()->getLocale())}}</p>
    </li>
@endif

@if(!empty($data->ads_electronics[0]->specialization))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{ GoogleTranslate::trans('specialization', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_electronics[0]->specialization , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_electronics[0]->type))
    <li>
        <h6> {{ GoogleTranslate::trans('type', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans( $type[$data->ads_electronics[0]->type] , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_electronics[0]->screen_size))
    <li>
        <h6>{{ GoogleTranslate::trans('Screen Size', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_electronics[0]->screen_size , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_electronics[0]->capacity))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{ GoogleTranslate::trans('Capacity', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( config('constants.CAPACITY')[$data->ads_electronics[0]->capacity] , app()->getLocale()) }}</p>
    </li>
@endif

