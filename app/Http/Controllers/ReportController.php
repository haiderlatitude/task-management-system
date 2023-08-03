<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function weeklyReport() {
        $tasksCreatedThisWeek = Task::weeklyTasksCreated();
        $tasksCompletedThisWeek = Task::weeklyTasksCompleted();

        return view('admin.pages.reports.report',
        [
            'tasks' => $tasksCreatedThisWeek,
            'tasksCompleted' => $tasksCompletedThisWeek,
            'timePeriod' => 'this week',
            'category' => 'week',
            'message' => null,
        ]);
    }

    public function monthlyReport(Request $request) {
        $monthNumber = null; $message = null;
        if ($request->month == null) {
            $tasksCreated = Task::monthlyTasksCreated(null);
            $tasksCompleted = Task::monthlyTasksCompleted(null);
        } elseif (preg_match('/[^1-9]/', $request->month) || $request->month < 1 || $request->month > 12){
            $tasksCreated = Task::monthlyTasksCreated(null);
            $tasksCompleted = Task::monthlyTasksCompleted(null);
            $message = 'Month can only be a valid number!';
        } else {
            $tasksCreated = Task::monthlyTasksCreated($request->month);
            $tasksCompleted = Task::monthlyTasksCompleted($request->month);
            $monthNumber = $request->month;
        }

        return view('admin.pages.reports.report',
        [
            'tasks' => $tasksCreated,
            'tasksCompleted' => $tasksCompleted,
            'timePeriod' => $monthNumber ? date('F', mktime(0, 0, 0, $monthNumber, 1)):'this month',
            'category' => 'month',
            'message' => $message,
        ]);
    }

    public function yearlyReport(Request $request) {
        $year = (int)$request->year; $message = null;
        $startYear = (int)substr(Task::find(1)->created_at, 0, 4);
        $endYear = (int)substr(now(), 0, 4);
        if ($year == null) {
            $tasksCreated = Task::yearlyTasksCreated(null);
            $tasksCompleted = Task::yearlyTasksCompleted(null);
            $year = 'this year';
        } elseif ($year >= $startYear && $year <= $endYear){
            $tasksCreated = Task::yearlyTasksCreated($year);
            $tasksCompleted = Task::yearlyTasksCompleted($year);
        } else {
            $tasksCreated = Task::yearlyTasksCreated(null);
            $tasksCompleted = Task::yearlyTasksCompleted(null);
            $year = 'this year';
            $message = 'Year can only be from start of usage of this app to current year!';
        }

        return view('admin.pages.reports.report',
        [
            'tasks' => $tasksCreated,
            'tasksCompleted' => $tasksCompleted,
            'timePeriod' => $year,
            'category' => 'year',
            'message' => $message,
        ]);
    }
}
