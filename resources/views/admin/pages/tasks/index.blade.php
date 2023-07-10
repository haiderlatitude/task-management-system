@section('admin_title','All Tasks')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
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
                                    <select name="status" id="status" onchange="$(this).updateStatus({{$task->id}}, '{{csrf_token()}}')">
                                        @foreach ($statuses as $status)
                                            <option value="{{$status->id}}" @if ($status->name === $task->status->name)
                                                selected
                                            @endif>{{$status->name}}</option>
                                        @endforeach
                                    </select>
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
<script src="{{asset('js/taskCrud.js')}}"></script>
@endsection
@endsection