@section('admin_title','All Users')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
      @if(session()->has('message'))
            <div class="alert alert-success">
                <b>{{session('message')}}</b>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <ul><b>{{$error}}</b></ul>
                @endforeach
            </div>
        @endif
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
                        <form action="/admin/deleted-or-active-users" method="POST">
                          @csrf
                          <div class="inline mr-3">
                            <input type="checkbox" name="active" id="active">
                            <label for="active">Active Users</label>
                          </div>
                          <div class="inline mx-3">
                            <input type="checkbox" name="deleted" id="deleted">
                            <label for="deleted">Deleted Users</label>
                          </div>
                          <button class="bg-blue-500 hover:bg-blue-600 rounded-md text-xs text-white px-2 py-1 mx-3">Show</button>
                        </form>
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                              <th>
                                #
                              </th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Date of Birth</th>
                              <th>Phone Number</th>
                              <th>CNIC</th>
                              <th>Tasks</th>
                              <th>Roles</th>
                              <th>Active/Deleted</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td></td>
                                <td>
                                  {{$user->name}}
                                </td>
                                <td>
                                  {{$user->email}}
                                </td>
                                <td>
                                  {{date('d m Y', strtotime($user->dob))}}
                                </td>
                                <td>
                                  {{$user->phone}}
                                </td>
                                <td>
                                  {{$user->cnic}}
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
                                  @if($user->roles->first() == null)
                                    None
                                  @else
                                    @foreach ($user->roles as $role)
                                      {{ $role->name }}
                                    @if (!$role == $loop->last)
                                      ,
                                    @endif
                                    @endforeach
                                  @endif
                                </td>
                                <td>
                                  @if($user->deleted_at == null)
                                    Active
                                  @else
                                    {{date('d-m-Y | g:i:s A', strtotime($user->deleted_at))}}
                                  @endif
                                </td>
                                <td>
                                    <form action="/admin/edit-user" class="inline" method="POST">@csrf
                                      <input type="hidden" name="userid" id="userid" value="{{$user->id}}">
                                        <button class="bi bi-pencil btn btn-primary text-white @if ($user->hasRole('admin'))
                                          col-10
                                        @endif"></button>
                                    </form>
                                    @if ($user->deleted_at == null)
                                      <form action="/admin/delete-user" method="POST" class="inline" @if ($user->hasRole('admin'))
                                        hidden
                                      @endif>@csrf
                                        <input type="hidden" name="userid" id="userid" value="{{$user->id}}">
                                          <button class="bi bi-trash text-white btn btn-danger"></button>
                                      </form>
                                    @else
                                      <form action="/admin/restore-user" method="POST" class="inline">@csrf
                                        <input type="hidden" name="userid" id="userid" value="{{$user->id}}">
                                          <button><i class="bi bi-bootstrap-reboot text-white btn btn-primary"></i></button>
                                      </form>
                                    @endif
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
@push('styles')
<link rel="stylesheet" href="{{asset('customCSS/rowNumber.css')}}">
@endpush