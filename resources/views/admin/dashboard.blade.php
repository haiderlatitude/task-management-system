@section('admin_title','Dashboard')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
      @if(session()->has('message'))
        <div class="card text-success px-3 py-3">
          <b>{{session('message')}}</b>
        </div>
      @endif
      <section class="section">
        <div class="row ">
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                  <div class="row ">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                      <div class="card-content">
                        <h5 class="font-15">New Users</h5>
                        <h2 class="mb-3 font-18">{{$lastWeekUsers->count()}}</h2>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="banner-img">
                        <img src="admin/assets/img/banner/1.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                  <div class="row ">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                      <div class="card-content">
                        <h5 class="font-15">All Users</h5>
                        <h2 class="mb-3 font-18">{{$users->count()}}</h2>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="banner-img">
                        <img src="admin/assets/img/banner/2.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                  <div class="row ">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                      <div class="card-content">
                        <h5 class="font-15">All Tasks</h5>
                        <h2 class="mb-3 font-18">{{$tasks->count()}}</h2>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="banner-img">
                        <img src="admin/assets/img/banner/3.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
              <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                  <div class="row ">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                      <div class="card-content">
                        <h5 class="font-15">Completed Tasks</h5>
                        <h2 class="mb-3 font-18">{{$completedTasks->count()}}</h2>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                      <div class="banner-img">
                        <img src="admin/assets/img/banner/4.png" alt="">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-12 col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h4>Revenue chart</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-9">
                    <div id="chart1"></div>
                    <div class="row mb-0">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="list-inline text-center">
                          <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                              class="col-green"></i>
                            <h5 class="m-b-0">$675</h5>
                            <p class="text-muted font-14 m-b-0">Weekly Earnings</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="list-inline text-center">
                          <div class="list-inline-item p-r-30"><i data-feather="arrow-down-circle"
                              class="col-orange"></i>
                            <h5 class="m-b-0">$1,587</h5>
                            <p class="text-muted font-14 m-b-0">Monthly Earnings</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="list-inline text-center">
                          <div class="list-inline-item p-r-30"><i data-feather="arrow-up-circle"
                              class="col-green"></i>
                            <h5 class="mb-0 m-b-0">$45,965</h5>
                            <p class="text-muted font-14 m-b-0">Yearly Earnings</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="row mt-5">
                      <div class="col-7 col-xl-7 mb-3">Total Users</div>
                      <div class="col-5 col-xl-5 mb-3">
                        <span class="text-big">8,257</span>
                        <sup class="col-green">+09%</sup>
                      </div>
                      <div class="col-7 col-xl-7 mb-3">Total Income</div>
                      <div class="col-5 col-xl-5 mb-3">
                        <span class="text-big">$9,857</span>
                        <sup class="text-danger">-18%</sup>
                      </div>
                      <div class="col-7 col-xl-7 mb-3">Tasks Completed</div>
                      <div class="col-5 col-xl-5 mb-3">
                        <span class="text-big">28</span>
                        <sup class="col-green">+16%</sup>
                      </div>
                      <div class="col-7 col-xl-7 mb-3">Total expense</div>
                      <div class="col-5 col-xl-5 mb-3">
                        <span class="text-big">$6,287</span>
                        <sup class="col-green">+09%</sup>
                      </div>
                      <div class="col-7 col-xl-7 mb-3">New Users</div>
                      <div class="col-5 col-xl-5 mb-3">
                        <span class="text-big">684</span>
                        <sup class="col-green">+22%</sup>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="mt-2"><b>All Task Details</b></h4>
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
                          <td @if($task->status->name == 'pending') class="text-danger" @elseif ($task->status->name == 'in-progress') class="text-warning" @else class="text-success" @endif>
                              {{ ucfirst($task->status->name) }}
                          </td>
                          <td>
                              @if ($task->creator == null)
                              None
                              @else
                                  {{ ucfirst($task->creator->name) }}
                              @endif
                          </td>
                          <td>
                              @if ($task->users->first() == null)
                              None
                              @else
                                  @foreach ($task->users as $user)
                                      {{ ucfirst($user->name) }}
                                      @if (!$user == $loop->last)
                                          ,
                                      @endif
                                  @endforeach
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
      </section>
    </div>
@endsection
