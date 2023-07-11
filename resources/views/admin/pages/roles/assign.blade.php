@section('admin_title','Assign Roles')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="card py-3 px-5 text-success">
                {{session('message')}}
            </div>
        @endif
        @if ($errors->count() > 0)
            <div class="card py-3 px-5 text-danger">
                {{$errors->first()}}
            </div>
        @endif

        <div class="card py-3 px-5">
            <form action="/admin/assign-role-to-user" method="POST">
                @csrf
                <p><b>Assign Roles to Users</b></p>
                <select class="w-full rounded-lg my-3 bg-gray-100 text-dark px-3 py-2" name="role" id="role">
                    <option value="select-task" selected>-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option id="{{$role->id}}" value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
        
                <select class="w-full rounded-lg my-3 bg-gray-100 text-dark px-3 py-2" name="user" id="user">
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