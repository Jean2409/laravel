<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Ventas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start py-10 px-4">

    <h1 class="text-3xl font-bold text-blue-700 mb-8">📊 Dashboard de Ventas</h1>

    <form method="POST" action="/registrar" class="flex flex-col sm:flex-row gap-4 mb-8 w-full max-w-xl">
        @csrf
        <input type="text" name="producto" placeholder="Producto"
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required>

        <input type="number" name="cantidad" placeholder="Cantidad"
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required>

        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
            ➕Agregar
        </button>
    </form>

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-3xl">
        <canvas id="grafico" height="150"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('grafico').getContext('2d');
        let chart;

        async function cargarDatos() {
            const res = await fetch('/datos');
            const datos = await res.json();
            const labels = datos.map(d => d.producto);
            const cantidades = datos.map(d => d.total);

            if (chart) chart.destroy();

            chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cantidad Vendida',
                        data: cantidades,
                        backgroundColor: [
                            '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'
                        ],
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            labels: {
                                color: '#1F2937',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                color: '#4B5563'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#4B5563'
                            }
                        }
                    }
                }
            });
        }

        setInterval(cargarDatos, 2000);
        cargarDatos();
    </script>

</body>
</html>
