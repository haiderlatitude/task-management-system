@section('admin_title','Assign Tasks')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="card py-3 px-5 text-success">
                <b>{{session('message')}}</b>
            </div>
        @endif
        @if ($errors->count() > 0)
            <div class="card py-3 px-5 text-red-600">
                <b>{{$errors->first()}}</b>
            </div>
        @endif

        <div class="card py-3 px-5">
            <form action="/admin/assign-task" method="POST">
                @csrf
                <p><b>Assign Tasks to Users</b></p>
                <x-input-select :collection="$tasks" :value="'select-task'" :name="'task'" :id="'task'" />
        
                <x-input-select :collection="$users" :value="'select-user'" :name="'user'" :id="'user'" />
        
                <button title="Assign" class="rounded-lg bg-blue-500 hover:bg-blue-600 text-white px-3 py-1">Assign</button>
            </form>
        </div>
    </div>
@endsection