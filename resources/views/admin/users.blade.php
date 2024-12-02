<x-admin-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Employee Management</h1>

        <!-- Form for adding an employee -->
        <form action="{{ route('employees.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-6">
            @csrf
            <h2 class="text-xl font-semibold mb-4">Add New Employee</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group">
                    <label for="employee_number" class="block text-sm font-medium text-gray-700">Employee Number</label>
                    <input type="text"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                        id="employee_number" name="employee_number" required>
                </div>
                <div class="form-group">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                        id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                        id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                        id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-500"
                        id="last_name" name="last_name" required>
                </div>
            </div>
            <button type="submit"
                class="mt-4 w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600 transition duration-200">Add
                Employee</button>
        </form>

        <hr class="my-6">

        <!-- Table for displaying employees -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Employee Number</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Username</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">First
                            Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last
                            Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $employee->employee_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $employee->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $employee->first_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $employee->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $employee->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
