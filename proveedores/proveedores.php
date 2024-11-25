<?php
include('../includes/conexion.php');

// Consulta para obtener todos los proveedores
$query = "SELECT * FROM proveedores";
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
        <a href="../compras/compras.php">Compras</a>
        <a href="proveedores.php">Proveedores</a>
    </div>

    <div class="main-content">
        <h1>Gestión de Proveedores</h1>
        <a href="insertar_proveedor.php" class="btn">Agregar Proveedor</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            <?php while ($proveedor = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $proveedor['ID_Proveedor']; ?></td>
                    <td><?= $proveedor['Nombre']; ?></td>
                    <td><?= $proveedor['Telefono']; ?></td>
                    <td><?= $proveedor['Contacto']; ?></td>
                    <td>
                        <a href="editar_proveedor.php?id=<?= $proveedor['ID_Proveedor']; ?>" class='btn'>Editar</a>
                        <a href="eliminar_proveedor.php?id=<?= $proveedor['ID_Proveedor']; ?>" class='btn' onclick="return confirm('¿Está seguro de eliminar este proveedor?');">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
