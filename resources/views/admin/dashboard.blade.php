@section('admin_title','Dashboard')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
      @if(session()->has('message'))
        <div class="alert alert-success">
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
          <div class="col-12 col-sm-12 col-lg-6">
            <div class="card ">
              <div class="card-header">
                <h4><b>Overall Tasks Analysis</b></h4>
              </div>
              <div class="card-body">
                <div>
                  {!! $lineChart->container() !!}
                  <script src="{{ $lineChart->cdn() }}"></script>
                  {!! $lineChart->script() !!}
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4><b>Overall Tasks Analysis</b></h4>
              </div>
              <div class="card-body">
                <div>
                  {!! $barChart->container() !!}
                  <script src="{{ $barChart->cdn() }}"></script>
                  {!! $barChart->script() !!}
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
