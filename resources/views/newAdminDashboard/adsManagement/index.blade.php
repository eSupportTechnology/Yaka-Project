@extends ('newAdminDashboard.master')

@section('content')
    <!-- Cleanup Section -->
    <div class="row mb-4">
        <div class="col-lg-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title text-danger mb-0">
                            <i class="fas fa-trash-alt me-2"></i>Cleanup Expired Ads
                        </h5>
                        <div class="cleanup-stats">
                            <span class="badge bg-warning me-2">
                                <i class="fas fa-clock me-1"></i>
                                Expired: <span id="expiredCount">Loading...</span>
                            </span>
                            <button class="btn btn-sm btn-outline-secondary" onclick="refreshStats()">
                                <i class="fas fa-refresh"></i>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-info btn-sm w-100" onclick="previewExpiredAds()">
                                <i class="fas fa-eye me-2"></i>
                                <span class="loading" id="previewLoading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                </span>
                                Preview Expired Ads
                            </button>
                        </div>
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-danger btn-sm w-100" onclick="deleteExpiredAds()">
                                <i class="fas fa-trash me-2"></i>
                                <span class="loading" id="deleteLoading" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>
                                </span>
                                Delete Expired Ads
                            </button>
                        </div>
                    </div>

                    <!-- Preview Section -->
                    <div id="previewSection" class="mt-3" style="display: none;">
                        <h6 class="text-info">Expired Ads Preview:</h6>
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>Ad Code</th>
                                    <th>Title</th>
                                    <th>Expired Date</th>
                                </tr>
                                </thead>
                                <tbody id="previewTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Results Section -->
                    <div id="resultsSection" class="mt-3" style="display: none;">
                        <div class="alert" id="resultsAlert">
                            <div id="resultsContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Original Ads List Section -->
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
                                <th>Mobile</th>
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
                                    <td>{{ $ads->mobile_number ?? 'N/A' }}</td>
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

    <!-- Original Disapprove Modal -->
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

    <!-- Cleanup Confirmation Modal -->
    <div class="modal fade" id="cleanupConfirmModal" tabindex="-1" aria-labelledby="cleanupConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="cleanupConfirmModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirm Cleanup
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black;">
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> This action cannot be undone.
                    </div>
                    <p>You are about to permanently delete:</p>
                    <ul>
                        <li><strong id="modalExpiredCount">0</strong> expired ads</li>
                        <li><strong id="modalImageCount">0</strong> associated images</li>
                    </ul>
                    <p>Are you sure you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmCleanup()">
                        <i class="fas fa-trash me-2"></i>Yes, Delete All
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Original disapprove modal script
        const disapproveModal = document.getElementById('disapproveModal');
        disapproveModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const adId = button.getAttribute('data-ad-id');
            const form = document.getElementById('disapproveForm');
            form.querySelector('textarea[name="reason"]').value = '';
            const action = `{{ url('/dashboard/ads/disapprove') }}/${adId}`;
            form.setAttribute('action', action);
        });

        // API Token and cleanup functionality
        let apiToken = null;

        // Get API token on page load
        document.addEventListener('DOMContentLoaded', async function() {
            await getApiToken();
            refreshStats();
        });

        async function getApiToken() {
            try {
                // Create a temporary token for cleanup operations
                const response = await fetch('/sanctum/csrf-cookie');
                if (response.ok) {
                    // For Sanctum, we'll use the session-based approach
                    // The token will be handled by the CSRF cookie
                    apiToken = '{{ csrf_token() }}';
                }
            } catch (error) {
                console.error('Error getting API token:', error);
            }
        }

        async function makeApiRequest(url, method = 'GET', data = null) {
            const headers = {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            };

            const config = {
                method: method,
                headers: headers,
                credentials: 'same-origin' // Important for session-based auth
            };

            if (data && method !== 'GET') {
                config.body = JSON.stringify(data);
            }

            return fetch(url, config);
        }

        async function refreshStats() {
            try {
                const response = await makeApiRequest('/api/cleanup/expired-ads/count');
                const data = await response.json();

                if (data.success) {
                    document.getElementById('expiredCount').textContent = data.expired_count;
                } else {
                    document.getElementById('expiredCount').textContent = 'Error';
                    console.error('API Error:', data.message);
                }
            } catch (error) {
                console.error('Error fetching stats:', error);
                document.getElementById('expiredCount').textContent = 'Error';
            }
        }

        async function previewExpiredAds() {
            const loading = document.getElementById('previewLoading');
            const section = document.getElementById('previewSection');
            const tbody = document.getElementById('previewTableBody');

            loading.style.display = 'inline-block';

            try {
                const response = await makeApiRequest('/api/cleanup/expired-ads/list');
                const data = await response.json();

                if (data.success) {
                    tbody.innerHTML = '';

                    if (data.expired_ads.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No expired ads found</td></tr>';
                    } else {
                        data.expired_ads.forEach(ad => {
                            const imageCount = (ad.mainImage ? 1 : 0) + (ad.subImage ? ad.subImage.length : 0);
                            const expiredDate = new Date(ad.package_expire_at).toLocaleDateString();

                            const row = `
                                <tr>
                                    <td><code>${ad.adsId}</code></td>
                                    <td>${ad.title}</td>
                                    <td>${expiredDate}</td>
                                                  </tr>
                            `;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });
                    }

                    section.style.display = 'block';
                } else {
                    showAlert('Error fetching expired ads: ' + data.message, 'danger');
                }
            } catch (error) {
                console.error('Error fetching preview:', error);
                showAlert('Error fetching preview data', 'danger');
            } finally {
                loading.style.display = 'none';
            }
        }

        function deleteExpiredAds() {
            const expiredCount = parseInt(document.getElementById('expiredCount').textContent);

            if (expiredCount === 0 || isNaN(expiredCount)) {
                showAlert('No expired ads to delete', 'info');
                return;
            }

            // Update modal with counts
            document.getElementById('modalExpiredCount').textContent = expiredCount;
            document.getElementById('modalImageCount').textContent = Math.round(expiredCount * 2.5);

            // Show confirmation modal
            const modal = new bootstrap.Modal(document.getElementById('cleanupConfirmModal'));
            modal.show();
        }

        async function confirmCleanup() {
            const loading = document.getElementById('deleteLoading');
            const modal = bootstrap.Modal.getInstance(document.getElementById('cleanupConfirmModal'));

            modal.hide();
            loading.style.display = 'inline-block';

            try {
                const response = await makeApiRequest('/api/cleanup/expired-ads', 'DELETE');
                const data = await response.json();

                if (data.success) {
                    showCleanupResults(data, 'success');
                    refreshStats(); // Refresh stats after cleanup

                    // Hide preview section
                    document.getElementById('previewSection').style.display = 'none';
                } else {
                    showCleanupResults(data, 'danger');
                }
            } catch (error) {
                console.error('Error performing cleanup:', error);
                showAlert('Error performing cleanup: ' + error.message, 'danger');
            } finally {
                loading.style.display = 'none';
            }
        }

        function showCleanupResults(data, type) {
            const section = document.getElementById('resultsSection');
            const alert = document.getElementById('resultsAlert');
            const content = document.getElementById('resultsContent');

            alert.className = `alert alert-${type}`;

            let html = `
                <h6><i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>${data.message}</h6>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <strong>Ads Deleted:</strong> ${data.deleted_count || 0}
                    </div>
                    <div class="col-md-4">
                        <strong>Images Deleted:</strong> ${data.images_deleted_count || 0}
                    </div>
                    <div class="col-md-4">
                        <strong>Cleanup Time:</strong> ${new Date(data.cleanup_date || Date.now()).toLocaleString()}
                    </div>
                </div>
            `;

            if (data.errors && data.errors.length > 0) {
                html += `
                    <div class="mt-3">
                        <h6>Errors (${data.errors.length}):</h6>
                        <ul class="list-unstyled">
                `;
                data.errors.forEach(error => {
                    html += `<li class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Ad ${error.ad_id}: ${error.error}</li>`;
                });
                html += `</ul></div>`;
            }

            content.innerHTML = html;
            section.style.display = 'block';

            // Auto-hide after 10 seconds
            setTimeout(() => {
                section.style.display = 'none';
            }, 10000);
        }

        function showAlert(message, type) {
            const alertHtml = `
                <div class="alert alert-${type} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; max-width: 400px;">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', alertHtml);

            // Auto-remove after 5 seconds
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert-dismissible');
                const lastAlert = alerts[alerts.length - 1];
                if (lastAlert) {
                    lastAlert.remove();
                }
            }, 5000);
        }
    </script>

    <style>
        .cleanup-stats .badge {
            font-size: 0.875rem;
        }

        .loading {
            color: #fff;
        }

        .btn:disabled {
            opacity: 0.6;
        }

        #resultsSection .alert {
            margin-bottom: 0;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .badge {
            font-size: 0.75em;
        }

        .alert {
            border: none;
            border-radius: 0.375rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-info {
            background-color: #cce7ff;
            color: #004085;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>

@endsection
