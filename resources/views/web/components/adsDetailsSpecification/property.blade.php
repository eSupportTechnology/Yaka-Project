@if(!empty($data->ads_property[0]->condition))
    <li>
        <h6>{{GoogleTranslate::trans('Condition', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( config('constants.CONDITION')[$data->ads_property[0]->condition], app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_property[0]->brand))
    <li>
        <h6>{{GoogleTranslate::trans('Brand', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $brands[$data->ads_property[0]->brand] , app()->getLocale())}}</p>
    </li>
@endif

@if(!empty($data->ads_property[0]->size_of_land))
    <li>
        <h6>{{GoogleTranslate::trans('Land Size', app()->getLocale())}}:</h6>
        <p>{{GoogleTranslate::trans($data->ads_property[0]->size_of_land . ' '. config('constants.UNIT')[$data->ads_property[0]->unit], app()->getLocale())}}</p>
    </li>
@endif

@if(!empty($data->ads_property[0]->size_sf))
    <li>
        <h6>{{ GoogleTranslate::trans('House Size (Sqft)', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans($data->ads_property[0]->size_sf, app()->getLocale())  }}</p>
    </li>
@endif

@if(!empty($data->ads_property[0]->address))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{GoogleTranslate::trans('Address', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_property[0]->address , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_property[0]->rooms))
    <li>
        <h6>{{GoogleTranslate::trans('Bedrooms', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans($data->ads_property[0]->rooms, app()->getLocale()) }}</p>
    </li>
@endif


@if(!empty($data->ads_property[0]->bathrooms))
    <li>
        <h6> {{GoogleTranslate::trans('Bathrooms', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans($data->ads_property[0]->bathrooms, app()->getLocale()) }}</p>
    </li>
@endif


@if(!empty($data->ads_property[0]->type))
    <li>
        <h6>{{ GoogleTranslate::trans('Type', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $type[$data->ads_property[0]->type] , app()->getLocale()) }}</p>
    </li>
@endif



