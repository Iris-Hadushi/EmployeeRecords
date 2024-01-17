<x-app-layout>


<div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-semibold mb-4">Create New User</h2>

                    <form action="{{ route('admin.user.create') }}" method="POST">
 @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 text-gray-700 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username:</label>
                            <input type="text" name="username" id="username" class="mt-1 p-2  text-gray-700 border rounded-md w-full" autocomplete="off" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email:</label>
                            <input type="email" name="email" id="email" class="mt-1 p-2 text-gray-700 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password:</label>
                            <input type="password" name="password" id="password" class="mt-1 p-2 text-gray-700 border rounded-md w-full" autocomplete="new-password" required>
                        </div>

                        <div class="mb-4">
                            <label for="department_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department:</label>
                            <select name="department_id" id="department_id" class="mt-1 p-2 text-gray-700 border rounded-md w-full" required>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                                    @endforeach
                            </select>
                         </div>
                         
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create User</button>
                        </div>
                    </form>

                    @if(session('status'))
                        <div class="alert alert-success text-white">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
