@section('admin_title','Edit Task')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <b>{{session('message')}}</b>
            </div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
              <ul><b>{{$error}}</b></ul>
            @endforeach
          </div>
        @endif
        <form action="/admin/store-edited-task" method="POST">
            @csrf @method('put')
            <input type="hidden" name="taskid" id="taskid" value="{{$task->id}}">
            <div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mt-2"><b>Enter Details to update</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" id="name" value="{{$task->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-text-paragraph"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="description" id="description" value="{{$task->description}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Due Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="due_date" id="due_date" value="{{$task->due_date}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        YYYY-MM-DD HH:MM:SS
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-list-check"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="status" id="status" value="{{$task->status->name}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Created By</label>
                            <p class="ml-4"><b>{{ucfirst($task->creator->name)}}</b></p>
                        </div>
                        <div class="form-group">
                            <label>Assigned To</label>
                            <div class="text-danger"><sub>*Check the check-boxes below to remove the task from User</sub></div>
                            @if($task->users->first() == null)
                                <p class="ml-4"><b>No One</b></p>
                            @else
                                @foreach ($task->users as $user)
                                    <div class="mx-3 my-2 text-dark">
                                        <input type="checkbox" class="mx-2" name="users[]" id="{{$user->id}}" value="{{$user->id}}">
                                        <label for="{{$user->id}}">{{$user->name}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="mx-4 my-4">
                        <button class="bg-blue-500 hover:bg-blue-600 rounded text-white px-3 py-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
