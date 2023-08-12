<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskAssignRequest;
use App\Http\Requests\TaskStatusUpdateRequest;
use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskAssigned;
use App\Notifications\TaskComplete;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    // List all tasks with status
    public function index()
    {
        $tasks = Task::all();
        $statuses = Status::all();
        return view('admin.pages.tasks.index', compact('tasks', 'statuses'));
    }

    // View for assinging task to user
    public function formToAssignTask()
    {
        $tasks = Task::all();
        $users = User::all();
        return view('admin.pages.tasks.assign', compact('tasks', 'users'));
    }

    // View for adding task
    public function formToAddTask()
    {
        return view('admin.pages.tasks.add');
    }

    // Assign Task 
    public function assignTask(TaskAssignRequest $req)
    {
        try {
            $task = Task::findOrFail($req->task);
            $user = User::findOrFail($req->user);
            $task->users()->attach($user, ['assigned_day_id' => Day::where('name', now()->format('l'))->first()->id]);
            $user->notify(new TaskAssigned($task->name));
            return back()->with('message', 'Task has been assigned successfully!');
        } catch (\Exception $e) {
            return back()->withErrors('Oops! Something went wrong!');
        }
    }

    // Update task status
    public function updateTaskStatus(TaskStatusUpdateRequest $request)
    {
        try {
            $task = Task::findOrFail($request->taskid);
            $task->status_id = $request->statusid;

            if($task->status_id == 2){
                $task->start_time = now();
            }

            // If task status_id is 3 (i.e complete)
            if ($task->status_id == 3) {
                $task->completed_at = now();
                if($task->time_spent == null)
                    $task->time_spent = Carbon::parse($task->start_time)->diff($task->completed_at)->format('%d Days, %h:%i:%s');
                $task->completed_day_id = Day::where('name', now()->format('l'))->first()->id;
                User::find(1)->notify(new TaskComplete($request->user()->name, $task->name)); // Notify admin
            }
            $task->save();

            return back()->with('message', 'Task Status has been updated successfully!');
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    // Store task details
    public function store(TaskStoreRequest $req)
    {
        $req->validate([
            'due_date' => 'after:today',
        ]);
        // dd(Day::where('name', now()->format('l'))->first()->id, now()->dayOfWeek);
        Task::create([
            'name' => $req->name,
            'description' => $req->description,
            'due_date' => Carbon::parse($req->due_date)->endOfDay(),
            'creator_id' => request()->user()->id,
            'created_day_id' => Day::where('name', now()->format('l'))->first()->id,
        ]);

        return redirect('/admin/add-task')->with('message', 'Task has been saved successfully!');
    }

    // View for editing task
    public function editTask($id)
    {
        try {
            $task = Task::findOrFail($id);
            return view('admin.pages.tasks.edit', compact('task'));
        } catch (ModelNotFoundException $e) {
            return back()->withErrors('Unfortunately, we could not find the task with id: '.$id);
        } catch (\Exception $e) {
            return back()->withErrors('Oops! Something went wrong, please try again!');
        }
    }

    // Store edited task details
    public function storeEditedTask(TaskUpdateRequest $request)
    {
        try {
            // try to find and update the task details
            $task = Task::findOrFail($request->taskid);
            $request->validate([
                'due_date' => 'after:' . date('d-m-Y', strtotime($task->created_at)),
            ]);
            $task->update([
                'name' => $request->name,
                'description' => $request->description,
                'due_date' => $request->due_date,
            ]);
            if (!is_null($request->users)) {
                foreach ($request->users as $user) {
                    $task->users()->detach($user);
                }
            }
            $task->save();
            return redirect('/admin/all-tasks')->with('message', 'Task details have been updated successfully!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->getMessage());
        } catch (\Exception $e) {
            return back()->withErrors('Oops! Something went wrong, please try again!');
        }
    }
}
