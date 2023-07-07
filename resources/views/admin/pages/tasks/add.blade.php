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
        <div class="card py-3 px-5">
            <form action="/admin/store-task" method="POST">
                @csrf
                <p><b>Add Details</b></p>
                <div class="my-3 text-center">
                    <label class="px-3 my-2 text-dark" for="name"><i class="bi bi-list-ul"></i></label>
                    <input type="text" class="bg-gray-200 text-dark rounded-md px-3 my-2 py-2 w-50" name="name" id="name" placeholder="Name"> <br>
                
                    <label class="px-3 my-2 text-dark" for="description"><i class="bi bi-text-paragraph"></i></label>
                    <input type="text" class="bg-gray-200 text-dark rounded-md px-3 my-2 py-2 w-50" name="description" id="description" placeholder="Description"> <br>
                
                    <label class="px-3 my-2 text-dark" for="date"><i class="bi bi-calendar"></i></label>
                    <input type="date" class="bg-gray-200 text-dark rounded-md px-3 my-2 py-2 w-50" name="date" id="date" placeholder="Date"> <br>
                    
                    <div class="text-start">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 my-2 rounded">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
