<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Home, lands & buildings - Land For Sale', app()->getLocale())}}</h3>
    </div>
 <br>

 @include('web.components.AdsForms.common-fechas')
 <br><br>
 <div class="row">
    <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Land Type', app()->getLocale())}}</label>
                <select name="type"onchange="selecterror('type')"class="form-control custom-select">
                    <option selected value="0">Select Land Type</option>
                    @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach

                </select>
                @if ($errors->has('type'))
                    <div class="alert alert-danger" id="type">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-8">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Land size', app()->getLocale())}}</label>
                <input value="{{old('size_of_land')}}" onchange="selecterror('size_of_land')"type="number" name="size_of_land"class="form-control" placeholder="What is size of your land">
                @if ($errors->has('size_of_land'))
                    <div class="alert alert-danger" id="size_of_land">
                        {{ $errors->first('size_of_land') }}
                    </div>
                @endif
            </div>
        </div>
        <br>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Unit', app()->getLocale())}}</label>
                <select value="{{old('unit')}}" onchange="selecterror('unit')" name="unit" class="form-control custom-select">
                @foreach(config('constants.UNIT') as $key=>$unit)
                    <option value="{{$key}}">{{$unit}}</option>

                @endforeach
                </select>
                @if ($errors->has('unit'))
                    <div class="alert alert-danger" id="unit">
                        {{ $errors->first('unit') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Address', app()->getLocale())}}</label>
                <input value="{{old('address')}}" onchange="selecterror('address')"name="address"type="text" class="form-control" placeholder="Enter street,house number and/or post code">
                @if ($errors->has('address'))
                    <div class="alert alert-danger" id="address">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    
</div>
