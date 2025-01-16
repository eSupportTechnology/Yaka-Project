@if(!empty($data->ads_jobs[0]->role))
    <li>
        <h6>{{GoogleTranslate::trans('Job Role', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans($data->ads_jobs[0]->role, app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_jobs[0]->job_type))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{ GoogleTranslate::trans('Job Type', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans($data->ads_jobs[0]->job_type, app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_jobs[0]->application_deadline))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{ GoogleTranslate::trans('Application Deadline', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_jobs[0]->application_deadline , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_jobs[0]->experience))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{ GoogleTranslate::trans('Experience', app()->getLocale()) }}:</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_jobs[0]->experience , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_jobs[0]->cv_sent_email))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{ GoogleTranslate::trans('CV Sent Email', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_jobs[0]->cv_sent_email , app()->getLocale()) }}</p>
    </li>
@endif

@if(!empty($data->ads_jobs[0]->salary_per_month))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px"> {{ GoogleTranslate::trans('Salary Per Month', app()->getLocale()) }} :</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_jobs[0]->salary_per_month , app()->getLocale()) }}</p>
    </li>
@endif


@if(!empty($data->ads_jobs[0]->education))
    <li style="display: flex;flex-direction: column;align-items: start">
        <h6 style="margin-bottom: 5px">{{ GoogleTranslate::trans('Education', app()->getLocale())}}:</h6>
        <p>{{ GoogleTranslate::trans( $data->ads_jobs[0]->education , app()->getLocale()) }}</p>
    </li>
@endif


