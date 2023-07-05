<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table style="width: 100%;"
                        class="border-collapse border border-slate-200 rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gray-700 text-white">
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Sr. No.
                                </th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Name
                                </th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Email
                                </th>
                                <th scope="col" class="text-start px-5 py-3 border border-slate-200 text-sm">Role
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
                                    <tr>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $user->id }}
                                        </td>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $user->name }}
                                        </td>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">{{ $user->email }}
                                        </td>
                                        <td class="text-start px-5 py-3 border border-slate-200 text-sm">
                                            @foreach ($user->getRoleNames() as $role)
                                                {{ $role }}
                                            @endforeach
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
</x-app-layout>
