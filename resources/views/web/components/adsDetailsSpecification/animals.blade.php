@if(!empty($data->ads_animals[0]->condition))
    <li>
        <h6>{{GoogleTranslate::trans('Condition', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans(config('constants.CONDITION')[$data->ads_animals[0]->condition], app()->getLocale()) }}</p>
    </li>
@endif


@if(!empty($data->ads_animals[0]->type))
    <li>
        <h6>{{GoogleTranslate::trans('Type', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans($type[$data->ads_animals[0]->type], app()->getLocale())}}</p>
    </li>
@endif



