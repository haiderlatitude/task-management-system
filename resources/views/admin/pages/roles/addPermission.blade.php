@section('admin_title','Add Role')
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
        <form action="/admin/store-permission" method="POST">
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
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name must be unique">
                            </div>
                        </div>
                        <div class="text-sm text-dark">
                            *You can also enter multiple comma separated permission names at once!
                        </div>
                    </div>
                    <div class="mx-4 my-4">
                        <button class="bg-blue-500 hover:bg-blue-600 rounded text-white px-3 py-2">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
