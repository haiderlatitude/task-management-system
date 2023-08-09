<?php

namespace App\Charts;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UserYearlyTasksBarChart
{
    protected $chart;
    protected $years = [];

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
        $tasksCollection = auth()->user()->tasks->sortBy('ascending');
        foreach($tasksCollection as $task){
            $timeStamp = $task->pivot->created_at;
            $year = substr($timeStamp, 0, 4);
            if(!in_array($year, $this->years)){
                array_push($this->years, substr($task->pivot->created_at, 0, 4));
            }
        }
    }

    public function build(User $user): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $tasksAssigned = [];
        $tasksCompleted = []; 
        foreach($this->years as $year){
            array_push($tasksAssigned, User::yearlyTasksAssigned($user, $year)->count());
            array_push($tasksCompleted, User::yearlyTasksCompleted($user, $year)->count());
        }
        return $this->chart->barChart()
            ->addData('Assigned', $tasksAssigned)
            ->addData('Completed', $tasksCompleted)
            ->setXAxis($this->years);
    }
}
