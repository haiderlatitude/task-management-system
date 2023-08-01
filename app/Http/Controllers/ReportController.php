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
        try{
            $monthNumber = (int)substr(Carbon::parse('1 '.$request->month), 5, 2);
        } catch(\Exception $e){
            $monthNumber = (int)$request->month;
        }

        $tasksCreated = Task::monthlyTasksCreated($monthNumber);
        $tasksCompleted = Task::monthlyTasksCompleted($monthNumber);

        return view('admin.pages.reports.report',
        [
            'tasks' => $tasksCreated,
            'tasksCompleted' => $tasksCompleted,
            'timePeriod' => $request->month ? date('F', mktime(0, 0, 0, $monthNumber, 1)):'this month',
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
