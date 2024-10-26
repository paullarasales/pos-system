<x-admin-layout>
    <form action="{{ route('product.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>
        
        <h4>Select Raw Materials:</h4>
        @foreach ($rawMaterials as $rawMaterial) 
            <div class="form-group">
                <label>
                    <input type="checkbox" name="materials[{{ $rawMaterial->id }}][selected]" value="1">
                    {{ $rawMaterial->name }}
                </label>
                <input type="number" name="materials[{{ $rawMaterial->id }}][quantity]" value="500" min="1" style="width: 100px;">
            </div>
        @endforeach
        
        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</x-admin-layout>
