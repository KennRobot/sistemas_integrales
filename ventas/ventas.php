<?php
include '../includes/conexion.php';

$query = "SELECT v.ID_Venta, v.Fecha, c.Nombre AS Cliente, v.Total
          FROM ventas v
          LEFT JOIN clientes c ON v.ID_Cliente = c.ID_Cliente";
$result = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores - Gestión</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="../productos/productos.php">Productos</a>
        <a href="../clientes/clientes.php">Clientes</a>
        <a href="ventas.php">Ventas</a>
    </div>

    
    <div class="main-content">
    <div class="container">
    <h1>Ventas Realizadas</h1>
    <a href="insertar_venta.php" class="btn">Realizar una venta</a>
    <table>
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Detalles</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['ID_Venta'] ?></td>
                    <td><?= $row['Fecha'] ?></td>
                    <td><?= $row['Cliente'] ?></td>
                    <td>$<?= number_format($row['Total'], 2) ?></td>
                    <td><a href="detalles_venta.php?id=<?= $row['ID_Venta'] ?>" class="btn">Ver Detalles</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
