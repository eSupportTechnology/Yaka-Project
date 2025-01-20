@extends('adminPanel.layout.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex;justify-content: space-between">
                        <h4 style="margin-bottom: 20px" class="card-title">Ads List</h4>
                        <form action="{{route('dashboard.ads')}}" style="width: 30%; display: flex; align-items: center;">
                            <input name="code" value="{{ $_GET['code'] ?? "" }}" type="search" id="searchInput" class="form-control" placeholder="Ad Code Search" title="Search here" style="flex-grow: 1; margin-right: 10px;">
                            <button type="submit" style="width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">
                                Search
                            </button>
                            <a href="{{route('dashboard.ads')}}" style="text-decoration: none;margin-left: 10px;width: 90px;border: none;background: #5c3939;color: white;padding: 7px;border-radius: 3px;">Clear</a>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Ads Code</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>District</th>
                                <th>City</th>
                                <th>Ads Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($adsData as $ads)
                                <tr>
                                    <td>{{ $ads->id }}</td>
                                    <td>{{ $ads->adsId }}</td>
                                    <td>{{ $ads->title }}</td>
                                    <td>{{ $ads->category->name }}</td>
                                    <td>{{ $ads->subcategory->name }}</td>
                                    <td>{{ $ads->main_location->name_en }}</td>
                                    <td>{{ $ads->sub_location->name_en }}</td>
                                    <td>
                                        @if($ads->status == 1)
                                            <span  class="btn btn-inverse-success btn-fw">Approved</span>
                                        @else
                                            <span  class="btn btn-inverse-danger btn-fw">Disapproved</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">
                                            <a href="{{route('ads.details',[$ads->id])}}" class="btn btn-primary">
                                                View <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                            </a>
                                            @if($ads->status == 1)
                                                <a href="{{route('dashboard.ads.status',['disapprove',$ads->id])}}" class="btn btn-primary">
                                                    Disapprove <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                                </a>
                                            @else
                                                <a href="{{route('dashboard.ads.status',['approve',$ads->id])}}" class="btn btn-primary">
                                                    Approve <!-- Assuming you want to use a "View" icon, change "ti-home" to the appropriate icon class -->
                                                </a>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $adsData->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
