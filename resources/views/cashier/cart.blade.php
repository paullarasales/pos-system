<x-app-layout>
    <div class="flex flex-col md:flex-row gap-6 p-4">

        <!-- Available Products Section -->
        <div class="w-full md:w-1/2 bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-4">Available Products</h2>

            <!-- Show All Products Button -->
            <form action="{{ route('cashier.cart') }}" method="GET" class="mb-4">
                <button type="submit" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">Show All
                    Products</button>
            </form>

            <!-- Search Form -->
            <form action="{{ route('cashier.cart') }}" method="GET" class="mb-4">
                <input type="text" name="search" placeholder="Search products..."
                    class="border border-gray-300 p-2 rounded w-full focus:outline-none focus:ring focus:ring-blue-500">
                <button type="submit"
                    class="mt-2 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Search</button>
            </form>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 text-left">Product</th>
                        <th class="py-2 px-4 text-left">Price</th>
                        <th class="py-2 px-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4 flex items-center">
                                <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}"
                                    class="w-16 h-16 object-cover rounded mr-2">
                                {{ $product->name }}
                            </td>
                            <td class="py-2 px-4">₱{{ number_format($product->price, 2) }}</td>
                            <td class="py-2 px-4">
                                <form action="{{ route('cashier.addToCart', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">Add to
                                        Cart</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order Summary Section -->
        <div class="w-full md:w-1/2 bg-white rounded-lg shadow p-4">
            <h2 class="text-xl font-semibold mb-4">Order Summary</h2>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b">
                        <th class="py-2 px-4 text-left">Product</th>
                        <th class="py-2 px-4 text-left">Price</th>
                        <th class="py-2 px-4 text-left">Quantity</th>
                        <th class="py-2 px-4 text-left">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach (session('cart', []) as $id => $item)
                        @php
                            $product = \App\Models\Product::find($id);
                            if ($product) {
                                $itemTotal = $product->price * $item['quantity'];
                                $total += $itemTotal;
                            }
                        @endphp
                        @if ($product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4 flex items-center">
                                    <img src="{{ asset($product->photo) }}" alt="{{ $product->name }}"
                                        class="w-16 h-16 object-cover rounded mr-2">
                                    {{ $product->name }}
                                </td>
                                <td class="py-2 px-4">₱{{ number_format($product->price, 2) }}</td>
                                <td class="py-2 px-4">{{ $item['quantity'] }}</td>
                                <td class="py-2 px-4">₱{{ number_format($itemTotal, 2) }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 text-lg font-semibold">Total: ₱{{ number_format($total, 2) }}</div>

            <form action="{{ route('cashier.checkout') }}" method="POST" class="mt-4">
                @csrf
                <button type="submit"
                    class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 w-full">Checkout</button>
            </form>

            <!-- Cancel Button -->
            <form action="{{ route('cashier.cancel') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit"
                    class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 w-full">Cancel</button>
            </form>
        </div>
    </div>
</x-app-layout>
