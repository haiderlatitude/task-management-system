@section('admin_title','Assign Permission')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <b>{{$error}}</b>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card py-3 px-5 col-lg-6">
            <form action="/admin/assign-permission-to-role" method="POST">
                @csrf
                <p><b>Assign Permissions to Roles</b></p>
                <select class="w-full rounded-lg my-3 bg-gray-100 text-dark px-3 py-2 outline-none outline-blue-200" name="permissions[]" id="permissions" multiple>
                    @foreach ($permissions as $permission)
                        <option id="{{$permission->id}}" value="{{$permission->id}}">{{$permission->name}}</option>
                    @endforeach
                </select>
        
                <select class="w-full rounded-lg my-3 bg-gray-100 text-dark px-3 py-2 outline-none outline-blue-200" name="role" id="role">
                    <option value="" selected>-- Select Role --</option>
                    @foreach ($roles as $role)
                        <option id="{{$role->id}}" value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
        
                <button title="Assign" class="rounded-lg bg-blue-500 hover:bg-blue-600 text-white px-3 py-1">Assign</button>
            </form>
        </div>
    </div>
@endsection