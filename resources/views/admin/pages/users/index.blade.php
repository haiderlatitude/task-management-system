@section('admin_title','All Users')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h4 class="mt-2"><b>All Users</b></h4>
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
                              <th>Email</th>
                              <th>Tasks</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>
                                  {{$user->id}}
                                </td>
                                <td>{{ $user->name}}</td>
                                <td>
                                  {{$user->email}}
                                </td>
                                <td>
                                    @if ($user->tasks->first() == null)
                                    None
                                    @else
                                        @foreach ($user->tasks as $task)
                                            {{ $task->name }}
                                            @if (!$task == $loop->last)
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
@endsection