@section('admin_title','Assign Tasks')
@extends('admin.layouts.master')
@section('style')
@endsection
@section('main-content')
    <div class="main-content">
        <div class="card py-3 px-5">
            <form id="assignTask">
                <p><b>Assign Tasks to Users</b></p>
                <input type="hidden" id="token" value="{{csrf_token()}}">
                <select class="w-full rounded-lg my-3 bg-gray-200 text-dark px-3 py-2" name="task" id="task">
                    <option value="select-task" selected>-- Select Task --</option>
                    @foreach ($tasks as $task)
                        <option id="{{$task->id}}" value="{{$task->id}}">{{$task->name}}</option>
                    @endforeach
                </select>
        
                <select class="w-full rounded-lg my-3 bg-gray-200 text-dark px-3 py-2" name="user" id="user">
                    <option value="select-user" selected>-- Select User --</option>
                    @foreach ($users as $user)
                        <option id="{{$user->id}}" value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
        
                <button title="Assign" class="rounded-lg bg-blue-500 hover:bg-blue-600 text-white px-3 py-1">Assign</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script src="{{asset('js/taskCrud.js')}}"></script>
@endsection
