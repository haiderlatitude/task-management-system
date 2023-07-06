<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('role:admin')->prefix('admin')->group(function(){
    Route::get('/all-tasks', [TaskController::class, 'index']);
    Route::post('/add-task', [TaskController::class, 'store']);
    Route::get('/task-form', [TaskController::class, 'formToAssignTask']);
    Route::post('/assign-task', [TaskController::class, 'assignTask']);
    Route::post('/update-task-status', [TaskController::class, 'updateTaskStatus']);

    Route::get('/all-users', [AdminController::class, 'index']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';