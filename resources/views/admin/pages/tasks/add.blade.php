@section('admin_title','Add Tasks')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <b>{{session('message')}}</b>
            </div>
        @endif
        @if($errors->count() > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <ul><b>{{$error}}</b></ul>
                @endforeach
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
                                        <x-icon :icon="'bi bi-list-ul'" />
                                    </div>
                                </div>
                                <x-text-input type="text" class="form-control" name="name" id="name" placeholder="Name" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Description</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'bi bi-text-paragraph'" />
                                    </div>
                                </div>
                                <x-text-input type="text" class="form-control" name="description" id="description" placeholder="Description" />
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <x-icon :icon="'bi bi-calendar'" />
                                    </div>
                                </div>
                                <x-text-input type="date" class="form-control" name="due_date" id="due_date" placeholder="Date" />
                            </div>
                        </div>
                    </div>
                    <div class="mx-4 my-4">
                        <x-primary-button class="bg-blue-500 hover:bg-blue-600 rounded text-white px-3 py-2">Add</x-primary-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
