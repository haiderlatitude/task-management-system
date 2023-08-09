<?php

namespace App\Http\Controllers;

use App\Charts\UserMonthlyTasksBarChart;
use App\Charts\UserWeeklyTasksBarChart;
use App\Charts\UserYearlyTasksBarChart;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserReportController extends Controller
{
    public function weeklyReport(Request $request, UserWeeklyTasksBarChart $chart) {
        $user = auth()->user();
        $tasksAssignedThisWeek = $user->tasks->filter(function($item) {
            return $item->pivot->created_at > now()->startOfWeek() && $item->pivot->created_at < now()->endOfWeek() && ($item->status_id == 1 || $item->status_id == 2);
        });
        $tasksCompletedThisWeek = User::weeklyTasksCompleted($user);


        return view('user.pages.reports.report',
        [
            'tasks' => $tasksAssignedThisWeek,
            'tasksCompleted' => $tasksCompletedThisWeek,
            'timePeriod' => 'this week',
            'category' => 'week',
            'message' => null,
            'completedTasksCheckbox' => $request->completedTasksCheckbox,
            'chart' => $chart->build($user),
        ]);
    }

    public function monthlyReport(Request $request, UserMonthlyTasksBarChart $chart) {
        $monthNumber = null; $message = null; $user = auth()->user();
        if ($request->month == null) {
            $tasksAssigned = $user->tasks->filter(function($item) {
                return $item->pivot->created_at > now()->startOfMonth() && $item->pivot->created_at < now()->endOfMonth() && ($item->status_id == 1 || $item->status_id == 2);
            });
            $tasksCompleted = User::monthlyTasksCompleted($user, null);
        } elseif (preg_match('/[^1-9]/', $request->month) || $request->month < 1 || $request->month > 12){
            $tasksAssigned = $user->tasks->filter(function($item) {
                return $item->pivot->created_at > now()->startOfMonth() && $item->pivot->created_at < now()->endOfMonth() && ($item->status_id == 1 || $item->status_id == 2);
            });
            $tasksCompleted = User::monthlyTasksCompleted($user, null);
            $message = 'Month can only be a valid number!';
        } else {
            $monthNumber = $request->month;
            $tasksAssigned = [];
            foreach($user->tasks as $task){
                if($task->pivot->created_at > now()->day(1)->month($monthNumber)->startOfMonth() &&
                    $task->pivot->created_at < now()->day(1)->month($monthNumber)->endOfMonth() &&
                    ($task->status_id == 1 || $task->status_id == 2)){
                        array_push($tasksAssigned, $task);
                }
            }
            $tasksCompleted = User::monthlyTasksCompleted($user, $request->month);
        }

        return view('user.pages.reports.report',
        [
            'tasks' => $tasksAssigned,
            'tasksCompleted' => $tasksCompleted,
            'timePeriod' => $monthNumber ? date('F', mktime(0, 0, 0, $monthNumber, 1)):'this month',
            'category' => 'month',
            'message' => $message,
            'completedTasksCheckbox' => $request->completedTasksCheckbox,
            'chart' => $chart->build($user),
        ]); 
    }

    public function yearlyReport(Request $request, UserYearlyTasksBarChart $chart) {
        $user = auth()->user();
        $year = (int)$request->year; 
        $message = null;
        $startYear = (int)substr(Task::find(1)->created_at, 0, 4);
        $endYear = (int)substr(now(), 0, 4);
        if ($year == null) {
            $tasksAssigned = [];
            foreach($user->tasks as $task){
                if(
                    $task->pivot->created_at > now()->startOfYear() &&
                    $task->pivot->created_at < now()->endOfYear() &&
                    ($task->status_id == 1 || $task->status_id ==2)
                ) {
                    array_push($tasksAssigned, $task);
                }
            }
            $tasksCompleted = User::yearlyTasksCompleted($user, null);
            $year = 'this year';
        } elseif ($year >= $startYear && $year <= $endYear){
            $tasksAssigned = [];
            foreach($user->tasks as $task){
                if(
                    $task->pivot->created_at > now()->day(1)->year($year)->startOfYear() &&
                    $task->pivot->created_at < now()->day(1)->year($year)->endOfYear() &&
                    ($task->status_id == 1 || $task->status_id ==2)
                ) {
                    array_push($tasksAssigned, $task);
                }
            }
            $tasksCompleted = User::yearlyTasksCompleted($user, $year);
        } else {
            $tasksAssigned = [];
            foreach($user->tasks as $task){
                if(
                    $task->pivot->created_at > now()->startOfYear() &&
                    $task->pivot->created_at < now()->endOfYear() &&
                    ($task->status_id == 1 || $task->status_id ==2)
                ) {
                    array_push($tasksAssigned, $task);
                }
            }
            $tasksCompleted = User::yearlyTasksCompleted($user, null);
            $year = 'this year';
            $message = 'Year can only be from start of usage of this app to current year!';
        }

        return view('user.pages.reports.report',
        [
            'tasks' => $tasksAssigned,
            'tasksCompleted' => $tasksCompleted,
            'timePeriod' => $year,
            'category' => 'year',
            'message' => $message,
            'completedTasksCheckbox' => $request->completedTasksCheckbox,
            'chart' => $chart->build($user),
        ]);
    }
}
