<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Home, lands & buildings - Houses For Sale', app()->getLocale())}}</h3>
    </div>
    <br>

    @include('web.components.AdsForms.common-fechas')
    <br><br>
    <div class="row">
    <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Bedrooms', app()->getLocale())}}</label>
                <select name="rooms" onchange="selecterror('rooms')"class="form-control custom-select">
                    <option selected>Bedrooms</option>
                    @foreach(config('constants.BEDROOMS') as $key=>$bedRooms)
                    <option value="{{$key}}">{{$bedRooms}}</option>

                @endforeach

                </select>
                @if ($errors->has('rooms'))
                    <div class="alert alert-danger" id="rooms">
                        {{ $errors->first('rooms') }}
                    </div>
                @endif
            </div>
        </div>
    </div><br>
    <div class="row">
    <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Bathrooms', app()->getLocale())}}</label>
                <select onchange="selecterror('bathrooms')"  name="bathrooms"class="form-control custom-select">
                    <option selected>Bathrooms</option>

                    @foreach(config('constants.BEDROOMS') as $key=>$bedRooms)
                    <option value="{{$key}}">{{$bedRooms}}</option>

                @endforeach
                </select>
                @if ($errors->has('bathrooms'))
                    <div class="alert alert-danger" id="bathrooms">
                        {{ $errors->first('bathrooms') }}
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
                <label class="form-label">{{ GoogleTranslate::trans('House size (sqft)', app()->getLocale())}}</label>
                <input value="{{old('size_sf')}}"onchange="selecterror('size_sf')" type="number" name="size_sf"class="form-control" placeholder="What is size of your House size (sqft)">
                @if ($errors->has('size_sf'))
                    <div class="alert alert-danger" id="size_sf">
                        {{ $errors->first('size_sf') }}
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
                <input value="{{old('address')}}"onchange="selecterror('address')" name="address"type="text" class="form-control" placeholder="Enter street,house number and/or post code">
                @if ($errors->has('address'))
                    <div class="alert alert-danger" id="address">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
        </div></div>
        
</div>
