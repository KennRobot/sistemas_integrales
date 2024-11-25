<?php
include '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_producto = $_POST['producto'];
    $cantidad = $_POST['cantidad'];
    $id_cliente = $_POST['cliente'];
    $fecha = date('Y-m-d');

    // Obtener el precio del producto
    $query_producto = "SELECT Precio, Cantidad_Stock FROM productos WHERE ID_Producto = $id_producto";
    $result_producto = mysqli_query($conexion, $query_producto);
    $producto = mysqli_fetch_assoc($result_producto);

    $precio_unitario = $producto['Precio'];
    $stock_actual = $producto['Cantidad_Stock'];

    if ($cantidad > $stock_actual) {
        echo "Error: No hay suficiente stock disponible.";
        exit;
    }

    $total = $precio_unitario * $cantidad;

    // Insertar en la tabla ventas
    $query_venta = "INSERT INTO ventas (Fecha, ID_Cliente, Total) VALUES ('$fecha', $id_cliente, $total)";
    mysqli_query($conexion, $query_venta);
    $id_venta = mysqli_insert_id($conexion);

    // Insertar en la tabla detalles_venta
    $query_detalle = "INSERT INTO detalles_venta (ID_Venta, ID_Producto, Cantidad, Precio_Unitario)
                      VALUES ($id_venta, $id_producto, $cantidad, $precio_unitario)";
    mysqli_query($conexion, $query_detalle);

    // Actualizar el stock del producto
    $nuevo_stock = $stock_actual - $cantidad;
    $query_update_stock = "UPDATE productos SET Cantidad_Stock = $nuevo_stock WHERE ID_Producto = $id_producto";
    mysqli_query($conexion, $query_update_stock);

    if (mysqli_query($conexion, $query_update_stock)) {
        echo "<script>alert('Venta realizada con exitosamente');</script>";
        echo "<script>window.location.href = 'ventas.php';</script>";
    } else {
        header("Location: proveedores.php?error=Error al realizar la venta: " . mysqli_error($conexion));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="../productos/productos.php">Productos</a>
        <a href="../clientes/clientes.php">Clientes</a>
        <a href="ventas.php">Ventas</a>
    </div>

    <div class="main-content">
    <div class="container">

    <h1>Registrar Nueva Venta</h1>
    <form method="POST" action="">
        <label for="producto">Seleccionar Producto:</label>
        <select name="producto" id="producto" required>
            <option value="">Seleccione un producto</option>
            <?php
            $query = "SELECT ID_Producto, Nombre, Cantidad_Stock FROM productos WHERE Cantidad_Stock > 0";
            $result = mysqli_query($conexion, $query);
            while ($producto = mysqli_fetch_assoc($result)) {
                echo "<option value='{$producto['ID_Producto']}'>{$producto['Nombre']} (Stock: {$producto['Cantidad_Stock']})</option>";
            }
            ?>
        </select>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" min="1" required>

        <label for="cliente">Seleccionar Cliente:</label>
        <select name="cliente" id="cliente" required>
            <option value="">Seleccione un cliente</option>
            <?php
            $query = "SELECT ID_Cliente, Nombre FROM clientes";
            $result = mysqli_query($conexion, $query);
            while ($cliente = mysqli_fetch_assoc($result)) {
                echo "<option value='{$cliente['ID_Cliente']}'>{$cliente['Nombre']}</option>";
            }
            ?>
        </select>

        <button type="submit">Registrar Venta</button>
        <a href="ventas.php" class="btn btn-delete">Cancelar</a>
    </form>
</body>
</html>
