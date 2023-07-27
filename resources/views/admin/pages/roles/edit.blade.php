@section('admin_title','Edit Role')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <b>{{session('message')}}</b>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><b>{{$error}}</b></li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/admin/store-edited-role/{{$role->id}}" method="POST">
            @csrf
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
                                <input type="text" class="form-control" name="name" id="name" value="{{$role->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Permissions</label>
                            @if($role->permissions->first() == null)
                                <p class="ml-4"><b>No Permissions</b></p>
                            @else
                                <div>
                                    @foreach ($role->permissions as $permission)
                                        <div class="mx-3 my-2 text-dark inline">
                                            <input type="checkbox" class="mx-2" name="permissions[]" id="{{$permission->id}}" value="{{$permission->name}}" checked>
                                            <label for="{{$permission->name}}">{{$permission->name}}</label>
                                        </div>
                                    @endforeach
                                </div>
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
