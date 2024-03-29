@section('admin_title','All Roles')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
      @if(session()->has('message'))
        <div class="alert alert-success">
            <b>{{session('message')}}</b>
        </div>
      @endif
      @if ($errors->count() > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>
                    <b>{{$error}}</b>
                </li>
          @endforeach
          </ul>
        </div>
      @endif
    <section class="section">
        <div class="section-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="mt-2"><b>All Roles</b></h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Permissions</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @if ($role->permissions->first() == null)
                                    None
                                @else
                                    @foreach ($role->permissions as $permission)
                                        {{$permission->name}}
                                        @if(!$permission == $loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="/admin/edit-role/{{$role->id}}" class="btn btn-primary">
                                    <i class="bi bi-pencil text-white"></i>
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