<x-admin-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6">Edit Product</h2>
        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" name="name" id="name"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ old('name', $product->name) }}" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                <input type="number" name="price" id="price"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-blue-500"
                    value="{{ old('price', $product->price) }}" required>
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Raw Materials</label>
                @foreach ($rawMaterials as $material)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="materials[{{ $material->id }}][selected]"
                            id="material_{{ $material->id }}" class="mr-2" value="1"
                            {{ $product->materials->contains($material->id) ? 'checked' : '' }}>
                        <label class="text-gray-700" for="material_{{ $material->id }}">
                            {{ $material->name }}
                        </label>
                        <input type="number" name="materials[{{ $material->id }}][quantity]"
                            class="border border-gray-300 p-1 rounded w-24 ml-4"
                            value="{{ old('materials.' . $material->id . '.quantity', $product->materials->find($material->id)->pivot->quantity ?? 0) }}"
                            min="0" placeholder="Quantity (ml/grams)">
                    </div>
                @endforeach
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-medium mb-2">Product Image</label>
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-blue-500">
                @error('photo')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror

                @if ($product->photo)
                    <div class="mt-2">
                        <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}"
                            class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
            </div>

            <button type="submit"
                class="mt-4 bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
                Update Product
            </button>
        </form>
    </div>
</x-admin-layout>
