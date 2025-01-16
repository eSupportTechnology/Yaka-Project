<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('leisure,kids items & sports - art collectibles ', app()->getLocale())}}</h3>
    </div>
   
   
    <br>
    @include('web.components.AdsForms.common-fechas')
   <br><br>
    <div class="row mt-4">
    <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <ul class="form-check-list" >
                    <li>
                        <label class="form-label">{{ GoogleTranslate::trans('Product Condition', app()->getLocale())}}</label>
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
    
</div>