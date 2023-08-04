<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class WeeklyTasksBarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Created', [6, 9, 3, 4, 10, 8])
            ->addData('Completed', [7, 3, 8, 2, 6, 4])
            ->setXAxis(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']);
    }
}
