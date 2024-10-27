<x-admin-layout>
    <div class="p-6 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold">Monthly Sales Report</h1>
        
        <div class="mt-4">
            <button id="toggleOnline" class="px-4 py-2 bg-blue-500 text-white rounded">Online Sales</button>
            <button id="toggleWalkIn" class="px-4 py-2 bg-gray-300 text-black rounded">Walk-In Sales</button>
        </div>

        <div id="onlineSales" class="mt-6 transition-opacity duration-300 opacity-100">
            <h2 class="mt-8 text-2xl font-semibold text-gray-700">Online Monthly Revenue</h2>
            <canvas id="revenueChartOnline" class="w-full h-64"></canvas>
            
            <h2 class="mt-8 text-2xl font-semibold text-gray-700">Most Sold Products</h2>
            <canvas id="mostSoldChart" class="w-full h-64"></canvas>
        </div>

        <div id="walkInSales" class="mt-6 transition-opacity duration-300 opacity-0 hidden">
            <h2 class="mt-8 text-2xl font-semibold text-gray-700">Walk-In Monthly Revenue</h2>
            <canvas id="revenueChartWalkIn" class="w-full h-64"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let revenueChartOnline;
        let mostSoldChart;
        let revenueChartWalkIn;

        async function fetchMonthlyRevenueOnline() {
            const response = await fetch('http://localhost:8001/api/monthly-revenue');
            const data = await response.json();

            const labels = data.monthly_revenue.map(item => {
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                return `${monthNames[item.month - 1]} ${item.year}`;
            });

            const revenues = data.monthly_revenue.map(item => item.revenue);

            const ctx = document.getElementById('revenueChartOnline').getContext('2d');
            if (revenueChartOnline) revenueChartOnline.destroy();

            const colors = revenues.map((revenue, index) => {
                return revenue >= (revenues[index - 1] || 0) ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)';
            });

            revenueChartOnline = new Chart(ctx, {
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

        async function fetchMostSoldProducts() {
            const response = await fetch('http://localhost:8001/api/most-sold-products');
            const data = await response.json();

            const productNames = data.most_sold_products.map(product => product.product_name || 'Unknown Product');
            const productQuantities = data.most_sold_products.map(product => product.total_quantity);

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

        async function fetchMonthlyRevenueWalkIn() {
            const currentYear = new Date().getFullYear();
            const response = await fetch(`http://localhost:8000/api/monthly-sales/${currentYear}`);
            const data = await response.json();

            const ctx = document.getElementById('revenueChartWalkIn').getContext('2d');
            if (revenueChartWalkIn) revenueChartWalkIn.destroy();

            revenueChartWalkIn = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.months,
                    datasets: [{
                        label: 'Revenue',
                        data: data.revenues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Revenue'
                            }
                        }
                    }
                }
            });
        }

        function toggleSections(isOnline) {
            const onlineSales = document.getElementById('onlineSales');
            const walkInSales = document.getElementById('walkInSales');

            if (isOnline) {
                onlineSales.classList.remove('hidden', 'opacity-0');
                onlineSales.classList.add('opacity-100');
                walkInSales.classList.remove('opacity-100');
                walkInSales.classList.add('opacity-0', 'hidden');
            } else {
                walkInSales.classList.remove('hidden', 'opacity-0');
                walkInSales.classList.add('opacity-100');
                onlineSales.classList.remove('opacity-100');
                onlineSales.classList.add('opacity-0', 'hidden');
            }
        }

        document.getElementById('toggleOnline').addEventListener('click', () => toggleSections(true));
        document.getElementById('toggleWalkIn').addEventListener('click', () => toggleSections(false));

        fetchMonthlyRevenueOnline();
        fetchMostSoldProducts();
        fetchMonthlyRevenueWalkIn();
    </script>
</x-admin-layout>
