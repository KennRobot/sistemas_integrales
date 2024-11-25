<?php
include '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];

    // Validar que los campos no estén vacíos
    if (empty($nombre)) {
        header("Location: insertar_categoria.php?error=Todos los campos son obligatorios.");
        exit();
    }

    // Insertar categoría en la base de datos
    $query = "INSERT INTO categorias (Nombre) VALUES ('$nombre')";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        header("Location: categorias.php?mensaje=Categoría agregada exitosamente.");
    } else {
        header("Location: insertar_categoria.php?error=Error al insertar la categoría: " . mysqli_error($conexion));
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Categoría</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
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
            <h1>Agregar Nueva Categoría</h1>

            <!-- Mensajes de Éxito/Error -->
            <?php if (isset($_GET['mensaje'])) { ?>
                <div class="success"><?= $_GET['mensaje']; ?></div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="error"><?= $_GET['error']; ?></div>
            <?php } ?>

            <!-- Formulario para insertar categoría -->
            <div class="card">
                <h2>Formulario de Nueva Categoría</h2>
                <form action="insertar_categoria.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre de la Categoría:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ingresa el nombre" required>
                    </div>
                    <button type="submit" class="btn">Guardar Categoría</button>
                    <a href="categorias.php" class="btn btn-delete">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
