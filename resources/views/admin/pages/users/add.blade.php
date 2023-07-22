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
                    <x-name-input-field />
                    <x-email-input-field />
                    <x-password-input-field />
                    <x-dob-input-field />
                    <x-phone-input-field />
                    <x-cnic-input-field />
                    <x-role-input-field :roles="$roles" />
                    <div class="mx-4 my-4">
                        <button class="bg-blue-500 hover:bg-blue-600 rounded text-white px-3 py-2">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection