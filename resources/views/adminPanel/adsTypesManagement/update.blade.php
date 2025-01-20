@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update @if(isset($maincategory)) Sub @endif Ads Types</h4>

                    @if (isset($success) && $success)
                        <div class="alert alert-success" role="alert">
                            {{$success}}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                   {{ $error }}</li>
                                @endforeach
                        </div>
                    @endif

                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.adsTypes.updateCatergory',[$data->url])}}" enctype="multipart/form-data" >

                        @csrf

                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Sub Category <span style="color: red">*</span></label>
                            <div style="font-size: 15px;margin-left: 20px;">{{$catId->name}}</div>
                            <input type="hidden" value="{{$catId->id}}" name="sub_cat_id">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputUsername1">Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="name" value="{{ old('name') ?? $data->name  }}" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">status </label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option @if($catId->status == 0) selected @endif  value="0">N/A</option>
                                <option @if($catId->status == 1) selected @endif  value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('dashboard.adsTypes') }}" class="btn btn-light">Cancel</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
