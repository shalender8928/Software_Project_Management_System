<nav class="sidebar">
<div class="sidebar-header">
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
    <a href="{{route('projectManager.dashboard')}}" class="nav-link">
      <i class="link-icon" data-feather="box"></i>
      <span class="link-title">Dashboard</span>
    </a>
  </li>

  <li class="nav-item nav-category">home</li>

 <!-- start the manage Development team -->

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">Manage Task</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="pages/email/inbox.html" class="nav-link">view list of project plan</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/read.html" class="nav-link">view assigned task</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">announce task completion</a>
        </li>
      </ul>
    </div>
  </li>
  
  <!-- End  the manage task -->

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">view notification</span>
    </a>
  </li>

  <li class="nav-item">
 
  <a href="{{url('view_feedback')}}" class="nav-link"> <i class="link-icon" data-feather="mail"></i>
  <span class="link-title"> 
  View Feedback</span></a>
       
       
   </li>




</ul>
</div>
</nav>