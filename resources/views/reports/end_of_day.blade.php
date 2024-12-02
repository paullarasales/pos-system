<x-app-layout>
    <div class="container mx-auto p-6">
        <form action="{{ route('report.download') }}" method="GET" class="mb-4">
            <input type="hidden" name="date" value="{{ $date }}">
            <input type="hidden" name="totalSales" value="{{ $totalSales }}">
            <input type="hidden" name="productSales" value="{{ json_encode($productSales) }}">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Download
                Report</button>
        </form>
        <h1 class="text-2xl font-bold mb-4">End of Day Report for {{ $date }}</h1>
        <h2 class="text-xl mb-4">Total Sales: ₱{{ number_format($totalSales, 2) }}</h2>

        <h3 class="text-lg mb-2">Product Sales:</h3>
        <table class="table-auto w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Product Name</th>
                    <th class="border border-gray-300 px-4 py-2">Quantity Sold</th>
                    <th class="border border-gray-300 px-4 py-2">Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productSales as $productId => $sales)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $sales['name'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $sales['quantity'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">₱{{ number_format($sales['total'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Chart.js Canvas -->
        <h3 class="text-lg mb-2">Sales Chart:</h3>
        <canvas id="salesChart" width="400" height="200"></canvas>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare data for the chart
        const labels = @json(array_column($productSales, 'name'));
        const quantities = @json(array_column($productSales, 'quantity'));
        const totals = @json(array_column($productSales, 'total'));

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar', // You can change this to 'line', 'pie', etc.
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantity Sold',
                    data: quantities,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Total Sales',
                    data: totals,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
