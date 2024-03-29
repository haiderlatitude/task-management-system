<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleNPermissionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReportController;
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
Route::get('/loginForm', function () {
    return view('admin.auth.login');
});
Route::get('/registerForm', function () {
    return view('admin.auth.register');
});

Route::get('/reset-password', function () {
    return view('auth.forgot-password');
});

Route::post('/validate-email', [ProfileController::class, 'validateEmail']);
Route::put('/store-reset-password', [ProfileController::class, 'storeNewPassword']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Tasks
        Route::controller(TaskController::class)->group(function () {
            Route::get('/all-tasks', 'index');
            Route::get('/add-task', 'formToAddTask');
            Route::get('/task-form', 'formToAssignTask');
            Route::post('/store-task', 'store');
            Route::get('/edit-task/{id}', 'editTask');
            Route::put('/store-edited-task', 'storeEditedTask');
            Route::post('/assign-task', 'assignTask');
            Route::post('/update-task-status', 'updateTaskStatus');
        });

        // Admin manages Users
        Route::controller(AdminController::class)->group(function () {
            Route::get('/all-users', 'index');
            Route::get('/add-user', 'addUser');
            Route::post('/store-user', 'storeUser');
            Route::get('/edit-user/{id}', 'editUser');
            Route::put('/store-edited-user', 'storeEditedUser');
            Route::get('/delete-user/{id}', 'deleteUser');
            Route::get('/restore-user/{id}', 'restoreUser');
            Route::post('/deleted-or-active-users', 'deletedOrActiveUsers');
        });

        // Roles and Permissions
        Route::controller(RoleNPermissionController::class)->group(function () {
            Route::get('/all-roles', 'allRoles');
            Route::get('/add-role', 'addRole');
            Route::get('/edit-role/{roleId}', 'editRole');
            Route::post('/store-role', 'store');
            Route::post('/store-edited-role/{roleId}', 'storeEditedRole');
            Route::get('/assign-role', 'assignRole');
            Route::post('/assign-role-to-user', 'assignRoleToUser');
            Route::get('/all-permissions', 'allPermissions');
            Route::get('/assign-permission', 'assignPermission');
            Route::post('/assign-permission-to-role', 'assignPermissionToRole');
        });

        // Reports
        Route::controller(AdminReportController::class)->group(function () {
            Route::get('/weekly-report', 'weeklyReport');
            Route::post('/weekly-report', 'weeklyReport');
            Route::get('/monthly-report', 'monthlyReport');
            Route::post('/monthly-report', 'monthlyReport');
            Route::get('/yearly-report', 'yearlyReport');
            Route::post('/yearly-report', 'yearlyReport');
        });

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

        // User Reports
        Route::controller(UserReportController::class)->group(function () {
            Route::get('/{username}/weekly-report', 'weeklyReport');
            Route::post('/{username}/weekly-report', 'weeklyReport');
            Route::get('/{username}/monthly-report', 'monthlyReport');
            Route::post('/{username}/monthly-report', 'monthlyReport');
            Route::get('/{username}/yearly-report', 'yearlyReport');
            Route::post('/{username}/yearly-report', 'yearlyReport');
        });
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
