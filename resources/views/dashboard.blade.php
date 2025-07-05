<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de Control - Barber Studio
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gráfico de barras: Ingresos últimos 7 días -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold mb-4">Ingresos de los últimos 7 días</h3>
                <canvas id="ingresosChart" height="120"></canvas>
            </div>

            <!-- Gráfico circular: Métodos de pago -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold mb-4">Métodos de pago usados</h3>
                <canvas id="metodosPagoChart" height="120"></canvas>
            </div>
        </div>

        <!-- Top servicios vendidos -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold mb-4">Servicios más solicitados</h3>
                <canvas id="topServiciosChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ingresos últimos 7 días
        const ingresosData = @json($ingresos);
        const ingresosLabels = ingresosData.map(i => i.fecha);
        const ingresosTotales = ingresosData.map(i => i.total);

        new Chart(document.getElementById('ingresosChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: ingresosLabels,
                datasets: [{
                    label: 'S/ Ingresos',
                    data: ingresosTotales,
                    backgroundColor: '#6366f1',
                    borderRadius: 8,
                }]
            },
            options: {
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Métodos de pago
        const metodosPago = @json($metodos_pago);
        const metodosLabels = Object.keys(metodosPago);
        const metodosValores = Object.values(metodosPago);
        const metodosColores = ['#111', '#06d6a0', '#ffd166', '#118ab2'];

        new Chart(document.getElementById('metodosPagoChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: metodosLabels,
                datasets: [{
                    data: metodosValores,
                    backgroundColor: metodosColores,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { weight: 'bold' } }
                    }
                }
            }
        });

        // Top servicios vendidos
        const topServicios = @json($top_servicios);
        const topLabels = topServicios.map(s => s.nombre);
        const topValores = topServicios.map(s => s.total);

        new Chart(document.getElementById('topServiciosChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: topLabels,
                datasets: [{
                    label: 'Reservas',
                    data: topValores,
                    backgroundColor: '#10b981',
                    borderRadius: 8,
                }]
            },
            options: {
                indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: { beginAtZero: true }
                }
            }
        });
    </script>
</x-app-layout>
