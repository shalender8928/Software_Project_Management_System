<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeniorManagerController;
use App\Http\Controllers\ProjectManagerController;
use App\Http\Controllers\DeveloperController;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;



Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
      ->name('admin.dashboard')
      ->middleware('CheckRole:Admin');

    Route::get('edit_profile', [AdminController::class, 'edit_profile'])
          ->middleware('CheckRole:Admin')
          ->name('admin.edit_profile');
      

    Route::get('/senior-manager/dashboard', [SeniorManagerController::class, 'dashboard'])
        ->name('seniorManager.dashboard')
        ->middleware('CheckRole:Senior Manager');
     
        Route::get('manager_edit_profile', [ProjectManagerController::class, 'manager_edit_profile'])
        ->middleware('CheckRole:projectManager')
        ->name('projectManager.manager_edit_profile');

        Route::get('/projectManager/dashboard', [projectManagerController::class, 'dashboard'])
        ->name('/projectManager/dashboard')
        ->middleware('CheckRole:projectManager');

    Route::get('/developer/dashboard', [DeveloperController::class, 'dashboard'])
        ->name('developer.dashboard')
        ->middleware('CheckRole:Developer');

    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])
        ->name('CheckRole.dashboard')
        ->middleware('role:Customer');
});

Route::get('/add_employee', [App\Http\Controllers\AdminController::class, 'add_employee'])
    ->name('admin.add_employee')
    ->middleware(['web', 'auth', 'CheckRole:Admin']);

// the home controller or landing page controller page start
     Route::get('/', [HomeController::class, 'index'])->name('home.index');

    

