<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function exportWeeklyReport(Request $request) {
        $tasks = json_decode($request->tasks);
        $timePeriod = $request->timePeriod;
        $pdf = Pdf::loadView('admin.pages.reports.export', compact('tasks', 'timePeriod'));
        return $pdf->download(str_replace(' ', '_', $request->timePeriod).'_tasks_report.pdf');
    }

    public function exportMonthlyReport(Request $request) {
        $tasks = json_decode($request->tasks);
        $timePeriod = $request->timePeriod;
        $pdf = Pdf::loadView('admin.pages.reports.export', compact('tasks', 'timePeriod'));
        return $pdf->download(str_replace(' ', '_', $request->timePeriod).'_tasks_report.pdf');
    }

    public function exportYearlyReport(Request $request) {
        $tasks = json_decode($request->tasks);
        $timePeriod = $request->timePeriod;
        $pdf = Pdf::loadView('admin.pages.reports.export', compact('tasks', 'timePeriod'));
        return $pdf->download(str_replace(' ', '_', $request->timePeriod).'_tasks_report.pdf');
    }
}
