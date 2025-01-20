@extends('adminPanel.layout.layout')

@section('content')

    <div class="col-lg-6 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-body">

                <h4 style="margin-bottom: 20px" class="modal-title" id="viewModalLabel">delete @if(isset($maincategory) && $category->mainId != 0 ) Sub @endif  category </h4>
                <form class="forms-sample" id="admin-form" method="post" action="{{route('dashboard.adsTypes.deleteType', $category -> url)}}" >
                    @csrf
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <div style=" border-bottom: 1px solid #e3e3e3;" class="form-group">
                        <p style="font-size: 13px;margin-left: 20px;">Are you sure you want to delete?</p>
                    </div>

                    <button style="background: red;border: none;"  class="btn btn-primary me-2">Delete</button>
                    @if(isset($maincategory) && $category->mainId != 0 )
                        <a href="{{route('dashboard.sub-categories',[$maincategory->url])}}" class="btn btn-light">Cancel</a>
                    @else
                        <a href="{{ route('dashboard.categories') }}" class="btn btn-light">Cancel</a>
                    @endif
                </form>

            </div>
        </div>
    </div>
@endsection
