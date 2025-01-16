<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Jobs - Job', app()->getLocale())}}</h3>
    </div>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Job Role', app()->getLocale())}}</label>
                <input type="text" onfocus="noneerror('role')" name="role" class="form-control" placeholder="Type your product title here" value="{{old('role') ?? ""}}">
                @if ($errors->has('role'))
                    <div class="alert alert-danger" id="role" >
                        {{ $errors->first('role') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>


   <div class="row">
       <div class="col-lg-12">
           <div class="form-group">
               <label class="form-label">{{ GoogleTranslate::trans('Title', app()->getLocale())}}</label>
               <input type="text" onfocus="noneerror('title')" name="title" class="form-control" placeholder="Type your product title here" value="{{old('title') ?? ""}}">
               @if ($errors->has('title'))
                   <div class="alert alert-danger" id="title" >
                       {{ $errors->first('title') }}
                   </div>
               @endif
           </div>
       </div>
   </div>
   <br>
   <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Description', app()->getLocale())}}</label>
                <textarea class="form-control" onfocus="noneerror('description')" name="description" placeholder="Describe your message">{{old('description') ?? ""}}</textarea>
                @if ($errors->has('description'))
                    <div class="alert alert-danger" id="description" >
                        {{ $errors->first('description') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>

    <input type="hidden" name="price" value="0">

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Salary', app()->getLocale())}}</label>
                <input type="number" name="salary_per_month" onfocus="noneerror('salary_per_month')" class="form-control" placeholder="Enter your pricing amount" value="{{old('salary_per_month')}}">
                @if ($errors->has('salary_per_month'))
                    <div class="alert alert-danger" id="salary_per_month" >
                        {{ $errors->first('salary_per_month') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>


    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <ul class="form-check-list">
                    <li>
                        <label class="form-label">{{ GoogleTranslate::trans('Job Type', app()->getLocale())}}</label>
                    </li>
                    @foreach(config('constants.JOBTYPE') as $jobtype)
                        <li style="display: flex;">
                            <input onchange="selecterror('job_type')"  @if(in_array($jobtype, old('job_type') ?? [])) checked @endif type="checkbox" value="{{$jobtype}}" name="job_type[]" class="form-check" id="{{$jobtype}}">
                            <label for="{{$jobtype}}" class="form-check-text ml-4">{{$jobtype}}</label>
                        </li>
                    @endforeach
                </ul>

            </div>
            @if ($errors->has('job_type'))
                <div class="alert alert-danger" id="job_type">
                    {{ $errors->first('job_type') }}
                </div>
            @endif
        </div>
    </div>
    <br>
    <br>



    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('work experience (years)', app()->getLocale())}}</label>
                <input type="number" onfocus="noneerror('experience')" name="experience" class="form-control" placeholder="Type your product title here" value="{{old('experience') ?? ""}}">
                @if ($errors->has('experience'))
                    <div class="alert alert-danger" id="experience" >
                        {{ $errors->first('experience') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>


    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <ul class="form-check-list">
                    <li>
                        <label class="form-label">{{ GoogleTranslate::trans('Education', app()->getLocale())}}</label>
                    </li>
                    @foreach(config('constants.EDUCATION') as $ed)


                        <li style="display: flex;">
                            <input onchange="selecterror('education')" @if(in_array($ed, old('education') ?? [])) checked @endif type="checkbox" value="{{$ed}}" name="education[]" class="form-check" id="{{$ed}}">
                            <label for="{{$ed}}" class="form-check-text ml-4">{{$ed}}</label>
                        </li>
                    @endforeach
                </ul>

            </div>
            @if ($errors->has('education'))
                <div class="alert alert-danger" id="education">
                    {{ $errors->first('education') }}
                </div>
            @endif
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="mb-5">
                <label for="formFile1" onclick="cnoneerror('mainImage')" class="form-label">{{ GoogleTranslate::trans('Upload Main Image', app()->getLocale())}}</label>
                <input style="display: none" name="mainImage" class="form-control" type="file" id="formFile1" onchange="preview('frame1')" >
                @if ($errors->has('mainImage'))
                    <div class="alert alert-danger" id="mainImage" >
                        {{ $errors->first('mainImage') }}
                    </div>
                @endif
            </div>
            <img id="frame1" src="" class="img-fluid" />
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Application deadline', app()->getLocale())}}</label>
                <input type="date" onfocus="noneerror('application_deadline')" name="application_deadline" class="form-control" placeholder="Type your product title here" value="{{old('application_deadline') ?? ""}}">
                @if ($errors->has('application_deadline'))
                    <div class="alert alert-danger" id="application_deadline" >
                        {{ $errors->first('application_deadline') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('CV sent Email', app()->getLocale())}}</label>
                <input type="email" onfocus="noneerror('cv_sent_email')" name="cv_sent_email" class="form-control" placeholder="Type your product title here" value="{{old('cv_sent_email') ?? ""}}">
                @if ($errors->has('cv_sent_email'))
                    <div class="alert alert-danger" id="cv_sent_email" >
                        {{ $errors->first('cv_sent_email') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>







</div>
