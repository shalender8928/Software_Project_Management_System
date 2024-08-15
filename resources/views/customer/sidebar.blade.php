<nav class="sidebar">
  <div class="sidebar-header">
  <a href="#" class="sidebar-brand" style="font-size:5;">
   Customer
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
        <span class="link-title">Requirement Project </span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="emails">
        <ul class="nav sub-menu">
          
          
          <li class="nav-item">
          <a href="{{ url('create_project') }}" class="nav-link">Create Requirement</a>
          </li>
          
          <li class="nav-item">
          <a href="{{url('select_project_to_edit')}}" class="nav-link">Edit Requirement</a>
  
          </li>
          <li class="nav-item">
            <a href="{{url('delete_Selected_project')}}" class="nav-link">Delete Requirement</a>
          </li>
          <li class="nav-item">
            <a href="{{url('select_category_to_list')}}" class="nav-link">View Project List </a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
        <i class="link-icon" data-feather="folder-plus"></i>
        <span class="link-title">feedback</span>
        <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="emails">
        <ul class="nav sub-menu">
          
          
          <li class="nav-item">
          <a href="{{ url('create_task') }}" class="nav-link">Add eedback</a>
          </li>
          
          <li class="nav-item">
          <a href="{{url('select_category_to_editt')}}" class="nav-link">Edit eedback</a>
  
          </li>
          <li class="nav-item">
            <a href="{{url('select_category_to_delette')}}" class="nav-link">Delete feedback</a>
          </li>
          <li class="nav-item">
            <a href="{{url('select_category_to_view_task')}}" class="nav-link">View eedback</a>
          </li>

         
        </ul>
      </div>
    </li>

  

  
  
  
       <!-- start the manage Development team -->
  
    <!-- End  the manage Development team -->
  
   
  
 
  
  
  
  
  </ul>
  </div>
  </nav>
