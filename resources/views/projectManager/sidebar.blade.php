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

      <!-- Manager Project Task -->
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#project" role="button" aria-expanded="false" aria-controls="project">
          <i class="link-icon" data-feather="folder-plus"></i>
          <span class="link-title">Project</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="project">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{url('Create_project')}}" class="nav-link">Create New Project</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('view_project_list') }}" class="nav-link">View Project List</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('projectmanager.edit_project') }}" class="nav-link">Edit Project</a>
            </li>
            <li class="nav-item">
              <a href="{{route('projectmanager.delete_project')}}" class="nav-link">Delete Project</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/compose.html" class="nav-link">Track Project Progress</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#project-plan" role="button" aria-expanded="false" aria-controls="project-plan">
          <i class="link-icon" data-feather="folder-plus"></i>
          <span class="link-title">Project Plan</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="project-plan">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('projectmanager.create_project_plan') }}" class="nav-link">Create Project Plan</a>
            </li>
            <li class="nav-item">
              <a href="ProjectManager.edit_project_plan" class="nav-link">Edit Project Plan</a>
            </li>
            <li class="nav-item">
              <a href="projectmanager.delete_project_plan" class="nav-link">Delete Project Plan</a>
            </li>
            <li class="nav-item">
              <a href="view_project_plan_list" class="nav-link">View Project Plan List</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#task" role="button" aria-expanded="false" aria-controls="task">
          <i class="link-icon" data-feather="folder-plus"></i>
          <span class="link-title">Task</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="task">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('ProjectManager.Assigntask') }}" class="nav-link">Create Assign Task</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('ProjectManager.Edit_Assigntask') }}" class="nav-link">Edit Assign Task</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('projectmanager.delete_task')}}" class="nav-link">Delete Task</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('view_task_list') }}" class="nav-link">View Task List</a>
            </li>
          </ul>
        </div>
      </li>

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
