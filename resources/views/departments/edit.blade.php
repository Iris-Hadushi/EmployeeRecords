<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Department') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Edit Department</h2>
                    <form action="{{ route('departments.update', $department->department_id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-4">
            <label for="department_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department Name:</label>
            <input type="text" name="department_name" id="department_name" class="mt-1 p-2 text-gray-700 border rounded-md w-full" value="{{ $department->department_name }}" required>
        </div>

        <div class="mb-4">
            <label for="parent_department_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Parent Department:</label>
            <select name="parent_department_id" id="parent_department_id" class="mt-1 p-2 text-gray-700 border rounded-md w-full">
                <option value="">Select Parent Department</option>
                @foreach($departments->where('parent_department_id', null) as $parentDepartment)
                    <option value="{{ $parentDepartment->department_id }}" {{ $parentDepartment->department_id == $department->parent_department_id ? 'selected' : '' }}>
                        {{ $parentDepartment->department_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="company_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company:</label>
            <select name="company_id" id="company_id" class="mt-1 p-2 text-gray-700 border rounded-md w-full">
                @foreach($companies as $company)
                    <option value="{{ $company->company_id }}" {{ $company->company_id == $department->company_id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Department</button>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
