@section('admin_title','Add User')
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
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        @endif
        <form action="/admin/store-user" method="POST">
            @csrf
            <div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mt-2"><b>Enter Details</b></h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'bi bi-person'" />
                                    </div>
                                </div>
                                <x-text-input type="text" class="form-control" name="name" id="name" placeholder="Name" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'bi bi-envelope'" />
                                    </div>
                                </div>
                                <x-text-input type="text" class="form-control" name="email" id="email" placeholder="Email" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'bi bi-key'" />
                                    </div>
                                </div>
                                <x-text-input type="text" class="form-control" name="password" id="password" placeholder="Password" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Date of birth</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'bi bi-calendar'" />
                                    </div>
                                </div>
                                <x-text-input type="date" class="form-control" name="dob" id="dob" placeholder="Date of birth" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Phone</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'bi bi-phone'" />
                                    </div>
                                </div>
                                <x-text-input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>CNIC</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'fa fa-id-card'" />
                                    </div>
                                </div>
                                <x-text-input type="text" class="form-control" name="cnic" id="cnic" placeholder="CNIC Number" />
                            </div>
                        </div>
                    </div>
                    <x-role-input-field :roles="$roles" />
                    <div class="mx-4 my-4">
                        <x-primary-button class="bg-blue-500 hover:bg-blue-600 rounded text-white px-3 py-2">Add</x-primary-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection