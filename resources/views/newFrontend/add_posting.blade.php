@extends('newFrontend.master')

@section('content')
<style>

    .free-ad-section {
        text-align: center;
        padding: 20px 20px;
    }

    .free-ad-section p {
        font-size: 1.2rem;
        color:black;
        margin-bottom: 20px;
        font-weight: 400;
    }

    /* Category List */
    .posting-allowances-list {
        list-style: none;
        padding: 0;
        text-align: center;
        margin-top: 20px;
    }


    .posting-allowances-list li {
        background: rgb(156, 11, 6);
        color: white;
        padding: 12px;
        margin: 8px 0;
        border-radius: 5px;
        display: inline-block;
        font-size: 1.1rem;
        font-weight: 500;
        transition: transform 0.3s, background 0.3s;
        width:80%;
    }

    .posting-allowances-list li:hover {
        background: rgb(200, 20, 15);
        transform: scale(1.05);
    }
</style>


<!-- Page Title -->
<section class="page-title style-two banner-part" style="background-image: url(newFrontend/Clasifico/assets/images/background/page-title.jpg);">
            <div class="auto-container">
                <div class="mr-0 content-box centred">
                    <div class="title">
                        <h1>Ad Posting Allowances</h1>
                    </div>
                    <ul class="clearfix bread-crumb">
                        <li><a href="{{route( '/')}}">Home</a></li>
                        <li>Ad Posting Allowances</li>
                    </ul>
                </div>
            </div>
        </section>

      
<!-- Free Ad Posting Section -->
<div class="container">
    <div class="row">
        <div class="pt-5 pb-5 col-md-12">
            <div class="free-ad-section">
                <p>Free ad posting is available in every category. Contact us to become a Yaka.lk subscriber and own your stall today.</p>
                
                <ul class="posting-allowances-list">
                    @php
                        $categories = \App\Models\Category::where('mainId', 0)->where('status', 1)->get();
                    @endphp

                    @foreach ($categories as $key => $cat)
                        <li>{{ $key+1 }}. {{ $cat->name }} - Free Ads: {{ $cat->free_add_count }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


    @endsection

