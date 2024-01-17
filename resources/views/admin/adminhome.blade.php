<!-- adminhome.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
 

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="py-12 ">
        <form action="{{ route('home') }}" method="GET">
            <input type="text" name="search" placeholder="Search" style="padding: 8px;  border-radius: 4px; margin-right: 5px;">
            <button type="submit" style="padding: 8px 16px; color: white; border: none; border: 1px solid #ccc;border-radius: 4px; cursor: pointer;">Search</button>
        </form>
</div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Name <a href="{{ route('home', ['sort_field' => 'name', 'sort_order' => 'asc']) }}">ASC</a></br>
                                Name <a href="{{ route('home', ['sort_field' => 'name', 'sort_order' => 'desc']) }}">DESC</a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Username <a href="{{ route('home', ['sort_field' => 'username', 'sort_order' => 'asc']) }}">ASC</a></br>
                                Username <a href="{{ route('home', ['sort_field' => 'username', 'sort_order' => 'desc']) }}">DESC</a>
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Department
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach($users as $user)
                            <tr onclick="window.location='{{ route('admin.edit_user', ['user' => $user->id]) }}';" style="cursor: pointer;">

                            <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->username }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $user->department->department_name ?? 'N/A' }}
                                    </td>
                                
                                    <td class="px-6 py-4 whitespace-nowrap">
                                            <form action="{{ route('admin.user.delete', ['user' => $user->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!-- Display pagination links -->

                    </table>
                    <div class="mt-5">
    {{ $users->links() }}
</div>
                </div>
            </div>

            @if(session('status'))
            <div class="alert alert-success text-white">
            {{ session('status') }}
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
