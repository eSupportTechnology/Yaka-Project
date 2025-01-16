<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Motor vehicles - Heavy Duty', app()->getLocale())}}</h3>
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
                <label class="form-label" id="button">{{ GoogleTranslate::trans('Brand Name', app()->getLocale())}}</label>
                <select id="brand" name="brand" onchange="selecterror('1brand')" class="form-control custom-select">
                    <option value="0">Select Brand</option>
                    @foreach($brands as $brand)
                        <option value="{{$brand->id}}">{{$brand->name}}</option>
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
    @include('web.components.AdsForms.common-fechas')






</div>
