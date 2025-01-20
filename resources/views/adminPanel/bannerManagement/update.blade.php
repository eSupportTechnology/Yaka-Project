@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Banner</h4>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    <!-- Update form -->
                    <form class="forms-sample" id="admin-form" method="post" action="{{ route('dashboard.banner.update', $banner->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <!-- Existing banner image preview -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Current Banner Image</label>
                            @if ($banner->type == 0)
                            <div>
                                <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image" width="100%">
                            </div>
                            @else
                            <div>
                                <img src="{{ asset('banners/' . $banner->img) }}" alt="Banner Image" width="200">
                            </div>
                            @endif
                            
                        </div>

                        <!-- Option to upload a new image -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Upload New Banner Image (optional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <!-- Type selection -->
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Type</label>
                            <select class="form-control" name="type" id="exampleFormControlSelect2">
                                <option value="0" {{ $banner->type == 0 ? 'selected' : '' }}>Leaderboard (Banner size: 1140x180)</option>
                                <option value="1" {{ $banner->type == 1 ? 'selected' : '' }}>Skyscrapers (Banner size: 285x500)</option>
                            </select>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" id="submit-form" class="btn btn-primary me-2">Update</button>
                        <a href="{{ route('dashboard.banner') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
