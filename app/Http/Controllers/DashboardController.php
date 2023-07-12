<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
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
        } else{
            $user = auth()->user();
            $pendingTasks = 0;
            $completedTasks = 0;
            foreach($user->tasks as $task){
                if($task->status->name == "pending" || $task->status->name == "in-progress")
                    $pendingTasks++;
                else
                    $completedTasks++;
            }
            return view('user.dashboard', compact('user', 'pendingTasks', 'completedTasks'));
        }
    }
}
