
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label class="form-label">{{ GoogleTranslate::trans('Product Title', app()->getLocale())}}</label>
            <input type="text" onfocus="noneerror('title')" name="title" class="form-control" placeholder="Type your product title here" value="{{old('title') ?? ""}}">
            @if ($errors->has('title'))
                <div class="alert alert-danger" id="title" >
                    {{ $errors->first('title') }}
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
            <label class="form-label">{{ GoogleTranslate::trans('Price', app()->getLocale())}}</label>
            <input type="number" name="price" onfocus="noneerror('price')" class="form-control" placeholder="Enter your pricing amount" value="{{old('price')}}">
            @if ($errors->has('price'))
                <div class="alert alert-danger" id="price" >
                    {{ $errors->first('price') }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">

    
    <div class="container col-md-12">
        <div >
            <label style="    border: 1px solid #e9dcdc;
    border-radius: 7px;
    width: 100%;
    padding: 10px;
    box-shadow: -1px 8px 7px 1px #ededed;
    cursor: pointer;
}" for="formFile1" onclick="cnoneerror('mainImage')" class="form-label">{{ GoogleTranslate::trans('Upload Main Image ', app()->getLocale())}}</label>
            <input style="display: none" name="mainImage" class="form-control" type="file" id="formFile1" onchange="preview('frame1')" >
            @if ($errors->has('mainImage'))
                <div class="alert alert-danger" id="mainImage" >
                    {{ $errors->first('mainImage') }}
                </div>
            @endif
        </div>
        <img id="frame1" src="" class="img-fluid" />
    </div>
    <div class="container col-md-12">
        <div >
            <label  style="    border: 1px solid #e9dcdc;
    border-radius: 7px;
    width: 100%;
    padding: 10px;
    box-shadow: -1px 8px 7px 1px #ededed;
    cursor: pointer;
}" for="formFile2" class="form-label">{{ GoogleTranslate::trans('Upload 01 Image', app()->getLocale())}}</label>
            <input style="display: none" name="subImage1" class="form-control" type="file" id="formFile2" onchange="preview('frame2')">
        </div>
        <img id="frame2" src="" class="img-fluid"  />
    </div>
    <div class="container col-md-12">
        <div >
            <label  style="    border: 1px solid #e9dcdc;
    border-radius: 7px;
    width: 100%;
    padding: 10px;
    box-shadow: -1px 8px 7px 1px #ededed;
    cursor: pointer;
}" for="formFile3" class="form-label">{{ GoogleTranslate::trans('Upload01 Image ', app()->getLocale())}}</label>
            <input style="display: none" name="subImage2" class="form-control" type="file" id="formFile3" onchange="preview('frame3')">
        </div>
        <img id="frame3" src="" class="img-fluid" />
    </div>
    <div class="container col-md-12">
        <div >
            <label  style="    border: 1px solid #e9dcdc;
    border-radius: 7px;
    width: 100%;
    padding: 10px;
    box-shadow: -1px 8px 7px 1px #ededed;
    cursor: pointer;
}" for="formFile4" class="form-label">{{ GoogleTranslate::trans('Upload 03 Image', app()->getLocale())}} </label>
            <input style="display: none" name="subImage3" class="form-control" type="file" id="formFile4" onchange="preview('frame4')">
        </div>
        <img id="frame4" src="" class="img-fluid" />
    </div>
    <div class="container col-md-12">
        <div >
            <label  style="    border: 1px solid #e9dcdc;
    border-radius: 7px;
    width: 100%;
    padding: 10px;
    box-shadow: -1px 8px 7px 1px #ededed;
    cursor: pointer;
}" for="formFile5" class="form-label">{{ GoogleTranslate::trans('Upload 04 Image', app()->getLocale())}} </label>
            <input style="display: none" name="subImage4" class="form-control" type="file" id="formFile5" onchange="preview('frame5')">
        </div>
        <img id="frame5" src="" class="img-fluid" />
    </div>
</div>
<br>
<br>




<div class="row mt-4">
    <div class="col-md-4 col-lg-4">
        <div class="form-group">
            <ul class="form-check-list">
                <div>
                    @foreach(config('constants.PRICE_TYPES') as $key => $price_type)
                        @if($key <= 2)
                        <li style="margin-right: 40px; display: flex">
                            <input style="margin-right: 5px" @if($price_type == 'negotiable') checked @endif type="radio" class="form-check" value="{{$key}}" name='price_type'>
                            <label class="form-check-text">{{$price_type}}</label>
                        </li>
                        @endif
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
    <div class="col-md-4 col-lg-4">
        <div class="form-group">
            <ul class="form-check-list">
                <div>
                    @foreach(config('constants.PRICE_TYPES') as $key => $price_type)
                        @if($key > 2)
                            <li style="margin-right: 40px; display: flex">
                                <input style="margin-right: 5px" @if($price_type == 'negotiable') checked @endif type="radio" class="form-check" value="{{$key}}" name='price_type'>
                                <label class="form-check-text">{{$price_type}}</label>
                            </li>
                        @endif
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
            <label class="form-label">{{ GoogleTranslate::trans('ad description', app()->getLocale())}}</label>
            <textarea class="form-control" onfocus="noneerror('description')" name="description" placeholder="Describe your message">{{old('description') ?? ""}}</textarea>
            @if ($errors->has('description'))
                <div class="alert alert-danger" id="description" >
                    {{ $errors->first('description') }}
                </div>
            @endif
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-md-4 col-lg-4">
        <div class="form-group">
            <ul class="form-check-list">
                <div style="display: flex;">
                    @foreach(config('constants.POST_TYPES') as $key => $post_type)
                        <li style="margin-right: 120px; display: flex">
                            <input style="margin-right: 5px" @if($post_type == 'sale') checked @endif type="radio" class="form-check" value="{{$key}}" name='post_type'>
                            <label class="form-check-text">{{$post_type}}</label>
                        </li>
                    @endforeach
                </div>
            </ul>
        </div>
    </div>
</div>
<br>
<br>
