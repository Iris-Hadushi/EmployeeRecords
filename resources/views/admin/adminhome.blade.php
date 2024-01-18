<!-- adminhome.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                   <!--go back after filtering -->
            @if(request()->has('search') || request()->has('filter_department'))
                <a href="{{ route('home') }}" class="btn text-white p-2"><u><< Back</u></a>
            @endif

            <form action="{{ route('home') }}" method="GET" class="flex items-center py-4" id="searchForm">
                <input type="text" name="search" id="searchInput" placeholder="Search employee..." class="p-2 bg-transparent text-white border-0" style="border-bottom:1px solid white !important">
            </form>

         

            <div class="flex justify-end mb-4">
            <form action="{{ route('home') }}" method="GET" class="flex items-center" id="filterForm">
            <select name="filter_department" id="filterDepartment" class="p-2 bg-transparent text-white" data-placeholder="Choose Department">
    @foreach($departments as $department)
        <option value="{{ $department->department_id }}" class="bg-gray-800" {{ request()->filter_department == $department->department_id ? 'selected' : '' }}>
            {{ $department->department_name }}
        </option>
    @endforeach
</select>
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
                    </table>
                    <div class="mt-5" >
                        {{ $users->links() }}
                    </div>
                </div>
            </div>

            @if(session('status'))
            <div class="alert alert-success mt-3 text-white bg-green-500 p-4 rounded" style="width:100%;height:50px;">
                {{ session('status') }}
            </div>
            @endif
            <script>
                // Add event listener for department change
                document.getElementById('filterDepartment').addEventListener('change', function () {
                    // Set the placeholder text to the selected department name
                    var selectedDepartment = this.options[this.selectedIndex].text;
                    this.setAttribute('data-placeholder', selectedDepartment);

                    // Submit the form when the department is selected
                    document.getElementById('filterForm').submit();
                });

                // Add event listener for 'Enter' key press on search input
                document.getElementById('searchInput').addEventListener('keypress', function (e) {
                    if (e.key === 'Enter') {
                        e.preventDefault(); // Prevent default form submission
                        document.getElementById('searchForm').submit(); // Submit the form
                    }
                });
    </script>
            
        </div>
    </div>
</x-app-layout>
