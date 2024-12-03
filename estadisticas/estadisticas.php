<?php
include('../includes/conexion.php');

// Consultas para obtener estadísticas detalladas
$queryClientes = "SELECT COUNT(*) AS total_clientes FROM clientes";
$resultClientes = mysqli_query($conexion, $queryClientes);
$totalClientes = mysqli_fetch_assoc($resultClientes)['total_clientes'];

$queryProductos = "SELECT COUNT(*) AS total_productos FROM productos";
$resultProductos = mysqli_query($conexion, $queryProductos);
$totalProductos = mysqli_fetch_assoc($resultProductos)['total_productos'];

$queryVentas = "SELECT COUNT(*) AS total_ventas FROM ventas";
$resultVentas = mysqli_query($conexion, $queryVentas);
$totalVentas = mysqli_fetch_assoc($resultVentas)['total_ventas'];

$queryProveedores = "SELECT COUNT(*) AS total_proveedores FROM proveedores";
$resultProveedores = mysqli_query($conexion, $queryProveedores);
$totalProveedores = mysqli_fetch_assoc($resultProveedores)['total_proveedores'];

$queryCompras = "SELECT COUNT(*) AS total_compras FROM compras";
$resultCompras = mysqli_query($conexion, $queryCompras);
$totalCompras = mysqli_fetch_assoc($resultCompras)['total_compras'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Detallados</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .sidebar {
            position: fixed;
            width: 200px;
            height: 100%;
            background-color: #2c3e50;
            color: #fff;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #16a085;
        }
        .main-content {
            margin-left: 220px;
            padding: 20px;
            flex: 1;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #2c3e50;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin: 10px 0;
            font-size: 18px;
        }
        .chart-container {
            margin: 20px 0;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .chart-container canvas {
            max-height: 300px;
        }
        button {
            margin-top: 10px;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <!-- Botón de Menú -->
    <button class="menu-button" id="menuButton">☰</button>
    <div class="sidebar">
        <a href="../index.html">Inicio</a>
        <a href="estadisticas.php">Estadísticas</a>
        <a href="../productos/productos.php">Productos</a>
        <a href="../ventas/ventas.php">Ventas</a>
        <a href="../clientes/clientes.php">Clientes</a>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>Reporte Detallado del Sistema</h1>

            <div class="chart-container">
                <h2>Distribución de Datos</h2>
                <canvas id="generalChart"></canvas>
                <button onclick="downloadChart('generalChart', 'Distribucion_Datos.pdf')">Descargar Gráfico</button>
            </div>

            <div class="chart-container">
                <h2>Comparativa de Estadísticas</h2>
                <canvas id="comparativeChart"></canvas>
                <button onclick="downloadChart('comparativeChart', 'Comparativa_Estadisticas.pdf')">Descargar Gráfico</button>
            </div>
        </div>
    </div>

    <footer>
        Churros con Canela y Azúcar S.A. de C.V.
    </footer>

    <script>
        const totalClientes = <?php echo $totalClientes; ?>;
        const totalProductos = <?php echo $totalProductos; ?>;
        const totalVentas = <?php echo $totalVentas; ?>;
        const totalProveedores = <?php echo $totalProveedores; ?>;
        const totalCompras = <?php echo $totalCompras; ?>;

        // Configuración del gráfico 1 (Pie Chart)
        const ctx1 = document.getElementById('generalChart').getContext('2d');
        new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Clientes', 'Productos', 'Ventas', 'Proveedores', 'Compras'],
                datasets: [{
                    data: [totalClientes, totalProductos, totalVentas, totalProveedores, totalCompras],
                    backgroundColor: ['#3498db', '#e74c3c', '#2ecc71', '#f1c40f', '#9b59b6'],
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'top' } } }
        });

        // Configuración del gráfico 2 (Bar Chart)
        const ctx2 = document.getElementById('comparativeChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Clientes', 'Productos', 'Ventas', 'Proveedores', 'Compras'],
                datasets: [{
                    label: 'Totales',
                    data: [totalClientes, totalProductos, totalVentas, totalProveedores, totalCompras],
                    backgroundColor: '#3498db',
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Función para descargar gráfico como PDF
        async function downloadChart(chartId, filename) {
            const { jsPDF } = window.jspdf; // Obtén la instancia de jsPDF
            const canvas = document.getElementById(chartId);
            const imgData = canvas.toDataURL('image/png');
            
            const pdf = new jsPDF({
                orientation: 'landscape',
                unit: 'mm',
                format: 'a4',
            });

            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

            pdf.addImage(imgData, 'PNG', 10, 10, pdfWidth - 20, pdfHeight - 20);
            pdf.save(filename);
        }
    </script>
</body>
</html>
