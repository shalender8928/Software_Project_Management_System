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

        // Project Manager Routes

    Route::middleware(['auth', 'CheckRole:Project Manager'])->group(function () 
    {
        
    Route::get('/project-manager/dashboard', [ProjectManagerController::class, 'dashboard'])->name('projectManager.dashboard');
    Route::get('edit_profile', [ProjectManagerController::class, 'edit_profile'])->name('projectManager.edit_profile');

    Route::patch('update_profile/{id}', [ProjectManagerController::class, 'update_profile']);
    
    Route::get('create_project', [ProjectController::class, 'create_project'])->name('projectManager.create_project');
    
   // Route::post('store_data', [ProjectController::class, 'store_data']);
    Route::post('/store_data', [ProjectController::class, 'store_data'])->name('store_data');

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

Route::middleware(['auth', 'CheckRole:Admin'])->group(function () {
    // Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('edit_profile', [AdminController::class, 'edit_profile'])->name('admin.edit_profile');
    Route::get('add_employee', [AdminController::class, 'add_employee'])->name('admin.add_employee');
    Route::get('edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('delete', [AdminController::class, 'delete'])->name('admin.delete');
    Route::get('delete_category', [AdminController::class, 'delete_category'])->name('admin.delete_category');

    Route::get('add_category', [AdminController::class, 'add_category'])->name('admin.add_category');
    Route::get('edit_category', [AdminController::class, 'edit_category'])->name('admin.edit_category');

    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');





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


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Senior Manager Routes
Route::middleware(['auth', 'CheckRole:Senior Manager'])->group(function () {
    Route::get('/senior-manager/dashboard', [SeniorManagerController::class, 'dashboard'])->name('seniorManager.dashboard');
});

// Project Manager Routes
Route::middleware(['auth', 'CheckRole:Project Manager'])->group(function () {
    Route::get('/project-manager/dashboard', [ProjectManagerController::class, 'dashboard'])->name('projectManager.dashboard');
});

// Developer Routes
Route::middleware(['auth', 'CheckRole:Developer'])->group(function () {
    Route::get('/developer/dashboard', [DeveloperController::class, 'dashboard'])->name('developer.dashboard');
});

// Customer Routes
Route::middleware(['auth', 'CheckRole:Customer'])->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

require __DIR__.'/auth.php';
