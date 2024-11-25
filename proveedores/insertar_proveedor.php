<?php
include('../includes/conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];

    $query = "INSERT INTO proveedores (Nombre, Telefono, Contacto) VALUES ('$nombre', '$telefono', '$email')";
    if (mysqli_query($conexion, $query)) {
        echo "<script>alert('Proveedor agregado exitosamente');</script>";
        echo "<script>window.location.href = 'proveedores.php';</script>";
    } else {
        header("Location: proveedores.php?error=Error al agregar el proveedor: " . mysqli_error($conexion));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
     <!-- Barra Lateral de Navegación -->
     <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="../compras/compras.php">Compras</a>
        <a href="../proveedores/proveedores.php">Proveedores</a>
    </div>


    <div class="main-content">
        <h1>Agregar Proveedor</h1>
        <form action="insertar_proveedor.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Agregar Proveedor</button>
            <a href="proveedores.php" class="btn btn-delete">Cancelar</a>
        </form>
    </div>
</body>
</html>
