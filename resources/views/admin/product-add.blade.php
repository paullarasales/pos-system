<x-admin-layout>
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold mb-4">Create New Product</h2>
    </div>

    <!-- Error messages -->
    <div id="error-messages" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative hidden" role="alert">
        <ul id="error-list"></ul>
    </div>

    <!-- Success message -->
    <div id="success-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative hidden" role="alert">
        Product created successfully!
    </div>

    <!-- Product form -->
    <form id="product-form" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="form-group">
            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="name" class="form-input mt-1 block w-full" id="name" required>
        </div>

        <div class="form-group">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" cols="30" rows="4" class="form-textarea mt-1 block w-full" required></textarea>
        </div>

        <div class="form-group">
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" name="price" class="form-input mt-1 block w-full" id="price" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
            <input type="number" name="quantity" class="form-input mt-1 block w-full" id="quantity" required>
        </div>

        <div class="form-group">
            <label for="photo" class="block text-sm font-medium text-gray-700">Product Image</label>
            <input type="file" name="photo" class="form-input mt-1 block w-full" id="photo">
        </div>

        <button type="submit" class="btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Product</button>
    </form>

    <!-- JavaScript Section -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ensure error and success messages are hidden on page load
            const errorMessages = document.getElementById('error-messages');
            const successMessage = document.getElementById('success-message');

            // Hide messages on page load
            errorMessages.classList.add('hidden');
            successMessage.classList.add('hidden');
        });

        document.getElementById('product-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const errorMessages = document.getElementById('error-messages');
            const successMessage = document.getElementById('success-message');
            const errorList = document.getElementById('error-list');

            // Hide previous messages
            errorMessages.classList.add('hidden');
            successMessage.classList.add('hidden');
            errorList.innerHTML = '';

            // Form data
            const form = document.getElementById('product-form');
            const formData = new FormData(form);

            try {
                const response = await fetch("{{ route('products.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    successMessage.classList.remove('hidden');
                    form.reset();
                } else {
                    if (data.errors) {
                        data.errors.forEach(error => {
                            const li = document.createElement('li');
                            li.textContent = error;
                            errorList.appendChild(li);
                        });
                        errorMessages.classList.remove('hidden');
                    }
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
</x-admin-layout>
