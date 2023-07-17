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

        <div class="card py-3 px-5 col-lg-6">
            <form action="/admin/assign-role-to-user" method="POST">
                @csrf
                <p><b>Assign Roles to Users</b></p>
                <select class="w-full rounded-lg my-3 text-dark px-3 py-2 outline-none outline-blue-200" name="roles[]" id="role" multiple>
                    @foreach ($roles as $role)
                        <option id="{{$role->id}}" value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
        
                <select type="text" class="w-full rounded-lg my-3 bg-white text-dark px-3 py-2 outline-none outline-blue-200" name="user" id="user">
                    <option value="select-user" selected>-- Select User --</option>
                    @foreach ($users as $user)
                        <option id="{{$user->id}}" value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
        
                <div>
                    <button title="Assign" class="rounded-lg bg-blue-500 hover:bg-blue-600 text-white px-3 py-1">Assign</button>
                </div>
            </form>
        </div>
    </div>
@endsection