
@if(!empty($data->ads_education[0]->condition))
    <li>
        <h6>{{GoogleTranslate::trans('condition', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans(config('constants.CONDITION')[$data->ads_education[0]->condition], app()->getLocale()) }}</p>
    </li>
@endif
@if(!empty($data->ads_education[0]->type))
    <li>
        <h6>{{GoogleTranslate::trans('Type', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans($type[$data->ads_education[0]->type], app()->getLocale()) }}</p>
    </li>
@endif




