<nav class="navbar navbar-top navbar-expand navbar-dark " style="background:#fff  !important">
  @php
    $user = Auth::user();
    $notifications = $user->notifications;
    $countnotification = count($notifications);
  @endphp
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show global-alert-message" role="alert">
                {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show global-alert-message" role="alert">
                {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Search form -->

            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center  ml-md-auto ">
                <li class="nav-item d-xl-none">
                    <!-- Sidenav toggler -->
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="ni ni-zoom-split-in"></i>
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
              <li class="nav-item dropdown  dnotification">
                  <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-bell" style="color:black"></i>
                      <span class="count" style="@if($countnotification > 9) right: 2px; @else right: 10px; @endif">{{$countnotification}}</span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                      <a class="dropdown-item py-3" >
                          <p class="mb-0 font-weight-medium float-left">You have {{$countnotification}} Unread Notification </p>
                      </a>
                      @php $calss = '' @endphp

                      @foreach($notifications as $noti)

                        @if($noti->data['title'] == "New Order") @php $calss = "fa fa-sort-amount-up-alt"; @endphp
                        @elseif($noti->data['title'] == "New Customer Registration") @php $calss = "fas fa-user-tie fa-lg";@endphp
                        @elseif($noti->data['title'] == "New Inquiry") @php $calss = "fas fa-headset fa-lg"; @endphp
                        @endif

                        @php $url = ''; @endphp
                        @if($noti->data['title'] == "New Order") @php $url = $noti->data['url'].'&notificationID='.$noti->id;  @endphp
                        @elseif($noti->data['title'] == "New Customer Registration") @php $url = $noti->data['url'].'?notificationID='.$noti->id; @endphp
                        @elseif($noti->data['title'] == "New Inquiry") @php $url = $noti->data['url'].'?notificationID='.$noti->id;  @endphp
                        @endif

                      <a class="dropdown-item preview-item" href="{{$url }}">
                          <div class="preview-item-content flex-grow py-2" style=" display: inline-flex">
                               <i class="{{ $calss }}"></i>
                              <p class="h4" style="margin-left: 20px; margin-bottom:0px;">{{ $noti->data['title'] }}</p>
                          </div>
                          <div class="">
                            <p class="h6">{{$noti->data['body']}}</p>
                          </div>
                          <div style="display:block;">
                          <p style="font-size: xx-small;">{{$noti->created_at}}</p>
                          </div>
                      </a>
                      @endforeach
                  </div>
              </li>
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{ asset('frontend') }}/images/profile.png">
                  </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm text-dark  font-weight-bold">{{Auth::user()->name }} (Role: {{ Auth::user()->getRoleNames()->first() }})</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow  m-0">Welcome!</h6>
                        </div>
                        <a href="{{route('user.edit',['id' => Auth::user()->id])}}" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>My profile</span>
                        </a>
                        <a href="{{route('user.changePassword')}}" class="dropdown-item">
                            <i class="ni ni-settings-gear-65"></i>
                            <span>Change Password</span>
                        </a>
                        <a href="{{route('clear.app.cache')}}" class="dropdown-item">
                          <i class="fa fa-eraser"></i>
                          <span>Clear Application Cache</span>
                        </a>
                        <a href="{{route('clear.cache')}}" class="dropdown-item">
                            <i class="fa fa-eraser"></i>
                            <span>Clear Cache</span>
                        </a>


                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span>{{ __('Logout') }}</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
