<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserMonthlyTasksBarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(User $user): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Assigned', [
                User::monthlyTasksAssigned($user, 1)->count(),
                User::monthlyTasksAssigned($user, 2)->count(),
                User::monthlyTasksAssigned($user, 3)->count(),
                User::monthlyTasksAssigned($user, 4)->count(),
                User::monthlyTasksAssigned($user, 5)->count(),
                User::monthlyTasksAssigned($user, 6)->count(),
                User::monthlyTasksAssigned($user, 7)->count(),
                User::monthlyTasksAssigned($user, 8)->count(),
                User::monthlyTasksAssigned($user, 9)->count(),
                User::monthlyTasksAssigned($user, 10)->count(),
                User::monthlyTasksAssigned($user, 11)->count(),
                User::monthlyTasksAssigned($user, 12)->count(),
            ])
            ->addData('Completed', [
                User::monthlyTasksCompleted($user, 1)->count(),
                User::monthlyTasksCompleted($user, 2)->count(),
                User::monthlyTasksCompleted($user, 3)->count(),
                User::monthlyTasksCompleted($user, 4)->count(),
                User::monthlyTasksCompleted($user, 5)->count(),
                User::monthlyTasksCompleted($user, 6)->count(),
                User::monthlyTasksCompleted($user, 7)->count(),
                User::monthlyTasksCompleted($user, 8)->count(),
                User::monthlyTasksCompleted($user, 9)->count(),
                User::monthlyTasksCompleted($user, 10)->count(),
                User::monthlyTasksCompleted($user, 11)->count(),
                User::monthlyTasksCompleted($user, 12)->count(),
            ])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']);
    }
}
