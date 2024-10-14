<x-admin-layout>
    <div class="overflow-x-auto mt-6">
        <table class="min-w-full divide-y divide-gray-200 mb-6">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Month</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Revenue</th>
                </tr>
            </thead>
            <tbody id="revenueTableBody" class="bg-white divide-y divide-gray-200">
            </tbody>
        </table>
    </div>

    <canvas id="revenueChart" class="mt-6"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chart;

        async function fetchMonthlyRevenue() {
            const response = await fetch('http://localhost:8000/api/monthly-revenue');
            const data = await response.json();

            const tableBody = document.getElementById('revenueTableBody');
            tableBody.innerHTML = '';

            const labels = [];
            const revenues = [];

            data.monthly_revenue.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.month}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${item.revenue.toFixed(2)}</td>
                `;
                tableBody.appendChild(row);
                
                labels.push(item.month);
                revenues.push(item.revenue);
            });

            const ctx = document.getElementById('revenueChart').getContext('2d');
            if (chart) {
                chart.destroy(); 
            }
            chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Monthly Revenue',
                        data: revenues,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true,
                    }],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        }
        fetchMonthlyRevenue();
    </script>
</x-admin-layout>
