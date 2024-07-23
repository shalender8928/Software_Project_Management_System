<nav class="sidebar">
<div class="sidebar-header">
<a href="#" class="sidebar-brand" style="font-size:5;">
  Manager<span> spms</span>
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
      <i class="link-icon" data-feather="folder-plus"></i>
      <span class="link-title"> Project </span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        
        <li class="nav-item">
          <a href="{{url('Create_project')}}" class="nav-link">Create New Project </a>
        </li>
        <li class="nav-item">
        <a href="{{ url('view_project_list') }}" class="nav-link">View Project List</a>

        </li>
        <li class="nav-item">
        <a href="{{ route('projectmanager.edit_project') }}" class="nav-link">Edit Project</a>

      </li>
        <li class="nav-item">
          <a href="{{route('projectmanager.delete_project')}}" class="nav-link">delete  project</a>
        </li>
     
        <li class="nav-item">
          <a href="{{ route('ProjectManager.Assigntask') }}" class="nav-link"> Create Assign Task</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('ProjectManager.Edit_Assigntask') }}" class="nav-link"> Edit Assign Task</a>
        </li>
        <li class="nav-item">
           <a href="{{ route('projectmanager.delete_task')}}" class="nav-link">Delete Task</a>
           </li>
        <li class="nav-item">
        <a href="{{ url('view_task_list') }}" class="nav-link">View Task List</a>

        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">track project progress</a>
        </li>
      </ul>
    </div>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="users"></i>
      <span class="link-title"> development team </span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
      
          <a href="pages/email/inbox.html" class="nav-link">view list of development team</a>
        </li>
        <li class="nav-item">
        
          <a href="pages/email/read.html" class="nav-link">track performance of development team </a>
        </li>
       
      </ul>

      <!-- End the manager project task-->
    </div>
  </li>


     <!-- start the manage Development team -->

  <!-- End  the manage Development team -->

 

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="send"></i>
      <span class="link-title">provide report </span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="eye"></i>
      <span class="link-title">view feedback of client</span>
    </a>
  </li>





  
</ul>
</div>
</nav>