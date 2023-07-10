<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $tasks = Task::all();
            $users = User::all();
            $completedTasks = Task::where('status_id', '3')->get();
            $lastWeekUsers = User::where('created_at', '>=', Carbon::now()->subDays(7));
            return view('admin.dashboard', compact('tasks', 'users', 'completedTasks', 'lastWeekUsers'));
        } else
            return view('user.dashboard');
    }
}
