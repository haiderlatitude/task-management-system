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
        <x-revenue-chart
        />
        <x-dashboard-table
          :tasks="$tasks"
        />
      </section>
    </div>
@endsection
