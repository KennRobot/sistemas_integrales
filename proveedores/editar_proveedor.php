<?php
include('../includes/conexion.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM proveedores WHERE ID_Proveedor = $id";
    $result = mysqli_query($conexion, $query);
    $proveedor = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];

        $updateQuery = "UPDATE proveedores SET Nombre = '$nombre', Telefono = '$telefono', Contacto = '$email' WHERE ID_Proveedor = $id";
        if (mysqli_query($conexion, $updateQuery)) {
            echo "<script>alert('Proveedor actualizado exitosamente');</script>";
            echo "<script>window.location.href = 'proveedores.php';</script>";
        } else {
            header("Location: proveedores.php?error=Error al actualizar el proveedor: " . mysqli_error($conexion));
            exit();
        }
    }
} else {
    header("Location: proveedores.php?error=ID no proporcionado");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="sidebar">
        <a href="../index.php">Inicio</a>
        <a href="../compras/compras.php">Compras</a>
        <a href="proveedores.php">Proveedores</a>
    </div>

    <div class="main-content">
        <h1>Editar Proveedor</h1>
        <form action="editar_proveedor.php?id=<?= $proveedor['ID_Proveedor']; ?>" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?= $proveedor['Nombre']; ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?= $proveedor['Telefono']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $proveedor['Contacto']; ?>" required>

            <button type="submit">Actualizar Proveedor</button>
            <a href="proveedores.php" class="btn btn-cancel">Cancelar</a>
        </form>
    </div>
</body>
</html>
