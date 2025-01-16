
@if(!empty($data->ads_fashionandbeauty[0]->condition))
    <li>
        <h6>{{GoogleTranslate::trans('Condition', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans(config('constants.CONDITION')[$data->ads_fashionandbeauty[0]->condition], app()->getLocale()) }}</p>
    </li>
@endif
@if(!empty($data->ads_fashionandbeauty[0]->type))
    <li>
        <h6>{{GoogleTranslate::trans('Type', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans($type[$data->ads_fashionandbeauty[0]->type], app()->getLocale()) }}</p>
    </li>
@endif
@if(!empty($data->ads_fashionandbeauty[0]->gender))
    <li>
        <h6>{{GoogleTranslate::trans('Gender', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans(config('constants.GENDER1')[$data->ads_fashionandbeauty[0]->gender], app()->getLocale()) }}</p>
    </li>
@endif



