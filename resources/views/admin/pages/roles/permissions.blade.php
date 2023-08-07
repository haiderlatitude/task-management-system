@section('admin_title','All Roles')
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
                  <h4 class="mt-2"><b>All Permissions</b></h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Assigned To Role</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if ($permissions->first() == null)
                          <tr>
                            <td colspan="3" class="text-center">
                              Nothing to show at the moment!
                            </td>
                          </tr>
                        @else
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                @if ($permission->roles->first() == null)
                                    None
                                @else
                                    @foreach ($permission->roles as $role)
                                        {{$role->name}}
                                        @if(!$role == $loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                          </tr>
                        @endforeach
                        @endif
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