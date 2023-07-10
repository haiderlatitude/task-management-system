@section('admin_title','Dashboard')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
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
                        <img src="assets/img/banner/1.png" alt="">
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
                        <img src="assets/img/banner/2.png" alt="">
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
                        <img src="assets/img/banner/3.png" alt="">
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
                        <img src="assets/img/banner/4.png" alt="">
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
        <div class="row">
          <div class="col-md-6 col-lg-12 col-xl-6">
            <!-- Support tickets -->
            <div class="card">
              <div class="card-header">
                <h4>Support Ticket</h4>
                <form class="card-header-form">
                  <input type="text" name="search" class="form-control" placeholder="Search">
                </form>
              </div>
              <div class="card-body">
                <div class="support-ticket media pb-1 mb-3">
                  <img src="assets/img/users/user-1.png" class="user-img mr-2" alt="">
                  <div class="media-body ml-3">
                    <div class="badge badge-pill badge-success mb-1 float-right">Feature</div>
                    <span class="font-weight-bold">#89754</span>
                    <a href="javascript:void(0)">Please add advance table</a>
                    <p class="my-1">Hi, can you please add new table for advan...</p>
                    <small class="text-muted">Created by <span class="font-weight-bold font-13">John
                        Deo</span>
                      &nbsp;&nbsp; - 1 day ago</small>
                  </div>
                </div>
                <div class="support-ticket media pb-1 mb-3">
                  <img src="assets/img/users/user-2.png" class="user-img mr-2" alt="">
                  <div class="media-body ml-3">
                    <div class="badge badge-pill badge-warning mb-1 float-right">Bug</div>
                    <span class="font-weight-bold">#57854</span>
                    <a href="javascript:void(0)">Select item not working</a>
                    <p class="my-1">please check select item in advance form not work...</p>
                    <small class="text-muted">Created by <span class="font-weight-bold font-13">Sarah
                        Smith</span>
                      &nbsp;&nbsp; - 2 day ago</small>
                  </div>
                </div>
                <div class="support-ticket media pb-1 mb-3">
                  <img src="assets/img/users/user-3.png" class="user-img mr-2" alt="">
                  <div class="media-body ml-3">
                    <div class="badge badge-pill badge-primary mb-1 float-right">Query</div>
                    <span class="font-weight-bold">#85784</span>
                    <a href="javascript:void(0)">Are you provide template in Angular?</a>
                    <p class="my-1">can you provide template in latest angular 8.</p>
                    <small class="text-muted">Created by <span class="font-weight-bold font-13">Ashton Cox</span>
                      &nbsp;&nbsp; -2 day ago</small>
                  </div>
                </div>
                <div class="support-ticket media pb-1 mb-3">
                  <img src="assets/img/users/user-6.png" class="user-img mr-2" alt="">
                  <div class="media-body ml-3">
                    <div class="badge badge-pill badge-info mb-1 float-right">Enhancement</div>
                    <span class="font-weight-bold">#25874</span>
                    <a href="javascript:void(0)">About template page load speed</a>
                    <p class="my-1">Hi, John, can you work on increase page speed of template...</p>
                    <small class="text-muted">Created by <span class="font-weight-bold font-13">Hasan
                        Basri</span>
                      &nbsp;&nbsp; -3 day ago</small>
                  </div>
                </div>
              </div>
              <a href="javascript:void(0)" class="card-footer card-link text-center small ">View
                All</a>
            </div>
            <!-- Support tickets -->
          </div>
          <div class="col-md-6 col-lg-12 col-xl-6">
            <div class="card">
              <div class="card-header">
                <h4>Projects Payments</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Client Name</th>
                        <th>Date</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>John Doe </td>
                        <td>11-08-2018</td>
                        <td>NEFT</td>
                        <td>$258</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Cara Stevens
                        </td>
                        <td>15-07-2018</td>
                        <td>PayPal</td>
                        <td>$125</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>
                          Airi Satou
                        </td>
                        <td>25-08-2018</td>
                        <td>RTGS</td>
                        <td>$287</td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>
                          Angelica Ramos
                        </td>
                        <td>01-05-2018</td>
                        <td>CASH</td>
                        <td>$170</td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>
                          Ashton Cox
                        </td>
                        <td>18-04-2018</td>
                        <td>NEFT</td>
                        <td>$970</td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>
                          John Deo
                        </td>
                        <td>22-11-2018</td>
                        <td>PayPal</td>
                        <td>$854</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>
                          Hasan Basri
                        </td>
                        <td>07-09-2018</td>
                        <td>Cash</td>
                        <td>$128</td>
                      </tr>
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
