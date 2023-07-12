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
                          <th>Action(s)</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>
                                {{ $task->id }}
                            </td>
                            <td>{{ $task->name }}</td>
                            <td>
                                {{$task->description}}
                            </td>
                            <form action="/users/{{auth()->user()->name}}/update-details" method="POST">
                                @csrf
                                <input type="hidden" name="taskid" id="taskid" value="{{$task->id}}">
                                <td>
                                    <select name="statusid" id="statusid">
                                        @foreach ($statuses as $status)
                                            <option value="{{$status->id}}" @if($status->name == $task->status->name) selected @endif>{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <button class="btn btn-primary">
                                        <i class="bi bi-save text-white"></i>
                                    </button>
                                </td>
                            </form>
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
@endsection