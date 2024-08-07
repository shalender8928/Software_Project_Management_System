<nav class="sidebar"style="width: 250px;">
<div class="sidebar-header"style="width: 250px;">
<a href="#" class="sidebar-brand" style="font-size:5;">
  senion Manager<span> spms</span>
</a>
<div class="sidebar-toggler not-active">
  <span></span>
  <span></span>
  <span></span>
</div>
</div>

<div class="sidebar-body">
<ul class="nav">
  <li class="nav-item nav-category">Main</li>
  <li class="nav-item">
    <a href="{{route('seniorManager.dashboard')}}" class="nav-link">
      <i class="link-icon" data-feather="box"></i>
      <span class="link-title">Dashboard</span>
    </a>
  </li>

  <li class="nav-item nav-category">home</li>


 <!-- start the manage Development team -->

    
      
 <a href="{{url('view_project_list')}}" class="nav-link"><i class="menu-icon" data-feather="list" class="icon-sm me-3"></i>
 <span class="link-title">View list of all project </span></a>
    
    <a href="{{ route('seniorManager.view_project_managers') }}" class="nav-link"><i class="menu-icon"  data-feather="user" class="icon-sm me-3"></i>
     <span class="link-title"> View project manager </span></a>

     <a href="{{ route('seniorManager.view_list_developere') }}" class="nav-link"><i class="menu-icon" data-feather="code" class="icon-sm me-3"></i>
    <span class="link-title">View developer team</span>
</a>

      <!-- Approve Project Plan Link -->
<a href="{{ route('seniorManager.approve_project', ['id' => 1]) }}" class="nav-link">
                <i  class="menu-icon" data-feather="check-circle" class="icon-sm me-3"></i>
                <span class="link-title">Approve project plan</span>
            </a>

            <!-- Reject Project Plan Link -->
            <a href="{{ route('seniorManager.reject_project', ['id' => 1]) }}" class="nav-link">
                <i class="menu-icon" data-feather="x-circle" class="icon-sm me-3"></i>
                <span class="link-title">Cancel project plan</span>
            </a> 

     <a href="pages/email/inbox.html" class="nav-link"><i class="menu-icon" data-feather="file-text" class="icon-sm me-3"></i>
     <span class="link-title">View report</span></a>

     <a href="pages/email/inbox.html" class="nav-link"><i class="menu-icon" data-feather="alert-triangle" class="icon-sm me-3"></i>
     <span class="link-title"> Notify issues</span></a>

     <a href="{{url('view_feedback')}}" class="nav-link"><i class="menu-icon" data-feather="message-circle" class="icon-sm me-3"></i>
     <span class="link-title"> View Feedback</span></a>

    <a class="nav-link" data-bs-toggle="collapse" href="#emails">
      <i class="menu-icon" data-feather="bell" class="icon-sm me-3"></i>
      <span class="link-title">view notification</span>
    </a>
</a>
  </ul></div>
</nav>