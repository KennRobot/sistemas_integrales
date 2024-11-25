<?php 
include('includes/conexion.php'); 

// Consultas para obtener el total de productos, clientes y ventas
$totalProductosQuery = "SELECT COUNT(*) as total FROM productos";
$totalClientesQuery = "SELECT COUNT(*) as total FROM clientes";
$totalVentasQuery = "SELECT COUNT(*) as total FROM ventas";

// Ejecutar las consultas
$totalProductosResult = mysqli_query($conexion, $totalProductosQuery);
$totalClientesResult = mysqli_query($conexion, $totalClientesQuery);
$totalVentasResult = mysqli_query($conexion, $totalVentasQuery);

// Obtener los resultados
$totalProductos = mysqli_fetch_assoc($totalProductosResult)['total'];
$totalClientes = mysqli_fetch_assoc($totalClientesResult)['total'];
$totalVentas = mysqli_fetch_assoc($totalVentasResult)['total'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
        /* Estilos Generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            width: 200px;
            height: 100%;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 15px;
            font-size: 14px;
            transition: 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            flex: 1;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .dashboard {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background-color: #ecf0f1;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h2 {
            color: #34495e;
            font-size: 20px;
        }

        .card p {
            color: #27ae60;
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }

        .success, .error {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            width: 100%;
        }

        .success {
            background-color: #2ecc71;
            color: white;
        }

        .error {
            background-color: #e74c3c;
            color: white;
        }

        .image-container {
            text-align: center;
            margin: 20px 0;
        }

        .image-container img {
            width: 100px;
            border-radius: 50%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .about {
            background-color: #fff;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
    <!-- Barra Lateral de Navegación -->
    <div class="sidebar">
        <a href="productos/productos.php">Productos</a>
        <a href="ventas/ventas.php">Ventas</a>
        <a href="proveedores/proveedores.php">Proveedores</a>
        <a href="compras/compras.php">Compras</a>
        <a href="compras/ubicaciones.php">Almacenes</a>
        <a href="clientes/clientes.php">Clientes</a>
        <a href="estadisticas/estadisticas.php">Estadísticas</a>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container">
            <h1>Bienvenido al Panel de Control</h1>

            <!-- Imagen decorativa -->
            <div class="image-container">
                <img src="assets/img/images.jpg" alt="Logo">
            </div>

            <!-- Mensajes de Éxito/Error -->
            <?php if (isset($_GET['mensaje'])) { ?>
                <div class="success"><?= $_GET['mensaje']; ?></div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="error"><?= $_GET['error']; ?></div>
            <?php } ?>

            <!-- Tarjetas con Información -->
            <div class="dashboard">
                <div class="card">
                    <h2>Total Productos</h2>
                    <p><?= $totalProductos; ?></p>
                </div>
                <div class="card">
                    <h2>Total Clientes</h2>
                    <p><?= $totalClientes; ?></p>
                </div>
                <div class="card">
                    <h2>Total Ventas</h2>
                    <p><?= $totalVentas; ?></p>
                </div>
            </div>

            <!-- Sección adicional de contenido -->
            <div class="about">
                <h2>Sobre el Sistema</h2>
                <p>Este panel de control te permite gestionar los productos, clientes y ventas de forma eficiente. Utiliza las herramientas del menú lateral para navegar entre las diferentes funcionalidades.</p>
                <p>Además, contamos con estadísticas detalladas y opciones avanzadas para mejorar tu experiencia.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        Churros con Canela y Azúcar S.A. de C.V.
    </footer>
</body>
</html>
