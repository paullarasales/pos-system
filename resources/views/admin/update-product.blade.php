<x-admin-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Edit Product</h2>

        <div id="error-messages" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul id="error-list"></ul>
        </div>

        <div id="success-message" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            Product updated successfully!
        </div>

        <form id="update-product-form" enctype="multipart/form-data" method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT') 
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Product Name</label>
                <input type="text" name="name" class="form-control border rounded w-full py-2 px-3" id="name" value="{{ $product->name }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control border rounded w-full py-2 px-3" required>{{ $product->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
                <input type="number" name="price" class="form-control border rounded w-full py-2 px-3" id="price" value="{{ $product->price }}" step="0.01" required>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-gray-700 font-bold mb-2">Quantity</label>
                <input type="number" name="quantity" class="form-control border rounded w-full py-2 px-3" id="quantity" value="{{ $product->quantity }}" required>
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700 font-bold mb-2">Product Image</label>
                <input type="file" name="photo" class="form-control-file border rounded w-full py-2 px-3" id="photo">
                <div class="mt-2">
                    @if($product->photo)
                        <img id="product-image" src="{{ asset($product->photo) }}" alt="{{ $product->name }}" class="h-16 w-16 object-cover mt-2">
                    @else
                        <span class="text-gray-500">No Image</span>
                    @endif
                </div>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Product</button>
        </form>
    </div>

    <script>
        document.getElementById('update-product-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    document.getElementById('error-messages').classList.add('d-none');
    document.getElementById('success-message').classList.add('d-none');
    document.getElementById('error-list').innerHTML = '';

    const form = document.getElementById('update-product-form');
    const formData = new FormData(form);

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
            },
            body: formData
        });

        const data = await response.json();
        console.log("Response data:", data);

        if (response.ok) {
            document.getElementById('success-message').textContent = data.success; // Set success message
            document.getElementById('success-message').classList.remove('d-none');

            setTimeout(() => {
                window.location.href = '/admin/product';
            }, 1000);
        } else {
            if (data.errors) {
                const errorList = document.getElementById('error-list');
                data.errors.forEach(error => {
                    const li = document.createElement('li');
                    li.textContent = error;
                    errorList.appendChild(li);
                });
                document.getElementById('error-messages').classList.remove('d-none');
            }
        }
    } catch (error) {
        console.error('Error:', error);
    }
});

    </script>
</x-admin-layout>
