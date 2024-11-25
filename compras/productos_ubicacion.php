<?php
include '../includes/conexion.php';

// Verificar si se ha pasado el ID de la ubicación
if (isset($_GET['id'])) {
    $id_ubicacion = $_GET['id'];

    // Obtener información de la ubicación
    $query_ubicacion = "SELECT * FROM ubicaciones WHERE ID_Ubicacion = $id_ubicacion";
    $result_ubicacion = mysqli_query($conexion, $query_ubicacion);
    $ubicacion = mysqli_fetch_assoc($result_ubicacion);

    // Obtener productos almacenados en la ubicación
    $query_productos = "
        SELECT p.ID_Producto, p.Nombre, p.Descripcion, s.Cantidad, c.Nombre AS NombreC
        FROM stock s
        INNER JOIN productos p ON s.ID_Producto = p.ID_Producto
        INNER JOIN categorias c ON p.ID_Categoria = c.ID_Categoria
        WHERE s.ID_Ubicacion = $id_ubicacion
    ";
    $result_productos = mysqli_query($conexion, $query_productos);
} else {
    echo "ID de ubicación no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos en <?php echo $ubicacion['Nombre']; ?></title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- Barra Lateral de Navegación -->
    <div class="sidebar">
    <a href="../index.php">Inicio</a>
        <a href="../compras/compras.php">Compras</a>
        <a href="../productos/productos.php">Productos</a>
        <a href="../productos/categorias.php">Categorías</a>
        <a href="ubicaciones.php">Almacenes</a>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container">
            <h1>Productos en <?php echo $ubicacion['Nombre']; ?></h1>

            <!-- Lista de Productos -->
            <div class="card">
                <h2>Productos Registrados</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($producto = mysqli_fetch_assoc($result_productos)) { ?>
                            <tr>
                                <td><?php echo $producto['ID_Producto']; ?></td>
                                <td><?php echo $producto['Nombre']; ?></td>
                                <td><?php echo $producto['Descripcion']; ?></td>
                                <td><?php echo $producto['Cantidad']; ?></td>
                                <td><?php echo $producto['NombreC']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
                <a href="ubicaciones.php" class="btn btn-cancel">Volver</a>
            </div>
        </div>
    </div>
</body>
</html>
