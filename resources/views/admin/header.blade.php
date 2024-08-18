<nav class="navbar">
        <a href="#" class="sidebar-toggler">
            <i data-feather="menu"></i>
        </a>
        <div class="navbar-content">
            <form class="search-form">
                <div class="input-group">
                <div class="input-group-text">
                  <i data-feather="search"></i>
                </div>
                    <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i data-feather="bell" class="feather-icon"></i>
                  <div class="notification-indicator">
                      <span class="notification-count">10</span>
                  </div>
              </a>
              
              <!-- Optional: Include some CSS to style the notification indicator -->
              <style>
                  .notification-indicator {
                      position: relative;
                  }
              
                  .notification-count {
                      position: absolute;
                      top: -30px;
                      right: -10px;
                      background-color: #dc3545; /* Bootstrap red color for notifications */
                      color: #fff;
                      border-radius: 50%;
                      width: 20px;
                      height: 20px;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      font-size: 12px;
                      font-weight: bold;
                  }
              </style>
              
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
                        <p>6 New Notifications</p>
                        <a href="javascript:;" class="text-muted">Clear all</a>
                    </div>
    <div class="p-1">
      <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                <i class="icon-sm text-white" data-feather="gift"></i>
        </div>
        <div class="flex-grow-1 me-2">
                                <p>New Order Recieved</p>
                                <p class="tx-12 text-muted">30 min ago</p>
        </div>	
      </a>
      <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                <i class="icon-sm text-white" data-feather="alert-circle"></i>
        </div>
        <div class="flex-grow-1 me-2">
                                <p>Server Limit Reached!</p>
                                <p class="tx-12 text-muted">1 hrs ago</p>
        </div>	
      </a>
      <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
          <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
        </div>
        <div class="flex-grow-1 me-2">
                                <p>New customer registered</p>
                                <p class="tx-12 text-muted">2 sec ago</p>
        </div>	
      </a>
      <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                <i class="icon-sm text-white" data-feather="layers"></i>
        </div>
        <div class="flex-grow-1 me-2">
                                <p>Apps are ready for update</p>
                                <p class="tx-12 text-muted">5 hrs ago</p>
        </div>	
      </a>
      <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
        <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                                <i class="icon-sm text-white" data-feather="download"></i>
        </div>
        <div class="flex-grow-1 me-2">
                                <p>Download completed</p>
                                <p class="tx-12 text-muted">6 hrs ago</p>
        </div>	
      </a>
    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a href="javascript:;">View all</a>
                    </div>
                </div>
            </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img class="wd-30 ht-30 rounded-circle" src="{{ asset('images/' . Auth::user()->image) }}" alt="profile">

                    </a>
                    <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                        <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                            <div class="mb-3">
                                <img class="wd-80 ht-80 rounded-circle" src="{{ asset('images/' . Auth::user()->image) }}" alt="">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{(Auth::user() -> firstname)}}</p>
                                <p class="tx-12 text-muted">{{(Auth::user() -> email)}}</p>
                            </div>
                        </div>
        <ul class="list-unstyled p-1">
          <li class="dropdown-item py-2">
            <a href="{{url('/view_profile')}}" class="text-body ms-0">
              <i class="me-2 icon-md" data-feather="user"></i>
              <span>View Profile</span>
            </a>
          </li>
          <li class="dropdown-item py-2">
            <a href="{{url('/admin_edit_profile')}}" class="text-body ms-0">
              <i class="me-2 icon-md" data-feather="edit"></i>
              <span>Edit Profile</span>
            </a>
          </li>
          <li class="dropdown-item py-2">
          <a href="{{url('changee_password_admin')}}" class="text-body ms-0">
            <i class="me-2 icon-md" data-feather="lock"></i>
              <span>Change Password</span>
            </a>
          </li>
          <li class="dropdown-item py-2">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
                  <input class = "btn btn-danger" type="submit" value = "Logout">
          </form>
          </li>
        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>