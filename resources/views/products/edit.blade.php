<x-admin-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
        <form action="{{ route('product.update', $product->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="border border-gray-300 p-2 rounded w-full" 
                    value="{{ old('name', $product->name) }}" 
                    required
                >
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    class="border border-gray-300 p-2 rounded w-full" 
                    value="{{ old('price', $product->price) }}" 
                    required
                >
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Raw Materials</label>
                @foreach ($rawMaterials as $material)
                    <div class="flex items-center mb-2">
                        <input 
                            type="checkbox" 
                            name="materials[]" 
                            id="material_{{ $material->id }}" 
                            class="mr-2" 
                            value="{{ $material->id }}" 
                            {{ $product->materials->contains($material->id) ? 'checked' : '' }}
                        >
                        <label class="text-gray-700" for="material_{{ $material->id }}">
                            {{ $material->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
                Update Product
            </button>
        </form>
    </div>
</x-admin-layout>
