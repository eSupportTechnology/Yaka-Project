@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
            <div class="col-lg-6 grid-margin stretch-card mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update  @if(isset($data) && $data->brandsId != 0 ) Model @else Brand @endif</h4>

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

                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.configuration.brands-and-models.update-brand', $data->url)}}" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <input type="hidden" name="brandid" value="{{$brand->id ?? 0}}">

                        @if(isset($subcategories))
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Sub Category <span style="color: red">*</span></label>
                            <select class="form-control" name="sub_cat_id" id="exampleFormControlSelect2">
                                @foreach($subcategories as $subcategory)
                                    <option @if($subcategory->id==$data->sub_cat_id) selected @endif value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="exampleInputUsername1">Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="name" value="{{ old('name') ?? $data->name }}" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">status </label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option  @if($data->status == 0) selected @endif value="0">N/A</option>
                                <option  @if($data->status == 1) selected @endif value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>
                        @if(isset($data) && $data->brandsId != 0 )
                            <a href="{{ route('dashboard.configuration.models',[$brand->url]) }}" class="btn btn-light">Cancel</a>
                        @else
                            <a href="{{ route('dashboard.configuration.brands-and-models') }}" class="btn btn-light">Cancel</a>
                        @endif


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
