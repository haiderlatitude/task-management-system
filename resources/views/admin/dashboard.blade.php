@section('admin_title','Dashboard')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        <div class="card py-2 px-2">
            <table style="width: 100%;" class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Sr. No.
                        </th>
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Task Name
                        </th>
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Description
                        </th>
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Status
                        </th>
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Assigned To
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$tasks)
                        <tr>
                            <td colspan="4" class="text-center px-5 py-3 border border-slate-200 text-sm"><b>No Data To Show At The Moment!</b>
                            </td>
                        </tr>
                    @else
                        @foreach ($tasks as $task)
                            <tr class="text-dark">
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->id }}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->name }}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->description }}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{$task->status->name}}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                    @if ($task->users->count() == 0)
                                        <p>No one</p>
                                    @else
                                        @foreach ($task->users as $user)
                                            {{$user->name}}
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
    @section('script')
    <script src="{{ asset('js/taskCrud.js') }}"></script>
    @endsection
@endsection
