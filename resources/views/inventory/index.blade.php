<x-admin-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Stock Management</h2>
        <a href="{{ route('inventory.create') }}" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition mb-4">
            Add Raw Material
        </a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Name</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Quantity</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Unit</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $material->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $material->quantity }}</td>
                        <td class="py-2 px-4 border-b">{{ $material->unit }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('inventory.edit', $material) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
