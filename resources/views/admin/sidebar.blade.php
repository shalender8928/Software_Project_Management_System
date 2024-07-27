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
    <a href="{{url('dashboard')}}" class="nav-link">
      <i class="link-icon" data-feather="box"></i>
      <span class="link-title">Dashboard</span>
    </a>
  </li>


  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="users"></i>
      <span class="link-title">Employees</span>
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
          <a href="{{url('view_employee_list')}}" class="nav-link">View list of Employee</a>
        </li>

        <li class="nav-item">
          <a href="{{url('delete')}}" class="nav-link">Delete Employee</a>
        </li>
      </ul>
    </div>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="layers"></i>
      <span class="link-title"> Project Categories</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="{{url('add_category')}}" class="nav-link">Add New Category</a>
        </li>
        <li class="nav-item">
          <a href="{{url('edit_category')}}" class="nav-link">Edit Category</a>
        </li>
        <li class="nav-item">
          <a href="{{url('delete_category')}}" class="nav-link">Delete Category</a>
        </li>
        <li class="nav-item">
          <a href="{{url('view_category_list')}}" class="nav-link">View List of Category</a>
        </li>
        <li class="nav-item">
          <a href="{{url('assign_category')}}" class="nav-link">Assign Category to Employee</a>
        </li>
        <li class="nav-item">
          <a href="{{url('update_assigned_category')}}" class="nav-link">Update Assigned Category</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="user-check"></i>
      <span class="link-title">Roles</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="{{url('add_role')}}" class="nav-link">Add New Role</a>
        </li>
        <li class="nav-item">
          <a href="{{url('edit_role')}}" class="nav-link">Edit Role</a>
        </li>
        <li class="nav-item">
          <a href="{{url('delete_role')}}" class="nav-link">Delete Role</a>
        </li>
        <li class="nav-item">
          <a href="{{url('view_role_list')}}" class="nav-link">View List of Role</a>
        </li>
        <li class="nav-item">
          <a href="{{url('assign_role')}}" class="nav-link">Assign Role</a>
        </li>
        <li class="nav-item">
          <a href="{{url('update_user_assigned_role')}}" class="nav-link">Update Assigned Role</a>
        </li>
      </ul>
    </div>
  </li>

  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
      <i class="link-icon" data-feather="lock"></i>
      <span class="link-title">Permissions</span>
      <i class="link-arrow" data-feather="chevron-down"></i>
    </a>
    <div class="collapse" id="emails">
      <ul class="nav sub-menu">
        <li class="nav-item">
          <a href="{{url('add_new_permission')}}" class="nav-link">Add New Permission</a>
        </li>
        <li class="nav-item">
          <a href="{{url('edit_permission')}}" class="nav-link">Edit Permission</a>
        </li>
        <li class="nav-item">
          <a href="{{url('delete_permission')}}" class="nav-link">Delete Permission</a>
        </li>
        <li class="nav-item">
          <a href="{{url('view_permission_list')}}" class="nav-link">View List of Permission</a>
        </li>
        <li class="nav-item">
          <a href="{{url('assign_permission')}}" class="nav-link">Assign Permission</a>
        </li>
      </ul>
    </div>
  </li>

</div>
</nav>