<?php 
include '../includes/conexion.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - Gestión</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<style>
    ul {
        list-style: none;
    }
</style>
<body>
    <!-- Barra Lateral de Navegación -->
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="productos.php">Productos</a>
        <a href="categorias.php">Categorias</a>
        <a href="../compras/ubicaciones.php">Almacenes</a>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <div class="container">
            <h1>Gestión de Categorías</h1>

            <!-- Mensajes de Éxito/Error -->
            <?php if(isset($_GET['mensaje'])) { ?>
                <div class="success"><?= $_GET['mensaje']; ?></div>
            <?php } ?>
            <?php if(isset($_GET['error'])) { ?>
                <div class="error"><?= $_GET['error']; ?></div>
            <?php } ?>

            <!-- Lista de Categorías y Productos -->
            <div class="card">
                <h2>Categorías Existentes</h2>
                <a href='insertar_categoria.php?' class='btn'>Agregar Categoría</a>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Productos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obtener las categorías de la base de datos
                        $query = "SELECT * FROM categorias";
                        $result = mysqli_query($conexion, $query);

                        if (!$result) {
                            die("Error en la consulta: " . mysqli_error($conexion));
                        }
                        
                        while ($categoria = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $categoria['Nombre'] . "</td>";

                            // Consulta para obtener los productos de cada categoría
                            $idCategoria = $categoria['ID_Categoria'];
                            $queryProductos = "SELECT Nombre FROM productos WHERE ID_Categoria = $idCategoria";
                            $resultProductos = mysqli_query($conexion, $queryProductos);

                            if (mysqli_num_rows($resultProductos) > 0) {
                                echo "<td><ul>";
                                while ($producto = mysqli_fetch_assoc($resultProductos)) {
                                    echo "<li>" . $producto['Nombre'] . "</li>";
                                }
                                echo "</ul></td>";
                            } else {
                                echo "<td>No hay productos</td>";
                            }

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
