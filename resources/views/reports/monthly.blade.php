<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold">Monthly Sales Report for {{ $year }}</h1>

        <div class="mt-6">
            <canvas id="revenueChart" width="400" height="200"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'line', // Use a line chart
            data: {
                labels: @json($months), // Month names for the last 12 months
                datasets: [{
                    label: 'Revenue',
                    data: @json($revenues), // Revenue data for the last 12 months
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true, // Fill the area under the line
                    tension: 0.1 // Adjust the tension for smoothness
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
    </script>
</x-app-layout>
