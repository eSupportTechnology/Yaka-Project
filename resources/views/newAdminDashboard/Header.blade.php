<header class="main-header navbar shadow-sm">
    <div class="col-search">
        
    </div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
        <ul class="nav">
            @php
                $pendingads = \App\Models\Ads::where('status',0)->with('user')->orderBy('created_at', 'DESC')->get();
                $pendingads_count = count($pendingads);
            @endphp
            <li class="nav-item dropdown"> 
                 <a class="nav-link btn-icon dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="material-icons md-notifications animation-shake"></i>
                      @if($pendingads_count > 0)<span class="badge rounded-pill">
                      {{$pendingads_count}}
                          </span>@endif
                 </a>
                 <div style="height:300px; overflow:hidden;overflow-y:scroll;" class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item py-3 border-bottom">
                        <p class="mb-0 font-weight-medium float-left">{{$pendingads_count}} Pending ads </p>
                        <a style="display: block;position: absolute;top: 13px;right: 2px;" href="{{route('dashboard.ads')}}"></a>
                    </a>
                    @foreach($pendingads as $ads)
                        <a class="dropdown-item preview-item py-3">
                            <div class="preview-thumbnail">
                                <i class="md md-alert m-auto text-primary"></i>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject fw-normal text-dark mb-1">{{$ads->user->first_name ." ".$ads->user->last_name}}</h6>
                                <p class="fw-light small-text mb-0"> {{$ads->created_at->diffForHumans()}} </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </li>

           <li class="nav-item">
                <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
            </li>
            <li class="dropdown nav-item" style="position: relative;">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false">
                    <img class="img-xs rounded-circle" 
                        src="{{ asset('storage/user_images/' . session('image', 'default-user.png')) }}" 
                        alt="User" />
                </a>
            </li>
        </ul>
    </div>
</header>
