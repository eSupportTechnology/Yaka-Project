<div class="adpost-card">
    <div class="adpost-title">
        <h3>{{ GoogleTranslate::trans('Daily Essentials - Grocery', app()->getLocale())}}</h3>
    </div>
   
   
    <br>
   


    
   <div class="row">
   <div class="col-lg-12">
           <div class="form-group">
               <label class="form-label">{{ GoogleTranslate::trans('Type', app()->getLocale())}}</label>
               <select name="type"onchange="selecterror('type')"class="form-control custom-select">
                   <option selected value="0">Type</option>
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
       
    
    
    <br><br>
    @include('web.components.AdsForms.common-fechas')
</div>
