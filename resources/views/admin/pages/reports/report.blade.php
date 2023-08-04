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
                <h4 class="mt-2"><b>{{ucfirst($category).'ly'}} Tasks Evaluation</b></h4>
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
                  <h4 class="mt-2"><b>{{ucfirst($category).'ly'}} Report ({{$timePeriod}})</b></h4>
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
                        @if(in_array($category, ['month', 'year']))
                            <form action="/admin/{{$category.'ly'}}-report" method="POST" class="inline w-3/6">@csrf
                                <label for="{{$category}}">{{ucfirst($category)}}:</label>
                                <input type="text" class="border border-gray-100 rounded-sm focus:outline-none px-2 py-2 w-4/6" name="{{$category}}"
                                        placeholder="@if($category == 'month') Month Number only, e.g 1 for January @else Usage year - 2023 @endif">
                                <button class="text-xs bg-blue-500 hover:bg-blue-700 rounded-sm px-3 py-2 text-white">Search</button>
                            </form>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                          <thead>
                            <tr>
                              <th>
                                #
                              </th>
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
                            @foreach ($tasks as $task)
                            <tr>
                                <td></td>
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