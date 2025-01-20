@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Create New @if(isset($maincategory)) Sub @endif Category</h4>

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

                    <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.categories.store')}}" enctype="multipart/form-data" >

                        @csrf
                        @if(isset($maincategory))
                            <input type="hidden" name="mainid" value="{{$maincategory->id}}">
                        @endif

                        <div class="form-group">
                            <label for="exampleInputUsername1">Name <span style="color: red">*</span></label>
                            <input type="text" required  class="form-control" id="exampleInputUsername1" name="name" value="{{ old('name')  }}" placeholder="Name">
                        </div>

                        @if(!isset($maincategory)) 
                          <div class="form-group">
                            <label for="count">Free add count </label>
                            <input type="number" required  class="form-control" id="count" name="free_add_count" value="{{ old('free_add_count') ?? 0   }}" placeholder="Free add count">
                        </div>
                        @endif

                      

                        <div class="form-group">
                            <label for="formFileDisabled">Image <span style="color: red">*</span></label>
                            <input style="height: 46px;" type="file" required  class="form-control" id="formFileDisabled" name="image"  >
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlSelect2">status </label>
                            <select class="form-control" name="status" id="exampleFormControlSelect2">
                                <option  value="0">N/A</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Submit</button>

                        @if(isset($maincategory))
                            <a href="{{ route('dashboard.sub-categories',[$maincategory->url]) }}" class="btn btn-light">Cancel</a>
                        @else
                            <a href="{{ route('dashboard.categories') }}" class="btn btn-light">Cancel</a>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
