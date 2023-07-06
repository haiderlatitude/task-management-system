@section('admin_title','All Users')
@extends('admin.layouts.master')
@section('main-content')
    <div class="main-content">
        <div class="card py-3 px-3">
            <table style="width: 100%;" class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-700 text-white">
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Sr. No.
                        </th>
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Name
                        </th>
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Email Address
                        </th>
                        <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Assigned Task(s)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$users)
                        <tr>
                            <td colspan="4" class="text-center px-5 py-3 border border-slate-200 text-sm"><b>No Data To Show At The Moment!</b>
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $user)
                            <tr class="text-dark">
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $user->id }}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $user->name }}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $user->email }}
                                </td>
                                <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                    @foreach ($user->tasks as $task)
                                        {{ $task->name }}
                                        @if (!$task == $loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection