<x-admin-layout>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Product List</h2>

        @if($products->isEmpty())
            <p class="text-gray-500">No products available.</p>
        @else
            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Description</th>
                        <th class="py-2 px-4 border-b">Price</th>
                        <th class="py-2 px-4 border-b">Quantity</th>
                        <th class="py-2 px-4 border-b">Image</th>
                        <th class="py-2 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $product->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->description }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->price }}</td>
                            <td class="py-2 px-4 border-b">{{ $product->quantity }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($product->photo)
                                    <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">
                                <a href="{{ route('admin.edit', $product->id)}}" class="bg-blue-500 text-md text-white">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-admin-layout>
