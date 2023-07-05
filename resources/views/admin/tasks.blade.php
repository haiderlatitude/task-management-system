<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button class="bg-blue-500 hover:bg-blue-600 rounded-lg px-3 py-1 text-white" onclick="$(this).addTask('{{csrf_token()}}')">Add Task</button>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="assignTask">
                        <p><b>Assign Tasks to Users</b></p>
                        <input type="hidden" id="token" value="{{csrf_token()}}">
                        <select class="w-full rounded-lg my-3" name="task" id="task">
                            <option value="select-task" selected>-- Select Task --</option>
                            @foreach ($tasks as $task)
                                <option id="{{$task->id}}" value="{{$task->id}}">{{$task->name}}</option>
                            @endforeach
                        </select>
    
                        <select class="w-full rounded-lg my-3" name="user" id="user">
                            <option value="select-user" selected>-- Select User --</option>
                            @foreach ($users as $user)
                                <option id="{{$user->id}}" value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>

                        <button title="Assign" class="rounded-lg bg-blue-500 hover:bg-blue-600 text-white px-3 py-1">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table style="width: 100%;"
                        class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
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
                                    <tr>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->id }}
                                        </td>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->name }}
                                        </td>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->description }}
                                        </td>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                            <select class="rounded" name="status" id="status" onchange="$(this).updateStatus({{$task->id}}, '{{csrf_token()}}')">
                                                @foreach ($statuses as $status)
                                                    <option value="{{$status->id}}" @if ($status->name === $task->status->name)
                                                        selected
                                                    @endif >{{$status->name}}</option>
                                                @endforeach
                                            </select>
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
        </div>
    </div>
<script src="{{ asset('js/taskCrud.js') }}"></script>
</x-app-layout>
