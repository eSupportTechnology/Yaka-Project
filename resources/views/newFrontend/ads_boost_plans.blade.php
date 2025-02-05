
@extends ('newFrontend.master')

@section('content')


<div class="container mt-4">
    <h2>Boost Your Ad</h2>
    <div class="card">
        <img src="{{ asset($ad->mainImage) }}" class="card-img-top" alt="Ad Image">
        <div class="card-body">
            <h5 class="card-title">{{ $ad->title }}</h5>
            <p class="card-text">Price: Rs {{ number_format($ad->price, 2) }}</p>
            <p class="card-text text-muted">Location: {{ $ad->location }}</p>

            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning"><i class="fas fa-rocket"></i> Boost Now</button>
            </form>
        </div>
    </div>
</div>
@endsection
