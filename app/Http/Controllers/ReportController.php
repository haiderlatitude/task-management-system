<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyTasksBarChart;
use App\Charts\WeeklyTasksBarChart;
use App\Charts\YearlyTasksBarChart;
use App\Models\Task;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function weeklyReport(Request $request, WeeklyTasksBarChart $chart) {
        $tasksCreatedThisWeek = Task::weeklyTasksCreated();
        $tasksCompletedThisWeek = Task::weeklyTasksCompleted();


        return view('admin.pages.reports.report',
        [
            'tasks' => $tasksCreatedThisWeek,
            'tasksCompleted' => $tasksCompletedThisWeek,
            'timePeriod' => 'this week',
            'category' => 'week',
            'message' => null,
            'completedTasksCheckbox' => $request->completedTasksCheckbox,
            'chart' => $chart->build(),
        ]);
    }

    public function monthlyReport(Request $request, MonthlyTasksBarChart $chart) {
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
            'completedTasksCheckbox' => $request->completedTasksCheckbox,
            'chart' => $chart->build(),
        ]);
    }

    public function yearlyReport(Request $request, YearlyTasksBarChart $chart) {
        $year = (int)$request->year; 
        $message = null;
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
            'completedTasksCheckbox' => $request->completedTasksCheckbox,
            'chart' => $chart->build(),
        ]);
    }
}
