<nav class="sidebar">
<div class="sidebar-header">
<a href="#" class="sidebar-brand" style="font-size:5;">
Developer<span> spms</span>
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
    <a href="{{route('developer.dashboard')}}" class="nav-link">
      <i class="link-icon" data-feather="box"></i>
      <span class="link-title">Dashboard</span>
    </a>
  </li>

  <li class="nav-item nav-category">home</li>

      <!-- start the manager project task-->

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">Manage Task</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
        <a class="nav-link" href="{{url('create_project')}}">View assigned task</a>
        
        </li>
        
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link"> View list of project plan</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link"> Announce task completion</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">delete new project plan</a>
        </li>
     
    </div>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title"> View feedback  </span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="pages/email/inbox.html" class="nav-link">View feedback of Customer</a>
        </li>
       
      </ul>

      <!-- End the manager project task-->
    </div>
  </li>



</ul>
</div>
</nav>