<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Daily Essentials -  Fruits & Vegetables', app()->getLocale())}}</h3>
    </div>
   
   
    <br>
    @include('web.components.AdsForms.common-fechas')
   <br><br>
    <div class="row mt-4">
    <div class="col-md-4 col-lg-4">
            <div class="form-group">
                <ul class="form-check-list" >
                    <li>
                        <label class="form-label">{{ GoogleTranslate::trans('Type', app()->getLocale())}}</label>
                    </li>
                   <div style="display: flex;">
                   
                   
                    @foreach(config('constants.FOOD') as $key=>$food)
                    <li style="margin-right: 140px;">
                    <div style="display: flex;">
                        <input type="radio" 
                        {{ $food == 'Fruits' ? 'checked' : '' }}
                        value="{{$food}}"
                        style="margin-right: 30px;"
                        class="form-check" 
                        name='condition' 
                        id="use-check{{ $key }}" >
                        <label for="use-check{{ $key }}" class="form-check-text">{{$food}}</label>
                        </div>
                        </li>
                    @endforeach
                  
                   
                   
                    </div> 
                </ul>
            </div>
        </div>
        
    </div>
    
     

       
</div>
