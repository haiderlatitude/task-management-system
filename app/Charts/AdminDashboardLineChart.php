<?php

namespace App\Charts;

use App\Models\Task;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AdminDashboardLineChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        return $this->chart->lineChart()
            ->setTitle('Tasks Analysis during current year')
            ->setSubtitle('Tasks Created VS Tasks Completed')
            ->addData('Tasks Created', [
                Task::monthlyTasksCreated(1)->count(),
                Task::monthlyTasksCreated(2)->count(),
                Task::monthlyTasksCreated(3)->count(),
                Task::monthlyTasksCreated(4)->count(),
                Task::monthlyTasksCreated(5)->count(),
                Task::monthlyTasksCreated(6)->count(),
                Task::monthlyTasksCreated(7)->count(),
                Task::monthlyTasksCreated(8)->count(),
                Task::monthlyTasksCreated(9)->count(),
                Task::monthlyTasksCreated(10)->count(),
                Task::monthlyTasksCreated(11)->count(),
                Task::monthlyTasksCreated(12)->count(),
            ])
            ->addData('Tasks Completed', [
                Task::monthlyTasksCompleted(1)->count(),
                Task::monthlyTasksCompleted(2)->count(),
                Task::monthlyTasksCompleted(3)->count(),
                Task::monthlyTasksCompleted(4)->count(),
                Task::monthlyTasksCompleted(5)->count(),
                Task::monthlyTasksCompleted(6)->count(),
                Task::monthlyTasksCompleted(7)->count(),
                Task::monthlyTasksCompleted(8)->count(),
                Task::monthlyTasksCompleted(9)->count(),
                Task::monthlyTasksCompleted(10)->count(),
                Task::monthlyTasksCompleted(11)->count(),
                Task::monthlyTasksCompleted(12)->count(),
            ])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
    }
}
