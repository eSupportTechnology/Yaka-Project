<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Motor vehicles - Motorbikes', app()->getLocale())}}</h3>
    </div>
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
                                           style="margin-right: 30px;"
                                           class="form-check"
                                           name='condition'
                                           id="use-check{{ $key }}" >
                                    <label for="use-check{{ $key }}" class="form-check-text">{{$condition}}</label>
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
                <label class="form-label" id="button">{{ GoogleTranslate::trans('Brand', app()->getLocale())}}</label>
                <select id="brand" name="brand" onchange="selecterror('1brand')" class="form-control custom-select">
                    <option value="0">Select Brand</option>
                    @foreach($brands as $brand)
                        <option @if(old('brand', 'default_value') == $brand->id) selected @endif value="{{$brand->id}}" >{{$brand->name}}</option>
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
                    <option @if(old('brand', 'default_value') == $brand->id) selected @endif value="0">Select Model</option>
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
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Trim / Edition (optional)', app()->getLocale())}}</label>
                <input value="{{old('edition')}}" onchange="selecterror('edition')" type="text" name="edition" class="form-control" placeholder="What is Trim / Edition (optional) of your vehicle">
                @if ($errors->has('edition'))
                    <div class="alert alert-danger" id="edition">
                        {{ $errors->first('edition') }}
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
                <label class="form-label">{{ GoogleTranslate::trans('Year of Manufacture', app()->getLocale())}}</label>
                <input value="{{old('manufacture_year')}}" onchange="selecterror('manufacture_year')" type="number" name="manufacture_year"class="form-control" placeholder="When was your car manufatured">
                @if ($errors->has('manufacture_year'))
                    <div class="alert alert-danger" id="manufacture_year">
                        {{ $errors->first('manufacture_year') }}
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
                <label class="form-label">{{ GoogleTranslate::trans('Mileage ', app()->getLocale())}}(km)</label>
                <input value="{{old('Mileage')}}" onchange="selecterror('Mileage')" type="number" name="Mileage" class="form-control" placeholder="What is Mileage  of vehicle">
                @if ($errors->has('Mileage'))
                    <div class="alert alert-danger" id="Mileage">
                        {{ $errors->first('Mileage') }}
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
                <label class="form-label">{{ GoogleTranslate::trans('Engine capacity ', app()->getLocale())}}(cc)</label>
                <input value="{{old('engine_capacity')}}" onchange="selecterror('engine_capacity')" type="number" name="engine_capacity" class="form-control" placeholder="What is Engine capacity (cc)  of vehicle">
                @if ($errors->has('engine_capacity'))
                    <div class="alert alert-danger" id="engine_capacity">
                        {{ $errors->first('engine_capacity') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br>
    <br>


    @include('web.components.AdsForms.common-fechas')
</div>
