<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleNPermissionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/loginForm', function(){
    return view('admin.auth.login');
});
Route::get('/registerForm', function(){
    return view('admin.auth.register');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->group(function(){
        // Tasks
        Route::get('/all-tasks', [TaskController::class, 'index']);
        Route::get('/add-task', [TaskController::class, 'formToAddTask']);
        Route::get('/task-form', [TaskController::class, 'formToAssignTask']);
        Route::post('/store-task', [TaskController::class, 'store']);
        Route::post('/edit-task', [TaskController::class, 'editTask']);
        Route::post('/store-edited-task', [TaskController::class, 'storeEditedTask']);
        Route::post('/assign-task', [TaskController::class, 'assignTask']);
        Route::post('/update-task-status', [TaskController::class, 'updateTaskStatus']);

        // Users
        Route::get('/all-users', [AdminController::class, 'index']);
        Route::post('/edit-user', [AdminController::class, 'editUser']);
        Route::post('/store-edited-user', [AdminController::class, 'storeEditedUser']);

        // Roles and Permissions 
        Route::get('/all-roles', [RoleNPermissionController::class, 'allRoles']);
        Route::get('/add-role', [RoleNPermissionController::class, 'addRole']);
        Route::get('/edit-role/{roleId}', [RoleNPermissionController::class, 'editRole']);
        Route::post('/store-role', [RoleNPermissionController::class, 'store']);
        Route::post('/store-edited-role/{roleId}', [RoleNPermissionController::class, 'storeEditedRole']);
        Route::get('/assign-role', [RoleNPermissionController::class, 'assignRole']);
        Route::post('/assign-role-to-user', [RoleNPermissionController::class, 'assignRoleToUser']);
        Route::get('/all-permissions', [RoleNPermissionController::class, 'allPermissions']);
        Route::get('/add-permission', [RoleNPermissionController::class, 'addPermission']);
        Route::post('/store-permission', [RoleNPermissionController::class, 'storePermission']);
        Route::get('/assign-permission', [RoleNPermissionController::class, 'assignPermission']);
        Route::post('/assign-permission-to-role', [RoleNPermissionController::class, 'assignPermissionToRole']);
    });

    Route::prefix('users')->group(function(){
        Route::get('/{username}/my-tasks', [UserController::class, 'userTasks']);
        Route::post('/{username}/update-details', [TaskController::class, 'updateTaskStatus']);
        Route::get('/{username}/my-roles', [UserController::class, 'userRoles']);
        Route::get('/{username}/my-permissions', [UserController::class, 'userPermissions']);
    });
    
    Route::get('/edit-profile', [ProfileController::class, 'edit']);
    Route::patch('/update-profile', [ProfileController::class, 'update']);
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';