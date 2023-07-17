@section('admin_title','Edit User')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="card py-3 px-5 text-success">
                <b>{{session('message')}}</b>
            </div>
        @endif
        @if($errors->count() > 0)
            <div class="card py-3 px-5 text-danger">
                <b>{{$errors->first()}}</b>
            </div>
        @endif
        <form action="/admin/store-edited-user" method="POST">
            @csrf
            <input type="hidden" name="userid" id="userid" value="{{$user->id}}">
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
                                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                                <input type="date" class="form-control" name="dob" id="dob" value="{{$user->dob}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-phone"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>CNIC No.</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-id-card"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="cnic" id="cnic" value="{{$user->cnic}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Assigned Roles</label>
                            @if($user->roles->first() == null)
                            <p class="ml-4"><b>None</b></p>
                            @else
                                <div class="text-danger text-xs">*Check the check-boxes below to remove the role from this User</div>
                                @foreach ($user->roles as $role)
                                    <div class="mx-3 my-2 text-dark">
                                        <input type="checkbox" class="mx-2" name="roles[]" id="{{$role->id}}" value="{{$role->id}}" @if ($role->name == 'admin' && $user->name == 'admin')
                                            disabled
                                        @endif>
                                        <label for="{{$role->id}}">{{$role->name}}</label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    <div class="mx-4 my-4">
                        <button class="bg-blue-500 hover:bg-blue-600 rounded text-white px-3 py-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
