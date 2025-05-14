@extends ('newAdminDashboard.master')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/graph.js') }}"></script>
<style>
    .spinner-border {
        width: 3rem;
        height: 3rem;
    }
    #chartLoading p {
        color: #666;
        font-size: 0.9rem;
    }
</style>
<div class="row">
    <h1>Welcome to admin panel.</h1>
</div>
<div class="row">
    <div class="col-md-6">
        {{-- <div class="col-sm-12">
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

             <dotlottie-player src="https://lottie.host/f4161653-a903-4d65-b8c2-0bf4fd4421f5/YlKLOKHVb0.json" background="transparent" speed="1" style="    width: 100%;height: 50%;" loop autoplay></dotlottie-player>
        </div> --}}
        <center><div class="chart-container" style="position: relative; height:400px; width:100%">
            <canvas id="userChart"></canvas>
        </div></center>
        <div id="chartLoading" class="text-center mt-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading chart data...</p>
        </div>
        <div id="chartError" class="alert alert-danger mt-4" style="display: none;"></div>
    </div>
    <div class="col-md-6">
        {{-- <div class="col-sm-12">
            <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

             <dotlottie-player src="https://lottie.host/f4161653-a903-4d65-b8c2-0bf4fd4421f5/YlKLOKHVb0.json" background="transparent" speed="1" style="    width: 100%;height: 50%;" loop autoplay></dotlottie-player>
        </div> --}}
        <center><div class="chart-container" style="position: relative; height:400px; width:100%">
            <canvas id="paidChart"></canvas>
        </div></center>
        <div id="paidChartLoading" class="text-center mt-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading chart data...</p>
        </div>
        <div id="paidChartError" class="alert alert-danger mt-4" style="display: none;"></div>
    </div>
    <div class="col-md-6 mt-3">
        <center><div class="chart-container" style="position: relative; height:400px; width:100%">
            <canvas id="freeChart"></canvas>
        </div></center>
        <div id="freeChartLoading" class="text-center mt-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading chart data...</p>
        </div>
        <div id="freeChartError" class="alert alert-danger mt-4" style="display: none;"></div>
    </div>
</div>


@endsection
