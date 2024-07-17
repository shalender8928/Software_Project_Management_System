<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SeniorManagerController;
use App\Http\Controllers\ProjectManagerController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;

<<<<<<< HEAD



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




=======
>>>>>>> 45bbf9aa614c660f5aee0417bd731c72dd503009
Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth', 'CheckRole:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('edit_profile', [AdminController::class, 'edit_profile'])->name('admin.edit_profile');
    Route::get('add_employee', [AdminController::class, 'add_employee'])->name('admin.add_employee');
    Route::get('edit', [AdminController::class, 'edit'])->name('admin.edit');

    Route::patch('update_profile/{id}', [AdminController::class, 'update']);


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
