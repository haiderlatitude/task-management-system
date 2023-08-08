@section('admin_title','All Roles')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
      @if(session()->has('message'))
        <div class="alert alert-success">
            <b>{{session('message')}}</b>
        </div>
      @endif
      @if($message != null)
        <div class="alert alert-warning">
            <b>{{$message}}</b>
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
                <h4 class="mt-2"><b>{{ucfirst($category).'ly'}} Tasks Analysis</b></h4>
              </div>
              <div class="card-body">
                <div>
                  {!! $chart->container() !!}
                  <script src="{{ $chart->cdn() }}"></script>
                  {!! $chart->script() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section">
        <div class="section-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header flex justify-between">
                  <div>
                    <h4 class="mt-2"><b>{{ucfirst($category).'ly'}} Report ({{$timePeriod}})</b></h4>
                    <p class="text-xs text-gray-400">This report by default shows the tasks CREATED in {{$timePeriod}}</p>
                  </div>
                    <form action="/admin/export-{{$category}}ly-report" method="POST">@csrf
                      <input type="hidden" name="tasks" value="{{$tasks}}">
                      <input type="hidden" name="timePeriod" value="{{$timePeriod}}">
                      <button class="bg-blue-500 hover:bg-blue-600 focus:bg-blue-600 px-3 py-2 text-white text-sm rounded-sm mx-2">Export</button>
                    </form>
                </div>
                <div class="card-body">
                    <div class="flex justify-between">
                        <div class="tasksData text-dark inline">
                            <div class="text-dark">
                                Number of tasks created in {{$timePeriod}}: <b>{{$tasks->count()}}</b>
                            </div>
                            <div class="text-dark my-4">
                                Number of tasks completed in {{$timePeriod}}: <b>{{$tasksCompleted->count()}}</b>
                            </div>
                            <div class="text-dark my-4">
                              Completion to Creation ratio: <b>{{round($tasksCompleted->count()/($tasks->count()?:1) *100, 2)}}%</b>
                            </div>
                        </div>
                        <div class="w-3/6">
                          @if(in_array($category, ['month', 'year']))
                            <div class="w-5/6">
                              <form action="/admin/{{$category.'ly'}}-report" method="POST" class="inline w-3/6">@csrf
                                <label for="{{$category}}">{{ucfirst($category)}}:</label><br>
                                <input type="text" class="border border-gray-100 rounded-sm focus:outline-none px-2 py-2 mb-3 w-full" name="{{$category}}"
                                        value="@if($category == 'month' && $timePeriod != 'this month'){{(int)date('m', strtotime($timePeriod))}}@elseif(!in_array($timePeriod, ['this week', 'this month', 'this year'])){{$timePeriod}}@endif"
                                        placeholder="@if($category == 'month') Month Number only, e.g 1 for January @else Usage year - 2023 @endif"><br>
                                        <input type="checkbox" name="completedTasksCheckbox" id="completedTasksCheckbox" @if ($completedTasksCheckbox == 'on')
                                            checked
                                          @endif>
                                        <label for="completedTasksCheckbox">Show {{$timePeriod}}'s COMPLETED Tasks</label><br>
                                <button class="text-xs bg-blue-500 hover:bg-blue-700 rounded-sm px-3 py-2 mb-3 text-white">Go</button>
                              </form>
                            </div>
                          @endif
                          @if($category == 'week')
                            <form action="#" class="float-right">
                              <input type="checkbox" name="completedTasksCheckbox" id="completedTasksCheckbox" @if ($completedTasksCheckbox == 'on') checked @endif>
                              <label for="completedTasksCheckbox">Show {{$timePeriod}}'s COMPLETED Tasks</label>
                              <button class="text-xs text-white bg-blue-500 hover:bg-blue-600 rounded-sm px-2 py-1 mx-3">Go</button>
                            </form>
                          @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Status</th>
                              <th>Year</th>
                              <th>Due Date</th>
                              <th>Complete Date</th>
                              <th>Assigned To</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if ($completedTasksCheckbox == 'on')
                              @foreach ($tasksCompleted as $task)
                                <tr>
                                  <td>{{$task->name}}</td>
                                  <td>
                                    {{$task->description}}
                                  </td>
                                  <td>
                                      {{ucwords(str_replace('-', ' ', $task->status->name))}}
                                  </td>
                                  <td>
                                    {{date('Y', strtotime($task->created_at))}}
                                  </td>
                                  <td>
                                    {{date('d m Y', strtotime($task->due_date))}}
                                  </td>
                                  <td>
                                    @if ($task->completed_at == null)
                                        Pending
                                    @elseif ($task->due_date >= $task->completed_at)
                                        {{date('d m Y', strtotime($task->completed_at))}}
                                    @else
                                        {{date('d m Y', strtotime($task->completed_at))}}
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
                                </tr>
                              @endforeach
                            @else
                              @foreach ($tasks as $task)
                                <tr>
                                  <td>{{$task->name}}</td>
                                  <td>
                                    {{$task->description}}
                                  </td>
                                  <td>
                                      {{ucwords(str_replace('-', ' ', $task->status->name))}}
                                  </td>
                                  <td>
                                    {{date('Y', strtotime($task->created_at))}}
                                  </td>
                                  <td>
                                    {{date('d m Y', strtotime($task->due_date))}}
                                  </td>
                                  <td>
                                    @if ($task->completed_at == null)
                                        Pending
                                    @elseif ($task->due_date >= $task->completed_at)
                                        {{date('d m Y', strtotime($task->completed_at))}}
                                    @else
                                        {{date('d m Y', strtotime($task->completed_at))}}
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