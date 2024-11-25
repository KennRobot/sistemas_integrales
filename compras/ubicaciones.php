<?php 
include '../includes/conexion.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicaciones - Gestión</title>
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
            <h1>Gestión de Almacenes</h1>

            <!-- Mensajes de Éxito/Error -->
            <?php if (isset($_GET['mensaje'])) { ?>
                <div class="success"><?= $_GET['mensaje']; ?></div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="error"><?= $_GET['error']; ?></div>
            <?php } ?>

            <!-- Lista de Ubicaciones -->
            <div class="card">
                <h2>Almacenes Registrados</h2>
                <a href='insertar_ubicaciones.php' class='btn'>Registrar un nuevo almacen</a>
                <table>
                    <thead>
                        <tr>
                            <th>ID Ubicación</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Ver Productos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obtener todas las ubicaciones
                        $query_ubicaciones = "SELECT * FROM ubicaciones";
                        $result_ubicaciones = mysqli_query($conexion, $query_ubicaciones);

                        if (!$result_ubicaciones) {
                            die("Error en la consulta: " . mysqli_error($conexion));
                        }

                        // Mostrar resultados en la tabla
                        while ($ubicacion = mysqli_fetch_assoc($result_ubicaciones)) {
                            echo "<tr>";
                            echo "<td>" . $ubicacion['ID_Ubicacion'] . "</td>";
                            echo "<td>" . $ubicacion['Nombre'] . "</td>";
                            echo "<td>" . $ubicacion['Direccion'] . "</td>";
                            echo "<td><a href='productos_ubicacion.php?id=" . $ubicacion['ID_Ubicacion'] . "' class='btn'>Ver Productos</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
