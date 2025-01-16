@extends('web.layout.layout')


@section('content')

    <!--=====================================
                  SINGLE BANNER PART START
        =======================================-->
    <section class="inner-section single-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-content">
                        <h2>{{GoogleTranslate::trans('Ads', app()->getLocale())}}</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('/')}}">{{GoogleTranslate::trans('Home', app()->getLocale())}}</a></li>
                            <li class="breadcrumb-item" style="color: white">{{GoogleTranslate::trans('Search', app()->getLocale())}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================
              SINGLE BANNER PART END
    =======================================-->


    <!--=====================================
                AD LIST PART START
    =======================================-->
    <section class="inner-section ad-list-part">
        <div class="container">
                <div class="col-lg-12 ">
                    <div class="row">
                        @foreach($adsdata as $ads)
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
                                @include('web.components.cards.adCards')
                            </div>
                        @endforeach
                    </div>

                    <div class="row">
                        {{-- {{ $adsdata->links('pagination::bootstrap-5') }} --}}
                    </div>
                </div>
            </div>
    </section>
    <!--=====================================
                AD LIST PART END
    =======================================-->
@endsection
