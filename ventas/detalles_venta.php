<?php
include '../includes/conexion.php';

// Verificar si se ha recibido el ID de la venta
if (isset($_GET['id'])) {
    $id_venta = $_GET['id'];

    // Consulta para obtener los detalles de la venta
    $query_venta = "SELECT v.ID_Venta, v.Fecha, c.Nombre AS Cliente, v.Total
                    FROM ventas v
                    LEFT JOIN clientes c ON v.ID_Cliente = c.ID_Cliente
                    WHERE v.ID_Venta = $id_venta";
    $result_venta = mysqli_query($conexion, $query_venta);
    $venta = mysqli_fetch_assoc($result_venta);

    // Verificar si se encontró la venta
    if (!$venta) {
        echo "Venta no encontrada.";
        exit;
    }

    // Consulta para obtener los detalles de los productos vendidos
    $query_detalles = "SELECT p.Nombre AS Producto, dv.Cantidad, dv.Precio_Unitario,
                       (dv.Precio_Unitario * 0.16) AS IVA,
                       (dv.Precio_Unitario * 1.16) AS Precio_Unitario_Con_IVA,
                       (dv.Cantidad * dv.Precio_Unitario * 1.16) AS Subtotal
                       FROM detalles_venta dv
                       LEFT JOIN productos p ON dv.ID_Producto = p.ID_Producto
                       WHERE dv.ID_Venta = $id_venta";
    $result_detalles = mysqli_query($conexion, $query_detalles);
} else {
    echo "ID de venta no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Venta</title>
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
            <h1>Detalles de la Venta #<?= $venta['ID_Venta'] ?></h1>
            <p><strong>Fecha:</strong> <?= $venta['Fecha'] ?></p>
            <p><strong>Cliente:</strong> <?= $venta['Cliente'] ?></p>
            <p><strong>Total:</strong> $<?= number_format($venta['Total'], 2) ?></p>

            <h2>Productos Vendidos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario (sin IVA)</th>
                        <th>IVA</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($detalle = mysqli_fetch_assoc($result_detalles)) { ?>
                        <tr>
                            <td><?= $detalle['Producto'] ?></td>
                            <td><?= $detalle['Cantidad'] ?></td>
                            <td>$<?= number_format($detalle['Precio_Unitario'], 2) ?></td>
                            <td>$<?= number_format($detalle['IVA'], 2) ?></td>
                            <td>$<?= number_format($detalle['Subtotal'], 2) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="ventas.php" class="btn">Volver a Ventas</a>
        </div>
    </div>
</body>
</html>
