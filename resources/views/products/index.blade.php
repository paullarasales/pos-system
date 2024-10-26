<x-admin-layout>
    <div class="container">
        <h2>Products</h2>
        <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Raw Materials</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @foreach ($product->materials as $material)
                                {{ $material->name }} ({{ $material->pivot->quantity }})@if(!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $product) }}">Edit</a>
                            <form action="{{ route('product.destroy', $product) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>