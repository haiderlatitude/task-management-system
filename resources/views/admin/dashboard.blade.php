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
        <x-admin-small-cards
          :users="$users"
          :tasks="$tasks"
          :completedTasks="$completedTasks"
          :lastWeekUsers="$lastWeekUsers"
        />
        <div class="row">
          <div class="col-12 col-sm-12 col-lg-12">
            <div class="card ">
              <div class="card-header">
                <h4><b>Overall Tasks Analysis</b></h4>
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
        <x-dashboard-table
          :tasks="$tasks"
        />
      </section>
    </div>
@endsection
