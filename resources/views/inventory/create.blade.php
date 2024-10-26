<x-admin-layout>
    <div>
        <h1>Add Raw Material</h1>
        <form action="{{ route('inventory.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>
            <div>
                <label for="unit">Unit</label>
                <input type="text" id="unit" name="unit" required>
            </div>
            <button type="submit">Add Raw Materials</button>
        </form>
    </div>
</x-admin-layout>