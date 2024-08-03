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
    <li class="nav-item">
      <a href="{{route('projectManager.dashboard')}}" class="nav-link">
        <i class="link-icon" data-feather="box"></i>
        <span class="link-title">Dashboard</span>
      </a>
    </li>
  
  
        <!-- start the manager project task-->
  
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
        <i class="link-icon" data-feather="folder-plus"></i>
        <span class="link-title">Projects </span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="emails">
        <ul class="nav sub-menu">
          
          
          <li class="nav-item">
          <a href="{{ url('create_project') }}" class="nav-link">Add New Project</a>
          </li>
          
          <li class="nav-item">
          <a href="{{url('select_project_to_edit')}}" class="nav-link">Edit Project</a>
  
          </li>
          <li class="nav-item">
            <a href="{{url('delete_Selected_project')}}" class="nav-link">Delete Project</a>
          </li>
          <li class="nav-item">
            <a href="{{url('select_category_to_list')}}" class="nav-link">View Project List </a>
          </li>
        </ul>
      </div>
    </li>

    

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title"> Project Plan </span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="emails">
        <ul class="nav sub-menu">
          <li class="nav-item">
        
            <a href="#" class="nav-link">Create New Project Plan</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Edit Project Plan </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Delete Project Plan </a>
          </li>
          
         
        </ul>
  
        <!-- End the manager project task-->
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
        <i class="link-icon" data-feather="folder-plus"></i>
        <span class="link-title">Tasks </span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="emails">
        <ul class="nav sub-menu">
          
          
          <li class="nav-item">
          <a href="{{ url('create_task') }}" class="nav-link">Add New Task</a>
          </li>
          
          <li class="nav-item">
          <a href="{{url('select_category_to_editt')}}" class="nav-link">Edit Task</a>
  
          </li>
          <li class="nav-item">
            <a href="{{url('select_category_to_delette')}}" class="nav-link">Delete Task</a>
          </li>
          <li class="nav-item">
            <a href="{{url('select_category_to_view_task')}}" class="nav-link">View Task List</a>
          </li>

          <li class="nav-item">
            <a href="{{url('assign_task')}}" class="nav-link">Assign Task to Developer</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title"> Developer </span>
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
