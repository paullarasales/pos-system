<x-admin-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Edit Raw Material</h2>
        <form action="{{ route('inventory.update', $rawMaterial->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="border border-gray-300 p-2 rounded w-full" 
                    value="{{ $rawMaterial->name }}" 
                    required
                >
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
                <input 
                    type="number" 
                    name="quantity" 
                    id="quantity" 
                    class="border border-gray-300 p-2 rounded w-full" 
                    value="{{ $rawMaterial->quantity }}" 
                    required
                >
                @error('quantity')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="unit" class="block text-gray-700 font-medium mb-2">Unit</label>
                <input 
                    type="text" 
                    id="unit" 
                    name="unit" 
                    class="border border-gray-300 p-2 rounded w-full" 
                    value="{{ $rawMaterial->unit }}" 
                    required
                >
                @error('unit')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
                Update Raw Material
            </button>
        </form>
    </div>
</x-admin-layout>
