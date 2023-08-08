<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserWeeklyTasksBarChart
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
                $user->tasks()->wherePivot('assigned_day_id', '=', 1)->count(),
                $user->tasks()->wherePivot('assigned_day_id', '=', 2)->count(),
                $user->tasks()->wherePivot('assigned_day_id', '=', 3)->count(),
                $user->tasks()->wherePivot('assigned_day_id', '=', 4)->count(),
                $user->tasks()->wherePivot('assigned_day_id', '=', 5)->count(),
                $user->tasks()->wherePivot('assigned_day_id', '=', 6)->count(),
            ])
            ->addData('Completed', [
                $user->tasks->where('completed_day_id', '=', 1)->count(),
                $user->tasks->where('completed_day_id', '=', 2)->count(),
                $user->tasks->where('completed_day_id', '=', 3)->count(),
                $user->tasks->where('completed_day_id', '=', 4)->count(),
                $user->tasks->where('completed_day_id', '=', 5)->count(),
                $user->tasks->where('completed_day_id', '=', 6)->count(),
            ])
            ->setXAxis(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);
    }
}
