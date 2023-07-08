@section('admin_title','Add Tasks')
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
        <form action="/admin/store-task" method="POST">
            @csrf
            <div class="col-12 col-md-6 col-lg-6">
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
                                        <i class="bi bi-list-ul"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Description</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-text-paragraph"></i>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="bi bi-calendar"></i>
                                    </div>
                                </div>
                                <input type="date" class="form-control" name="date" id="date" placeholder="Date">
                            </div>
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
