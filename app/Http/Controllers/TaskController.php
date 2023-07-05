<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        $users = User::all();
        $statuses = Status::all();
        return view('admin.tasks', compact('tasks', 'users', 'statuses'));
    }

    public function assignTask(Request $req) {
        $task = Task::find($req->taskid);
        $user = User::find($req->userid);
        if($task && $user){
            $task->users()->attach($user);
        }
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
