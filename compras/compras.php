<?php 
include '../includes/conexion.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras - Gestión</title>
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
            <h1>Gestión de Compras</h1>

            <!-- Mensajes de Éxito/Error -->
            <?php if (isset($_GET['mensaje'])) { ?>
                <div class="success"><?= $_GET['mensaje']; ?></div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="error"><?= $_GET['error']; ?></div>
            <?php } ?>

            <!-- Lista de Compras Detalladas -->
            <div class="card">
                <h2>Compras Registradas</h2>
                <a href='insertar_compra.php' class='btn'>Realizar Compra de producto</a>
                <table>
                    <thead>
                        <tr>
                            <th>ID Compra</th>
                            <th>Fecha</th>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Categoria</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                           <!--  <th>Acciones</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Consulta para obtener compras detalladas con productos y proveedores
                        $query = "SELECT c.ID_Compra, c.Fecha, p.Nombre AS Proveedor, 
                        pr.Nombre AS Producto, cat.Nombre AS Categoria, 
                        dc.Cantidad, dc.Precio_Unitario, 
                        (dc.Cantidad * dc.Precio_Unitario) AS Total 
                        FROM compras c
                        JOIN proveedores p ON c.ID_Proveedor = p.ID_Proveedor
                        JOIN detalles_compra dc ON c.ID_Compra = dc.ID_Compra
                        JOIN productos pr ON dc.ID_Producto = pr.ID_Producto
                        LEFT JOIN categorias cat ON pr.ID_Categoria = cat.ID_Categoria
                        ORDER BY c.Fecha DESC";
       
                        
                        $result = mysqli_query($conexion, $query);

                        if (!$result) {
                            die("Error en la consulta: " . mysqli_error($conexion));
                        }

                        // Mostrar resultados en la tabla
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_Compra'] . "</td>";
                            echo "<td>" . $row['Fecha'] . "</td>";
                            echo "<td>" . $row['Proveedor'] . "</td>";
                            echo "<td>" . $row['Producto'] . "</td>";
                            echo "<td>" . ($row['Categoria'] ?? 'Sin categoría') . "</td>";
                            echo "<td>" . $row['Cantidad'] . "</td>";
                            echo "<td>$" . number_format($row['Precio_Unitario'], 2) . "</td>";
                            echo "<td>$" . number_format($row['Total'], 2) . "</td>";
                 /*            echo "<td>
                                    <a href='editar_compra.php?id=" . $row['ID_Compra'] . "' class='btn'>Editar</a>
                                    <a href='eliminar_compra.php?id=" . $row['ID_Compra'] . "' class='btn btn-delete'>Eliminar</a>
                                  </td>";*/
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
