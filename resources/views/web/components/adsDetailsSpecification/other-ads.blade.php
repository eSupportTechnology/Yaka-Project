

@if(!empty($data->ads_services[0]->type))
    <li>
        <h6>{{GoogleTranslate::trans('Type', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $type[$data->ads_services[0]->type] , app()->getLocale()) }}</p>
    </li>
@endif



