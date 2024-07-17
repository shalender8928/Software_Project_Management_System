<nav class="sidebar">
<div class="sidebar-header">
<a href="#" class="sidebar-brand">
  Admin<span> spms</span>
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
    <a href="{{route('admin.dashboard')}}" class="nav-link">
      <i class="link-icon" data-feather="box"></i>
      <span class="link-title">Dashboard</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">Manager Employee</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="{{url('add_employee')}}" class="nav-link">Add New Employee</a>
        </li>
        
        <li class="nav-item">
          <a href="{{url('edit')}}" class="nav-link">Edit Employee Details</a>
        </li>

        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">Update Employee Status</a>
        </li>

        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">View list of Employee</a>
        </li>

        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">Delete Employee</a>
        </li>
      </ul>
    </div>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="mail"></i>
      <span class="link-title">Manage Project Category</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="pages/email/inbox.html" class="nav-link">Add New Category</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/read.html" class="nav-link">Edit Category</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">Delete Category</a>
        </li>
        <li class="nav-item">
          <a href="pages/email/compose.html" class="nav-link">View List of Category</a>
        </li>
      </ul>
    </div>
  </li>
</div>
</nav>