<?php
include '../includes/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="../productos/productos.php">Productos</a>
        <a href="../clientes/clientes.php">Clientes</a>
    </div>

    <div class="main-content">
        <div class="container">
            <h1>Clientes Registrados</h1>
            <a href="insertar_cliente.php" class="btn">Agregar Cliente</a>
            <table>
                <tr>
                    <th>ID Cliente</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
                <?php
                $query = "SELECT * FROM clientes";
                $result = mysqli_query($conexion, $query);
                while ($cliente = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$cliente['ID_Cliente']}</td>
                        <td>{$cliente['Nombre']}</td>
                        <td>{$cliente['Telefono']}</td>
                        <td>{$cliente['Contacto']}</td>
                        <td>
                            <a href='editar_cliente.php?id={$cliente['ID_Cliente']}' class='btn'>Editar</a> |
                            <a href='eliminar_cliente.php?id={$cliente['ID_Cliente']}' class='btn' onclick='return confirm('¿Está seguro de eliminar este proveedor?');'>Eliminar</a>
                        </td>
                    </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
