<x-admin-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6">Products</h2>
        <a href="{{ route('product.create') }}"
            class="inline-block bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">
            Add Product
        </a>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Name
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Price
                        </th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Raw
                            Materials</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                            <td class="py-2 px-4 border-b">
                                @foreach ($product->materials as $material)
                                    {{ $material->name }} ({{ $material->pivot->quantity }})@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('product.edit', $product) }}"
                                    class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="{{ route('product.destroy', $product) }}" method="POST"
                                    style="display:inline;">
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
    </div>
</x-admin-layout>
