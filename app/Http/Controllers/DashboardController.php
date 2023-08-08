<?php

namespace App\Http\Controllers;

use App\Charts\AdminDashboardBarChart;
use App\Charts\AdminDashboardLineChart;
use App\Charts\UserDashboardBarChart;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index(AdminDashboardLineChart $lineChart, AdminDashboardBarChart $barChart, UserDashboardBarChart $userBarChart)
    {
        if (Auth::user()->hasRole('admin')) {
            $tasks = Task::all();
            $users = User::all();
            $completedTasks = Task::where('status_id', '3')->get();
            $lastWeekUsers = User::where('created_at', '>=', Carbon::now()->subDays(7));
            return view('admin.dashboard',[
                'tasks' => $tasks,
                'users' => $users,
                'completedTasks' => $completedTasks,
                'lastWeekUsers' => $lastWeekUsers,
                'lineChart' => $lineChart->build(),
                'barChart' => $barChart->build(),
            ]);
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
            return view('user.dashboard', [
                'user' => $user,
                'pendingTasks' => $pendingTasks,
                'completedTasks' => $completedTasks,
                'barChart' => $userBarChart->build($user),
            ]);
        }
    }
}
