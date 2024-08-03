<nav class="sidebar">
  <div class="sidebar-header">
<<<<<<< HEAD
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
        
            <a href="{{url('create_project_plan')}}" class="nav-link">Create New Project Plan</a>
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
=======
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

      
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#milestone" role="button" aria-expanded="false" aria-controls="milestone">
          <i class="link-icon" data-feather="folder-plus"></i>
          <span class="link-title">Milestone</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="milestone">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('projectmanager.create_milestone_project') }}" class="nav-link">Create Milestone</a>
            </li>
            <li class="nav-item">
              <a href="ProjectManager.Edit_Milestone" class="nav-link">Edit Milestone</a>
            </li>
            <li class="nav-item">
              <a href="'projectmanager.delete_Milestone" class="nav-link">Delete Milestone</a>
            </li>
            <li class="nav-item">
              <a href="view_Milestone_list" class="nav-link">View Milestone</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#timelines" role="button" aria-expanded="false" aria-controls="timelines">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Timelines</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="timelines">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('projectmanager.create_timelines')}}" class="nav-link">Create Timelines</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/read.html" class="nav-link">Read</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/compose.html" class="nav-link">Compose</a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#timelines" role="button" aria-expanded="false" aria-controls="timelines">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">resource</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="timelines">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('projectmanager.create_resources')}}" class="nav-link">Create Resorces</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/read.html" class="nav-link">Read</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/compose.html" class="nav-link">Compose</a>
            </li>
          </ul>
        </div>
      </li>




      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#timelines" role="button" aria-expanded="false" aria-controls="timelines">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Delivarable</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="timelines">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('projectmanager.create_deliverable')}}" class="nav-link">Create delivarable</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/read.html" class="nav-link">Read</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/compose.html" class="nav-link">Compose</a>
            </li>
          </ul>
        </div>
      </li>



>>>>>>> 206e5991b5dc43eef9ca94c85505ca864c46b609

          <li class="nav-item">
            <a href="{{url('assign_task')}}" class="nav-link">Assign Task to Developer</a>
          </li>
        </ul>
      </div>
    </li>

<<<<<<< HEAD
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
=======
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#timelines" role="button" aria-expanded="false" aria-controls="timelines">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title"> Dependency</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="timelines">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{route('projectmanager.create_dependencies')}}" class="nav-link">dependencies</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/read.html" class="nav-link">Read</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/compose.html" class="nav-link">Compose</a>
            </li>
          </ul>
        </div>
      </li>




   




      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#development-team" role="button" aria-expanded="false" aria-controls="development-team">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Development Team</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="development-team">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="pages/email/inbox.html" class="nav-link">View List of Development Team</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/read.html" class="nav-link">Track Performance of Development Team</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#report" role="button" aria-expanded="false" aria-controls="report">
          <i class="link-icon" data-feather="send"></i>
          <span class="link-title">Provide Report</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#feedback" role="button" aria-expanded="false" aria-controls="feedback">
          <i class="link-icon" data-feather="eye"></i>
          <span class="link-title">View Feedback of Client</span>
        </a>
      </li>
    </ul>
  </div>
</nav>
>>>>>>> 206e5991b5dc43eef9ca94c85505ca864c46b609
