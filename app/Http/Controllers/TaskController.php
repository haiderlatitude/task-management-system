<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use App\Notifications\TaskComplete;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // List all tasks with status
    public function index() {
        $tasks = Task::all();
        $statuses = Status::all();
        return view('admin.pages.tasks.index', compact('tasks', 'statuses'));
    }

    // View for assinging task to user
    public function formToAssignTask() {
        $tasks = Task::all();
        $users = User::all();
        return view('admin.pages.tasks.assign', compact('tasks', 'users'));
    }

    // View for adding task
    public function formToAddTask() {
        return view('admin.pages.tasks.add');
    }

    // Assign Task
    public function assignTask(Request $req) {
        try{
            $task = Task::find($req->task);
            $user = User::find($req->user);
            $task->users()->attach($user);
            $user->notify(new TaskAssigned($task->name));
            return redirect('/admin/all-tasks')->with('message', 'Task has been assigned successfully!');
        } catch(\Exception $e){
            return back()->withErrors('Something went wrong!');
        }
    }

    // Update task status
    public function updateTaskStatus(Request $req) {
        try{
            $task = Task::find($req->taskid);
            $task->status_id = $req->statusid;

            // If task status_id is 3 (i.e complete)
            if($task->status_id == 3){
                $task->completed_at = now();
                User::find(1)->notify(new TaskComplete($req->user()->name, $task->name));
            }
            $task->save();

            return back()->with('message', 'Task Status has been updated successfully!');

        }
        catch(\Exception $e){
            return back()->withErrors('Something went wrong!');
        }
    }

    // Store task details
    public function store(Request $req) {
        if($req->name == '' || $req->description == '' || $req->date == ''){
            return redirect('/admin/add-task')->withErrors('Please fill out all fields!');
        }
        
        if(Carbon::parse($req->date)->lessThan(now()))
            return back()->withErrors('Due Date cannot be from the past!');

        Task::create([
            'name' => $req->name,
            'description' => $req->description,
            'due_date' => $req->date,
            'creator_id' => request()->user()->id,
        ]);

        return redirect('/admin/add-task')->with('message', 'Task has been saved successfully!');
    }

    // View for editing task
    public function editTask(Request $request) {
        $task = Task::find($request->taskid);
        return view('admin.pages.tasks.edit', compact('task'));
    }

    // Store edited task details
    public function storeEditedTask(Request $request) {
        if($request->name == '' || $request->description == '')
            return redirect('/admin/all-tasks')->withErrors('Name or Description fields cannot be empty!');
            
        $task = Task::find($request->taskid);
        $task->name = $request->name;
        $task->description = $request->description;
        if(!is_null($request->users)){
            foreach($request->users as $user){
                $task->users()->detach($user);
            }
        }
        $task->save();
        return redirect('/admin/all-tasks')->with('message', 'Task details have been updated successfully!');
    }
}
