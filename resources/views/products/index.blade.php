<x-admin-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Products</h2>
        <a href="{{ route('product.create') }}" class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
            Add Product
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
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Price</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Raw Materials</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                        <td class="py-2 px-4 border-b">
                            @foreach ($product->materials as $material)
                                {{ $material->name }} ({{ $material->pivot->quantity }})@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('product.edit', $product) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <form action="{{ route('product.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
