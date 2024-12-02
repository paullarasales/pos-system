<x-admin-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Add Raw Material</h1>
        <form action="{{ route('inventory.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" id="name" name="name" required
                    class="border border-gray-300 p-2 rounded w-full">
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
                <input type="number" id="quantity" name="quantity" required
                    class="border border-gray-300 p-2 rounded w-full">
                @error('quantity')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="unit" class="block text-gray-700 font-medium mb-2">Unit</label>
                <input type="text" id="unit" name="unit" required
                    class="border border-gray-300 p-2 rounded w-full">
                @error('unit')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
                Add Raw Materials
            </button>
        </form>
    </div>
</x-admin-layout>
