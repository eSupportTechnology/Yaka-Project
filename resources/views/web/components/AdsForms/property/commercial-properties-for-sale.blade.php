<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Home, lands & buildings - Commercial Properties For Sale', app()->getLocale())}}</h3>
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
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label"> {{ GoogleTranslate::trans('apartment Size (sqft)', app()->getLocale())}}</label>
                <input value="{{old('size_sf')}}"name="size_sf"onchange="selecterror('size_sf')"  type="number" class="form-control" placeholder="What is size of your property">
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
                <input value="{{old('address')}}"type="text" name="address"onchange="selecterror('address')"class="form-control" placeholder="Enter street,house number and/or post code">
                @if ($errors->has('address'))
                    <div class="alert alert-danger" id="address">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
        </div></div>
        


</div>
