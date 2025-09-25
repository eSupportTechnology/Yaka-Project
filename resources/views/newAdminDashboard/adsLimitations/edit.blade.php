@extends('newAdminDashboard.master')

@section('content')
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Ads Limitation</h4>

                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                @endif

                <form class="forms-sample" method="POST" action="{{ route('dashboard.limit.update', $adsLimitation->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name <span style="color: red">*</span></label>
                        <input type="text" required class="form-control" id="name" name="name"
                               value="{{ old('name', $adsLimitation->name) }}" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="limit">Limit Ads <span style="color: red">*</span></label>
                        <input type="number" required class="form-control" id="limit" name="limit"
                               value="{{ old('limit', $adsLimitation->limit) }}" placeholder="Limit Ads">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0" {{ $adsLimitation->status == 0 ? 'selected' : '' }}>N/A</option>
                            <option value="1" {{ $adsLimitation->status == 1 ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Update</button>
                    <a href="{{ route('dashboard.limit.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
