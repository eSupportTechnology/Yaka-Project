@extends ('newAdminDashboard.master')

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
                                <th>Disapprove  Reason</th>
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
                                    <td>{{ $ads->main_location ? $ads->main_location->name_en : 'N/A' }}</td>
                                    <td>{{ $ads->sub_location ? $ads->sub_location->name_en : 'N/A' }}</td>
                                    <td>{{ $ads->reason ?? 'N/A' }}</td>
                                    <td>
                                        @if($ads->status == 1)
                                            <span style="background:#28A745" class="btn btn-inverse-success btn-fw">Approved</span>
                                        @elseif($ads->status == 2)
                                            <span style="background:#DC3545" class="btn btn-inverse-danger btn-fw">Disapproved</span>
                                        @elseif($ads->status == 0)
                                            <span style="background:#FFC107" class="btn btn-inverse-danger btn-fw">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="template-demo d-flex  flex-nowrap">

                                        <a href="{{ route('ads.details', [$ads->adsId]) }}" class="btn btn-view btn-sm me-2">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                            @if($ads->status == 0)
                                            <a href="javascript:void(0);"
                                                class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#disapproveModal"
                                                data-ad-id="{{ $ads->adsId }}">
                                                Disapprove
                                            </a>
                                            &emsp;
                                                <a href="{{ route('dashboard.ads.status', ['status' => 'approve', 'id' => $ads->adsId]) }}" class="btn btn-success btn-sm">
                                                    Approve
                                                </a>
                                            @elseif($ads->status == 1)
                                                <a href="javascript:void(0);"
                                                    class="btn btn-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#disapproveModal"
                                                    data-ad-id="{{ $ads->adsId }}">
                                                    Disapprove
                                                </a>

                                            @elseif ($ads->status == 2)
                                                <a href="{{ route('dashboard.ads.status', ['status' => 'approve', 'id' => $ads->adsId]) }}" class="btn btn-success btn-sm">
                                                    Approve
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
    <!-- Disapprove Modal -->
    <div class="modal fade" id="disapproveModal" tabindex="-1" aria-labelledby="disapproveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form id="disapproveForm" method="GET">
            @csrf
            <input type="hidden" name="ads_id" id="modal_ads_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="disapproveModalLabel">Disapprove Ad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason for Disapproval</label>
                        <textarea class="form-control" name="reason" id="reason" rows="3" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Submit Disapproval</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <script>
        const disapproveModal = document.getElementById('disapproveModal');

        disapproveModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const adId = button.getAttribute('data-ad-id');
            const form = document.getElementById('disapproveForm');
            form.querySelector('textarea[name="reason"]').value = '';
            // Set dynamic form action
            const action = `{{ url('/dashboard/ads/disapprove') }}/${adId}`;
            form.setAttribute('action', action);
        });
    </script>

@endsection
