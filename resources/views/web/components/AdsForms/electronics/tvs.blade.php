<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Electronics - TVs', app()->getLocale())}}</h3>
    </div>
    <br>
    @include('web.components.AdsForms.common-fechas')
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
    <br><br>
    <div class="row">
    <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Item Type', app()->getLocale())}}</label>
                <select name="type"onchange="selecterror('type')"class="form-control custom-select">
                    <option selected value="0">Item Type</option>
                    @foreach($types as $type)
                        <option
                        @if(old('type', 'default_value') == $type->id) selected @endif
                        value="{{$type->id}}">{{$type->name}}</option>
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
    <br>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label" id="button">{{ GoogleTranslate::trans('Brand Name', app()->getLocale())}}</label>
                <select  id="brand" name="brand" onchange="selecterror('1brand')" class="form-control custom-select">
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
    <div class="col-lg-12">
            <div class="form-group">
                <label class="form-label">{{ GoogleTranslate::trans('Screen Size (optional)', app()->getLocale())}}</label>
                <select value="{{old('ssize')}}" onchange="selecterror('ssize')" name="ssize" class="form-control custom-select">
                   @foreach(config('constants.SCREEN_SIZE') as $key=>$screen_size)
                        <option @if($screen_size == 'none') selected @endif value="{{$key}}">{{$screen_size}}</option>
                   @endforeach
                </select>
                @if ($errors->has('ssize'))
                    <div class="alert alert-danger" id="ssize">
                        {{ $errors->first('ssize') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
