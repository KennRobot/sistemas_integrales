<?php
include '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($direccion)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Insertar nueva ubicación en la base de datos
        $query = "INSERT INTO ubicaciones (Nombre, Direccion) VALUES ('$nombre', '$direccion')";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            header("Location: ubicaciones.php?mensaje=Ubicación agregada exitosamente");
            exit();
        } else {
            $error = "Error al agregar la ubicación: " . mysqli_error($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Ubicación</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<style>
        /* Estilos adicionales para el formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 500px;
            margin: auto;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            min-height: 120px;
            resize: vertical; /* Permitir redimensionar verticalmente */
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
</style>
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
            <h1>Agregar Nuevo Almacen</h1>

            <!-- Mensajes de Error -->
            <?php if (isset($error)) { ?>
                <div class="error"><?= $error; ?></div>
            <?php } ?>

            <!-- Formulario para Agregar Ubicación -->
            <div class="card">
                <form action="insertar_ubicaciones.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre de la Ubicación:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección:</label>
                        <textarea id="direccion" name="direccion" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn">Agregar Ubicación</button>
                    <a href="ubicaciones.php" class="btn btn-cancel">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
