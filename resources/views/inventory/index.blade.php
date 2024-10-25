<x-admin-layout>
    <div class="container">
        <h2>Raw Materials</h2>
        <a href="{{ route('inventory.create') }}" class="btn btn-primary">Add Raw Material</a>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td>{{ $material->name }}</td>
                        <td>{{ $material->quantity }}</td>
                        <td>{{ $material->unit }}</td>
                        <td>
                            <a href="{{ route('inventory.edit', $material) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('inventory.destroy', $material) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>