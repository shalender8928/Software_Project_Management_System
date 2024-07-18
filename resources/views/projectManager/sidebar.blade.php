<nav class="sidebar">
<div class="sidebar-header">
<a href="#" class="sidebar-brand" style="font-size:5;">
  Pro Manager<span> spms</span>
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
    <a href="{{route('projectManager.dashboard')}}" class="nav-link">
      <i class="link-icon" data-feather="box"></i>
      <span class="link-title">Dashboard</span>
    </a>
  </li>

  <li class="nav-item nav-category">home</li>

      <!-- start the manager project task-->

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">Manage Project </span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
        <a class="nav-link" href="{{url('create_project')}}">Create New Project Plan</a>
        
        </li>
        
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">view list of project</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">update project plan</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">delete new project plan</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">assign task</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">track project progress</a>
        </li>
      </ul>
    </div>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">Manage development team </span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="pages/email/inbox.html" class="nav-link">view list of development team</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/read.html" class="nav-link">track performance of Dev team </a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">delete category</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">view list of project  category</a>
        </li>
      </ul>

      <!-- End the manager project task-->
    </div>
  </li>


     <!-- start the manage Development team -->

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">Manager Project employee</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="pages/email/inbox.html" class="nav-link">add new employee</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/read.html" class="nav-link">edit employee</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">delete employee</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">view list of project  employee</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/inbox.html" class="nav-link"> Update employee status</a>
        </li>
      </ul>
    </div>
  </li>
  
  <!-- End  the manage Development team -->

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">view notification</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">provide report </span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">view feedback of client</span>
    </a>
  </li>




</ul>
</div>
</nav>