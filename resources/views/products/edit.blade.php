<x-admin-layout>
    <div class="container">
        <h2>Edit Product</h2>
        <form action="{{ route('product.update', $product->id) }}" method="POST"> <!-- Use product ID -->
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" required>
            </div>
            <div class="form-group">
                <label for="raw_materials">Raw Materials</label>
                @foreach ($rawMaterials as $material)
                    <div class="form-check">
                        <input 
                            type="checkbox" 
                            name="materials[]" 
                            id="material_{{ $material->id }}" 
                            class="form-check-input" 
                            value="{{ $material->id }}" 
                            {{ $product->materials->contains($material->id) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="material_{{ $material->id }}">
                            {{ $material->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</x-admin-layout>
