<x-admin-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6">Create Product</h2>
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Product Name</label>
                <input type="text" name="name" id="name"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-blue-500"
                    required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                <input type="text" name="price" id="price"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-blue-500"
                    required>
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <h4 class="text-lg font-semibold mb-4">Select Raw Materials:</h4>
            @foreach ($rawMaterials as $rawMaterial)
                <div class="flex items-center mb-4">
                    <label class="flex items-center mr-4">
                        <input type="checkbox" name="materials[{{ $rawMaterial->id }}][selected]" value="1"
                            class="mr-2">
                        <span class="text-gray-700">{{ $rawMaterial->name }}</span>
                    </label>
                    <input type="number" name="materials[{{ $rawMaterial->id }}][quantity]" value="500"
                        min="1"
                        class="border border-gray-300 p-1 rounded w-24 focus:outline-none focus:ring focus:ring-blue-500">
                </div>
            @endforeach

            <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-medium mb-2">Product Image</label>
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-blue-500">
                @error('photo')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="mt-4 bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
                Create Product
            </button>
        </form>
    </div>
</x-admin-layout>