Route::middleware(['auth', 'CheckRole:Admin'])->group(function () 
{
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('edit_profile', [AdminController::class, 'edit_profile'])->name('admin.edit_profile');
  

     // Define route for editing profile image
    Route::get('admin_image_edit', [AdminController::class, 'admin_image_edit'])->name('admin.admin_image_edit');
    Route::patch('update_admin_profile_image/{id}', [AdminController::class, 'update_admin_profile_image']);
    Route::get('admin_edit_profile', [AdminController::class, 'admin_edit_profile'])->name('admin.admin_edit_profile');
    Route::get('add_employee', [AdminController::class, 'add_employee'])->name('admin.add_employee');
    Route::post('register_employee', [AdminController::class, 'register_employee'])->name('register_employee');
    
    Route::get('edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('delete', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('delete_category', [AdminController::class, 'delete_category'])->name('admin.delete_category');

    Route::get('add_category', [AdminController::class, 'add_category'])->name('admin.add_category');
    Route::get('edit_category', [AdminController::class, 'edit_category'])->name('admin.edit_category');

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');





    Route::get('view_profile', [AdminController::class, 'view_profile'])->name('admin.view_profile');
    Route::get('view_employee_list', [AdminController::class, 'view_employee_list'])->name('admin.view_employee_list');
    Route::get('view_category_list', [AdminController::class, 'view_category_list'])->name('admin.view_category_list');

              // changee_password_sm
    Route::get('changee_password_admin', [AdminController::class, 'changee_password_admin'])->name('admin.changee_password_admin');
    Route::post('update_changee_password_admin', [AdminController::class, 'change_Password_admin'])->name('admin.update_changee_password_admin');


    Route::get('view_employee_detail/{id}', [AdminController::class, 'view_employee_detail'])->name('admin.view_employee_detail');
    Route::get('view_category_detail/{id}', [AdminController::class, 'view_category_detail'])->name('admin.view_category_detail');

    Route::get('update_employee/{id}', [AdminController::class, 'update_employee'])->name('admin.update_employee');
    Route::get('update_category/{id}', [AdminController::class, 'update_category'])->name('admin.update_category');

    Route::get('delete_employee/{id}', [AdminController::class, 'delete_employee']);
    Route::get('delete_pro_category/{id}', [AdminController::class, 'delete_pro_catecgory']);


    Route::patch('admin_update_profile/{id}', [AdminController::class, 'admin_update_profile']);

    Route::patch('update_employee_profile/{id}', [AdminController::class, 'update_employee_profile']);
    Route::patch('update_pro_category/{id}', [AdminController::class, 'update_pro_category']);

    Route::post('register_employee', [AdminController::class, 'register_employee']);
    Route::post('add_new_category', [AdminController::class, 'add_new_category']);

    // Role Creation
    Route::get('add_role', [AdminController::class, 'add_role'])->name('admin.add_role');
    Route::post('create_role', [AdminController::class, 'create_role']);

    // Role Assignning
    Route::get('assign_role', [AdminController::class, 'assign_role'])->name('admin.assign_role');
    Route::get('assign_role_to_employee/{id}', [AdminController::class, 'showAssignRoleForm'])->name('admin.assign_role_to_employee');
     Route::post('assign_role_finally/{id}', [AdminController::class, 'assign_role_finally'])->name('assign_role_finally');

     // Edit Role
    Route::get('edit_role', [AdminController::class, 'edit_role'])->name('admin.edit_role');
    Route::get('update_role/{id}', [AdminController::class, 'update_role'])->name('admin.update_role');
    Route::patch('update_role_db/{id}', [AdminController::class, 'update_role_db']);

    // Delete Role
    Route::get('delete_role', [AdminController::class, 'delete_role'])->name('admin.delete_role');
    Route::get('delete_role_added/{id}', [AdminController::class, 'delete_role_added']);

    // View List of Roles
    Route::get('view_role_list', [AdminController::class, 'view_role_list'])->name('admin.view_role_list');
    Route::get('view_assined_user/{id}', [AdminController::class, 'view_assined_user'])->name('admin.view_assined_user');

    // update Assigned Role
    Route::get('update_user_assigned_role', [AdminController::class, 'update_user_assigned_role'])->name('admin.update_user_assigned_role');
    Route::get('update_rolllee/{id}', [AdminController::class, 'update_rolllee'])->name('admin.update_rolllee');
    Route::patch('submit_role_update/{id}', [AdminController::class, 'submit_role_update']);


    // Adding Permission to the database

    Route::get('add_new_permission', [AdminController::class, 'add_new_permission'])->name('admin.add_new_permission');
    Route::post('add_permission', [AdminController::class, 'add_permission'])->name('admin.add_permission');

    // Edit Permission
    Route::get('edit_permission', [AdminController::class, 'edit_permission'])->name('admin.edit_permission');
    Route::get('update_permission/{id}', [AdminController::class, 'update_permission'])->name('admin.update_permission');
    Route::patch('update_permission_db/{id}', [AdminController::class, 'update_permission_db'])->name('admin.update_permission_db');
    

    //Delete Permission
    Route::get('delete_permission', [AdminController::class, 'delete_permission'])->name('admin.delete_permission');
    Route::get('delete_permission_added/{id}', [AdminController::class, 'delete_permission_added']);


    //Assign Permission
    Route::get('assign_permission', [AdminController::class, 'assign_permission'])->name('admin.assign_permission');
    Route::get('view_user_of_such_role/{id}', [AdminController::class, 'view_user_of_such_role'])->name('admin.view_user_of_such_role');
    Route::get('assign_permission_for_selected_user/{id}', [AdminController::class, 'assign_permission_for_selected_user'])->name('admin.assign_permission_for_selected_user');
    Route::post('update_permissions_for_selected_user/{id}', [AdminController::class, 'update_permissions_for_selected_user']);

    // View Permission list
    Route::get('view_permission_list', [AdminController::class, 'view_permission_list'])->name('admin.view_permission_list');
    Route::get('view_permitted_user/{id}', [AdminController::class, 'view_permitted_user'])->name('admin.view_permitted_user');

    // Assign Category
    Route::get('assign_category', [AdminController::class, 'assign_category'])->name('admin.assign_category');
    Route::get('assign_category_to_selected_user/{id}', [AdminController::class, 'assign_category_to_selected_user'])->name('admin.assign_category_to_selected_user');
    Route::post('assign_category_post/{id}', [AdminController::class, 'assign_category_post']);

    // View User Under Specific Category
    Route::get('view_employee_category/{id}', [AdminController::class, 'view_employee_category'])->name('admin.view_employee_category');

    // Update Assigned Employee Category for Developer and Project Manager
    Route::get('update_assigned_category', [AdminController::class, 'update_assigned_category'])->name('admin.update_assigned_category');
    Route::get('update_category_assigned/{id}', [AdminController::class, 'update_category_assigned'])->name('admin.update_category_assigned');
    Route::patch('submit_category_update/{id}', [AdminController::class, 'submit_category_update']);


    //Add new Qualification for developer and Project manager
    Route::get('add_new_qualification', [AdminController::class, 'add_new_qualification'])->name('admin.add_new_qualification');
    Route::post('create_qualification', [AdminController::class, 'create_qualification']);

    // Edit Qualification
    Route::get('edit_qualification', [AdminController::class, 'edit_qualification'])->name('admin.edit_qualification');
    Route::get('update_qualifications/{id}', [AdminController::class, 'update_qualifications'])->name('admin.update_qualifications');
    Route::patch('update_qualification_db/{id}', [AdminController::class, 'update_qualification_db']);

    // Delete Qualification
    Route::get('delete_qualification', [AdminController::class, 'delete_qualification'])->name('admin.delete_qualification');
    Route::get('delete_qualifications_added/{id}', [AdminController::class, 'delete_qualifications_added']);

    // View list of Qualification
    Route::get('view_qualification_list', [AdminController::class, 'view_qualification_list'])->name('admin.view_qualification_list');
    Route::get('view_qualified_user/{id}', [AdminController::class, 'view_qualified_user'])->name('admin.view_qualified_user');



    // Assign Qualifiaction for Project Manager and Developer
    Route::get('assign_qualification', [AdminController::class, 'assign_qualification'])->name('admin.assign_qualification');
    Route::get('view_user_of_such_role_qualification/{id}', [AdminController::class, 'view_user_of_such_role_qualification'])->name('admin.view_user_of_such_role_qualification');
    Route::get('assign_qualifiaction_for_selected_user/{id}', [AdminController::class, 'assign_qualifiaction_for_selected_user'])->name('admin.assign_qualifiaction_for_selected_user');
    Route::post('update_qualification_for_selected_user/{id}', [AdminController::class, 'update_qualification_for_selected_user']);




});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    // Developer Routes Start ❤🧡💛💚

Route::middleware(['auth', 'CheckRole:Developer'])->group(function () 
{
    Route::get('/developer/dashboard', [DeveloperController::class, 'dashboard'])->name('developer.dashboard');

    Route::get('dev_view_profile', [DeveloperController::class, 'dev_view_profile'])->name('developer.dev_view_profile');
       // Define route for editing profile image
    Route::get('developer_image_edit', [DeveloperController::class, 'developer_image_edit'])->name('developer.developer_image_edit');

        // changee_password_sm
    Route::get('changee_password_dt', [DeveloperController::class, 'changee_password_dt'])->name('developer.changee_password_dt');

    Route::post('update_changee_password_dt', [DeveloperController::class, 'changePassword_dev_team'])->name('developer.update_changee_password_dt');

    Route::patch('update_developer_image/{id}', [DeveloperController::class, 'update_developer_image']);

    Route::get('edit_developer_profile', [DeveloperController::class, 'edit_developer_profile'])->name('developer.edit_developer_profile');

    Route::get('view_project_plans', [DeveloperController::class, 'view_project_plans'])->name('developer.view_project_plans');

    Route::get('view_projects_by_category_developer/{id}', [DeveloperController::class, 'viewProjectsByCategory_DT'])->name('developer.view_projects_by_category_developer');

    Route::get('view_project_details_developer/{id}', [DeveloperController::class, 'view_project_details_developer'])->name('developer.view_project_details_developer');
    
    Route::get('view_feedback', [DeveloperController::class, 'view_feedback'])->name('developer.view_feedback');

    Route::get('view_feedback_details/{id}', [DeveloperController::class, 'view_feedback_details'])->name('developer.view_feedback_detail');

    Route::patch('update_profile/{id}', [DeveloperController::class, 'update_profile']);

    Route::get('view_task_list', [DeveloperController::class, 'view_task_list'])->name('developer.view_task_list');

    Route::get('view_task_detail/{id}', [DeveloperController::class, 'view_task_detail'])->name('developer.view_task_detail');




});

          // Developer Routes End ❤🧡💛💚

          // Senior Manager Routes Start 🌹🌹🌹🌹
Route::middleware(['auth', 'CheckRole:Senior Manager'])->group(function () 
{
    Route::get('/senior-manager/dashboard', [SeniorManagerController::class, 'dashboard'])->name('seniorManager.dashboard');

    Route::get('edit_profile', [SeniorManagerController::class, 'edit_profile'])->name('seniorManager.edit_profile');
    // changee_password_sm
    Route::get('changee_password_sm', [SeniorManagerController::class, 'changee_password_sm'])->name('seniorManager.changee_password_sm');

    Route::post('update_changee_password', [SeniorManagerController::class, 'changePassword'])->name('seniorManager.update_changee_password');

    Route::get('mange_view_profile', [SeniorManagerController::class, 'mange_view_profile'])->name('seniorManager.mange_view_profile');
    
    Route::patch('update_profile/{id}', [SeniorManagerController::class, 'update_profile']);

    Route::get('view_project_list', [SeniorManagerController::class, 'view_project_list'])->name('seniorManager.view_project_list');

    Route::get('view_project_details/{id}', [SeniorManagerController::class, 'view_project_details'])->name('seniorManager.view_project_details');

    // view project manager

    Route::get('view_project_managers', [SeniorManagerController::class, 'view_project_managers'])->name('seniorManager.view_project_managers');
    // view project manager details 

    Route::get('/view_project_manager_details/{id}', [SeniorManagerController::class, 'viewProjectManagerDetails'])->name('seniorManager.view_project_manager_details');

    // the project  manager addresse
   Route::get('view_project_manager_address/{id}', [SeniorManagerController::class, 'viewProjectManagerAddress'])->name('seniorManager.view_project_manager_address');
  
   Route::get('view_list_developere', [SeniorManagerController::class, 'viewListDevelopers'])->name('seniorManager.view_list_developere');

   Route::get('/view_projec_developer_details/{id}', [SeniorManagerController::class, 'viewProjectDevelopereDetails'])->name('seniorManager.view_projec_developer_details');

   Route::get('view_projects_by_category/{id}', [SeniorManagerController::class, 'viewProjectsByCategory'])->name('seniorManager.view_projects_by_category');

   // Define route for editing profile image
  Route::get('image_edit', [SeniorManagerController::class, 'editImage'])->name('seniorManager.image_edit');

  Route::patch('update_profile_image/{id}', [SeniorManagerController::class, 'update_profile_image']);

  Route::get('View_project_Details_with_project_plan/{id}' , [SeniorManagerController:: class, 'View_project_Details_with_project_plan'])->name('seniorManager.View_project_Details_with_project_plan');
      //View Project plan 
  Route::get('view_project_plan/{id}' , [SeniorManagerController:: class, 'view_project_plan'])->name('seniorManager.view_project_plan');
      //View project plan objective
  Route::get('view_objective_of_project_plan/{id}' , [SeniorManagerController:: class, 'view_objective_of_project_plan'])->name('seniorManager.view_objective_of_project_plan');
    //View project plan scop
  Route::get('view_project_plan_scope/{id}' , [SeniorManagerController:: class, 'view_project_plan_scope'])->name('seniorManager.view_project_plan_scope');
       //View project plan deliverable
  Route::get('view_project_deliverable/{id}' , [SeniorManagerController:: class, 'view_project_deliverable'])->name('seniorManager.view_project_deliverable');
      //View project plan dependency
  Route::get('view_project_dependency/{id}' , [SeniorManagerController:: class, 'view_project_dependency'])->name('seniorManager.view_project_dependency');
      //View project plan  milestone
  Route::get('view_project_milestone/{id}' , [SeniorManagerController:: class, 'view_project_milestone'])->name('seniorManager.view_project_milestone');
       //View project resource
  Route::get('view_project_resource/{id}' , [SeniorManagerController:: class, 'view_project_resource'])->name('seniorManager.view_project_resource');
   // Approve Project Plan
  Route::get('approve_project/{id}', [SeniorManagerController::class, 'approve'])->name('seniorManager.approve_project');
        //  approved_reject_project
  Route::get('approved_reject_project/{id}', [SeniorManagerController::class, 'approved_reject_project'])->name('seniorManager.approved_reject_project');

   // Reject Project form
  Route::get('reject_project/{id}', [SeniorManagerController::class, 'showRejectionForm'])->name('seniorManager.reject_project');
     // reject project
  Route::post('reject/{id}', [SeniorManagerController::class, 'rejectProject'])->name('seniorManager.reject');
  // approved project list pagee
  Route::get('approved_project_page', [SeniorManagerController::class, 'approvedProjectPage'])->name('seniorManager.approved_project_page');

  Route::get('reject_project_list', [SeniorManagerController::class, 'rejectProjectPage'])->name('seniorManager.reject_project_list');

  Route::get('reject_approved_project/{id}', [SeniorManagerController::class, 'reject_approved_project'])->name('seniorManager.reject_approved_project');

  Route::post('reject_approved_pp/{id}', [SeniorManagerController::class, 'reject_approved_pp'])->name('seniorManager.reject_approved_pp');




});

       // Senior Manager Routes End
    
       // Customer Routes Start 
Route::middleware(['auth', 'CheckRole:Customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

       // Customer Routes End 


       // Project Manager Routes Start

   Route::middleware(['auth', 'CheckRole:Project Manager'])->group(function () 
   {

   Route::get('/projectManager/dashboard', [projectManagerController::class, 'dashboard'])->name('projectManager.dashboard');

       // Create Project

   Route::get('create_project', [ProjectManagerController::class, 'createProject'])->name('projectManager.create_project');
   Route::post('create_project_post', [ProjectManagerController::class, 'create_project_post'])->name('projectmanager.create_project_post');
   
   //Edit Project
   Route::get('select_project_to_edit', [ProjectManagerController::class, 'select_project_to_edit'])->name('projectManager.select_project_to_edit');
   Route::get('edit_project/{id}', [ProjectManagerController::class, 'edit_project'])->name('projectManager.edit_project');
   Route::get('update_project/{id}', [ProjectManagerController::class, 'update_project'])->name('projectManager.update_project');
   Route::patch('update_project_post/{id}', [ProjectManagerController::class, 'update_project_post']);

   //Delete Project
   Route::get('delete_Selected_project', [ProjectManagerController::class, 'delete_Selected_project'])->name('projectManager.delete_Selected_project');
   Route::get('delete_project/{id}', [ProjectManagerController::class, 'delete_project'])->name('projectManager.delete_project');
   Route::get('delete_project_post/{id}', [ProjectManagerController::class, 'delete_project_post']);

   // View list of Project
   Route::get('select_category_to_list', [ProjectManagerController::class, 'select_category_to_list'])->name('projectManager.select_category_to_list');
   Route::get('view_project_list/{id}', [ProjectManagerController::class, 'view_project_list'])->name('projectManager.view_project_list');
   Route::get('view_project_detail/{id}', [ProjectManagerController::class, 'view_project_detail'])->name('projectManager.view_project_detail');


   // Create Project Plan
   Route::get('create_project_plan', [ProjectManagerController::class, 'create_project_plan'])->name('projectManager.create_project_plan');
   Route::post('add_new_project_plan', [ProjectManagerController::class, 'add_new_project_plan'])->name('ProjectManager.add_new_project_plan');


   // Create Task
   Route::get('create_task', [ProjectManagerController::class, 'create_task'])->name('projectManager.create_task');
   Route::post('create_task_post', [ProjectManagerController::class, 'create_task_post'])->name('ProjectManager.create_task_post');

   // Edit Task 
   Route::get('select_category_to_editt', [ProjectManagerController::class, 'select_category_to_editt'])->name('projectManager.select_category_to_editt');
   Route::get('select_project_to_editt/{id}', [ProjectManagerController::class, 'select_project_to_editt'])->name('projectManager.select_project_to_editt');
   Route::get('edit_task/{id}', [ProjectManagerController::class, 'edit_task'])->name('projectManager.edit_task');
   Route::get('update_task/{id}', [ProjectManagerController::class, 'update_task'])->name('projectManager.update_project');
   Route::patch('update_task_post/{id}', [ProjectManagerController::class, 'update_task_post']);

    // Delete Task
   Route::get('select_category_to_delette', [ProjectManagerController::class, 'select_category_to_delette'])->name('projectManager.select_category_to_delette');
   Route::get('select_project_to_delette/{id}', [ProjectManagerController::class, 'select_project_to_delette'])->name('projectManager.select_project_to_delette');
   Route::get('delete_task/{id}', [ProjectManagerController::class, 'delete_task'])->name('projectManager.delete_task');
   Route::get('delete_task_post/{id}', [ProjectManagerController::class, 'delete_task_post']);

   // View Task List
   Route::get('select_category_to_view_task', [ProjectManagerController::class, 'select_category_to_view_task'])->name('projectManager.select_category_to_view_task');
   Route::get('select_project_to_view_task/{id}', [ProjectManagerController::class, 'select_project_to_view_task'])->name('projectManager.select_project_to_view_task');
   Route::get('view_task_list/{id}', [ProjectManagerController::class, 'view_task_list'])->name('projectManager.view_task_list');
   Route::get('view_task_detail/{id}', [ProjectManagerController::class, 'view_task_detail'])->name('projectManager.view_task_detail');

   // Assign Task to Developer

   Route::get('select_category_assign_task', [ProjectManagerController::class, 'select_category_assign_task'])->name('projectManager.select_category_assign_task');
   Route::get('select_project_to_assign_task/{id}', [ProjectManagerController::class, 'select_project_to_assign_task'])->name('projectManager.select_project_to_assign_task');
   Route::get('assign_task/{id}', [ProjectManagerController::class, 'assign_task'])->name('projectManager.assign_task');
   Route::get('select_user_to_assign_task/{id}', [ProjectManagerController::class, 'select_user_to_assign_task'])->name('projectManager.select_user_to_assign_task');
   Route::post('assign_task_post/{id}', [ProjectManagerController::class, 'assign_task_post']);

   //Update Assiged TAsk for Developer
   Route::get('select_category_update_task', [ProjectManagerController::class, 'select_category_update_task'])->name('projectManager.select_category_update_task');
   Route::get('select_project_to_update_assigned_task/{id}', [ProjectManagerController::class, 'select_project_to_update_assigned_task'])->name('projectManager.select_project_to_update_assigned_task');
   Route::get('select_task/{id}', [ProjectManagerController::class, 'select_task'])->name('projectManager.select_task');
   Route::get('select_assigned_user/{id}', [ProjectManagerController::class, 'select_assigned_user'])->name('projectManager.select_assigned_user');
   Route::post('assign_task_update_post/{id}', [ProjectManagerController::class, 'assign_task_update_post']);


   //Adding Project Plan
   Route::get('select_category_to_add_pro_plan', [ProjectManagerController::class, 'select_category_to_add_pro_plan'])->name('projectManager.select_category_to_add_pro_plan');
   Route::get('select_project_to_add_pro_plan/{id}', [ProjectManagerController::class, 'select_project_to_add_pro_plan'])->name('projectManager.select_project_to_add_pro_plan');
   Route::get('add_new_pro_plan/{id}', [ProjectManagerController::class, 'add_new_pro_plan'])->name('projectManager.add_new_pro_plan');
   Route::post('create_project_plan', [ProjectManagerController::class, 'create_project_plan'])->name('projectManager.create_project_plan');

   // Adding Project Objective
   Route::get('go_to_objective/{id}', [ProjectManagerController::class, 'go_to_objective'])->name('projectManager.go_to_objective');
    Route::post('store_project_objective', [ProjectManagerController::class, 'store_project_objective'])->name('projectManager.store_project_objective');


    // Adding Project Scope
   Route::get('go_to_scope/{id}', [ProjectManagerController::class, 'go_to_scope'])->name('projectManager.go_to_scope');
   Route::get('store_project_scope', [ProjectManagerController::class, 'store_project_scope'])->name('projectManager.store_project_scope');


   Route::get('assign_task', [ProjectManagerController::class, 'assign_task'])->name('projectManager.assign_task');
   
   Route::get('project_manger_view_profile', [ProjectManagerController::class, 'project_manger_view_profile'])->name('projectManager.project_manger_view_profile');

      // Define route for editing profile image
   Route::get('change_image', [ProjectManagerController::class, 'changeImage'])->name('projectManager.change_image');
          // changee_password_sm
   Route::get('changee_password_pm', [ProjectManagerController::class, 'changee_password_pm'])->name('projectManager.changee_password_pm');

   Route::post('update_changee_password_pm', [ProjectManagerController::class, 'changePassword_project_manager'])->name('projectManager.update_changee_password_pm');

  Route::patch('project_man_update_profile_image/{id}', [ProjectManagerController::class, 'project_man_update_profile_image']);

  Route::get('pro_man_edit_profile', [ProjectManagerController::class, 'pro_man_edit_profile'])->name('projectManager.pro_man_edit_profile');

  Route::patch('pro_manager_update_profile/{id}', [ProjectManagerController::class, 'pro_manager_update_profile']);


   
   //Adding Project Deliverable
   Route::get('go_to_deliverable/{id}', [ProjectManagerController::class, 'go_to_deliverable'])->name('projectManager.go_to_deliverable');
   Route::post('store_project_deliverable', [ProjectManagerController::class, 'store_project_deliverable'])->name('projectManager.store_project_deliverable');

   // Adding Project Dependency
   Route::get('go_to_dependencies/{id}', [ProjectManagerController::class, 'go_to_dependencies'])->name('projectManager.go_to_dependencies');
   Route::post('store_project_dependency', [ProjectManagerController::class, 'store_project_dependency'])->name('projectManager.store_project_dependency');

   // Adding Poject Resource
   Route::get('go_to_resources/{id}', [ProjectManagerController::class, 'go_to_resources'])->name('projectManager.go_to_resources');
   Route::post('store_project_resource', [ProjectManagerController::class, 'store_project_resource'])->name('projectManager.store_project_resource');

   //Adding Project Milesones
   Route::get('go_to_milestones/{id}', [ProjectManagerController::class, 'go_to_milestones'])->name('projectManager.go_to_milestones');
   Route::post('store_project_milestone', [ProjectManagerController::class, 'store_project_milestone'])->name('projectManager.store_project_milestone');


   // Editing Project Plan
    Route::get('select_category_to_edit_pp' , [ProjectManagerController:: class, 'select_category_to_edit_pp'])->name('projectManager.select_category_to_edit_pp');
    Route::get('select_project_to_edit_pp/{id}' , [ProjectManagerController:: class, 'select_project_to_edit_pp'])->name('projectManager.select_project_to_edit_pp');
    Route::get('select_project_plan/{id}' , [ProjectManagerController:: class, 'select_project_plan'])->name('projectManager.select_project_plan');
  
    //Edit PPlan
    Route::get('edit_plan/{id}' , [ProjectManagerController:: class, 'edit_plan'])->name('projectManager.edit_plan');
   Route::patch('update_project_plan/{id}', [ProjectManagerController::class, 'update_project_plan']);

   // Edit Objective 
   Route::get('edit_objective/{id}' , [ProjectManagerController:: class, 'edit_objective'])->name('projectManager.edit_objective');
   Route::patch('update_project_objective/{id}', [ProjectManagerController::class, 'update_project_objective']);


   // Edit Scope
   Route::get('edit_scope/{id}' , [ProjectManagerController:: class, 'edit_scope'])->name('projectManager.edit_scope');
   Route::patch('update_project_scope/{id}', [ProjectManagerController::class, 'update_project_scope']);

   // Edit Deliverables
   Route::get('edit_deliverable/{id}' , [ProjectManagerController:: class, 'edit_deliverable'])->name('projectManager.edit_deliverable');
   Route::get('edit_deliverable_form/{id}' , [ProjectManagerController:: class, 'edit_deliverable_form'])->name('projectManager.edit_deliverable_form');
   Route::patch('update_project_deliverable/{id}', [ProjectManagerController::class, 'update_project_deliverable']);

   // Edit Dependency
   Route::get('edit_dependency/{id}' , [ProjectManagerController:: class, 'edit_dependency'])->name('projectManager.edit_dependency');
   Route::get('edit_dependency_form/{id}' , [ProjectManagerController:: class, 'edit_dependency_form'])->name('projectManager.edit_dependency_form');
   Route::patch('update_project_dependency/{id}', [ProjectManagerController::class, 'update_project_dependency']);

   // Edit Milestone
   Route::get('edit_milestone/{id}' , [ProjectManagerController:: class, 'edit_milestone'])->name('projectManager.edit_milestone');
   Route::get('edit_milestone_form/{id}' , [ProjectManagerController:: class, 'edit_milestone_form'])->name('projectManager.edit_milestone_form');
   Route::patch('update_project_milestone/{id}', [ProjectManagerController::class, 'update_project_milestone']);


   // Edit Resource
   Route::get('edit_resource/{id}' , [ProjectManagerController:: class, 'edit_resource'])->name('projectManager.edit_resource');
   Route::get('edit_resource_form/{id}' , [ProjectManagerController:: class, 'edit_resource_form'])->name('projectManager.edit_resource_form');
   Route::patch('update_project_resource/{id}', [ProjectManagerController::class, 'update_project_resource']);


   // Delete Project Plan
   Route::get('select_category_to_delete_pp', [ProjectManagerController::class, 'select_category_to_delete_pp'])->name('projectManager.select_category_to_delete_pp');
   Route::get('select_project_to_delete_pp/{id}', [ProjectManagerController::class, 'select_project_to_delete_pp'])->name('projectManager.select_project_to_delete_pp');
   Route::get('select_project_plan_to_delete/{id}', [ProjectManagerController::class, 'select_project_plan_to_delete'])->name('projectManager.select_project_plan_to_delete');


   // Delete Plan
   Route::get('delete_plan/{id}', [ProjectManagerController::class, 'delete_plan'])->name('projectManager.delete_plan');
   
   // Delete Objective
   Route::get('delete_objective/{id}', [ProjectManagerController::class, 'delete_plan'])->name('projectManager.delete_plan');


});
       
   // Project Manager Routes End 

require __DIR__.'/auth.php';
