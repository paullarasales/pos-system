<x-admin-layout>
    <div class="p-6 bg-white shadow rounded-lg">
        <canvas id="revenueChart" class="w-full h-64"></canvas>
    </div>

    <h2 class="mt-8 text-2xl font-semibold text-gray-700">Most Sold Products</h2>

    <div class="p-6 bg-white shadow rounded-lg">
        <canvas id="mostSoldChart" class="w-full h-64"></canvas>
    </div>

    <div class="mt-4 overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Quantity Sold</th>
                </tr>
            </thead>
            <tbody id="mostSoldProductsTable" class="bg-white divide-y divide-gray-200">

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let revenueChart;
        let mostSoldChart;

        async function fetchMonthlyRevenue() {
            const response = await fetch('http://192.168.2.103:8000/api/monthly-revenue');
            const data = await response.json();

            const labels = data.monthly_revenue.map(item => {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                return `${monthNames[item.month - 1]} ${item.year}`;
            });

            const revenues = data.monthly_revenue.map(item => item.revenue);

            const ctx = document.getElementById('revenueChart').getContext('2d');
            if (revenueChart) revenueChart.destroy(); 

            const colors = revenues.map((revenue, index) => {
                return revenue >= (revenues[index - 1] || 0) ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)';
            });

            revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: revenues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: colors,
                        borderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.3
                        }
                    }
                }
            });
        }
        //added product chart
        async function fetchMostSoldProducts() {
            const response = await fetch('http://192.168.2.103:8000/api/most-sold-products');
            const data = await response.json();

            const productNames = data.most_sold_products.map(product => product.product_name || 'Unknown Product');
            const productQuantities = data.most_sold_products.map(product => product.total_quantity);

            const tableBody = document.getElementById('mostSoldProductsTable');
            tableBody.innerHTML = '';
            data.most_sold_products.forEach(product => {
                const row = document.createElement('tr');
                row.classList.add('hover:bg-gray-50');
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${product.product_name || 'Unknown Product'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${product.total_quantity}</td>
                `;
                tableBody.appendChild(row);
            });

            const ctx = document.getElementById('mostSoldChart').getContext('2d');
            if (mostSoldChart) mostSoldChart.destroy();

            mostSoldChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: productNames,
                    datasets: [{
                        label: 'Total Quantity Sold',
                        data: productQuantities,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        fetchMonthlyRevenue();
        fetchMostSoldProducts();
    </script>
</x-admin-layout>