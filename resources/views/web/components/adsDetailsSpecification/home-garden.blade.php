@if(!empty($data->ads_homegarden[0]->condition))
    <li>
        <h6>{{ GoogleTranslate::trans('Condition', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans(config('constants.CONDITION')[$data->ads_homegarden[0]->condition], app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_homegarden[0]->brand))
    <li>
        <h6> {{ GoogleTranslate::trans('brand', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $brands[$data->ads_homegarden[0]->brand] , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_homegarden[0]->type))
    <li>
        <h6> {{ GoogleTranslate::trans('Type', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans( $type[$data->ads_homegarden[0]->type] , app()->getLocale()) }}</p>
    </li>
@endif



