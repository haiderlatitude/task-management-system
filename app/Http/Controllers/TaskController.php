<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return view('admin.tasks', compact('tasks'));
    }

    public function store(Request $req) {
        if($req->name == '' || $req->description == '' || $req->date == ''){
            return response([
                'icon' => 'error', 'message' => 'Please fill out all fields!',
            ]);
        }

        $task = new Task();
        $task->name = $req->name;
        $task->description = $req->description;
        $task->due_date = $req->date;
        $task->save();

        return response([
            'icon' => 'success', 'message' => 'Task has been saved successfully!',
        ]);
    }
}
