<?php

namespace App\Charts;

use App\Models\Task;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AdminYearlyTasksBarChart
{
    protected $chart;
    protected $years = [];

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $yearsCollection = Task::pluck('created_at');
        foreach($yearsCollection as $item){
            if(!in_array(substr((string)$item, 0, 4), $this->years)){
                array_push($this->years, substr((string)$item, 0, 4));
            }
        }
        unset($yearsCollection);
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $createdData = [];
        $completedData = [];
        foreach($this->years as $year){
            array_push($createdData, Task::yearlyTasksCreated($year)->count());
            array_push($completedData, Task::yearlyTasksCompleted($year)->count());
        }
        return $this->chart->barChart()
            ->addData('Created', $createdData)
            ->addData('Completed', $completedData)
            ->setXAxis($this->years);
    }
}
