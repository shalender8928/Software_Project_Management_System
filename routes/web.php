<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SeniorManagerController;
use App\Http\Controllers\ProjectManagerController;
use App\Http\Controllers\DeveloperController;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;



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
     
        Route::get('edit_profile', [ProjectManagerController::class, 'edit_profile'])
        ->middleware('CheckRole:projectManager')
        ->name('projectManager.edit_profile');

        Route::get('/projectManager/dashboard', [projectManager::class, 'dashboard'])
        ->name('projectManager.dashboard')
        ->middleware('CheckRole:projectManager');
        // Project Manager Routes

    Route::middleware(['auth', 'CheckRole:Project Manager'])->group(function () 
    {
        


     Route::get('/projectManager/dashboard', [ProjectManagerController::class, 'dashboard'])->name('projectManager.dashboard');

    Route::get('update_profile_pm', [ProjectManagerController::class, 'update_profile_pm'])->name('projectManager.update_profile_pm');
    Route::patch('update_profile/{id}', [ProjectManagerController::class, 'update_profile']);
    Route::get('view_profile', [ProjectManagerController::class, 'view_profile'])->name('ProjectManagerController.view_profile');

// create project

   

// edit project
     // routes/web.php
   // routes/web.php

// Route for listing projects

// Route for editing a project by ID
    Route::get('/Create_project', [ProjectManagerController::class, 'createProject'])->name('projectmanager.create_project');
    Route::post('add_new_project', [ProjectManagerController::class, 'add_new_Project'])->name('projectmanager.add_new_project');
    Route::get('edit_project', [ProjectManagerController::class, 'edit_project'])->name('projectmanager.edit_project');
    Route::get('update_project/{id}', [ProjectManagerController::class, 'update_project'])->name('projectmanager.update_project');
    Route::patch('update_pro_project/{id}', [ProjectManagerController::class, 'update_pro_project'])->name('projectmanager.update_pro_project');
    Route::get('delete_project', [ProjectManagerController::class, 'delete_project'])->name('projectmanager.delete_project');
    Route::get('delete_pro_project/{id}', [ProjectManagerController::class, 'delete_pro_project']);
    Route::get('/view_project_list', [ProjectManagerController::class, 'view_project_list'])->name('projectmanager.view_project_list');
    Route::get('/view_project_detail/{id}', [ProjectManagerController::class, 'view_project_detail'])->name('projectmanager.view_project_detail');

   

   // Route::post('store_data', [ProjectController::class, 'store_data']);
   
   Route::get('Assigntask', [ProjectManagerController::class, 'Assigntask'])->name('ProjectManager.Assigntask');
   Route::post('Assigntask', [ProjectManagerController::class, 'storeTask'])->name('ProjectManager.storeTask');
   Route::get('Edit_Assigntask', [ProjectManagerController::class, 'Edit_Assigntask'])->name('ProjectManager.Edit_Assigntask');
   Route::get('update_assigntask/{id}', [ProjectManagerController::class, 'update_assigntask'])->name('ProjectManager.update_assigntask');
   Route::patch('update_pro_assigntask/{id}', [ProjectManagerController::class, 'update_pro_assigntask'])->name('ProjectManager.update_pro_assigntask');
  
   Route::get('delete_task', [ProjectManagerController::class, 'delete_task'])->name('projectmanager.delete_task');
   Route::get('delete_pro_assigntask/{id}', [ProjectManagerController::class, ' delete_pro_assigntask']);

   Route::get('/view_task_list', [ProjectManagerController::class, 'view_task_list'])->name('projectmanager.view_task_list');
   Route::get('/view_task_detail/{id}', [ProjectManagerController::class, 'view_task_detail'])->name('projectmanager.view_task_detail');





    });
        

    Route::get('/developer/dashboard', [DeveloperController::class, 'dashboard'])
        ->name('developer.dashboard')
        ->middleware('CheckRole:Developer');

    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])
        ->name('CheckRole.dashboard')
        ->middleware('role:Customer');
});




Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'CheckRole:Admin'])->group(function () 
{
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('edit_profile', [AdminController::class, 'edit_profile'])->name('admin.edit_profile');
    Route::get('add_employee', [AdminController::class, 'add_employee'])->name('admin.add_employee');
    Route::get('edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('delete', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('delete_category', [AdminController::class, 'delete_category'])->name('admin.delete_category');

    Route::get('add_category', [AdminController::class, 'add_category'])->name('admin.add_category');
    Route::get('edit_category', [AdminController::class, 'edit_category'])->name('admin.edit_category');




    Route::get('view_profile', [AdminController::class, 'view_profile'])->name('admin.view_profile');
    Route::get('view_employee_list', [AdminController::class, 'view_employee_list'])->name('admin.view_employee_list');
    Route::get('view_category_list', [AdminController::class, 'view_category_list'])->name('admin.view_category_list');


    Route::get('view_employee_detail/{id}', [AdminController::class, 'view_employee_detail'])->name('admin.view_employee_detail');
    Route::get('view_category_detail/{id}', [AdminController::class, 'view_category_detail'])->name('admin.view_category_detail');

    Route::get('update_employee/{id}', [AdminController::class, 'update_employee'])->name('admin.update_employee');
    Route::get('update_category/{id}', [AdminController::class, 'update_category'])->name('admin.update_category');

    Route::get('delete_employee/{id}', [AdminController::class, 'delete_employee']);
    Route::get('delete_pro_category/{id}', [AdminController::class, 'delete_pro_category']);


    Route::patch('update_profile/{id}', [AdminController::class, 'update']);
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
    


    


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Senior Manager Routes
Route::middleware(['auth', 'CheckRole:Senior Manager'])->group(function () 
{
    Route::get('/senior-manager/dashboard', [SeniorManagerController::class, 'dashboard'])->name('seniorManager.dashboard');

    Route::get('edit_profile', [SeniorManagerController::class, 'edit_profile'])->name('seniorManager.edit_profile');

    Route::get('mange_view_profile', [SeniorManagerController::class, 'mange_view_profile'])->name('seniorManager.mange_view_profile');
    
    Route::patch('update_profile/{id}', [SeniorManagerController::class, 'update_profile']);
    
});

// Developer Routes
Route::middleware(['auth', 'CheckRole:Developer'])->group(function () {
    Route::get('/developer/dashboard', [DeveloperController::class, 'dashboard'])->name('developer.dashboard');
    Route::get('/developer/edit-profile', [DeveloperController::class, 'edit_profile'])->name('developer.edit_profile');
});
// Customer Routes
Route::middleware(['auth', 'CheckRole:Customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

require __DIR__.'/auth.php';
