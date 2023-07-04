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
                            @foreach ($tasks as $task)
                                <tr>
                                    <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->id }}
                                    </td>
                                    <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->name }}
                                    </td>
                                    <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->description }}
                                    </td>
                                    <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $task->status->name }}
                                    </td>
                                    <td class="text-start px-5 py-3 border border-slate-200 text-sm">Assigned To
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('js/taskCrud.js') }}"></script>
</x-app-layout>
