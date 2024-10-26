<x-admin-layout>
    <div class="container">
        <h2>Edit Raw Material</h2>
        <form action="{{ route('inventory.update', $rawMaterial->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $rawMaterial->name }}" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $rawMaterial->quantity }}" required>
            </div>
            <div>
                <label for="unit">Unit</label>
                <input type="text" id="unit" name="unit" class="form-control" value="{{ $rawMaterial->unit }}"required>
            </div>
            <button type="submit" class="btn btn-primary">Update Raw Material</button>
        </form>
    </div>
</x-admin-layout>