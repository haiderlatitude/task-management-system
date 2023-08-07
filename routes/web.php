<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleNPermissionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Task;
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
Route::get('/ex', function () {
    $tasks = Task::all();
    return view('admin.pages.reports.export', compact('tasks'));
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/loginForm', function () {
    return view('admin.auth.login');
});
Route::get('/registerForm', function () {
    return view('admin.auth.register');
});

Route::get('/reset-password', function(){
    return view('auth.forgot-password');
});

Route::post('/validate-email', [ProfileController::class, 'validateEmail']);
Route::put('/store-reset-password', [ProfileController::class, 'storeNewPassword']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Tasks
        Route::get('/all-tasks', [TaskController::class, 'index']);
        Route::get('/add-task', [TaskController::class, 'formToAddTask']);
        Route::get('/task-form', [TaskController::class, 'formToAssignTask']);
        Route::post('/store-task', [TaskController::class, 'store']);
        Route::get('/edit-task/{id}', [TaskController::class, 'editTask']);
        Route::put('/store-edited-task', [TaskController::class, 'storeEditedTask']);
        Route::post('/assign-task', [TaskController::class, 'assignTask']);
        Route::post('/update-task-status', [TaskController::class, 'updateTaskStatus']);

        // Admin manages Users
        Route::get('/all-users', [AdminController::class, 'index']);
        Route::get('/add-user', [AdminController::class, 'addUser']);
        Route::post('/store-user', [AdminController::class, 'storeUser']);
        Route::get('/edit-user/{id}', [AdminController::class, 'editUser']);
        Route::put('/store-edited-user', [AdminController::class, 'storeEditedUser']);
        Route::get('/delete-user/{id}', [AdminController::class, 'deleteUser']);
        Route::get('/restore-user/{id}', [AdminController::class, 'restoreUser']);
        Route::post('/deleted-or-active-users', [AdminController::class, 'deletedOrActiveUsers']);

        // Roles and Permissions 
        Route::get('/all-roles', [RoleNPermissionController::class, 'allRoles']);
        Route::get('/add-role', [RoleNPermissionController::class, 'addRole']);
        Route::get('/edit-role/{roleId}', [RoleNPermissionController::class, 'editRole']);
        Route::post('/store-role', [RoleNPermissionController::class, 'store']);
        Route::post('/store-edited-role/{roleId}', [RoleNPermissionController::class, 'storeEditedRole']);
        Route::get('/assign-role', [RoleNPermissionController::class, 'assignRole']);
        Route::post('/assign-role-to-user', [RoleNPermissionController::class, 'assignRoleToUser']);
        Route::get('/all-permissions', [RoleNPermissionController::class, 'allPermissions']);
        Route::get('/assign-permission', [RoleNPermissionController::class, 'assignPermission']);
        Route::post('/assign-permission-to-role', [RoleNPermissionController::class, 'assignPermissionToRole']);

        // Reports
        Route::get('/weekly-report', [ReportController::class, 'weeklyReport']);
        Route::post('/weekly-report', [ReportController::class, 'weeklyReport']);
        Route::get('/monthly-report', [ReportController::class, 'monthlyReport']);
        Route::post('/monthly-report', [ReportController::class, 'monthlyReport']);
        Route::get('/yearly-report', [ReportController::class, 'yearlyReport']);
        Route::post('/yearly-report', [ReportController::class, 'yearlyReport']);
        Route::post('/export-weekly-report', [PdfController::class, 'exportWeeklyReport']);
        Route::post('/export-monthly-report', [PdfController::class, 'exportMonthlyReport']);
        Route::post('/export-yearly-report', [PdfController::class, 'exportYearlyReport']);
    });

    // User Routes
    Route::prefix('users')->group(function () {
        Route::get('/{username}/my-tasks', [UserController::class, 'userTasks']);
        Route::get('/{username}/my-roles', [UserController::class, 'userRoles']);
        Route::get('/{username}/my-permissions', [UserController::class, 'userPermissions']);
        Route::post('/{username}/update-details', [TaskController::class, 'updateTaskStatus']);
    });

    // Profile Routes
    Route::get('/edit-profile', [ProfileController::class, 'edit']);
    Route::patch('/update-profile', [ProfileController::class, 'update']);
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notification Routes
    Route::post('/read-notification', [NotificationController::class, 'readNotification']);
    Route::post('/read-all-notifications', [NotificationController::class, 'readAllNotifications']);
    Route::post('/delete-all-notifications', [NotificationController::class, 'deleteAllNotifications']);
    Route::delete('/delete-notification', [NotificationController::class, 'deleteNotification']);
});

require __DIR__ . '/auth.php';
