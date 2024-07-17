<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SeniorManagerController;
use App\Http\Controllers\ProjectManagerController;
use App\Http\Controllers\DeveloperController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
