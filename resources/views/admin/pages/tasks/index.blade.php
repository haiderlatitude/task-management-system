@section('admin_title','All Tasks')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        @if(session()->has('message'))
            <div class="card py-3 px-5 text-success">
                <b>{{session('message')}}</b>
            </div>
        @endif
        @if ($errors->count() > 0)
          <div class="card py-3 px-5 text-danger">
            <b>{{$errors->first()}}</b>
          </div>
        @endif
        <section class="section">
            <div class="section-body">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="mt-2"><b>All Tasks</b></h4>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                              <th class="text-center">
                                #
                              </th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Created By</th>
                              <th>Assigned To</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($tasks as $task)
                            <tr>
                                <td>
                                  {{$task->id}}
                                </td>
                                <td>{{ $task->name}}</td>
                                <td>
                                  {{$task->description}}
                                </td>
                                <td>
                                    <form action="/admin/update-task-status" method="POST">
                                      @csrf
                                      <input type="hidden" name="taskid" id="taskid" value="{{$task->id}}">
                                      <select name="statusid" id="statusid">
                                        @foreach ($statuses as $status)
                                            <option value="{{$status->id}}" @if ($status->name === $task->status->name)
                                                selected
                                            @endif>{{$status->name}}</option>
                                        @endforeach
                                      </select>
                                      <button class="bg-blue-500 hover:bg-blue-600 text-sm btn-primary mx-2 px-2 py-1 rounded-sm"><i class="bi bi-upload"></i></button>
                                    </form>
                                </td>
                                <td>
                                    @if ($task->creator == null)
                                    None
                                    @else
                                        {{ $task->creator->name }}
                                    @endif
                                </td>
                                <td>
                                    @if ($task->users->first() == null)
                                    None
                                    @else
                                        @foreach ($task->users as $user)
                                            {{ $user->name }}
                                            @if (!$user == $loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-primary">
                                        <i class="bi bi-pencil text-white"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="bi bi-trash text-white"></i>
                                    </a>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </div>
@section('script')
<script src="public/js/taskCrud.js"></script>
@endsection
@endsection