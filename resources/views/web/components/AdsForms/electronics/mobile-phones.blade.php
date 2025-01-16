<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Electronics - Mobile Phones', app()->getLocale())}}</h3>
    </div>
<br>
<br> @include('web.components.AdsForms.common-fechas')
<br><br>
<div class="row mt-4">
    <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <ul class="form-check-list" >
                    <li>
                        <label class="form-label">{{ GoogleTranslate::trans('product condition', app()->getLocale())}}</label>
                    </li>
                   <div style="display: flex;">
                   
                   
                    @foreach(config('constants.CONDITION') as $key=>$condition)
                    <li style="margin-right: 140px;">
                    <div style="display: flex;">
                        <input type="radio" 
                        {{ $condition == 'New' ? 'checked' : '' }}
                        value="{{$condition}}"
                        {{ $condition == 'Reconditioned' ? 'hidden' : '' }}
                        style="margin-right: 30px;"
                        class="form-check" 
                        name='condition' 
                        id="use-check{{ $key }}" >
                        <label 
                        {{ $condition == 'Reconditioned' ? 'hidden' : '' }}
                        for="use-check{{ $key }}"  value="{{$condition}}"class="form-check-text">{{$condition}}</label>
                        </div>
                        </li>
                    @endforeach
                  
                   
                   
                    </div> 
                </ul>
            </div>
        </div>
        
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" id="button">{{ GoogleTranslate::trans('Brand Name', app()->getLocale())}}</label>
                <select id="brand" name="brand" onchange="selecterror('1brand')" class="form-control custom-select">
                    <option value="0">Select Brand</option>
                    @foreach($brands as $brand)
                        <option  @if(old('brand', 'default_value') == $brand->id) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select>
                @if ($errors->has('brand'))
                    <div class="alert alert-danger" id="1brand">
                        {{ $errors->first('brand') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Model', app()->getLocale())}}</label>
                <select id="model" onchange="selecterror('1model')" name="model" class="form-control custom-select">
                    <option value="0">Select Model</option>
                </select>
                @if ($errors->has('model'))
                    <div class="alert alert-danger" id="1model">
                        {{ $errors->first('model') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <ul class="form-check-list">
                    <li>
                        <label class="form-label">{{ GoogleTranslate::trans('Features (optional)', app()->getLocale())}}</label>
                    </li>
                    @foreach(config('constants.FEATURES') as $key => $feature)
                        @if($key <= 12)
                            <li style="display: flex;">
                                <input type="checkbox" value="{{$feature}}" name="specialization[]" class="form-check" id="{{$feature}}">
                                <label for="{{$feature}}" class="form-check-text ml-4">{{$feature}}</label>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <ul class="form-check-list mt-4">
                    @foreach(config('constants.FEATURES') as $key => $feature)
                        @if($key > 12)
                            <li style="display: flex;">
                                <input type="checkbox" value="{{$feature}}" name="specialization[]" class="form-check" id="{{$feature}}">
                                <label for="{{$feature}}" class="form-check-text ml-4">{{$feature}}</label>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>
