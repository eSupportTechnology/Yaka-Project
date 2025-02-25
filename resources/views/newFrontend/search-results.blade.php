@extends ('newFrontend.master')
<style>
    .ad-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    text-align: right;
    margin-bottom: 10px;
}

.ad-card h3 {
    font-size: 1.2rem;
    font-weight: bold;
}

.ad-card p {
    margin: 5px 0;
}

.price {
    font-size: 1.1rem;
    color: #d9534f;
    font-weight: bold;
}

.card-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

/* Card image styling if needed */
.ad-card img {
    max-width: 50%;
    border-radius: 8px;
}

.slider-container {
    width: 100%;
    overflow: hidden;
    position: relative;
}

.card-container {
    display: flex;
    width: 200%;
    transition: transform 0.5s ease-in-out;
}

.ad-card {
    width: 20%;
    padding: 15px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    flex-shrink: 0;
}
.badge {
            position: absolute;
            top: 10px;
            left:10px;
            background: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            clip-path: polygon(100% 0%, 100% 100%, 50% 80%, 0 100%, 0 0);
        }
</style>
@section('content')
    <div class="auto-container">
        <div class="sec-title centred">
            <span>Search Results</span>
            <h2>Search Results for "{{ request('query') }}"</h2>
          
        </div>

        <div class="tabs-box">
            <div class="tabs-content">
                <div class="tab active-tab" id="tab-1">
                    <div class="clearfix row justify-content-center">
                        @if($ads->isEmpty())
                            <p>No ads found matching your search.</p>
                        @else
                            @foreach($ads as $ad)
                                <div class="col-lg-3 col-md-5 col-sm-12 feature-block justify-content-center">
                                    <div class="feature-block-one wow fadeInDown animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                                        <div class="inner-box">
                                            <div class="image-box">
                                                <figure class="image">
                                                    <img src="{{ asset('storage/' . $ad->mainImage) }}" alt="" style="width: 370px; height: 220px; object-fit: cover;">
                                                </figure>

                                               
                                            </div>

                                            <div class="lower-content">
                                                <h3 style="margin-top: 20px;">
                                                    <a href="{{ route('ads.details', ['adsId' => $ad->adsId]) }}">{{ $ad->title }}</a>
                                                </h3>
                                                
                                                <ul class="clearfix info">
    <li><i class="fas fa-map-marker-alt"></i>
    <span>{{$ad->location}}</span>
    </li>
</ul>
                                                <div class="lower-box">
                                                    <h5><span>Price:</span>{{ $ad->price ?? 'N/A' }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
