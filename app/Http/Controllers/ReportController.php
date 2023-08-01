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
            'category' => 'week'
        ]);
    }

    public function monthlyReport(Request $request) {
        $monthNumber = null;
        if($request->month < 1 || $request->month > 12 || preg_match('/[^1-9]/',$request->month)){
            $tasksCreated = Task::monthlyTasksCreated(null);
            $tasksCompleted = Task::monthlyTasksCompleted(null);
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
            'category' => 'month'
        ]);
    }

    public function yearlyReport(Request $request) {
        $tasksCreated = Task::yearlyTasksCreated($request->year);
        $tasksCompleted = Task::yearlyTasksCompleted($request->year);

        return view('admin.pages.reports.report',
        [
            'tasks' => $tasksCreated,
            'tasksCompleted' => $tasksCompleted,
            'timePeriod' => $request->year ? $request->year:'this year',
            'category' => 'year'
        ]);
    }
}
