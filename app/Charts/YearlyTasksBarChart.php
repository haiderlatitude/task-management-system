<?php

namespace App\Charts;

use App\Models\Task;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class YearlyTasksBarChart
{
    protected $chart;
    protected $years = array();

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $this->years = Task::pluck('created_at');
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->addData('Created', [
                
            ])
            ->addData('Completed', [
                
            ])
            ->setXAxis([substr(Task::find(1)->created_at, 0, 4)]);
    }
}
