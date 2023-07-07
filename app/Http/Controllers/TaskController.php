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
        $statuses = Status::all();
        return view('admin.pages.tasks.index', compact('tasks', 'statuses'));
    }

    public function formToAssignTask() {
        $tasks = Task::all();
        $users = User::all();
        return view('admin.pages.tasks.assign', compact('tasks', 'users'));
    }

    public function formToAddTask() {
        return view('admin.pages.tasks.add');
    }

    public function assignTask(Request $req) {
        try{
            $task = Task::find($req->taskid);
            $user = User::find($req->userid);
            $task->users()->attach($user);
            return response([
                'icon' => 'success', 'message' => 'Task assigned to '.$user->name.' successfully!',
            ]);
        } catch(\Exception $e){
            return response([
                'icon' => 'error', 'message' => 'Some error occured. Please try again later!',
            ]);
        }
    }

    public function updateTaskStatus(Request $req) {
        try{
            $task = Task::find($req->taskid);
            $task->status_id = $req->statusid;
            $task->save();

            return response([
                'icon' => 'success', 'message' => 'Status updated successfully!',
            ]);
        }
        catch(\Exception $e){
            return response([
                'icon' => 'error', 'message' => 'Some error occured!',
            ]);
        }
    }

    public function store(Request $req) {
        if($req->name == '' || $req->description == '' || $req->date == ''){
            return redirect('/admin/add-task')->withErrors('Please fill out all fields!');
        }

        $task = new Task();
        $task->name = $req->name;
        $task->description = $req->description;
        $task->due_date = $req->date;
        $task->creator_id = null;
        $task->save();

        return redirect('/admin/add-task')->with('message', 'Task has been saved successfully!');
    }
}
