@section('admin_title','All Permissions')
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
                          <th>
                            #
                          </th>
                          <th>Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if($permissions->first() == null)
                            <tr>
                                <td class="text-center" colspan="2">
                                    <b>Nothing to show at the moment!</b>
                                </td>
                            </tr>
                        @else
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>
                                    {{ $permission->id }}
                                </td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                            @endforeach
                        @endempty
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