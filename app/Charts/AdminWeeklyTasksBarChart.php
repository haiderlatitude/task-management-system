<?php

namespace App\Charts;

use App\Models\Task;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AdminWeeklyTasksBarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Created', [
                Task::where('created_day_id', '1')->get()->count(),
                Task::where('created_day_id', '2')->get()->count(),
                Task::where('created_day_id', '3')->get()->count(),
                Task::where('created_day_id', '4')->get()->count(),
                Task::where('created_day_id', '5')->get()->count(),
                Task::where('created_day_id', '6')->get()->count(),
            ])
            ->addData('Completed', [
                Task::where('completed_day_id', '1')->get()->count(),
                Task::where('completed_day_id', '2')->get()->count(),
                Task::where('completed_day_id', '3')->get()->count(),
                Task::where('completed_day_id', '4')->get()->count(),
                Task::where('completed_day_id', '5')->get()->count(),
                Task::where('completed_day_id', '6')->get()->count(),
            ])
            ->setXAxis(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']);
    }
}
